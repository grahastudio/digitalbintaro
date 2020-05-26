<?php
$id = $this->session->userdata('id');
$user = $this->user_model->user_detail($id);
$meta = $this->meta_model->get_meta();
?>



<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center bg-gradient-primary" href="<?php echo base_url('admin/dashboard'); ?>">

        <div class="sidebar-brand-icon">
            <i class="ti-lock"></i> </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>
    <hr class="sidebar-divider my-0">

    <?php if ($user->role_id == 1) : ?>
        <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url('admin/dashboard'); ?>">
                <i class="ti-home fa-fw"></i>
                <span>Dashboard</span></a>
        </li>







        <div class="sidebar-heading">
            MASTER DATA
        </div>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin/pemasukan'); ?>">
                <i class="fa-fw ti-import text-success"></i>
                <span>Pemasukan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin/pengeluaran'); ?>">
                <i class="fa-fw ti-export text-danger"></i>
                <span>Pengeluaran</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin/kas'); ?>">
                <i class="fa-fw ti-credit-card text-info"></i>
                <span>Saldo</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin/category'); ?>">
                <i class="fa-fw ti-bookmark-alt text-primary"></i>
                <span>kategori</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin/asrama'); ?>">
                <i class="fa-fw fas fa-store text-primary"></i>
                <span>Asrama</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin/cabang'); ?>">
                <i class="fa-fw fas fa-users text-primary"></i>
                <span>User</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin/myaccount'); ?>">
                <i class="fa-fw ti-user text-primary"></i>
                <span>My Account</span>
            </a>
        </li>


        <div class="sidebar-heading">
            Seting Web
        </div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage" aria-expanded="true" aria-controls="collapsePage">
                <i class="fas fa-fw fa-cog"></i>
                <span>Site Setings</span>
            </a>
            <div id="collapsePage" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <!-- <h6 class="collapse-header">Example Pages</h6> -->
                    <a class="collapse-item" href="<?php echo base_url('admin/meta'); ?>">Setings</a>
                    <a class="collapse-item" href="<?php echo base_url('admin/meta/logo'); ?>">Logo</a>
                    <a class="collapse-item" href="<?php echo base_url('admin/meta/favicon'); ?>">Favicon</a>
                </div>
            </div>
        </li>
        <!-- <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('admin/menu'); ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Menu</span>
        </a>
    </li> -->

        <!-- MENU ADMIN CABANG -->

    <?php else : ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin/home'); ?>">
                <i class="ti-home fa-fw"></i>
                <span>Home</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin/home/pemasukan'); ?>">
                <i class="fa-fw ti-import text-success"></i>
                <span>Pemasukan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin/home/pengeluaran'); ?>">
                <i class="fa-fw ti-export text-danger"></i>
                <span>Pengeluaran</span>
            </a>
        </li>
        <div class="sidebar-heading">
            PENGATURAN AKUN
        </div>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin/myaccount'); ?>">
                <i class="ti-user fa-fw"></i>
                <span>Akun Saya</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin/myaccount/update'); ?>">
                <i class="ti-comments-smiley fa-fw"></i>
                <span>Ubah Profile</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin/myaccount/ubah_password'); ?>">
                <i class="ti-lock fa-fw"></i>
                <span>Ganti Password</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('auth/logout'); ?>">
                <i class="ti-plug fa-fw"></i>
                <span>Logout</span></a>
        </li>
    <?php endif; ?>


</ul>
<!-- Sidebar -->

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">