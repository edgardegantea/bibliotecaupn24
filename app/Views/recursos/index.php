<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>



<div class="container mt-4">
    <h1>Lista de Recursos</h1>

    <a href="/recursos/new" class="btn btn-primary mb-3">Crear Nuevo Recurso</a>

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
                        if (isset($recurso['autores']) && is_array($recurso['autores'])) {
                            $autoresString = "";
                            foreach ($recurso['autores'] as $autor) {
                                $nombreAutor = isset($autor['nombre']) ? $autor['nombre'] : '';
                                $apellidoAutor = isset($autor['apellido']) ? $autor['apellido'] : '';
                                $autoresString .= $nombreAutor . " " . $apellidoAutor . ", ";
                            }
                            echo rtrim($autoresString, ", "); // Eliminar la última coma
                        } else {
                            echo "Sin autores"; // Mostrar un mensaje si no hay autores
                        }
                        ?>
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