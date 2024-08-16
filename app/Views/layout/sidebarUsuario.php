<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand"><a href="./index.html" class="brand-link">
            <!-- <img src="../../dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow"> -->
            <span class="brand-text fw-light">Biblioteca</span></a></div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open"><a href="#" class="nav-link active"> <i
                                class="nav-icon bi bi-boxes"></i>
                        <p>
                            Catálogos
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/recursos'); ?>" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Recursos bibliográficos</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('admin/archivos'); ?>" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Recursos digitales</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</aside>