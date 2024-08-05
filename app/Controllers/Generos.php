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
        return view('generos/index', $data);
    }



    public function show($id = null)
    {
        $data['genero'] = $this->model->find($id);
        if (!$data['genero']) {
            return redirect()->to('/generos')->with('error', 'Género no encontrado');
        }
        return view('generos/show', $data);
    }

    // Mostrar formulario para crear una nueva genero
    public function new()
    {
        return view('generos/form', ['validation' => \Config\Services::validation()]);
    }

    // Procesar el formulario de creación
    public function create()
    {
        $data = $this->request->getPost();

        if (!$this->model->validate($data)) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        $this->model->insert($data);
        return redirect()->to('/generos')->with('success', 'Género creado exitosamente');
    }

    // Mostrar formulario para editar una genero
    public function edit($id = null)
    {
        $data['genero'] = $this->model->find($id);
        if (!$data['genero']) {
            return redirect()->to('/generos')->with('error', 'Género no encontrada');
        }
        return view('generos/form', $data); // Reutilizar la misma vista 'form'
    }

    // Procesar el formulario de edición
    public function update($id = null)
    {
        $data = $this->request->getPost();

        // Verificar si la genero existe
        if (!$this->model->find($id)) {
            return redirect()->to('/generos')->with('error', 'Género no encontrada');
        }

        // Reglas de validación para actualizar, permitiendo que el nombre sea el mismo
        $validationRules = $this->model->validationRules;
        // $validationRules['nombre'] = "required|min_length[3]|is_unique[generos.nombre]";

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, $data);
        return redirect()->to('/generos')->with('success', 'Género actualizada exitosamente');
    }

    // Eliminar una genero
    public function delete($id = null)
    {
        $this->model->delete($id);
        return redirect()->to('/generos')->with('success', 'Género eliminada exitosamente');
    }
}
