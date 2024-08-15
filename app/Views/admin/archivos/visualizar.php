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

    <div class="row">
        <div class="col-md-8">
            <h3><?= $archivo['nombre'] ?></h3>
        </div>
        <div class="col-md-4">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="<?= base_url('admin/archivos'); ?>" class="btn btn-primary">Volver</a>
            </div>
        </div>

    </div>


    <div id="pdf-viewer"></div>


</div>

<script>
    window.onload = function() {
        PDFObject.embed("<?= base_url($archivo['ruta']) ?>", "#pdf-viewer");
    };
</script>


<?= $this->endSection(); ?>