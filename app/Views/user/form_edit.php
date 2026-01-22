<?php echo $this->extend('layout/default'); ?>
<?php echo $this->section('form_tambah'); ?>

<section class="section">
    <div class="section-header">
        <h1>Ubah Data Pengguna</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url('home'); ?>">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="<?php echo base_url('pengguna'); ?>">Pengguna</a></div>
            <div class="breadcrumb-item">Ubah Data Pengguna</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Ubah Data Pengguna</h4>
                    </div>

                    <div class="card-body">
                        <form action="<?php echo base_url('pengguna/'.$user->id); ?>" method="post"
                            autocomplete="off">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="_method" value="PUT">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="username"
                                            value="<?php echo $user->username; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email"
                                            value="<?php echo $user->email; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password">
                                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti password</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role_select">Role</label>
                                        <select class="form-control" id="role_select" name="role">
                                            <option value="" selected disabled hidden>Pilih Role</option>
                                            <option value="admin" <?php echo ($user->role == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                            <option value="user" <?php echo ($user->role == 'user') ? 'selected' : ''; ?>>User</option>
                                        </select>
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