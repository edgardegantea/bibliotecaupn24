<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

    <h1 class="my-4">Editar publicación</h1>
    <form action="<?= base_url('carousel/update/' . $image['id']); ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <input type="hidden" name="_method" value="PUT">

        <div class="mb-3">
            <label for="image" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            <img src="<?= base_url('uploads/' . $image['filename']); ?>" alt="Imagen Actual" class="img-thumbnail mt-2" style="max-width: 300px;">
        </div>
        <div class="mb-3">
            <label for="autor" class="form-label">Autor</label>
            <input type="text" class="form-control" id="autor" name="autor" value="<?= $image['autor']; ?>">
        </div>
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="<?= $image['titulo']; ?>">
        </div>
        <div class="mb-3">
            <label for="resumen" class="form-label">Resumen</label>
            <textarea class="form-control" id="resumen" name="resumen" rows="3"><?= $image['resumen']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="contenido" class="form-label">Contenido</label>
            <textarea class="form-control" id="contenido" name="contenido" rows="5"><?= $image['contenido']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-select" id="estado" name="estado">
                <option value="activo" <?= ($image['estado'] == 'activo') ? 'selected' : ''; ?>>Activo</option>
                <option value="inactivo" <?= ($image['estado'] == 'inactivo') ? 'selected' : ''; ?>>Inactivo</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-select" id="tipo" name="tipo">
                <option value="imagen" <?= ($image['tipo'] == 'imagen') ? 'selected' : ''; ?>>Imagen</option>
                <option value="video" <?= ($image['tipo'] == 'video') ? 'selected' : ''; ?>>Video</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>


<?= $this->endSection() ?>