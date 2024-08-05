<?php

namespace App\Models;

use CodeIgniter\Model;

class LibroModel extends Model
{
    protected $table            = 'recursos';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = [
        'titulo', 'subtitulo', 'genero', 'isbn', 'anio_publicacion', 'idioma',
        'editorial', 'edicion', 'descripcion', 'portada', 'paginas', 'fecha_publicacion',
        'clasificacion', 'temas', 'formato', 'precio', 'sellado', 'etiquetado', 'notas'
    ];
    protected $useTimestamps    = true;

    protected $validationRules  = [
        'titulo'         => 'required|min_length[3]',
        'isbn'           => 'required|is_unique[recursos.isbn,id,{id}]',
        'genero'         => 'required|is_natural_no_zero',
        'editorial'      => 'required|is_natural_no_zero',
        // ... otras reglas de validación según tus necesidades
    ];

    // Relaciones con otras tablas
    protected $belongsTo = [
        'genero' => [
            'model' => 'App\Models\GeneroModel',
            'foreignKey' => 'genero'
        ],
        'editorial' => [
            'model' => 'App\Models\EditorialModel',
            'foreignKey' => 'editorial'
        ]
    ];

    protected $belongsToMany = [
        'autores' => [
            'model' => 'App\Models\AutoresModel',
            'pivotTable' => 'autores_recursos',
            'foreignKey' => 'recurso',
            'otherKey' => 'autor'
        ]
    ];
}
