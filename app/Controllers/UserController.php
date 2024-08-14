<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class UserController extends ResourceController
{
    protected $modelName = 'App\Models\UserModel';
    protected $format = 'json';

    public function index()
    {
        $data['users'] = $this->model->findAll();
        return view('admin/users/index', $data);
    }

    public function show($id = null)
    {
        $user = $this->model->find($id);
        if (!$user) {
            return $this->failNotFound('Usuario no encontrado');
        }
        return $this->respond($user);
    }

    public function new()
    {
        return view('admin/users/form');
    }




    public function create()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|valid_email|is_unique[users.email]',
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $this->validator->getErrors()
            ])->setStatusCode(400);
        }

        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        ];

        $this->model->save($data);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Usuario registrado con éxito',
            'redirect' => base_url('admin/users')
        ]);
    }







    public function edit($id = null)
    {
        $user = $this->model->find($id);

        if (!$user) {
            return $this->failNotFound('User not found');
        }

        return view('admin/users/form', ['user' => $user]);
    }

    public function update($id = null)
    {
        if (!$id) {
            return $this->failValidationError('Invalid ID');
        }

        $user = $this->model->find($id);

        if (!$user) {
            return $this->failNotFound('User not found');
        }

        $rules = [
            'name' => 'required',
            'email' => 'required|valid_email|is_unique[users.email,id,' . $id . ']',
            'username' => 'required|min_length[3]|is_unique[users.username,id,' . $id . ']',
        ];

        if ($this->request->getVar('password')) {
            $rules['password'] = 'required|min_length[8]';
            $rules['confirm_password'] = 'required|matches[password]';
        }

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $this->validator->getErrors()
            ])->setStatusCode(400);
        }

        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
        ];

        if ($this->request->getVar('password')) {
            $data['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        }

        $this->model->update($id, $data);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Usuario actualizado con éxito',
            'redirect' => base_url('admin/users')
        ]);
    }



    public function delete($id = null)
    {
        if (!$id) {
            return $this->failValidationError('ID inválido');
        }

        $user = $this->model->find($id);

        if (!$user) {
            return $this->failNotFound('Usuario no encontrado en la base de datos');
        }

        if ($this->model->delete($id)) {
            return redirect()->to(base_url('admin/users'))->with('success', 'Usuario eliminado con éxito');
        } else {
            return $this->failServerError('La operación ha fallado. Favor de contactar con el desarrollador del sistema.');
        }
    }
}
