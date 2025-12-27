<?php echo $this->extend('layout/default'); ?>

<?php echo $this->section('judul'); ?>
<title>View | User</title>
<?php echo $this->endSection(); ?>

<?php echo $this->section('tabel_pengguna'); ?>
<section class="section">
    <div class="section-header">

        <h1>Data Pengguna</h1>
        <div class="section-header-button">
            <a href="<?php echo base_url('pengguna/tambah'); ?>" class="btn btn-primary">Tambah Pengguna</a>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url('home'); ?>">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="<?php echo base_url('pengguna'); ?>">Pengguna</a></div>
            <div class="breadcrumb-item">Data Pengguna</div>
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
                        <h4>Tabel Pengguna</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                                <?php
                                $page = isset($_GET['page']) ? $_GET['page'] : 1;
$no = 1 + (10 * ($page - 1));
foreach ($user as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $value->username; ?></td>
                                    <td><?php echo $value->email; ?></td>
                                    <td><?php echo $value->role; ?></td>
                                    <td>
                                        <a href="<?php echo base_url('pengguna/ubah/'.$value->id); ?>"
                                            class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                        <form class="d-inline" action="<?php echo base_url('pengguna/'.$value->id); ?>"
                                            method="post" onsubmit="return confirm('Anda yakin ingin menghapus data?')">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
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