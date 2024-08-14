<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<h1>Géneros</h1>

<?php if (session()->has('success')): ?>
    <div class="alert alert-success"><?= session('success') ?></div>
<?php endif; ?>

<?php if (session()->has('error')): ?>
    <div class="alert alert-danger"><?= session('error') ?></div>
<?php endif; ?>

<a href="/generos/new" class="btn btn-primary mb-3">Nuevo Género</a>

<table id="example" class="display table-hover table-responsive mt-3">
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($generos as $genero): ?>
        <tr>
            <td><?= $genero['id'] ?></td>
            <td><?= $genero['nombre'] ?></td>
            <td>
                <a href="/generos/<?= $genero['id'] ?>" class="btn btn-info btn-sm">Ver</a>
                <a href="/generos/<?= $genero['id'] ?>/edit" class="btn btn-warning btn-sm">Editar</a>
                <form action="/generos/<?= $genero['id'] ?>" method="post" class="d-inline">
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
