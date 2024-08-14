<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h1>Subir Archivo</h1>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<?= form_open('/admin/archivos/store', ['enctype' => 'multipart/form-data']) ?>

<div class="form-group">
    <label for="archivos">Seleccionar Archivos:</label>
    <input type="file" accept=".pdf" class="form-control-file" id="archivos" name="archivos[]" multiple required>
</div>

<div class="form-group">  

    <label for="clasificacion_id">Clasificación:</label>
    <select class="form-control" id="clasificacion_id" name="clasificacion_id">
        <?php foreach ($clasificaciones as $clasificacion): ?>
            <option value="<?= $clasificacion['id'] ?>"><?= $clasificacion['nombre'] ?></option>
        <?php endforeach; ?>
    </select>
</div>

<button type="submit" class="btn btn-primary">Subir</button>

</form>


<?= $this->endSection(); ?>