<?= $this->extend('layout/main'); ?>


<?= $this->section('content'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="container">
        <h2><?= isset($user) ? 'Editar Usuario' : 'Crear Usuario'; ?></h2>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
        <?php endif; ?>

        <form id="userForm" action="<?= base_url('admin/users' . (isset($user) ? '/' . $user['id'] : '')); ?>" method="post">
            <?php if (isset($user)): ?>
                <input type="hidden" name="_method" value="PUT" />
            <?php endif; ?>

            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= old('name', isset($user['name']) ? $user['name'] : ''); ?>">
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= old('email', isset($user['email']) ? $user['email'] : ''); ?>">
            </div>

            <div class="form-group">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= old('username', isset($user['username']) ? $user['username'] : ''); ?>">
            </div>

            <?php if (!isset($user)): ?>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirmar Contraseña:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const form = document.getElementById('userForm');

            form.addEventListener('submit', (event) => {
                event.preventDefault();

                const formData = new FormData(form);

                fetch(form.action, {
                    method: form.method,
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        if (response.status === 400) {
                            return response.json().then(data => {
                                throw new Error(Object.values(data.errors).join("<br>"));
                            });
                        } else {
                            throw new Error('Ocurrió un error.');
                        }
                    }
                    return response.json();
                })
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        title: data.message,
                    }).then(() => {
                        window.location.href = "<?= base_url('admin/users') ?>";
                    });
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: error.message
                    });
                });
            });
        });
    </script>

<?= $this->endSection(); ?>
