<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<h1><?= isset($autor) ? 'Editar Autor' : 'Crear Autor' ?></h1>

<?php if (session()->has('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?= base_url('autores' . (isset($autor) ? '/' . $autor['id'] : '')) ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <?php if (isset($autor)): ?>
        <input type="hidden" name="_method" value="PUT">
    <?php endif; ?>

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control" name="nombre" value="<?= old('nombre', $autor['nombre'] ?? '') ?>">
    </div>

    <div class="mb-3">
        <label for="foto" class="form-label">Foto:</label>
        <input type="file" class="form-control" name="foto">
        <?php if (isset($autor) && $autor['foto']): ?>
            <img src="<?= base_url('uploads/' . $autor['foto']) ?>" alt="Foto del Autor" class="img-thumbnail mt-2" width="100">
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="bio" class="form-label">Biografía:</label>
        <textarea class="form-control" name="bio"><?= old('bio', $autor['bio'] ?? '') ?></textarea>
    </div>

    <div class="mb-3">
        <label for="nacionalidad" class="form-label">Nacionalidad:</label>
        <input type="text" class="form-control" name="nacionalidad" value="<?= old('nacionalidad', $autor['nacionalidad'] ?? '') ?>">
    </div>

    <div class="mb-3">
        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
        <input type="date" class="form-control" name="fecha_nacimiento" value="<?= old('fecha_nacimiento', $autor['fecha_nacimiento'] ?? '') ?>">
    </div>

    <div class="mb-3">
        <label for="fecha_fallecimiento" class="form-label">Fecha de Fallecimiento:</label>
        <input type="date" class="form-control" name="fecha_fallecimiento" value="<?= old('fecha_fallecimiento', $autor['fecha_fallecimiento'] ?? '') ?>">
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" name="estado" value="1" <?= old('estado', $autor['estado'] ?? '') ? 'checked' : '' ?>>
        <label class="form-check-label" for="estado">Estado (Activo)</label>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
<?= $this->endSection() ?>
