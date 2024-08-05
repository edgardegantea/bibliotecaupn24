<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissionModel extends Model
{
    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description'];
    protected $validationRules = [
        'name' => 'required|is_unique[permissions.name]'
    ];
}
