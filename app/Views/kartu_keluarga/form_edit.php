<?php echo $this->extend('layout/default'); ?>

<?php echo $this->section('judul'); ?>
<title>Create | Kartu Keluarga</title>
<?php echo $this->endSection(); ?>


<?php echo $this->section('form_tambah'); ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?php echo base_url('kartu-keluarga'); ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Tambah Kartu Keluarga</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url('home'); ?>">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="<?php echo base_url('kartu-keluarga'); ?>">Kartu Keluarga</a></div>
            <div class="breadcrumb-item">Tambah Kartu Keluarga</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Masukan Data Kartu Keluarga Baru</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url('kartu-keluarga/'.$kartu_keluarga->nomor_kk); ?>"
                            method="post" autocomplete="off">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="_method" value="PUT">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor KK</label>
                                        <input type="number" name="nomor_kk" class="form-control"
                                            value="<?php echo $kartu_keluarga->nomor_kk; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text" name="alamat" class="form-control"
                                            value="<?php echo $kartu_keluarga->alamat; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>RT</label>
                                        <input type="text" name="rt" class="form-control"
                                            value="<?php echo $kartu_keluarga->rt; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>RW</label>
                                        <input type="text" name="rw" class="form-control"
                                            value="<?php echo $kartu_keluarga->rw; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dusun</label>
                                        <input type="text" name="dusun" class="form-control"
                                            value="<?php echo $kartu_keluarga->dusun; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pendapatan</label>
                                        <input type="number" name="pendapatan" class="form-control"
                                            value="<?php echo $kartu_keluarga->pendapatan; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Skala Rumah</label>
                                        <input type="number" name="skala_rumah" class="form-control"
                                            value="<?php echo $kartu_keluarga->skala_rumah; ?>">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Simpan Data</button>
                        </form>

                    </div>


                </div>
            </div>
</section>
<?php echo $this->endSection(); ?>