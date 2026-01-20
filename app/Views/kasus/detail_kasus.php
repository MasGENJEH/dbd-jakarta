<?php echo $this->extend('layout/default'); ?>

<?php echo $this->section('judul'); ?>
<title>Detail | Kasus</title>
<?php echo $this->endSection(); ?>

<?php echo $this->section('form_tambah'); ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?php echo base_url('kasus'); ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Detail Kasus</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url('home'); ?>">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="<?php echo base_url('kasus'); ?>">Kasus</a></div>
            <div class="breadcrumb-item">Detail Kasus</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Informasi Kasus</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>Alamat</th>
                                <td><?php echo $kasus->lokasi; ?></td>
                            </tr>
                            <tr>
                                <th>Wilayah Kota</th>
                                <td><?php echo $kasus->kota; ?></td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td><?php echo $kasus->jenis_kelamin; ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <?php if ($kasus->status == 'aktif') { ?>
                                        <div class="badge badge-warning">Aktif</div>
                                    <?php } else { ?>
                                        <div class="badge badge-success">Sembuh</div>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Tanggal Kasus</th>
                                <td><?php echo date('d F Y', strtotime($kasus->tanggal_kasus)); ?></td>
                            </tr>
                            <tr>
                                <th>Latitude</th>
                                <td><?php echo $kasus->lat; ?></td>
                            </tr>
                            <tr>
                                <th>Longitude</th>
                                <td><?php echo $kasus->long; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Lokasi Peta</h4>
                    </div>
                    <div class="card-body">
                        <div id="map" data-height="300" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var lat = <?php echo $kasus->lat; ?>;
    var lng = <?php echo $kasus->long; ?>;

    var map = L.map('map').setView([lat, lng], 15);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([lat, lng]).addTo(map)
        .bindPopup('<b>Lokasi Kasus</b><br>' + '<?php echo $kasus->lokasi; ?>').openPopup();
</script>

<?php echo $this->endSection(); ?>
