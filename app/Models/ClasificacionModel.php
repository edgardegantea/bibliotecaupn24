<?php

namespace App\Models;

use CodeIgniter\Model;

class ClasificacionModel extends Model
{
    protected $table = 'clasificaciones';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'created_at', 'updated_at', 'deleted_at'];
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
}
