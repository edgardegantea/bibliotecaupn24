<?php

namespace App\Controllers;

use CodeIgniter\Controller; // Cambiar a CodeIgniter\Controller
use App\Models\RecursoModel;
use App\Models\GeneroModel;
use App\Models\EditorialModel;
use App\Models\AutorModel;

class Recursos extends Controller // Eliminar ResourceController
{
    protected $recursoModel;
    protected $generoModel;
    protected $editorialModel;
    protected $autorModel;

    public function __construct()
    {
        $this->recursoModel = new RecursoModel();
        $this->generoModel = new GeneroModel();
        $this->editorialModel = new EditorialModel();
        $this->autorModel = new AutorModel();
        helper('form');
    }



    public function index()
    {
        $data['recursos'] = $this->recursoModel
            ->select('recursos.*, generos.nombre as genero_nombre, editoriales.nombre as editorial_nombre, autores.id as autor_id, autores.nombre, autores.apellido') // Asegúrate de seleccionar el ID del autor
            ->join('generos', 'generos.id = recursos.genero')
            ->join('editoriales', 'editoriales.id = recursos.editorial', 'left')
            ->join('autores_recursos', 'autores_recursos.recurso_id = recursos.id', 'left')
            ->join('autores', 'autores.id = autores_recursos.autor_id', 'left')
            ->groupBy('recursos.id')
            ->findAll();

        // Reestructurar los datos para agrupar los autores por recurso
        $recursosAgrupados = [];
        foreach ($data['recursos'] as $recurso) {
            $recursoId = $recurso['id'];
            if (!isset($recursosAgrupados[$recursoId])) {
                $recursosAgrupados[$recursoId] = $recurso;
                $recursosAgrupados[$recursoId]['autores'] = [];
            }
            // Verificar si autor_id existe y no es nulo antes de agregarlo
            if (isset($recurso['autor_id']) && !is_null($recurso['autor_id'])) {
                $recursosAgrupados[$recursoId]['autores'][] = [
                    'id' => $recurso['autor_id'],
                    'nombre' => $recurso['nombre'],
                    'apellido' => $recurso['apellido'],
                ];
            }
        }

        $data['recursos'] = $recursosAgrupados;

        return view('recursos/index', $data);
    }




    public function show($id = null)
    {
        /*
        $data['recurso'] = $this->recursoModel->getRecursoConAutores($id);
        if (!$data['recurso']) {
            return redirect()->to('/recursos')->with('error', 'Recurso no encontrado');
        }
        */
        return view('recursos/show');
    }



    public function new()
    {
        $data['generos'] = $this->generoModel->findAll();
        $data['editoriales'] = $this->editorialModel->findAll();
        $data['autores'] = $this->autorModel->findAll();
        return view('recursos/form', $data);
    }



    public function create()
    {
        $generoModel = new GeneroModel();
        $editorialModel = new EditorialModel();

        $validationRules = [
            'titulo'       => 'required|min_length[3]',
            'genero'       => 'required|is_natural_no_zero',
            'editorial'    => 'required|is_natural_no_zero',
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
            // ... (otros campos del formulario)
        ]);

