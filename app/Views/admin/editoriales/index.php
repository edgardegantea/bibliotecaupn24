<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<h1>Editoriales</h1>

<?php if (session()->has('success')): ?>
    <div class="alert alert-success"><?= session('success') ?></div>
<?php endif; ?>

<?php if (session()->has('error')): ?>
    <div class="alert alert-danger"><?= session('error') ?></div>
<?php endif; ?>

<a href="/editoriales/new" class="btn btn-primary mb-3">Nueva Editorial</a>

<table id="example" class="display table-hover table-responsive mt-3">
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($editoriales as $editorial): ?>
        <tr>
            <td><?= $editorial['id'] ?></td>
            <td><?= $editorial['nombre'] ?></td>
            <td><?= $editorial['tipo'] ?></td>
            <td>
                <a href="/editoriales/<?= $editorial['id'] ?>" class="btn btn-info btn-sm">Ver</a>
                <a href="/editoriales/<?= $editorial['id'] ?>/edit" class="btn btn-warning btn-sm">Editar</a>
                <form action="/editoriales/<?= $editorial['id'] ?>" method="post" class="d-inline">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>
