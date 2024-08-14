<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

        <h1>Lista de Clasificaciones</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <a href="/admin/clasificaciones/create" class="btn btn-primary mb-3">Crear Nueva Clasificación</a>

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