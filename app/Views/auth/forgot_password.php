<!DOCTYPE html>
<html>
<head>
    <title>Recuperar Contraseña</title>
</head>
<body>
<div class="container">
    <h2>Recuperar Contraseña</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>

    <form action="<?= base_url('forgot-password'); ?>" method="post">
        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar Instrucciones</button>
    </form>
</div>
</body>
</html>
