<?php

namespace App\Controllers;

use CodeIgniter\Controller; 
use App\Models\RecursoModel;
use App\Models\GeneroModel;
use App\Models\EditorialModel;
use App\Models\AutorModel;
use App\Models\TagModel;

class Recursos extends Controller 
{
    protected $recursoModel;
    protected $generoModel;
    protected $editorialModel;
    protected $autorModel;
    protected $tagModel;

    public function __construct()
    {
        $this->recursoModel = new RecursoModel();
        $this->generoModel = new GeneroModel();
        $this->editorialModel = new EditorialModel();
        $this->autorModel = new AutorModel();
        $this->tagModel = new TagModel();
        helper('form');
    }

    public function index()
    {
        $data['recursos'] = $this->recursoModel
            ->select('recursos.*, generos.nombre as genero_nombre, editoriales.nombre as editorial_nombre')
            ->join('generos', 'generos.id = recursos.genero')
            ->join('editoriales', 'editoriales.id = recursos.editorial')
            ->findAll();

        // Obtener autores para cada recurso
        foreach ($data['recursos'] as &$recurso) {
            $recurso['autores'] = $this->recursoModel->find($recurso['id'])->autores;
        }

        return view('admin/recursos/index', $data);
    }

    public function show($id = null)
    {
        $data['recurso'] = $this->recursoModel->find($id);
        if (!$data['recurso']) {
            return redirect()->to('/admin/recursos')->with('error', 'Recurso no encontrado');
        }

        // Obtener autores, género, editorial y tag relacionados
        $data['recurso']->autores = $this->recursoModel->find($id)->autores;
        $data['recurso']->genero = $this->recursoModel->find($id)->genero;
        $data['recurso']->editorial = $this->recursoModel->find($id)->editorial;
        $data['recurso']->tag = $this->recursoModel->find($id)->tag;

        return view('admin/recursos/show', $data);
    }

    public function new()
    {
        $data['generos'] = $this->generoModel->findAll();
        $data['editoriales'] = $this->editorialModel->findAll();
        $data['autores'] = $this->autorModel->findAll();
        $data['tags'] = $this->tagModel->findAll(); 
        return view('admin/recursos/form', $data);
    }

