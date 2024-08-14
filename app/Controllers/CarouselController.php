<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\CarouselModel;

class CarouselController extends BaseController
{
    private $db;
    private $carouselModel;

    public function __construct()
    {
        helper(['url', 'form', 'session']);
        $this->db = \Config\Database::connect();
        $this->carouselModel = new CarouselModel();
        $this->session = \Config\Services::session();
    }


    public function index()
    {
        $model = new CarouselModel();
        $data['carouselItems'] = $model->findAll();

        return view('admin/carousel/index', $data); 
    }

    public function create()
    {
        return view('admin/carousel/create');
    }

    public function store()
    {
        $model = new CarouselModel();

        $file = $this->request->getFile('image');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads', $newName);

            $data = [
                'filename' => $newName,
                'autor' => $this->session->get('user_id'),
                'titulo' => $this->request->getPost('titulo'),
                'enlace' => $this->request->getPost('enlace'),
                'resumen' => $this->request->getPost('resumen'),
                'contenido' => $this->request->getPost('contenido'),
                'estado' => $this->request->getPost('estado'),
                'tipo' => $this->request->getPost('tipo')
            ];

            $model->insert($data);
        }

        return redirect()->to('admin/carousel');
    }


    public function edit($id)
    {
        $model = new CarouselModel();
        $data['image'] = $model->find($id);

        return view('admin/carousel/edit', $data);
    }

    public function update($id = null)
    {
        $model = new CarouselModel();
        $image = $model->find($id);

        $file = $this->request->getFile('image');

        if ($file->isValid() && !$file->hasMoved()) {
            unlink('uploads/' . $image['filename']);

            $newName = $file->getRandomName();
            $file->move('uploads', $newName);

            $data = [
                'filename' => $newName,
                'autor' => $this->request->getPost('autor'),
                'titulo' => $this->request->getPost('titulo'),
                'resumen' => $this->request->getPost('resumen'),
                'enlace' => $this->request->getPost('enlace'),
                'contenido' => $this->request->getPost('contenido'),
                'estado' => $this->request->getPost('estado'),
                'tipo' => $this->request->getPost('tipo')
            ];

            $model->update($id, $data);
        } else {
            $data = [
                'autor' => $this->request->getPost('autor'),
                'titulo' => $this->request->getPost('titulo'),
                'resumen' => $this->request->getPost('resumen'),
                'enlace' => $this->request->getPost('enlace'),
                'contenido' => $this->request->getPost('contenido'),
                'estado' => $this->request->getPost('estado'),
                'tipo' => $this->request->getPost('tipo')
            ];

            $model->update($id, $data);
        }

        return redirect()->to('admin/carousel');

    }


    public function delete($id)
    {
        if (!$this->request->getMethod() === 'post') {
            return redirect()->to('/admin/carousel')->with('error', 'Petición inválida.');
        }

        $image = $this->carouselModel->find($id);

        if (!$image) {
            return redirect()->to('/admin/carousel')->with('error', 'Imagen no encontrada.');
        }

        $filePath = FCPATH . 'uploads/' . $image['filename'];

        if (file_exists($filePath) && !unlink($filePath)) {
            log_message('error', "Failed to delete image file: {$filePath}");
            return redirect()->to('/admin/carousel')->with('error', 'Error al tratar de eliminar la imagen.');
        }

        $this->carouselModel->delete(['id' => $id]);

        return redirect()->to('/admin/carousel')->with('success', 'Imagen y publicación eliminadas con éxito');
    }







}
