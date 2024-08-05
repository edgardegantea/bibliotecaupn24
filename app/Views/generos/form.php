<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<h1><?= isset($genero) ? 'Editar Género' : 'Crear Género' ?></h1>

<?php if (session()->has('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?= base_url('generos' . (isset($genero) ? '/' . $genero['id'] : '')) ?>" method="post">
    <?= csrf_field() ?>
    <?php if (isset($genero)): ?>
        <input type="hidden" name="_method" value="PUT">
    <?php endif; ?>

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control" name="nombre" value="<?= old('nombre', $genero['nombre'] ?? '') ?>">
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción:</label>
        <textarea class="form-control" name="descripcion"><?= old('descripcion', $genero['descripcion'] ?? '') ?></textarea>
    </div>

    

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
<?= $this->endSection() ?>
