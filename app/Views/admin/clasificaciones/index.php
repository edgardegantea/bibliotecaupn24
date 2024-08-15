<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>


<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>



<div class="row mt-3">
    <div class="col-md-8">
        <h2>Clasificaciones</h2>
    </div>
    <div class="col-md-4">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="<?= base_url('admin/clasificaciones/create'); ?>" class="btn btn-primary">Crear clasificación</a>
        </div>
    </div>

</div>



<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clasificaciones as $clasificacion): ?>
            <tr>
                <td><?= $clasificacion['id'] ?></td>
                <td><?= $clasificacion['nombre'] ?></td>
                <td>
                    <a href="/admin/clasificaciones/edit/<?= $clasificacion['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="/admin/clasificaciones/delete/<?= $clasificacion['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta clasificación?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>


<?= $this->endSection(); ?>