<?php

namespace App\Models;

use CodeIgniter\Model;

class AutorModel extends Model
{
    protected $table            = 'autores';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['nombre', 'apellido', 'foto', 'bio', 'nacionalidad', 'fecha_nacimiento', 'fecha_fallecimiento', 'estado'];
    protected $useTimestamps    = true;

}
