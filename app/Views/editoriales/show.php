<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<h1>Detalles de la Editorial</h1>

<p><strong>ID:</strong> <?= $editorial['id'] ?></p>
<p><strong>Nombre:</strong> <?= $editorial['nombre'] ?></p>
<p><strong>Tipo:</strong> <?= $editorial['tipo'] ?></p>
<p><strong>Dirección:</strong> <?= $editorial['direccion'] ?></p>
<p><strong>Email:</strong> <?= $editorial['email'] ?></p>

<a href="/editoriales" class="btn btn-secondary">Volver</a>
<?= $this->endSection() ?>
