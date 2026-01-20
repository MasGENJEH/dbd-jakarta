<?php echo $this->extend('layout/default'); ?>

<?php echo $this->section('judul'); ?>
<title>Dashboard</title>
<?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>

<style>
    #map { 
        height: 600px; 
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
                        <?php echo $jumlah_kasus_dbd; ?>
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
                        <?php echo $jumlah_hari_ini; ?>
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
                    <div class="card-body"><?php echo $jumlah_kasus_aktif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Statistik Kasus DBD Tahun <?php echo date('Y'); ?></h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart" height="100"></canvas>
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
                    <div id="map" data-height="600">
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
        ]).addTo(map).
        bindPopup(
            "<b>" + kasusDbd[i].lokasi + "</b><br/>" +
            "Prediksi: " + kasusDbd[i].lat+ ", " + kasusDbd[i].long + "</b><br/>" +
            "Tanggal Kasus: " + kasusDbd[i].tanggal_kasus
        ).openPopup();

    }

    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
            datasets: [{
                label: 'Kasus DBD',
                data: <?php echo json_encode($statistik); ?>,
                borderWidth: 2,
                backgroundColor: 'rgba(63,82,227,.8)',
                borderWidth: 0,
                borderColor: 'transparent',
                pointBorderWidth: 0,
                pointRadius: 3.5,
                pointBackgroundColor: 'rgba(63,82,227,.8)',
                pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        drawBorder: false,
                        color: '#f2f2f2',
                    },
                    ticks: {
                        beginAtZero: true,
                        stepSize: 10
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            },
        }
    });
</script>


<?php echo $this->endSection(); ?>