        // Manejo de la portada (similar a como lo hiciste en el método create)
        $portada = $this->request->getFile('portada');
        if ($portada->isValid() && !$portada->hasMoved()) {
            $nuevoNombre = $portada->getRandomName();
            $portada->move(ROOTPATH . 'public/uploads', $nuevoNombre);
            $datosRecurso['portada'] = $nuevoNombre;
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

        // Crear y asociar nuevos autores (si se agregaron)
        $nuevosAutores = $this->request->getPost('nuevos_autores');
        if ($nuevosAutores) {
            $autorModel = new AutorModel();
            foreach ($nuevosAutores['nombre'] as $i => $nombre) {
                $apellido = $nuevosAutores['apellido'][$i];
                if (!empty($nombre) && !empty($apellido)) {
                    $autorId = $autorModel->insert(['nombre' => $nombre, 'apellido' => $apellido]);
                    $recursoModel->agregarAutores($recursoId, [$autorId]);
                }
            }
        }

        // Asociar géneros existentes (si se seleccionaron)
        $generosIds = $this->request->getPost('generos');
        if (!empty($generosIds)) {
            $recursoModel->agregarGeneros($recursoId, $generosIds);
        }

        // Crear y asociar nuevos géneros (si se agregaron)
        $nuevosGeneros = $this->request->getPost('nuevos_generos');
        if ($nuevosGeneros) {
            foreach ($nuevosGeneros as $nombreGenero) {
                if (!empty($nombreGenero)) {
                    $generoId = $generoModel->insert(['nombre' => $nombreGenero]);
                    $recursoModel->agregarGeneros($recursoId, [$generoId]);
                }
            }
        }

        // Asociar editoriales existentes (si se seleccionaron)
        $editorialesIds = $this->request->getPost('editoriales');
        if (!empty($editorialesIds)) {
            $recursoModel->agregarEditoriales($recursoId, $editorialesIds);
        }

        // Crear y asociar nuevas editoriales (si se agregaron)
        $nuevasEditoriales = $this->request->getPost('nuevas_editoriales');
        if ($nuevasEditoriales) {
            foreach ($nuevasEditoriales as $nombreEditorial) {
                if (!empty($nombreEditorial)) {
                    $editorialId = $editorialModel->insert(['nombre' => $nombreEditorial]);
                    $recursoModel->agregarEditoriales($recursoId, [$editorialId]);
                }
            }
        }

        return redirect()->to('/recursos')->with('success', 'Recurso creado exitosamente');
    }




    /*

    public function create()
    {
        $validationRules = [
            'titulo' => 'required|min_length[3]',
            'genero' => 'required|is_natural_no_zero',
            'editorial' => 'required|is_natural_no_zero',
            'isbn' => 'permit_empty|max_length[20]|is_unique[recursos.isbn]',
            'autores' => 'permit_empty|is_array',
            // ... (otras reglas de validación)
        ];

        $mensajesValidacion = [
            // ... (otros mensajes de error)
            'genero' => [
                'required' => 'El género es obligatorio.',
                'is_natural_no_zero' => 'El género debe ser un número válido (mayor que cero).',
            ],
            'editorial' => [
                'required' => 'La editorial es obligatoria.',
                'is_natural_no_zero' => 'La editorial debe ser un número válido (mayor que cero).',
            ],
        ];

        if (!$this->validate($validationRules, $mensajesValidacion)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $recursoModel = new RecursoModel();
        $autorModel = new AutorModel();
        $generoModel = new GeneroModel();
        $editorialModel = new EditorialModel();

        $datosRecurso = $this->request->getPost([
            'titulo',
            'subtitulo',
            'isbn',
            'anio_publicacion',
            'idioma',
            'edicion',
            'descripcion',
            'temas',
            'notas',
            'paginas',
            'fecha_publicacion',
            'clasificacion',
            'formato',
            'precio',
            'sellado',
            'etiquetado'
        ]);

        // Manejo de la portada
        $portada = $this->request->getFile('portada');
        if ($portada && $portada->isValid() && !$portada->hasMoved()) {
            $nuevoNombre = $portada->getRandomName();
            $portada->move(ROOTPATH . 'public/uploads', $nuevoNombre);
            $datosRecurso['portada'] = $nuevoNombre;
        }

        // Insertar el recurso en la base de datos
        $recursoId = $recursoModel->insert($datosRecurso);
        if (!$recursoId) {
            return redirect()->back()->withInput()->with('error', 'Error al crear el recurso');
        }

        // Asociar autores, géneros y editoriales (existentes y nuevos)
        $this->asociarElementos($recursoId, 'autores', $autorModel, $this->request->getPost('autores'), $this->request->getPost('nuevos_autores'));
        $this->asociarElementos($recursoId, 'generos', $generoModel, $this->request->getPost('generos'), $this->request->getPost('nuevos_generos'));
        $this->asociarElementos($recursoId, 'editoriales', $editorialModel, $this->request->getPost('editoriales'), $this->request->getPost('nuevas_editoriales'));

        return redirect()->to('/recursos')->with('success', 'Recurso creado exitosamente');
    }

    // Función auxiliar para asociar elementos (autores, géneros, editoriales)
    private function asociarElementos($recursoId, $tipoElemento, $model, $elementosExistentes, $nuevosElementos)
    {
        if (!empty($elementosExistentes)) {
            $recursoModel = new RecursoModel();
            $metodoAgregar = "agregar" . ucfirst($tipoElemento); // Ejemplo: agregarAutores, agregarGeneros
            $recursoModel->$metodoAgregar($recursoId, $elementosExistentes);
        }

        if ($nuevosElementos) {
            foreach ($nuevosElementos as $nombreElemento) {
                if (!empty($nombreElemento)) {
                    $elementoId = $model->insert(['nombre' => $nombreElemento]);
                    $recursoModel->$metodoAgregar($recursoId, [$elementoId]);
                }
            }
        }
    }
    */




