<?php echo $this->section('judul'); ?>
<title>Halaman Daftar Akun</title>
<?php echo $this->endSection(); ?>

<?php echo $this->include('layout/header'); ?>
<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-10 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                <div class="login-brand">

                    <img src="<?php echo base_url(); ?>/template/assets/img/avatar/avatar-1.png" alt="logo" width="100"
                        class="shadow-light rounded-circle">
                </div>

                <div class="card card-primary col-8 mx-auto">
                    <div class="card-header">
                        <h4>Daftar</h4>
                    </div>

                    <div class="card-body">
                        <?php if (session()->getFlashdata('error')) { ?>
                        <div class="alert alert-danger alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">x</button>
                                <b>Error</b>
                                <?php echo session()->getFlashdata('error'); ?>
                            </div>
                        </div>
                        <?php }  ?>
                        <form method="POST" action="<?php echo base_url('auth/daftar'); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" type="text"
                                    class="form-control <?php session('errors.username') ? 'is-invalid' : ''; ?>"
                                    name="username" autofocus>
                                <!-- <div class="invalid-feedback">
                                    <?php echo session('errors.username'); ?>
                                </div> -->
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email">
                                <div class="invalid-feedback">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="d-block">Password</label>
                                <input id="password" type="password" class="form-control pwstrength"
                                    data-indicator="pwindicator" name="password">
                                <div id="pwindicator" class="pwindicator">
                                    <div class="bar"></div>
                                    <div class="label"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password2" class="d-block">Password Confirmation</label>
                                <input id="password2" type="password" class="form-control" name="password-confirm">
                            </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            Register
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<?php echo $this->include('layout/footer'); ?>