<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<h1>Detalles del Autor</h1>

<?php if ($autor): ?>
    <img src="<?= base_url('uploads/' . $autor['foto']) ?>" alt="Foto del Autor" class="img-thumbnail mb-3" width="200">

    <p><strong>ID:</strong> <?= $autor['id'] ?></p>
    <p><strong>Nombre:</strong> <?= $autor['nombre'] ?></p>
    <p><strong>Biografía:</strong> <?= $autor['bio'] ?></p>
    <p><strong>Nacionalidad:</strong> <?= $autor['nacionalidad'] ?></p>
    <p><strong>Fecha de Nacimiento:</strong> <?= $autor['fecha_nacimiento'] ?></p>
    <p><strong>Fecha de Fallecimiento:</strong> <?= $autor['fecha_fallecimiento'] ?></p>
    <p><strong>Estado:</strong> <?= $autor['estado'] ? 'Activo' : 'Inactivo' ?></p>
<?php else: ?>
    <p>Autor no encontrado.</p>
<?php endif; ?>

<a href="/autores" class="btn btn-secondary">Volver</a>
<?= $this->endSection() ?>
