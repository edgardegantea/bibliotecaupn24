<?php

namespace App\Models;

use CodeIgniter\Model;

class RecursoModel extends Model
{
    protected $table = 'recursos';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'archivo', 'tipo', 'tag', 'titulo', 'subtitulo', 'genero', 'isbn', 
        'anio_publicacion', 'idioma', 'editorial', 'edicion', 'descripcion', 
        'portada', 'paginas', 'fecha_publicacion', 'clasificacion', 'temas', 
        'formato', 'precio', 'sellado', 'etiquetado', 'notas'
    ];
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime'; // O ajusta según tu configuración

    // Relaciones 

    // Relación con autores (Muchos a Muchos)
    public function autores()
    {
        return $this->belongsToMany(AutorModel::class, 'autores_recursos', 'recurso_id', 'autor_id');
    }

    // Relación con género (Uno a Muchos) 
    public function genero()
    {
        return $this->belongsTo(GeneroModel::class, 'genero', 'id'); 
    }

    // Relación con editorial (Uno a Muchos) 
    public function editorial()
    {
        return $this->belongsTo(EditorialModel::class, 'editorial', 'id');
    }

    public function tag()
    {
        return $this->belongsTo(TagModel::class, 'tag', 'id');
    }

    // Método para agregar autores 
    public function agregarAutores($recursoId, $autoresIds)
    {
        $data = [];
        foreach ($autoresIds as $autorId) {
            $data[] = [
                'recurso_id' => $recursoId,
                'autor_id' => $autorId
            ];
        }
        $this->db->table('autores_recursos')->insertBatch($data);
    }

}
