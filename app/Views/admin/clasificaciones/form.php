<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h1><?= isset($clasificacion) ? 'Editar Clasificación' : 'Crear Clasificación' ?></h1>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<form action="<?= isset($clasificacion) ? '/admin/clasificaciones/update/' . $clasificacion['id'] : '/admin/clasificaciones/store' ?>" method="post">
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= old('nombre', isset($clasificacion) ? $clasificacion['nombre'] : '') ?>" required>
    </div>
    <button type="submit" class="btn btn-primary mt-3"><?= isset($clasificacion) ? 'Actualizar' : 'Crear' ?></button>
</form>

<?= $this->endSection(); ?>