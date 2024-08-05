<?php
namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'slug', 'descripcion', 'estado'];
    protected $useSoftDeletes = true;
    protected $dateFormat = 'datetime';
}