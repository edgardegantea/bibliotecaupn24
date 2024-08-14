<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>



<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.11/pdfobject.min.js"></script>  




<h1>Lista de Archivos</h1>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<a href="/admin/archivos/create" class="btn btn-primary mb-3">Subir Nuevo Archivo</a>

<table id="example" class="display table-hover table-responsive mt-3 border-0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Clasificación</th>
            <th>Tamaño</th>
            <!-- <th>Tipo</th> -->
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($archivos as $archivo): ?>
            <tr>
                <td><?= $archivo['id'] ?></td>
                <td>
                <?php if ($archivo['tipo'] === 'application/pdf'): ?>
                        <a href="/admin/archivos/visualizar/<?= $archivo['id'] ?>" class="text-decoration-none" target="_self"><?= $archivo['nombre'] ?></a>
                    <?php endif; ?>
                </td>
                <td><?= $archivo['clasificacion_nombre'] ?></td>
                <td><?= number_format($archivo['peso'] / 1024, 2) ?> KB</td>
                <!-- <td><?= $archivo['tipo'] ?></td> -->
                <td>
                    <!--
                    <?php if ($archivo['tipo'] === 'application/pdf'): ?>
                        <a href="/admin/archivos/visualizar/<?= $archivo['id'] ?>" class="btn btn-info btn-sm" target="_self">Ver</a>
                    <?php endif; ?>
                    -->
                    <a href="/admin/archivos/edit/<?= $archivo['id'] ?>" class="btn btn-light btn-sm"><i class="bi bi-pencil-square"></i></a>
                    <a href="/admin/archivos/delete/<?= $archivo['id'] ?>" class="btn btn-light btn-sm border-0 text-danger" onclick="return confirm('¿Estás seguro de eliminar este archivo?')"><i class="bi bi-x-square"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</div>



<?= $this->endSection(); ?>