    /*
    public function create()
    {
        $validationRules = [
            'titulo'         => 'required|min_length[3]',
            'isbn'           => 'permit_empty|max_length[20]|is_unique[recursos.isbn]',
            'autores'        => 'permit_empty|is_array',
            'nuevos_autores' => 'permit_empty|is_array',
            'generos'        => 'permit_empty|is_array',
            'nuevos_generos' => 'permit_empty|is_array',
            'editoriales'     => 'permit_empty|is_array',
            'nuevas_editoriales' => 'permit_empty|is_array',
            // ... (otras reglas de validación)
        ];

        $mensajesValidacion = [
            // ... (mensajes de error de validación)
        ];

        if (!$this->validate($validationRules, $mensajesValidacion)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $recursoModel = new RecursoModel();
        $autorModel = new AutorModel();
        $generoModel = new GeneroModel();
        $editorialModel = new EditorialModel();

        $datosRecurso = $this->request->getPost([
            'titulo',
            'subtitulo',
            'isbn',
            'anio_publicacion',
            'idioma',
            'edicion',
            'descripcion',
            'temas',
            'notas',
            'paginas',
            'fecha_publicacion',
            'clasificacion',
            'formato',
            'precio',
            'sellado',
            'etiquetado'
        ]);

        // Manejo de la portada
        $portada = $this->request->getFile('portada');
        if ($portada && $portada->isValid() && !$portada->hasMoved()) {
            $nuevoNombre = $portada->getRandomName();
            $portada->move(ROOTPATH . 'public/uploads', $nuevoNombre);
            $datosRecurso['portada'] = $nuevoNombre;
        }

        // Insertar el recurso en la base de datos
        $recursoId = $recursoModel->insert($datosRecurso);
        if (!$recursoId) {
            return redirect()->back()->withInput()->with('error', 'Error al crear el recurso');
        }

        // Asociar elementos (autores, géneros, editoriales)
        $this->asociarElementos($recursoId, 'autores', $autorModel, $this->request->getPost('autores'), $this->request->getPost('nuevos_autores'));
        $this->asociarElementos($recursoId, 'generos', $generoModel, $this->request->getPost('generos'), $this->request->getPost('nuevos_generos'));
        $this->asociarElementos($recursoId, 'editoriales', $editorialModel, $this->request->getPost('editoriales'), $this->request->getPost('nuevas_editoriales'));

        return redirect()->to('/recursos')->with('success', 'Recurso creado exitosamente');
    }

    // Función auxiliar para asociar elementos (autores, géneros, editoriales)
    private function asociarElementos($recursoId, $tipoElemento, $model, $elementosExistentes, $nuevosElementos)
    {
        $recursoModel = new RecursoModel();
        $metodoAgregar = "agregar" . ucfirst($tipoElemento);

        if (!empty($elementosExistentes)) {
            $recursoModel->$metodoAgregar($recursoId, $elementosExistentes);
        }

        if (!empty($nuevosElementos)) {
            foreach ($nuevosElementos as $nuevoElemento) {
                if (!empty($nuevoElemento)) {
                    // Lógica específica para cada tipo de elemento (autor, género, editorial)
                    if ($tipoElemento === 'autores' && is_array($nuevoElemento)) {
                        // Verificar si el autor ya existe (usando ambos campos: nombre y apellido)
                        $autorExistente = $model->where('nombre', $nuevoElemento['nombre'])
                                                 ->where('apellido', $nuevoElemento['apellido'])
                                                 ->first();

                        if (!$autorExistente) {
                            $elementoId = $model->insert($nuevoElemento);
                        } else {
                            $elementoId = $autorExistente['id'];
                        }
                    } else {
                        // Verificar si el género/editorial ya existe (usando solo el nombre)
                        $elementoExistente = $model->where('nombre', $nuevoElemento)->first();

                        if (!$elementoExistente) {
                            $elementoId = $model->insert(['nombre' => $nuevoElemento]);
                        } else {
                            $elementoId = $elementoExistente['id'];
                        }
                    }

                    $recursoModel->$metodoAgregar($recursoId, [$elementoId]);
                }
            }
        }
    }
    */








