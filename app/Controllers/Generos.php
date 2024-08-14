<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\GeneroModel;

class Generos extends ResourceController
{
    protected $model = 'App\Models\GeneroModel';



    public function __construct()
    {
        $this->model = new GeneroModel();
        helper('form');
    }



    public function index()
    {
        $data['generos'] = $this->model->findAll();
        return view('admin/generos/index', $data);
    }



    public function show($id = null)
    {
        $data['genero'] = $this->model->find($id);
        if (!$data['genero']) {
            return redirect()->to('/admin/generos')->with('error', 'Género no encontrado');
        }
        return view('admin/generos/show', $data);
    }

    
    
    public function new()
    {
        return view('admin/generos/form', ['validation' => \Config\Services::validation()]);
    }

    

    public function create()
    {
        $data = $this->request->getPost();

        if (!$this->model->validate($data)) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        $this->model->insert($data);
        return redirect()->to('/admin/generos')->with('success', 'Género creado exitosamente');
    }

    

    public function edit($id = null)
    {
        $data['genero'] = $this->model->find($id);
        if (!$data['genero']) {
            return redirect()->to('/admin/generos')->with('error', 'Género no encontrada');
        }
        return view('admin/generos/form', $data);
    }



    public function update($id = null)
    {
        $data = $this->request->getPost();

        if (!$this->model->find($id)) {
            return redirect()->to('/admin/generos')->with('error', 'Género no encontrada');
        }

        $validationRules = $this->model->validationRules;

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, $data);
        return redirect()->to('/admin/generos')->with('success', 'Género actualizada exitosamente');
    }

    

    public function delete($id = null)
    {
        $this->model->delete($id);
        return redirect()->to('/admin/generos')->with('success', 'Género eliminada exitosamente');
    }
}
