<?php

namespace App\Models;

use CodeIgniter\Model;

class GeneroModel extends Model
{
    protected $table            = 'generos';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['nombre', 'descripcion', 'estado'];
    protected $useTimestamps    = true;

    protected $validationRules  = [
        'nombre'      => 'required|min_length[3]'
    ];

    protected $validationMessages = [
        'nombre' => [
            'is_unique' => 'El nombre de la editorial ya existe.'
        ]
    ];

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
