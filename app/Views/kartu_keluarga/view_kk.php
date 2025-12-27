<?php echo $this->extend('layout/default'); ?>

<?php echo $this->section('judul'); ?>
<title>View | Kartu Keluarga</title>
<?php echo $this->endSection(); ?>



<?php echo $this->section('kartu_keluarga'); ?>
<section class="section">
    <div class="section-header">
        <h1>Data Kartu Keluarga</h1>
        
        <div class="section-header-button">
            <a href="<?php echo base_url('kartu-keluarga/tambah'); ?>" class="btn btn-primary">Tambah Kartu Keluarga</a>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url('home'); ?>">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="<?php echo base_url('kartu-keluarga'); ?>">Kartu Keluarga</a></div>
            <div class="breadcrumb-item">Data Kartu Keluarga</div>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')) { ?>
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">x</button>
            <b>Success !</b>
            <?php echo session()->getFlashdata('success'); ?>
        </div>
    </div>
    <?php }  ?>
    <?php if (session()->getFlashdata('error')) { ?>
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">x</button>
            <b>Success !</b>
            <?php echo session()->getFlashdata('error'); ?>
        </div>
    </div>
    <?php }  ?>
    <div class="section-body">
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tabel Kartu Keluarga</h4>
                        <div class="card-header-form">
                            <form action="<?php echo base_url('kartu-keluarga'); ?>" method="GET">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Cari ..." value="<?php echo isset($_GET['keyword']) ? esc($_GET['keyword']) : ''; ?>">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        <?php if (isset($_GET['keyword'])) { ?>
                                            <a href="<?php echo base_url('kartu-keluarga'); ?>" class="btn btn-secondary"><i class="fas fa-times"></i></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tr>
                                    <th>No</th>
                                    <th>Nomor KK</th>
                                    <th>Alamat</th>
                                    <th>RT</th>
                                    <th>RW</th>
                                    <th>Dusun</th>
                                    <th>Status Penduduk</th>
                                    <th>Pendapatan</th>
                                    <th>Skala Rumah</th>
                                    <th>Verifikasi RT</th>
                                    <th>Verifikasi RW</th>
                                    <th>Action</th>
                                </tr>
                                <?php $userRole = session()->get('role'); ?>
                                <?php $page = isset($_GET['page']) ? $_GET['page'] : 1; ?>
                                <?php $no = 1 + (10 * ($page - 1)); ?>
                                <?php foreach ($kartu_keluarga as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $value->nomor_kk; ?></td>
                                    <td><?php echo $value->alamat; ?></td>
                                    <td><?php echo $value->rt; ?></td>
                                    <td><?php echo $value->rw; ?></td>
                                    <td><?php echo $value->dusun; ?></td>
                                    <td>
                                        <?php if ($value->desa === 'BENGLE') { ?>
                                            <span class="badge badge-primary">PENDUDUK ASLI</span>
                                        <?php } else { ?>
                                            <span class="badge badge-warning">PENDATANG</span>
                                        <?php } ?>
                                    </td>
                                    <td>Rp <?php echo number_format($value->pendapatan, 0, ',', '.'); ?></td>
                                    <td><?php echo $value->skala_rumah; ?>/5</td>

                                    <td>
                                        <?php if ($userRole === 'rt' && $value->status_verifikasi_rt === 'BELUM DISETUJUI') { ?>
                                            <form action="<?php echo base_url('kartu-keluarga/verifikasi-rt/'.$value->nomor_kk); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn btn-warning btn-sm">SETUJUI</button>
                                            </form>
                                        <?php } else { ?>
                                            <?php
                                                $class_rt = 'badge-warning';
                                            if ($value->status_verifikasi_rt === 'DISETUJUI') {
                                                $class_rt = 'badge-success';
                                            }
                                            if ($value->status_verifikasi_rt === 'TIDAK DISETUJUI') {
                                                $class_rt = 'badge-danger';
                                            }
                                            ?>
                                            <span class="badge <?php echo $class_rt; ?>"><?php echo $value->status_verifikasi_rt; ?></span>
                                        <?php } ?>
                                    </td>

                                    <td>
                                        <?php if ($userRole === 'rw' && $value->status_verifikasi_rt === 'DISETUJUI' && $value->status_verifikasi_rw === 'BELUM DISETUJUI') { ?>
                                            <form action="<?php echo base_url('kartu-keluarga/verifikasi-rw/'.$value->nomor_kk); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn btn-warning btn-sm">SETUJUI</button>
                                            </form>
                                        <?php } else { ?>
                                            <?php
                                                $class_rw = 'badge-warning';
                                            if ($value->status_verifikasi_rw === 'DISETUJUI') {
                                                $class_rw = 'badge-success';
                                            }
                                            if ($value->status_verifikasi_rw === 'TIDAK DISETUJUI') {
                                                $class_rw = 'badge-danger';
                                            }
                                            ?>
                                            <span class="badge <?php echo $class_rw; ?>"><?php echo $value->status_verifikasi_rw; ?></span>
                                        <?php } ?>
                                    </td>

                                    <td>
                                        <?php if ($userRole === 'admin') { ?>
                                            <a href="<?php echo base_url('kartu-keluarga/ubah/'.$value->nomor_kk); ?>" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form class="d-inline" action="<?php echo base_url('kartu-keluarga/'.$value->nomor_kk); ?>" method="post" onsubmit="return confirm('Anda yakin ingin menghapus data?')">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </form>
                                        <?php } else { ?>
                                            <span class="text-muted small">No Access</span>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">
                            <?php echo $pager->links('default', 'pagination'); ?>

                        </nav>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<?php echo $this->endSection(); ?>