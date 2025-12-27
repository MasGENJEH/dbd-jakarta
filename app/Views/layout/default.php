<?php echo $this->include('layout/header'); ?>

<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
            </li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>
        <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
        </div>
    </form>
    <ul class="navbar-nav navbar-right">
        <?php echo $this->include('element/profil'); ?>
    </ul>
</nav>
<div class="main-sidebar">
    <?php echo $this->include('layout/sidebar'); ?>
</div>
<div class="main-content">
    <?php echo $this->renderSection('content'); ?>
    <?php echo $this->renderSection('tabel_penduduk'); ?>
    <?php echo $this->renderSection('tabel_pengguna'); ?>
    <?php echo $this->renderSection('kartu_keluarga'); ?>
    <?php echo $this->renderSection('form_tambah'); ?>
    <?php echo $this->renderSection('form_edit'); ?>
</div>
<?php echo $this->include('layout/footer'); ?>