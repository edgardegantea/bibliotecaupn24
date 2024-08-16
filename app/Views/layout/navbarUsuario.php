<nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <!-- <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i class="bi bi-list"></i> </a> </li> -->

            <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Catálogos</a> </li>
            <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Préstamos</a> </li>

        </ul>
        <ul class="navbar-nav ms-auto">
            

            <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i> </a> </li>
            <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <span class="d-none d-md-inline"><?= session()->get('username'); ?></span> </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <li class="user-header text-bg-primary">
                        <!-- <img src="../../dist/assets/img/user2-160x160.jpg" class="rounded-circle shadow" alt="User Image"> -->
                        <p>
                            <?= session()->get('name'); ?>
                            <small><?= session()->get('email'); ?></small>
                        </p>
                    </li>
                    <li class="user-footer"> <a href="#" class="btn btn-default btn-flat">Perfil</a> <a href="<?= base_url('logout'); ?>" class="btn btn-default btn-flat float-end">Cerrar sesión</a> </li> <!--end::Menu Footer-->
                </ul>
            </li> <!--end::User Menu Dropdown-->
        </ul> <!--end::End Navbar Links-->
    </div> <!--end::Container-->
</nav> <!--end::Header-->