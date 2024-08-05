<!DOCTYPE html>
<html>
<head>
    <title>Restablecer Contraseña</title>
</head>
<body>
    <div class="container">
        <h2>Restablecer Contraseña</h2>

        <?php if (isset($validation)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($validation->getErrors() as $error): ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('auth/processResetPassword'); ?>" method="post">
            <input type="hidden" name="token" value="<?= $token; ?>">
            <div class="form-group">
                <label for="password">Nueva Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmar Contraseña:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Restablecer Contraseña</button>
        </form>
    </div>
</body>
</html>
