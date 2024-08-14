<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\AutorModel;

class Autores extends ResourceController
{
    protected $modelName = 'App\Models\AutorModel';



    public function index()
    {
        $data['autores'] = $this->model->findAll();
        return view('admin/autores/index', $data);
    }



    public function show($id = null)
    {
        $data['autor'] = $this->model->find($id);
        if (!$data['autor']) {
            return redirect()->to('/autores')->with('error', 'Autor no encontrado');
        }
        return view('admin/autores/show', $data);
    }



    public function new()
    {
        return view('admin/autores/form');
    }



    public function create()
    {
        $rules = $this->model->validationRules;
        $rules['foto'] = 'uploaded[foto]|max_size[foto,1024]|is_image[foto]';

        if ($this->validate($rules)) {
            $imagen = $this->request->getFile('foto');
            if ($imagen->isValid() && !$imagen->hasMoved()) {
                $nombreImagen = $imagen->getRandomName();
                $imagen->move(ROOTPATH . 'public/uploads', $nombreImagen);
                $data = $this->request->getPost();
                $data['foto'] = $nombreImagen;
            }

            $this->model->insert($data);

            return redirect()->to('/admin/autores')->with('success', 'Autor creado exitosamente');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }



    public function edit($id = null)
    {
        $data['autor'] = $this->model->find($id);
        if (!$data['autor']) {
            return redirect()->to('/admin/autores')->with('error', 'Autor no encontrado');
        }
        return view('admin/autores/form', $data);
    }



    public function update($id = null)
    {
        // ... (lógica de actualización similar al método create, pero usando $this->model->update($id, $data))
        $rules = $this->model->validationRules;
        $rules['foto'] = 'permit_empty|max_size[foto,1024]|is_image[foto]';

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $imagen = $this->request->getFile('foto');
        $data = $this->request->getPost();
        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            $nombreImagen = $imagen->getRandomName();
            $imagen->move(ROOTPATH . 'public/uploads', $nombreImagen);
            // Eliminar la imagen anterior si existe
            $autor = $this->model->find($id);
            if ($autor['foto']) {
                unlink(ROOTPATH . 'public/uploads/' . $autor['foto']);
            }
            $data['foto'] = $nombreImagen;
        }

        $this->model->update($id, $data);

        return redirect()->to('/admin/autores')->with('success', 'Autor actualizado exitosamente');
    }



    public function delete($id = null)
    {
        $autor = $this->model->find($id);
        if ($autor === null) {
            return redirect()->to('/admin/autores')->with('error', 'Autor no encontrado');
        }

        if ($autor['foto']) {
            unlink(ROOTPATH . 'public/uploads/' . $autor['foto']); // Eliminar la imagen
        }
        $this->model->delete($id);

        return redirect()->to('/admin/autores')->with('success', 'Autor eliminado exitosamente');
    }
}
