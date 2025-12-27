<?php echo $this->extend('layout/default'); ?>

<?php echo $this->section('judul'); ?>
<title>Dashboard</title>
<?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>

<style>
    #map { 
        height: 600px; 
        width: 1150px; 
        }
</style>

<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Kasus</h4>
                    </div>
                    <div class="card-body">
                        43534
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Kasus Baru</h4>
                    </div>
                    <div class="card-body">
                        3455
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Kasus Aktif</h4>
                    </div>
                    <div class="card-body">34534
                    </div>
                </div>
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
                    <div id="map">
                    </div>
                </div>
            </div>
            
         </div>
    </div>


<script>
    var map = L.map('map').setView([-6.121011, 106.900655], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'}).addTo(map);

    var kasusDbd = <?php echo json_encode($kasus_dbd); ?>;

    for (let i = 0; i < kasusDbd.length; i++) {
        L.marker([
            kasusDbd[i].lat,
            kasusDbd[i].long
        ]).addTo(map);
    }
    
</script>


<?php echo $this->endSection(); ?>