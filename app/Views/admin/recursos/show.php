<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
    <h1>Detalles del Recurso</h1>

    <?php if ($recurso): ?>
        <?php if ($recurso['portada']): ?>
            <img src="<?= base_url('uploads/' . $recurso['portada']) ?>" alt="Portada del Recurso" class="img-thumbnail mb-3" width="200">
        <?php endif; ?>

        <p><strong>ID:</strong> <?= $recurso['id'] ?></p>
        <p><strong>Título:</strong> <?= $recurso['titulo'] ?></p>
        <p><strong>Subtítulo:</strong> <?= $recurso['subtitulo'] ?></p>
        <p><strong>Autor(es):</strong> 
            <?php foreach ($recurso->autores as $autor): ?>
                <?= $autor->nombre ?>, 
            <?php endforeach; ?>
        </p>
        <p><strong>Género:</strong> <?= $recurso->genero->nombre ?></p>
        <p><strong>ISBN:</strong> <?= $recurso['isbn'] ?></p>
        <p><strong>Año de Publicación:</strong> <?= $recurso['anio_publicacion'] ?></p>
        <p><strong>Idioma:</strong> <?= $recurso['idioma'] ?></p>
        <p><strong>Editorial:</strong> <?= $recurso->editorial->nombre ?></p>
        <p><strong>Edición:</strong> <?= $recurso['edicion'] ?></p>
        <p><strong>Descripción:</strong> <?= $recurso['descripcion'] ?></p>
        <?php else: ?>
        <p>Recurso no encontrado.</p>
    <?php endif; ?>

    <a href="/recursos" class="btn btn-secondary">Volver</a>
<?= $this->endSection() ?>
