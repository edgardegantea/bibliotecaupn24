<?php

namespace App\Models;

use CodeIgniter\Model;

class EditorialModel extends Model
{
    protected $table            = 'editoriales';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = [
        'nombre_abreviado', 'nombre', 'tipo', 'direccion', 'email',
        'url', 'pais', 'prefijos', 'descripcion', 'estado'
    ];
    protected $useTimestamps    = true;

    protected $validationRules  = [
        'nombre'      => 'required|min_length[3]',
        'tipo'        => 'required|in_list[editorial,sello]',
        'email'       => 'permit_empty|valid_email',
        'url'         => 'permit_empty|valid_url',
        'pais'        => 'permit_empty'
    ];

    protected $validationMessages = [
        'nombre' => [
            'is_unique' => 'El nombre de la editorial ya existe.'
        ],
        'tipo' => [
            'in_list' => 'El tipo debe ser "editorial" o "sello".'
        ]
    ];


    public function getEditorialesActivas()
    {
        return $this->where('estado', 1)->findAll();
    }

    public function getEditorialConRecursos($id)
    {
        return $this->select('editoriales.*, COUNT(recursos.id) as total_recursos')
            ->join('recursos', 'recursos.editorial = editoriales.id', 'left')
            ->where('editoriales.id', $id)
            ->groupBy('editoriales.id')
            ->first();
    }

    protected function beforeInsert(array $data)
    {
        // Normalizar datos (opcional)
        // $data['data']['nombre'] = trim($data['data']['nombre']);
        // return $data;
    }

    protected function beforeUpdate(array $data)
    {
        return $this->beforeInsert($data);
    }
}
