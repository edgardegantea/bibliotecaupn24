<?php

namespace App\Controllers;

use App\Models\CarouselModel;

class Home extends BaseController
{
    private $db;
    private $carouselModel;

    public function __construct() {
        helper(['url', 'form', 'session']);
        $this->db = \Config\Database::connect();
        $this->carouselModel = new CarouselModel();
        $this->session = \Config\Services::session();
    }



    public function index()
    {
        $model = new CarouselModel();
        $data['images'] = $model->where('estado', 'activo')->where('tipo', 'imagen')->findAll();
        $data['bblio'] = $model->where('estado', 'activo')->where('tipo', 'video')->findAll();
        $data[] = $model->where('estado', 'activo')->where('tipo', 'gestorbibliografico')->findAll();

        return view('frontend/index', $data);
    }


    public function reglamento()
    {
        return view('frontend/reglamento');
    }

    public function servicios()
    {
        return view('frontend/servicios');
    }

    public function recursos()
    {
        

        return view('frontend/recinfo', $data);
    }

    public function equipo()
    {
        return view('frontend/equipo');
    }

    public function investigadores()
    {
        return view('frontend/investigadores');
    }

    public function acercade()
    {
        return view('frontend/acercade');
    }

}
