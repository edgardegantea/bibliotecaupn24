<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="mt-3">

    <div class="row">
        <div class="col-md-8">
            <h2>Recursos bibliográficos</h2>
        </div>
        <div class="col-md-4">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="<?= base_url('admin/recursos/new'); ?>" class="btn btn-primary">Subir recurso bibliográfico</a>
            </div>
        </div>
    </div>

    <?php if (session()->has('success')): ?>
        <div class="alert alert-success">
            <?= session('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger">
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <table id="example" class="display table-hover table-responsive mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Subtítulo</th>
                <th>Género</th>
                <th>ISBN</th>
                <th>Año Publicación</th>
                <th>Idioma</th>
                <th>Editorial</th>
                <th>Edición</th>
                <th>Autores</th>
                <th>Archivo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recursos as $recurso): ?>
                <tr>
                    <td><?= $recurso['id'] ?></td>
                    <td><?= $recurso['titulo'] ?></td>
                    <td><?= $recurso['subtitulo'] ?></td>
                    <td><?= $recurso['genero_nombre'] ?></td>
                    <td><?= $recurso['isbn'] ?></td>
                    <td><?= $recurso['anio_publicacion'] ?></td>
                    <td><?= $recurso['idioma'] ?></td>
                    <td><?= $recurso['editorial_nombre'] ?></td>
                    <td><?= $recurso['edicion'] ?></td>
                    <td>
                        <?php
                        $autores = $recurso['autores'];
                        if (!empty($autores)) {
                            $nombresAutores = array_column($autores, 'nombre');
                            echo implode(", ", $nombresAutores);
                        } else {
                            echo "Sin autores";
                        }
                        ?>
                    </td>
                    <td>
                        <?php if ($recurso['archivo']): ?>
                            <a href="/uploads/<?= $recurso['archivo'] ?>" target="_blank">
                                <?= $recurso['archivo'] ?>
                            </a>
                        <?php else: ?>
                            Sin archivo
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="/recursos/edit/<?= $recurso['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <form action="/recursos/delete/<?= $recurso['id'] ?>" method="post" style="display: inline;">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>