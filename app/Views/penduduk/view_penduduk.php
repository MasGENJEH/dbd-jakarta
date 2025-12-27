<?php echo $this->extend('layout/default'); ?>

<?php echo $this->section('judul'); ?>
<title>View | Rakyat Desa</title>
<?php echo $this->endSection(); ?>

<?php echo $this->section('tabel_penduduk'); ?>
<section class="section">
    <div class="section-header">

        <h1>Data Penduduk</h1>
        <div class="section-header-button">
            <a href="<?php echo base_url('penduduk/tambah'); ?>" class="btn btn-primary">Tambah Penduduk</a>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url('home'); ?>">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="<?php echo base_url('penduduk'); ?>">Penduduk</a></div>
            <div class="breadcrumb-item">Data Anggota Keluarga</div>
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
            <b>Error !</b>
            <?php echo session()->getFlashdata('error'); ?>
        </div>
    </div>
    <?php }  ?>
    <div class="section-body">
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tabel Penduduk</h4>
                        <div class="card-header-form">
                            <form action="<?php echo base_url('penduduk'); ?>" method="GET">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Cari NIK atau Nama..." value="<?php echo isset($_GET['keyword']) ? esc($_GET['keyword']) : ''; ?>">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        <?php if (isset($_GET['keyword'])) { ?>
                                            <a href="<?php echo base_url('penduduk'); ?>" class="btn btn-secondary"><i class="fas fa-times"></i></a>
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
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Pekerjaan</th>
                                    <th>Pendidikan Terakhir</th>
                                    <th>Status Pernikahan</th>
                                    <th>Verifikasi RT</th>
                                    <th>Verifikasi RW</th>
                                    <th>Action</th>
                                </tr>
                                <?php $userRole = session()->get('role'); ?>
                                <?php $page = isset($_GET['page']) ? $_GET['page'] : 1; ?>
                                <?php $no = 1 + (10 * ($page - 1)); ?>
                                <?php foreach ($penduduk as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $value->nik; ?></td>
                                    <td><?php echo $value->nama_lengkap; ?></td>
                                    <td><?php echo $value->tanggal_lahir; ?></td>
                                    <td><?php echo $value->jenis_kelamin; ?></td>
                                    <td><?php echo $value->pekerjaan; ?></td>
                                    <td><?php echo $value->pendidikan_terakhir; ?></td>
                                    <td><?php echo $value->status_perkawinan; ?></td>
                                    
                                    <td>
                                        <?php if ($userRole === 'rt' && $value->status_verifikasi_rt === 'BELUM DISETUJUI') { ?>
                                            <form action="<?php echo base_url('penduduk/verifikasi-rt/'.$value->nik); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn btn-warning btn-sm">SETUJUI</button>
                                            </form>
                                        <?php } else { ?>
                                            <?php
                                                $badge = [
                                                    'DISETUJUI' => 'badge-success',
                                                    'BELUM DISETUJUI' => 'badge-warning',
                                                    'TIDAK DISETUJUI' => 'badge-danger',
                                                ];
                                            $status = $value->status_verifikasi_rt;
                                            ?>
                                            <span class="badge <?php echo $badge[$status] ?? 'badge-secondary'; ?>"><?php echo $status; ?></span>
                                        <?php } ?>
                                    </td>

                                    <td>
                                        <?php if ($userRole === 'rw' && $value->status_verifikasi_rt === 'DISETUJUI' && $value->status_verifikasi_rw === 'BELUM DISETUJUI') { ?>
                                            <form action="<?php echo base_url('penduduk/verifikasi-rw/'.$value->nik); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn btn-warning btn-sm">SETUJUI</button>
                                            </form>
                                        <?php } else { ?>
                                            <?php
                                                $badge = [
                                                    'DISETUJUI' => 'badge-success',
                                                    'BELUM DISETUJUI' => 'badge-warning',
                                                    'TIDAK DISETUJUI' => 'badge-danger',
                                                ];
                                            $status = $value->status_verifikasi_rw;
                                            ?>
                                            <span class="badge <?php echo $badge[$status] ?? 'badge-secondary'; ?>"><?php echo $status; ?></span>
                                        <?php } ?>
                                    </td>

                                    <td>
                                        <?php if ($userRole === 'admin') { ?>
                                            <a href="<?php echo base_url('penduduk/ubah/'.$value->nik); ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                            <form class="d-inline" action="<?php echo base_url('penduduk/'.$value->nik); ?>" method="post" onsubmit="return confirm('Hapus data?')">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </form>
                                        <?php } else { ?>
                                            <span class="text-muted small">No Action</span>
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