    public function edit($id = null)
    {
        $data['recurso'] = $this->recursoModel->getRecursoConAutores($id);
        if (!$data['recurso']) {
            return redirect()->to('/recursos')->with('error', 'Recurso no encontrado');
        }
        $data['generos'] = $this->generoModel->findAll();
        $data['editoriales'] = $this->editorialModel->findAll();
        $data['autores'] = $this->autoresModel->findAll();
        return view('recursos/form', $data); // Reutilizar la misma vista 'form'
    }



    public function update($id = null)
    {
        $data = $this->request->getPost();

        // Verificar si el recurso existe
        if (!$this->recursoModel->find($id)) {
            return redirect()->to('/recursos')->with('error', 'Recurso no encontrado');
        }

        // Reglas de validación para actualizar, permitiendo que el isbn sea el mismo
        $validationRules = $this->recursoModel->validationRules;
        $validationRules['isbn'] = "required|is_unique[recursos.isbn,id,{$id}]";
        $validationRules['portada'] = 'permit_empty|max_size[portada,1024]|is_image[portada]';

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $portada = $this->request->getFile('portada');
        if ($portada && $portada->isValid() && !$portada->hasMoved()) {
            $nombrePortada = $portada->getRandomName();
            $portada->move(ROOTPATH . 'public/uploads', $nombrePortada);
            // Eliminar la imagen anterior si existe
            $recurso = $this->recursoModel->find($id);
            if ($recurso['portada']) {
                unlink(ROOTPATH . 'public/uploads/' . $recurso['portada']);
            }
            $data['portada'] = $nombrePortada;
        }

        $this->recursoModel->update($id, $data);

        $autoresSeleccionados = $this->request->getPost('autores');
        if ($autoresSeleccionados) {
            $this->recursoModel->autores()->sync($autoresSeleccionados, $id);
        }

        return redirect()->to('/recursos')->with('success', 'Recurso actualizado exitosamente');
    }



    public function delete($id = null)
    {
        $recurso = $this->recursoModel->find($id);
        if ($recurso === null) {
            return redirect()->to('/recursos')->with('error', 'Recurso no encontrado');
        }

        if ($recurso['portada']) {
            unlink(ROOTPATH . 'public/uploads/' . $recurso['portada']); // Eliminar la imagen
        }
        $this->recursoModel->delete($id);

        return redirect()->to('/recursos')->with('success', 'Recurso eliminado exitosamente');
    }
}