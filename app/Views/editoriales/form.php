<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<h1><?= isset($editorial) ? 'Editar Editorial' : 'Crear Editorial' ?></h1>

<?php if (session()->has('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?= base_url('editoriales' . (isset($editorial) ? '/' . $editorial['id'] : '')) ?>" method="post">
    <?= csrf_field() ?>
    <?php if (isset($editorial)): ?>
        <input type="hidden" name="_method" value="PUT">
    <?php endif; ?>

    <div class="mb-3">
        <label for="nombre_abreviado" class="form-label">Nombre Abreviado:</label>
        <input type="text" class="form-control" name="nombre_abreviado" value="<?= old('nombre_abreviado', $editorial['nombre_abreviado'] ?? '') ?>">
    </div>

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control" name="nombre" value="<?= old('nombre', $editorial['nombre'] ?? '') ?>">
    </div>

    <div class="mb-3">
        <label for="tipo" class="form-label">Tipo:</label>
        <select class="form-select" name="tipo">
            <option value="editorial" <?= old('tipo', $editorial['tipo'] ?? '') === 'editorial' ? 'selected' : '' ?>>Editorial</option>
            <option value="sello" <?= old('tipo', $editorial['tipo'] ?? '') === 'sello' ? 'selected' : '' ?>>Sello</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="direccion" class="form-label">Dirección:</label>
        <input type="text" class="form-control" name="direccion" value="<?= old('direccion', $editorial['direccion'] ?? '') ?>">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" name="email" value="<?= old('email', $editorial['email'] ?? '') ?>">
    </div>

    <div class="mb-3">
        <label for="url" class="form-label">URL:</label>
        <input type="url" class="form-control" name="url" value="<?= old('url', $editorial['url'] ?? '') ?>">
    </div>

    <div class="mb-3">
        <label for="pais" class="form-label">País:</label>
        <input type="text" class="form-control" name="pais" value="<?= old('pais', $editorial['pais'] ?? '') ?>">
    </div>

    <div class="mb-3">
        <label for="prefijos" class="form-label">Prefijos:</label>
        <input type="text" class="form-control" name="prefijos" value="<?= old('prefijos', $editorial['prefijos'] ?? '') ?>">
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción:</label>
        <textarea class="form-control" name="descripcion"><?= old('descripcion', $editorial['descripcion'] ?? '') ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
<?= $this->endSection() ?>
