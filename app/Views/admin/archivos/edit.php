<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h1>Editar Archivo</h1>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="/archivos/update/<?= $archivo['id'] ?>" method="post">
            <div class="form-group">
                <label for="clasificacion_id">Clasificación:</label>
                <select class="form-control" id="clasificacion_id" name="clasificacion_id">
                    <?php foreach ($clasificaciones as $clasificacion): ?>
                        <option value="<?= $clasificacion['id'] ?>" <?= ($clasificacion['id'] == $archivo['clasificacion_id']) ? 'selected' : '' ?>><?= $clasificacion['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>

        <?= $this->endSection(); ?>