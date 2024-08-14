<?php

namespace App\Controllers\Usuario;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ArchivoModel;

class UsuarioController extends BaseController
{
    public function __construct()
    {
        if (session()->get('rol') != "usuario") {
            echo view('accesonoautorizado');
            exit;
        }
    }


    public function index()
    {
        $archivoModel = new ArchivoModel();
        $data['archivos'] = $archivoModel->select('archivos.*, clasificaciones.nombre AS clasificacion_nombre')
            ->join('clasificaciones', 'clasificaciones.id = archivos.clasificacion_id')
            ->orderBy('archivos.id', 'desc')
            ->findAll(3);

        return view('usuario/dashboard', $data);
    }
}
