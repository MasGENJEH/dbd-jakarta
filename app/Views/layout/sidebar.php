<aside id="sidebar-wrapper">
    <div class="sidebar-brand">

        <a href="<?php echo base_url('home'); ?>"><i class="fa fa-user-circle-o"></i>DBD JAKARTA</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">

        <li class="menu-header">Menu</li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('home'); ?>">
                <span><i class="fa fa-home" aria-hidden="true"></i>Kasus Dbd</span></a>
        </li>

        <?php if (session()->get('role') == 'admin') { ?>
        <li class="nav-item dropdown">
            <a class="nav-link has-dropdown" href="#">
                <span><i class="fa fa-users" aria-hidden="true"></i>Pengguna</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?php echo base_url('/pengguna'); ?>">
                        <i class="fas fa-table fa-fw"></i>
                        <span>Tabel Pengguna</span></a></li>
                <li><a class="nav-link" href="<?php echo base_url('/pengguna/tambah'); ?>">
                        <i class="fas fa-user-plus fa-fw"></i>
                        <span>Tambah Pengguna</span></a></li>
            </ul>
        </li>
        <?php }  ?>

    </ul>
</aside>