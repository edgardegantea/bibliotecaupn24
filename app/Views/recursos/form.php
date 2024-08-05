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
        <label for="generos">Géneros:</label>
        <select name="generos[]" id="generos" class="form-control select2">
            <?php foreach ($generos as $genero): ?>
            <option value="<?= $genero['id'] ?>" 
                <?php if (isset($recurso['generos']) && in_array($genero['id'], array_column($recurso['generos'], 'id'))): ?>selected<?php endif; ?>>
                <?= $genero['nombre'] ?>
            </option>
            <?php endforeach; ?>
        </select>
        <div id="nuevosGeneros"></div>
        <button type="button" class="btn btn-secondary mt-2" id="agregarGeneroBtn">Agregar Género</button>
    </div>


    <div class="mb-3">
        <label for="editoriales">Editoriales:</label>
        <select name="editoriales[]" id="editoriales" class="form-control select2">
            <?php foreach ($editoriales as $editorial): ?>
            <option value="<?= $editorial['id'] ?>" 
                <?php if (isset($recurso['editoriales']) && in_array($editorial['id'], array_column($recurso['editoriales'], 'id'))): ?>selected<?php endif; ?>>
                <?= $editorial['nombre'] ?>
            </option>
            <?php endforeach; ?>
        </select>
        <div id="nuevasEditoriales"></div>
        <button type="button" class="btn btn-secondary mt-2" id="agregarEditorialBtn">Agregar Editorial</button>
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
            <input type="text" class="form-control" name="isbn" value="<?= old('isbn', $recurso['isbn'] ?? '') ?>" required>
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
            <input type="file" class="form-control" name="portada">
            <?php if (isset($recurso) && $recurso['portada']): ?>
            <img src="<?= base_url('uploads/' . $recurso['portada']) ?>" alt="Portada del Recurso"
                class="img-thumbnail mt-2" width="100">
            <?php endif; ?>
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
                <option value="libro" <?= (old('formato', $recurso['formato'] ?? '') === 'mapa') ? 'selected' : '' ?>>
                    Mapa
                </option>
                <option value="libro" <?= (old('formato', $recurso['formato'] ?? '') === 'compendio') ? 'selected' : '' ?>>
                    Compendio
                </option>
                <option value="libro" <?= (old('formato', $recurso['formato'] ?? '') === 'catálogo') ? 'selected' : '' ?>>
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
            <!-- Recurso digital: CD, USB, DVD, DV8, ... LISTA DESPLEGABLE ADICIONAL -->
                <option value="otro" <?= (old('formato', $recurso['formato'] ?? '') === 'CD') ? 'selected' : '' ?>>
                    CD
                </option>
                <option value="otro" <?= (old('formato', $recurso['formato'] ?? '') === 'USB') ? 'selected' : '' ?>>
                    USB
                </option>
                <option value="otro" <?= (old('formato', $recurso['formato'] ?? '') === 'DVD') ? 'selected' : '' ?>>
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


    <button type="submit"
        class="btn btn-primary mb-2"><?= isset($recurso) ? 'Actualizar Recurso' : 'Crear Recurso' ?></button>
</form>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>

<script>
$(document).ready(function() {
    $('.select2').select2();

    $("#agregarAutorBtn").click(function() {
        $("#nuevosAutores").append(`
                    <div class="nuevo-autor row mt-2">
                        <div class="col-md-4 form-group">
                            <!-- <label for="nombre">Nombre:</label> -->
                            <input type="text" placeholder="Nombre" name="nuevos_autores[nombre][]" class="form-control">
                        </div>
                        <div class="col-md-4 form-group">
                            <!-- <label for="apellido">Apellido:</label> -->
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



    $("#agregarGeneroBtn").click(function() {
        $("#nuevosGeneros").append(`
            <div class="nuevo-genero row mt-2">
                <div class="col-md-4 form-group">
                    <input type="text" placeholder="Nuevo Género" name="nuevos_generos[]" class="form-control">
                </div>
                <div class="col-md-8 form-group">
                    <button type="button" class="btn btn-danger eliminar-genero">Eliminar</button>
                </div>
            </div>
        `);
    });

    $(document).on('click', '.eliminar-genero', function() {
        $(this).closest('.nuevo-genero').remove();
    });

    $("#agregarEditorialBtn").click(function() {
        $("#nuevasEditoriales").append(`
            <div class="nuevo-editorial row mt-2">
                <div class="col-md-4 form-group">
                    <input type="text" placeholder="Nueva Editorial" name="nuevas_editoriales[]" class="form-control">
                </div>
                <div class="col-md-8 form-group">
                    <button type="button" class="btn btn-danger eliminar-editorial">Eliminar</button>
                </div>
            </div>
        `);
    });

    $(document).on('click', '.eliminar-editorial', function() {
        $(this).closest('.nuevo-editorial').remove();
    });
});
</script>
<?= $this->endSection() ?>