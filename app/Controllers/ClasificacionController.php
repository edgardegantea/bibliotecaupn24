<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ClasificacionModel;

class ClasificacionController extends BaseController
{
    public function index()
    {
        $clasificacionModel = new ClasificacionModel();
        $data['clasificaciones'] = $clasificacionModel->findAll(); // Obtener todas las clasificaciones

        return view('admin/clasificaciones/index', $data); // Mostrar la vista con la lista de clasificaciones
    }

    public function create()
    {
        return view('admin/clasificaciones/form'); // Mostrar el formulario para crear una nueva clasificación
    }

    public function store()
    {
        $clasificacionModel = new ClasificacionModel();

        $data = [
            'nombre' => $this->request->getPost('nombre'),
        ];

        if ($clasificacionModel->insert($data)) {
            session()->setFlashdata('success', 'Clasificación creada con éxito');
        } else {
            session()->setFlashdata('error', 'Error al crear la clasificación');
        }

        return redirect()->to('/admin/clasificaciones');
    }

    public function edit($id)
    {
        $clasificacionModel = new ClasificacionModel();
        $data['clasificacion'] = $clasificacionModel->find($id);

        if (!$data['clasificacion']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Clasificación no encontrada');
        }

        return view('admin/clasificaciones/form', $data);
    }

    public function update($id)
    {
        $clasificacionModel = new ClasificacionModel();

        $data = [
            'nombre' => $this->request->getPost('nombre'),
        ];

        if ($clasificacionModel->update($id, $data)) {
            session()->setFlashdata('success', 'Clasificación actualizada con éxito');
        } else {
            session()->setFlashdata('error', 'Error al actualizar la clasificación');
        }

        return redirect()->to('/admin/clasificaciones');
    }

    public function delete($id)
    {
        $clasificacionModel = new ClasificacionModel();

        if ($clasificacionModel->delete($id)) {
            session()->setFlashdata('success', 'Clasificación eliminada con éxito');
        } else {
            session()->setFlashdata('error', 'Error al eliminar la clasificación');
        }

        return redirect()->to('/admin/clasificaciones');
    }
}
