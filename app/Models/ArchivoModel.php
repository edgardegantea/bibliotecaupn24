<?php

namespace App\Models;

use CodeIgniter\Model;

class ArchivoModel extends Model
{
    protected $table = 'archivos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'ruta', 'clasificacion_id', 'peso', 'tipo', 'created_at', 'updated_at', 'deleted_at']; // Agregar los nuevos campos
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
}
