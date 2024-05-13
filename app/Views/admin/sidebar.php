<?= $this->extend('admin/dashboard') ?>

<?= $this->section('sidebar'); ?>

<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>

        <li class="sidebar-item active ">
            <a href="<?= base_url('/admin') ?>" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>


        <li class="sidebar-item  has-sub">
            <a href="" class='sidebar-link'>
                <i class="bi bi-envelope-fill"></i>
                <span>Laporan</span>
            </a>

            <ul class="submenu ">

                <li class="submenu-item  ">

                    <a href="<?= base_url('Laporan/index') ?>" class="submenu-link">Laporan Harian</a>

                </li>


            </ul>


        </li>

        <li class="sidebar-item  ">
            <a href="form-layout.html" class='sidebar-link'>
                <i class="bi bi-person-circle"></i>
                <span>Profile</span>
            </a>



    </ul>
</div>

</div>
</div>
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Selamat Datang</h3>
    </div>

    <!-- content -->
    <div class="page-content">

        <?= $this->renderSection('main'); ?>

    </div>

    <footer>
        <div class="footer clearfix mb-0 text-muted">
            <div class="float-start">
                <p>2024 &copy; Data Parfume</p>
            </div>
            <div class="float-end">
                <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                    by <a>Hira</a></p>
            </div>
        </div>
    </footer>
</div>
</div>

<?= $this->endSection(); ?>