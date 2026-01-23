<?php echo $this->extend('layout/default'); ?>

<?php echo $this->section('judul'); ?>
<title>View | Kasus</title>
<?php echo $this->endSection(); ?>

<?php echo $this->section('tabel_kasus'); ?>
<section class="section">
    <div class="section-header">

        <h1>Data Kasus DBD</h1>
        <div class="section-header-button">
            <a href="<?php echo base_url('kasus/tambah'); ?>" class="btn btn-primary">Tambah Data</a>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url('home'); ?>">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="<?php echo base_url('kasus'); ?>">Kasus Dbd</a></div>
            <div class="breadcrumb-item">Data Kasus DBD</div>
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
                        <h4>Tabel kasus</h4>
                        <div class="card-header-form">
                            <form action="<?php echo base_url('kasus'); ?>" method="GET">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Cari Nama atau lokasi..." value="<?php echo isset($_GET['keyword']) ? esc($_GET['keyword']) : ''; ?>">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        <?php if (isset($_GET['keyword'])) { ?>
                                            <a href="<?php echo base_url('kasus'); ?>" class="btn btn-secondary"><i class="fas fa-times"></i></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tr>
                                    <th>No</th>
                                    <th>Lokasi</th>
                                    <th>Kota</th>
                                    <th>Koordinat</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal Kasus</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                <?php $userRole = session()->get('role'); ?>
                                <?php $page = isset($_GET['page']) ? $_GET['page'] : 1; ?>
                                <?php $no = 1 + (10 * ($page - 1)); ?>
                                <?php foreach ($kasus as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $value->lokasi; ?></td>
                                    <td><?php echo $value->kota; ?></td>
                                    <td><?php echo $value->lat; ?>, <?php echo $value->long; ?></td>
                                    <td><?php echo $value->jenis_kelamin; ?></td>
                                    <td><?php echo $value->tanggal_kasus; ?></td>
                                            <?php
                                                $badge = [
                                                    'SEMBUH' => 'badge-success',
                                                    'AKTIF' => 'badge-warning',
                                                    'MENINGGAL' => 'badge-danger',
                                                ];
                                    $status = strtoupper($value->status);
                                    ?>
                                    <td><span class="badge <?php echo $badge[$status]; ?>"><?php echo $value->status; ?></span></td>

                                    <td>
                                        <?php if ($userRole === 'admin') { ?>
                                            <a href="<?php echo base_url('kasus/detail/'.$value->id); ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></i></a>
                                            <a href="<?php echo base_url('kasus/ubah/'.$value->id); ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                            <form class="d-inline" action="<?php echo base_url('kasus/'.$value->id); ?>" method="post" onsubmit="return confirm('Hapus data?')">
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