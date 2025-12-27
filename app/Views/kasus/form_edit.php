<?php echo $this->extend('layout/default'); ?>
<?php echo $this->section('form_edit'); ?>

<section class="section">
    <div class="section-header">
        <h1>Ubah Data Penduduk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url('home'); ?>">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="<?php echo base_url('penduduk'); ?>">Penduduk</a></div>
            <div class="breadcrumb-item">Ubah Data Pendududuk</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Ubah Data Penduduk</h4>
                    </div>

                    <div class="card-body">
                        <form action="<?php echo base_url('penduduk/'.$penduduk->nik); ?>" method="post"
                            autocomplete="off">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="_method" value="PUT">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" class="form-control" name="nama_lengkap"
                                            value="<?php echo $penduduk->nama_lengkap; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor KK</label>
                                        <input type="text" class="form-control" name="nomor_kk"
                                            value="<?php echo $penduduk->nomor_kk; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="tanggal_lahir"
                                            value="<?php echo $penduduk->tanggal_lahir; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status_keluarga_select">Status Keluarga</label>
                                        <select class="form-control" id="status_keluarga_select" name="status_keluarga">
                                            <option value="<?php echo $penduduk->status_keluarga; ?>" selected hidden>
                                                <?php echo $penduduk->status_keluarga; ?></option>
                                            <option value="Kepala Keluarga">KEPALA KELUARGA</option>
                                            <option value="Istri">ISTRI</option>
                                            <option value="Anak">ANAK</option>
                                            <option value="Menantu">MENANTU</option>
                                            <option value="Cucu">CUCU</option>
                                            <option value="Orang Tua">ORANG TUA</option>
                                            <option value="Mertua">MERTUA</option>
                                            <option value="Famili Lain">FAMILI LAIN</option>
                                            <option value="Lainnya">LAINNYA</option>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pendidikan_terakhir_select">Pendidikan Terakhir</label>
                                        <select class="form-control" id="pendidikan_terakhir_select"
                                            name="pendidikan_terakhir">
                                            <option value="<?php echo $penduduk->pendidikan_terakhir; ?>" selected
                                                hidden>
                                                <?php echo $penduduk->pendidikan_terakhir; ?></option>
                                            <option value="Tidak / Belum Sekolah">Tidak / Belum Sekolah</option>
                                            <option value="Belum Tamat SD / Sederajat">Belum Tamat SD / Sederajat
                                            </option>
                                            <option value="Tamat SD / Sederajat">Tamat SD / Sederajat</option>
                                            <option value="SLTP / Sederajat">SLTP / Sederajat</option>
                                            <option value="SLTA / Sederajat">SLTA / Sederajat</option>
                                            <option value="Diploma I">Diploma I</option>
                                            <option value="Diploma II">Diploma II</option>
                                            <option value="Diploma III">Diploma III</option>
                                            <option value="Diploma IV">Diploma IV</option>
                                            <option value="Strata I">Strata I</option>
                                            <option value="Strata II">Strata II</option>
                                            <option value="Strata III">Strata III</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pekerjaan</label>
                                        <input type="text" class="form-control" name="pekerjaan"
                                            value="<?php echo $penduduk->pekerjaan; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status_perkawinan_select">Status Perkawinan</label>
                                <select class="form-control" id="status_perkawinan_select" name="status_perkawinan">
                                    <option value="<?php echo $penduduk->status_perkawinan; ?>" selected hidden>
                                        <?php echo $penduduk->status_perkawinan; ?></option>
                                    <option value="Belum Kawin">Belum Kawin</option>
                                    <option value="Kawin">Kawin</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                    <option value="Kawin Belum Tercatat">Kawin Belum Tercatat</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Simpan Data</button>
                        </form>

                    </div>

                </div>
            </div>
</section>
<?php echo $this->endSection(); ?>