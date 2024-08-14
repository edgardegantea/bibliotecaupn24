<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\EditorialModel;

class Editoriales extends ResourceController
{
    protected $modelName = 'App\Models\EditorialModel';

    // Mostrar lista de editoriales
    public function index()
    {
        $data['editoriales'] = $this->model->findAll();
        return view('admin/editoriales/index', $data);
    }

    // Mostrar detalles de una editorial
    public function show($id = null)
    {
        $data['editorial'] = $this->model->find($id);
        if (!$data['editorial']) {
            return redirect()->to('/admin/editoriales')->with('error', 'Editorial no encontrada');
        }
        return view('admin/editoriales/show', $data);
    }

    // Mostrar formulario para crear una nueva editorial
    public function new()
    {
        return view('admin/editoriales/form', ['validation' => \Config\Services::validation()]);
    }

    // Procesar el formulario de creación
    public function create()
    {
        $data = $this->request->getPost();

        if (!$this->model->validate($data)) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        $this->model->insert($data);
        return redirect()->to('/admin/editoriales')->with('success', 'Editorial creada exitosamente');
    }

    // Mostrar formulario para editar una editorial
    public function edit($id = null)
    {
        $data['editorial'] = $this->model->find($id);
        if (!$data['editorial']) {
            return redirect()->to('/admin/editoriales')->with('error', 'Editorial no encontrada');
        }
        return view('admin/editoriales/form', $data); // Reutilizar la misma vista 'form'
    }

    // Procesar el formulario de edición
    public function update($id = null)
    {
        $data = $this->request->getPost();

        // Verificar si la editorial existe
        if (!$this->model->find($id)) {
            return redirect()->to('/admin/editoriales')->with('error', 'Editorial no encontrada');
        }

        // Reglas de validación para actualizar, permitiendo que el nombre sea el mismo
        $validationRules = $this->model->validationRules;
        // $validationRules['nombre'] = "required|min_length[3]|is_unique[editoriales.nombre]";

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, $data);
        return redirect()->to('/admin/editoriales')->with('success', 'Editorial actualizada exitosamente');
    }

    // Eliminar una editorial
    public function delete($id = null)
    {
        $this->model->delete($id);
        return redirect()->to('/admin/editoriales')->with('success', 'Editorial eliminada exitosamente');
    }
}