    public function create()
    {
        $validationRules = [
            'titulo'       => 'required|min_length[3]',
            'genero'       => 'required|is_natural_no_zero',
            'editorial'    => 'required|is_natural_no_zero',
            'tag'           => 'required|is_natural_no_zero', 
            'isbn'         => 'permit_empty|max_length[20]|is_unique[recursos.isbn]',
            'autores'      => 'permit_empty|is_array',
        ];

        $mensajesValidacion = [
            'titulo' => [
                'required'   => 'El título es obligatorio.',
                'min_length' => 'El título debe tener al menos 3 caracteres.',
            ],
            'genero' => [
                'required'          => 'El género es obligatorio.',
                'is_natural_no_zero' => 'El género debe ser un número válido.',
            ],
            'editorial' => [
                'required'          => 'La editorial es obligatoria.',
                'is_natural_no_zero' => 'La editorial debe ser un número válido.',
            ],
            'tag' => [ 
                'required'          => 'El tag es obligatorio.',
                'is_natural_no_zero' => 'El tag debe ser un número válido.',
            ],
            'isbn' => [
                'max_length' => 'El ISBN no puede exceder los 20 caracteres.',
                'is_unique' => 'El ISBN ya existe.',
            ],
            'autores' => [
                'is_array'  => 'El campo autores debe ser un array.',
            ],
        ];

        if (!$this->validate($validationRules, $mensajesValidacion)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $recursoModel = new RecursoModel();
        $datosRecurso = $this->request->getPost([
            'titulo',
            'subtitulo',
            'genero',
            'isbn',
            'anio_publicacion',
            'idioma',
            'editorial',
            'edicion',
            'descripcion',
            'portada', 
            'paginas', 
            'fecha_publicacion', 
            'clasificacion', 
            'temas', 
            'formato', 
            'precio', 
            'sellado', 
            'etiquetado', 
            'notas',
            'tipo',
            'tag' 
        ]);

        // Manejo de la portada 
        $portada = $this->request->getFile('portada');
        if ($portada->isValid() && !$portada->hasMoved()) {
            $nuevoNombre = $portada->getRandomName();
            $portada->move(ROOTPATH . 'public/uploads', $nuevoNombre);
            $datosRecurso['portada'] = $nuevoNombre;
        }

        // Manejo del archivo - Conservando el nombre original
        $archivo = $this->request->getFile('archivo');
        if ($archivo->isValid() && !$archivo->hasMoved()) {
            $nombreOriginal = $archivo->getName(); 
            $archivo->move(ROOTPATH . 'public/uploads', $nombreOriginal); 
            $datosRecurso['archivo'] = $nombreOriginal;
        }

        // Insertar el recurso en la base de datos
        $recursoId = $recursoModel->insert($datosRecurso);
        if (!$recursoId) {
            return redirect()->back()->withInput()->with('error', 'Error al crear el recurso');
        }

        // Asociar autores existentes (si se seleccionaron)
        $autoresIds = $this->request->getPost('autores');
        if (!empty($autoresIds)) {
            $recursoModel->agregarAutores($recursoId, $autoresIds);
        }

        return redirect()->to('/admin/recursos')->with('success', 'Recurso creado exitosamente');
    }

    public function edit($id = null)
    {
        $data['recurso'] = $this->recursoModel->find($id);
        if (!$data['recurso']) {
            return redirect()->to('/admin/recursos')->with('error', 'Recurso no encontrado');
        }

        // Obtener autores, género, editorial y tag relacionados
        $data['recurso']->autores = $this->recursoModel->find($id)->autores;
        $data['generos'] = $this->generoModel->findAll();
        $data['editoriales'] = $this->editorialModel->findAll();
        $data['autores'] = $this->autorModel->findAll();
        $data['tags'] = $this->tagModel->findAll(); 

        return view('admin/recursos/form', $data); 
    }

    public function update($id = null)
    {
        $data = $this->request->getPost();

        // Verificar si el recurso existe
        if (!$this->recursoModel->find($id)) {
            return redirect()->to('/admin/recursos')->with('error', 'Recurso no encontrado');
        }

        // Reglas de validación para actualizar, permitiendo que el isbn sea el mismo
        $validationRules = $this->recursoModel->validationRules;
        $validationRules['isbn'] = "permit_empty|max_length[20]|is_unique[recursos.isbn,id,{$id}]";
        $validationRules['portada'] = 'permit_empty|max_size[portada,1024]|is_image[portada]';
        // Puedes agregar reglas de validación para 'archivo' si es necesario

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $portada = $this->request->getFile('portada');
        if ($portada && $portada->isValid() && !$portada->hasMoved()) {
            $nombrePortada = $portada->getRandomName();
            $            $portada->move(ROOTPATH . 'public/uploads', $nombrePortada);
            // Eliminar la imagen anterior si existe
            $recurso = $this->recursoModel->find($id);
            if ($recurso['portada']) {
                unlink(ROOTPATH . 'public/uploads/' . $recurso['portada']);
            }
            $data['portada'] = $nombrePortada;
        }

        // Manejo del archivo - Conservando el nombre original (similar al método create)
        $archivo = $this->request->getFile('archivo');
        if ($archivo && $archivo->isValid() && !$archivo->hasMoved()) {
            $nombreOriginal = $archivo->getName();
            $archivo->move(ROOTPATH . 'public/uploads', $nombreOriginal);

            // Eliminar el archivo anterior si existe
            $recurso = $this->recursoModel->find($id);
            if ($recurso['archivo']) {
                unlink(ROOTPATH . 'public/uploads/' . $recurso['archivo']);
            }

            $data['archivo'] = $nombreOriginal;
        }

        $this->recursoModel->update($id, $data);

        // Actualizar autores (sincronizar)
        $autoresSeleccionados = $this->request->getPost('autores');
        if ($autoresSeleccionados) {
            $this->recursoModel->autores()->sync($autoresSeleccionados);
        } else {
            // Si no se seleccionaron autores, eliminar todas las asociaciones existentes
            $this->recursoModel->autores()->sync([]); 
        }

        return redirect()->to('/admin/recursos')->with('success', 'Recurso actualizado exitosamente');
    }

    public function delete($id = null)
    {
        $recurso = $this->recursoModel->find($id);
        if ($recurso === null) {
            return redirect()->to('/admin/recursos')->with('error', 'Recurso no encontrado');
        }

        if ($recurso['portada']) {
            unlink(ROOTPATH . 'public/uploads/' . $recurso['portada']); // Eliminar la imagen
        }

        if ($recurso['archivo']) {
            unlink(ROOTPATH . 'public/uploads/' . $recurso['archivo']); // Eliminar el archivo
        }

        $this->recursoModel->delete($id);

        return redirect()->to('/admin/recursos')->with('success', 'Recurso eliminado exitosamente');
    }
}

