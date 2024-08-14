<?= $this->extend('layout/main'); ?>


<?= $this->section('content'); ?>

<div class="container mt-5">
        <h1>Publicaciones</h1>

        <a href="/publicaciones/new" class="btn btn-primary mb-3">Crear Nueva Publicación</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Fecha Publicación</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($publicaciones as $publicacion): ?>
                    <tr>
                        <td><?= $publicacion['titulo'] ?></td>
                        <td><?= $publicacion['fecha_publicacion'] ?></td>
                        <td><?= $publicacion['estado'] ?></td>
                        <td>
                            <a href="/publicaciones/edit/<?= $publicacion['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="/publicaciones/delete/<?= $publicacion['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta publicación?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?= $this->endSection(); ?>