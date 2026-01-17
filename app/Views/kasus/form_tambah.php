<?php echo $this->extend('layout/default'); ?>

<?php echo $this->section('judul'); ?>
<title>Create | Kasus</title>
<?php echo $this->endSection(); ?>


<?php echo $this->section('form_tambah'); ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?php echo base_url('penduduk'); ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Tambah Kasus</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url('home'); ?>">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="<?php echo base_url('penduduk'); ?>">Kasus</a></div>
            <div class="breadcrumb-item">Tambah Pendududuk</div>
        </div>
    </div>



    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Masukan Data Kasus Baru</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url('penduduk/save'); ?>" method="post" autocomplete="off">
                            <?php echo csrf_field(); ?>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alamat Kasus</label>
                                        <input type="text" name="lokasi" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                id="radio_laki" value="LAKI-LAKI" required>
                                            <label class="form-check-label" for="radio_laki">Laki-laki</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                id="radio_perempuan" value="PEREMPUAN" required>
                                            <label class="form-check-label" for="radio_perempuan">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="radio_aktif" value="aktif" required>
                                            <label class="form-check-label" for="radio_aktif">Aktif</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="radio_sembuh" value="sembuh" required>
                                            <label class="form-check-label" for="radio_sembuh">Sembuh</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Kasus</label>
                                        <input type="date" name="tanggal_kasus" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="card">
                                        <div class="card-header">
                                                <h4>Peta Persebaran Kasus Dbd</h4>
                                        </div>
                                        <div class="card-body">
                                            <div id="map" data-height="600">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary mt-3">Simpan Data</button>
                                </div>
                            </div>

                        </form>

                    </div>


                </div>
            </div>
</section>


<script>
    var map = L.map('map').setView([-6.121011, 106.900655], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);
    
if (marker) {
    marker.setLatLng(e.latlng);
} else {
    marker = L.marker(e.latlng).addTo(map);
}

marker.bindPopup('Lat: ' + lat + '<br>Lng: ' + lng).openPopup();

console.log(lat, lng);
</script>
<?php echo $this->endSection(); ?>