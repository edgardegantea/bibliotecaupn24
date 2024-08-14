<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<h1><?= isset($recurso) ? 'Editar Recurso' : 'Crear Recurso' ?></h1>

<?php if (session()->has('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?= base_url('recursos' . (isset($recurso) ? '/' . $recurso['id'] : '')) ?>" method="post"
    enctype="multipart/form-data">
    <?= csrf_field() ?>
    <?php if (isset($recurso)): ?>
        <input type="hidden" name="_method" value="PUT">
    <?php endif; ?>

    <div class="mb-3">
        <label for="titulo" class="form-label">Título:</label>
        <input type="text" class="form-control" name="titulo" value="<?= old('titulo', $recurso['titulo'] ?? '') ?>">
    </div>

    <div class="mb-3">
        <label for="autores">Autores:</label>
        <select name="autores[]" id="autores" class="form-control select2" multiple>
            <?php foreach ($autores as $autor): ?>
                <option value="<?= $autor['id'] ?>" <?php
                                                    if (isset($recurso['autores']) && in_array($autor['id'], array_column($recurso['autores'], 'id'))) {
                                                        echo 'selected';
                                                    } ?>>
                    <?= $autor['nombre'] ?> <?= $autor['apellido'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <div id="nuevosAutores"></div>
        <button type="button" class="btn btn-secondary mt-2" id="agregarAutorBtn">Agregar Autor</button>
        <hr>
    </div>

    <div class="mb-3">
        <label for="genero">Género:</label>
        <select name="genero" id="genero" class="form-control select2">
            <?php foreach ($generos as $genero): ?>
                <option value="<?= $genero['id'] ?>"
                    <?php if (old('genero', $recurso['genero'] ?? '') == $genero['id']): ?>selected<?php endif; ?>>
                    <?= $genero['nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="editorial">Editorial:</label>
        <select name="editorial" id="editorial" class="form-control select2">
            <?php foreach ($editoriales as $editorial): ?>
                <option value="<?= $editorial['id'] ?>"
                    <?php if (old('editorial', $recurso['editorial'] ?? '') == $editorial['id']): ?>selected<?php endif; ?>>
                    <?= $editorial['nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="tag">Tag:</label>
        <select name="tag" id="tag" class="form-control select2">
            <?php foreach ($tags as $tag): ?>
                <option value="<?= $tag['id'] ?>"
                    <?php if (old('tag', $recurso['tag'] ?? '') == $tag['id']): ?>selected<?php endif; ?>>
                    <?= $tag['nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <hr>

    <div class="row">
        <div class="mb-3 col-md-4">
            <label for="subtitulo" class="form-label">Subtítulo:</label>
            <input type="text" class="form-control" name="subtitulo"
                value="<?= old('subtitulo', $recurso['subtitulo'] ?? '') ?>">
        </div>

        <div class="mb-3 col-md-4">
            <label for="isbn" class="form-label">ISBN:</label>
            <input type="text" class="form-control" name="isbn" value="<?= old('isbn', $recurso['isbn'] ?? '') ?>">
        </div>

        <div class="mb-3 col-md-4">
            <label for="anio_publicacion" class="form-label">Año de Publicación:</label>
            <input type="number" class="form-control" name="anio_publicacion"
                value="<?= old('anio_publicacion', $recurso['anio_publicacion'] ?? '') ?>">
        </div>

        <div class="mb-3 col-md-4">
            <label for="idioma" class="form-label">Idioma:</label>
            <input type="text" class="form-control" name="idioma"
                value="<?= old('idioma', $recurso['idioma'] ?? '') ?>">
        </div>

        <div class="mb-3 col-md-4">
            <label for="edicion" class="form-label">Edición:</label>
            <input type="text" class="form-control" name="edicion"
                value="<?= old('edicion', $recurso['edicion'] ?? '') ?>">
        </div>

        <div class="mb-3 col-md-4">
            <label for="portada" class="form-label">Portada:</label>
            <input accept="image/*" type="file" class="form-control" name="portada" id="portada">
            <?php if (isset($recurso) && $recurso['portada']): ?>
                <img src="<?= base_url('uploads/' . $recurso['portada']) ?>" alt="Portada del Recurso"
                    class="img-thumbnail mt-2" width="100">
            <?php endif; ?>
            <img id="portadaPreview" src="#" alt="Vista previa de la portada" style="max-width: 100%; display: none;">
        </div>

        <div class="mb-3 col-md-4">
            <label for="paginas" class="form-label">Páginas:</label>
            <input type="number" class="form-control" name="paginas"
                value="<?= old('paginas', $recurso['paginas'] ?? '') ?>">
        </div>

        <div class="mb-3 col-md-4">
            <label for="fecha_publicacion" class="form-label">Fecha de Publicación:</label>
            <input type="date" class="form-control" name="fecha_publicacion"
                value="<?= old('fecha_publicacion', $recurso['fecha_publicacion'] ?? '') ?>">
        </div>

        <div class="mb-3 col-md-4">
            <label for="clasificacion" class="form-label">Clasificación:</label>
            <input type="text" class="form-control" name="clasificacion"
                value="<?= old('clasificacion', $recurso['clasificacion'] ?? '') ?>">
        </div>

        <div class="mb-3 col-md-4">
            <label for="formato" class="form-label">Formato:</label>
            <select class="form-select" name="formato">
                <option value="libro" <?= (old('formato', $recurso['formato'] ?? '') === 'libro') ? 'selected' : '' ?>>
                    Libro
                </option>
                <option value="mapa" <?= (old('formato', $recurso['formato'] ?? '') === 'mapa') ? 'selected' : '' ?>>
                    Mapa
                </option>
                <option value="compendio" <?= (old('formato', $recurso['formato'] ?? '') === 'compendio') ? 'selected' : '' ?>>
                    Compendio
                </option>
                <option value="catálogo" <?= (old('formato', $recurso['formato'] ?? '') === 'catálogo') ? 'selected' : '' ?>>
                    Catálogo
                </option>
                <option value="revista"
                    <?= (old('formato', $recurso['formato'] ?? '') === 'revista') ? 'selected' : '' ?>>
                    Revista
                </option>
                <option value="audiolibro"
                    <?= (old('formato', $recurso['formato'] ?? '') === 'audiolibro') ? 'selected' : '' ?>>
                    Audiolibro
                </option>
                <option value="video" <?= (old('formato', $recurso['formato'] ?? '') === 'video') ? 'selected' : '' ?>>
                    Video
                </option>
                <option value="CD" <?= (old('formato', $recurso['formato'] ?? '') === 'CD') ? 'selected' : '' ?>>
                    CD
                </option>
                <option value="USB" <?= (old('formato', $recurso['formato'] ?? '') === 'USB') ? 'selected' : '' ?>>
                    USB
                </option>
                <option value="DVD" <?= (old('formato', $recurso['formato'] ?? '') === 'DVD') ? 'selected' : '' ?>>
                    DVD
                </option>
                <option value="otro" <?= (old('formato', $recurso['formato'] ?? '') === 'otro') ? 'selected' : '' ?>>
                    Otro
                </option>
            </select>
        </div>

        <div class="mb-3 col-md-4">
            <label for="precio" class="form-label">Precio:</label>
            <input type="number" class="form-control" name="precio" step="0.01"
                value="<?= old('precio', $recurso['precio'] ?? '') ?>">
        </div>

        <div class="mb-3 form-check col-md-4">
            <input type="checkbox" class="form-check-input" name="sellado" value="1"
                <?= old('sellado', $recurso['sellado'] ?? '') ? 'checked' : '' ?>>
            <label class="form-check-label" for="sellado">Sellado</label>
        </div>

        <div class="mb-3 form-check col-md-4">
            <input type="checkbox" class="form-check-input" name="etiquetado" value="1"
                <?= old('etiquetado', $recurso['etiquetado'] ?? '') ? 'checked' : '' ?>>
            <label class="form-check-label" for="etiquetado">Etiquetado</label>
        </div>

        <div class="mb-3 col-md-4">
            <label for="archivo" class="form-label">Archivo:</label>
            <input type="file" accept=".pdf" class="form-control" name="archivo" id="archivo">
            <?php if (isset($recurso) && $recurso['archivo']): ?>
                <p class="mt-2">Archivo actual: <a href="<?= base_url('uploads/' . $recurso['archivo']) ?>" target="_blank"><?= $recurso['archivo'] ?></a></p>
            <?php endif; ?>
            <embed id="archivoPreview" src="#" width="100%" height="300" style="display: none;"> 
        </div>

    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción:</label>
        <textarea class="form-control"
            name="descripcion"><?= old('descripcion', $recurso['descripcion'] ?? '') ?></textarea>
    </div>

    <div class="mb-3">
        <label for="temas" class="form-label">Temas:</label>
        <textarea class="form-control" name="temas"><?= old('temas', $recurso['temas'] ?? '') ?></textarea>
    </div>

    <div class="mb-3">
        <label for="notas" class="form-label">Notas:</label>
        <textarea class="form-control" name="notas"><?= old('notas', $recurso['notas'] ?? '') ?></textarea>
    </div>

    <div class="mb-3">
        <label for="tipo" class="form-label">Tipo:</label>
        <input type="text" class="form-control" name="tipo" value="<?= old('tipo', $recurso['tipo'] ?? '') ?>">
    </div>


    <button type="submit"
        class="btn btn-primary mb-2"><?= isset($recurso) ? 'Actualizar Recurso' : 'Crear Recurso' ?></button>
</form>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();

        $("#agregarAutorBtn").click(function() {
            $("#nuevosAutores").append(`
                    <div class="nuevo-autor row mt-2">
                        <div class="col-md-4 form-group">
                            <input type="text" placeholder="Nombre" name="nuevos_autores[nombre][]" class="form-control">
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="text" placeholder="Apellidos" name="nuevos_autores[apellido][]" class="form-control">
                        </div>
                        <div class="col-md-4 form-group">
                            <button type="button" class="btn btn-danger eliminar-autor">Eliminar autor</button>
                        </div>
                    </div>
                `);
        });

        $(document).on('click', '.eliminar-autor', function() {
            $(this).closest('.nuevo-autor').remove();
        });
    });
</script>


<script>
    // Vista previa de la portada
    function previewPortada(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#portadaPreview').attr('src', e.target.result);
                $('#portadaPreview').show(); // Mostrar la vista previa
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            $('#portadaPreview').hide(); // Ocultar la vista previa si no hay archivo seleccionado
        }
    }

    // Vista previa del archivo (PDF o imagen)
function previewArchivo(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var fileType = input.files[0].type;

        if (fileType === 'application/pdf') {
            reader.onload = function (e) {
                $('#archivoPreview').attr('src', e.target.result);
                $('#archivoPreview').attr('type', 'application/pdf'); // Indicar que es un PDF
                $('#archivoPreview').show();
            }

            reader.readAsDataURL(input.files[0]);
        } else if (fileType.startsWith('image/')) {
            reader.onload = function (e) {
                $('#archivoPreview').attr('src', e.target.result);
                $('#archivoPreview').attr('type', fileType); // Indicar el tipo de imagen
                $('#archivoPreview').show();
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            $('#archivoPreview').hide(); 
            // Puedes mostrar un mensaje indicando que el archivo no es una imagen ni un PDF si lo deseas
        }
    } else {
        $('#archivoPreview').hide(); 
    }
}

// Asociar las funciones de vista previa a los eventos de cambio de los campos de archivo
$("#portada").change(function(){
    previewPortada(this);
});

$("#archivo").change(function(){
    previewArchivo(this);
});
</script>
<?= $this->endSection() ?>