<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.11/pdfobject.min.js"></script>  

<style>
    #pdf-viewer {
        width: 100%;
        height: 70vh;
        /* Ajustar la altura al 100% de la ventana gráfica */
    }
</style>

<div class="">
    <h1>
        <div class="row">
            <div class="col">
                <?= $archivo['nombre'] ?>
            </div>
            <div class="col">
                <a href="/admin/archivos" class="btn btn-secondary">Volver</a>
            </div>
        </div>    
    </h1>

    <div id="pdf-viewer"></div>

    
</div>

<script>
    window.onload = function() {
        PDFObject.embed("<?= base_url($archivo['ruta']) ?>", "#pdf-viewer");
    };
</script>


<?= $this->endSection(); ?>