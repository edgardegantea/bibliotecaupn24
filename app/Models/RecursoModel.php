<?php

namespace App\Models;

use CodeIgniter\Model;

class RecursoModel extends Model
{
    protected $table = 'recursos';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'titulo', 'subtitulo', 'genero', 'isbn', 'anio_publicacion', 'idioma', 'editorial', 'edicion',
        'descripcion', 'portada', 'paginas', 'fecha_publicacion', 'clasificacion', 'temas', 'formato',
        'precio', 'sellado', 'etiquetado', 'notas',
    ];
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;

    /*
    public function autores()
    {
        return $this->belongsToMany(AutorModel::class, 'autores_recursos', 'recurso_id', 'autor_id');
    }

    public function editorial()
    {
        return $this->belongsTo(EditorialModel::class, 'editorial'); // Relación con la tabla de editoriales
    }

    public function genero()
    {
        return $this->belongsTo(GeneroModel::class, 'genero'); // Relación con la tabla de géneros
    }
    */


    // Relación con autores (Muchos a Muchos)
    public function autores()
    {
        return $this->belongsToMany(AutorModel::class, 'recursos_autores', 'recurso_id', 'autor_id');
    }





    /*
    public function agregarAutores($recursoId, $autoresIds)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('autores_recursos');

        foreach ($autoresIds as $autorId) {
            $builder->insert(['recurso_id' => $recursoId, 'autor_id' => $autorId]);
        }
    }
    */

    // Métodos para agregar autores, géneros y editoriales
    public function agregarAutores($recursoId, $autoresIds)
    {
        $data = [];
        foreach ($autoresIds as $autorId) {
            $data[] = [
                'recurso_id' => $recursoId,
                'autor_id' => $autorId
            ];
        }
        $this->db->table('recursos_autores')->insertBatch($data);
    }

    public function agregarGeneros($recursoId, $generosIds)
    {
        $data = [];
        foreach ($generosIds as $generoId) {
            $data[] = [
                'recurso_id' => $recursoId,
                'genero_id' => $generoId
            ];
        }
        $this->db->table('recursos_generos')->insertBatch($data);
    }

    public function agregarEditoriales($recursoId, $editorialesIds)
    {

        $data = [];
        foreach ($editorialesIds as $editorialId) {
            $data[] = [
                'recurso_id' => $recursoId,
                'editorial_id' => $editorialId
            ];
        }
        $this->db->table('recursos_editoriales')->insertBatch($data);
    }

}
