<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<h1>Detalles del Género seleccionado</h1>

<p><strong>ID:</strong> <?= $genero['id'] ?></p>
<p><strong>Nombre:</strong> <?= $genero['nombre'] ?></p>
<p><strong>Detalles:</strong> <?= $genero['descripcion'] ?></p>
<p><strong>Estado:</strong> <?= $genero['estado'] ?></p>


<a href="/generos" class="btn btn-secondary">Volver</a>
<?= $this->endSection() ?>
