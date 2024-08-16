<?= $this->extend('layout/mainUsuario'); ?>

<?= $this->section('content'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.11/pdfobject.min.js"></script>

<div class="container">
    <div class="container mt-5">
        <h1>Recursos digitales</h1>

        <div class="row">
            <?php foreach ($archivos as $archivo): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <?php if ($archivo['tipo'] === 'application/pdf'): ?>
                            <div id="pdf-viewer-<?= $archivo['id'] ?>" class="embed-responsive embed-responsive-16by9"></div> 
                            <script>
                                PDFObject.embed("<?= base_url($archivo['ruta']) ?>", "#pdf-viewer-<?= $archivo['id'] ?>", {
                                    page: 1,
                                    pageMode: 'none', 
                                    pdfOpenParams: { view: 'FitH' } // Ajustar la página horizontalmente
                                });
                            </script>
                        <?php else: ?>
                            <div class="card-body text-center">
                                <i class="far fa-file fa-5x"></i> 
                                <p class="card-text mt-2"><?= $archivo['tipo'] ?></p>
                            </div>
                        <?php endif; ?>

                        <div class="card-body">
                            <h5 class="card-title"><?= $archivo['nombre'] ?></h5>
                            <p class="card-text">Clasificación: <?= $archivo['clasificacion_nombre'] ?></p>
                            <p class="card-text">Peso: <?= number_format($archivo['peso'] / 1024, 2) ?> KB</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
