<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<h1>Publicación</h1>

<div class="">
<h1>Publicaciones</h1>

<form action="/carousel/store" method="post" enctype="multipart/form-data">

    <div class="mb-3">
        <label for="image" class="form-label">Imagen</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
    </div>


    <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" class="form-control" id="titulo" name="titulo"
            value="<?= old('titulo', $publicacion['titulo'] ?? '') ?>" placeholder="Título">
    </div>

    <div class="mb-3">
        <label for="resumen" class="form-label">Resumen</label>
        <textarea class="form-control" id="resumen" name="resumen"
            placeholder="Resumen"><?= old('resumen', $publicacion['resumen'] ?? '') ?></textarea>
    </div>

    <div class="mb-3">
        <label for="enlace" class="form-label">Enlace (opcional)</label>
        <input type="url" class="form-control" id="enlace" name="enlace"
            placeholder="Contenido" value="<?= old('enlace', $publicacion['enlace'] ?? '') ?>">
    </div>

    <div class="mb-3">
        <label for="contenido" class="form-label">Contenido</label>
        <textarea class="form-control" id="contenido" name="contenido"
            placeholder="Contenido"><?= old('contenido', $publicacion['contenido'] ?? '') ?></textarea>
    </div>

    <div class="mb-3">
        <label for="estado" class="form-label">Estado</label>
        <select class="form-select" id="estado" name="estado">

            <option value="activo" <?= isset($publicacion) && $publicacion['estado'] == 'activo' ? 'selected' : '' ?>>
                Activo</option>
            <option value="inactivo"
                <?= isset($publicacion) && $publicacion['estado'] == 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="tipo" class="form-label">Tipo</label>
        <select class="form-select" id="tipo" name="tipo">
            <option value="imagen" <?= isset($publicacion) && $publicacion['tipo'] == 'carousel' ? 'selected' : '' ?>>Carousel</option>
            <option value="gestorbibliografico" <?= isset($publicacion) && $publicacion['tipo'] == 'gestorbibliografico' ? 'selected' : '' ?>>Gestor Bibliográfico</option>
            <option value="buscadoracademico" <?= isset($publicacion) && $publicacion['tipo'] == 'buscadoracademico' ? 'selected' : '' ?>>Buscador Académico</option>
            <option value="traductor" <?= isset($publicacion) && $publicacion['tipo'] == 'traductor' ? 'selected' : '' ?>>Traductor</option>
            <option value="tppsicometricas" <?= isset($publicacion) && $publicacion['tipo'] == 'tppsicometricas' ? 'selected' : '' ?>>Test y Pruebas Psicométricas</option>
            <option value="diccionario" <?= isset($publicacion) && $publicacion['tipo'] == 'diccionario' ? 'selected' : '' ?>>Diccionario</option>
            <option value="enciclopedia" <?= isset($publicacion) && $publicacion['tipo'] == 'enciclopedia' ? 'selected' : '' ?>>Enciclopedia</option>
            <option value="prelectronicos" <?= isset($publicacion) && $publicacion['tipo'] == 'prelectronicos' ? 'selected' : '' ?>>Plataforma de Recursos Electrónicos</option>
        </select>
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-primary"><?= isset($publicacion) ? 'Actualizar' : 'Subir' ?></button>
    </div>
</form>
</div>

<?= $this->endSection() ?>