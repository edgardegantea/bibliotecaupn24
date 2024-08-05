<?= $this->extend('layout/main'); ?>


<?= $this->section('content'); ?>

    <div class="">
        <div class="card mt-3">
            <div class="card-header">
                <div class="">
                    <div class="row">
                        <div class="col-md-8">
                            <h2>Usuarios del sistema</h2>
                        </div>
                        <div class="col-md-4">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="<?= base_url('users/new'); ?>" class="btn btn-primary">Crear nuevo usuario</a>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="card-body">


            <table id="example" class="display table-hover table-responsive mt-3">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Nombre de Usuario</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id']; ?></td>
                        <td><?= $user['name']; ?></td>
                        <td><?= $user['email']; ?></td>
                        <td><?= $user['username']; ?></td>
                        <td>
                            <?php if (isset($user['role_name'])): ?>
                                <?= $user['role_name']; ?>
                            <?php else: ?>
                                Sin rol asignado
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= base_url('users/' . $user['id'] . '/edit'); ?>" class="btn btn-warning">Editar</a>
                            <form action="<?= base_url('users/' . $user['id']); ?>" method="post" style="display: inline;">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Nombre de Usuario</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
                </tfoot>
            </table>
            </div>

        </div>

    </div>


<?= $this->endSection('content'); ?>
