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
                        <form action="<?php echo base_url('kasus/save'); ?>" method="post" autocomplete="off">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="lat" id="lat">
                            <input type="hidden" name="long" id="long">

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alamat Kasus</label>
                                        <input type="text" name="lokasi" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Wilayah Kota</label>
                                        <select class="form-control" name="kota">
                                            <option value="Jakarta Pusat">Jakarta Pusat</option>
                                            <option value="Jakarta Utara">Jakarta Utara</option>
                                            <option value="Jakarta Barat">Jakarta Barat</option>
                                            <option value="Jakarta Selatan">Jakarta Selatan</option>
                                            <option value="Jakarta Timur">Jakarta Timur</option>
                                            <option value="Kepulauan Seribu">Kepulauan Seribu</option>
                                        </select>
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
                                            <div id="map" data-height="600" style="height: 600px;">
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
    var map = L.map('map').setView([-6.2088, 106.8456], 12); // Default Jakarta

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    setTimeout(function() {
        map.invalidateSize();
    }, 500);

    var marker;

    function onMapClick(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        // Update hidden inputs
        document.getElementById('lat').value = lat;
        document.getElementById('long').value = lng;

        // Update or add marker
        if (marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker(e.latlng).addTo(map);
        }

        marker.bindPopup('Lokasi Terpilih:<br>Lat: ' + lat + '<br>Lng: ' + lng).openPopup();

        // Reverse Geocoding (Ambil Nama Kota otomatis)
        console.log("Fetching address for:", lat, lng);
        fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
            .then(response => response.json())
            .then(data => {
                console.log("Nominatim Data:", data);
                if (data.address) {
                    // 1. Auto-fill Alamat (Lokasi)
                    var fullAddress = data.display_name;
                    document.getElementsByName('lokasi')[0].value = fullAddress;

                    // 2. Auto-select Kota dengan Mapping (English -> Indo)
                    var selectKota = document.getElementsByName('kota')[0];
                    var cityFromApi = data.address.city || data.address.county || data.address.state_district || "";
                    
                    // Mapping nama kota dari API (mungkin Bahasa Inggris) ke Value Option (Bahasa Indonesia)
                    var cityMapping = {
                        "Central Jakarta": "Jakarta Pusat",
                        "Jakarta Pusat": "Jakarta Pusat", 
                        "North Jakarta": "Jakarta Utara",
                        "Jakarta Utara": "Jakarta Utara",
                        "West Jakarta": "Jakarta Barat",
                        "Jakarta Barat": "Jakarta Barat",
                        "South Jakarta": "Jakarta Selatan",
                        "Jakarta Selatan": "Jakarta Selatan",
                        "East Jakarta": "Jakarta Timur",
                        "Jakarta Timur": "Jakarta Timur",
                        "Thousand Islands": "Kepulauan Seribu",
                        "Kepulauan Seribu": "Kepulauan Seribu"
                    };

                    // Coba cari match di mapping
                    var matchedKota = null;
                    Object.keys(cityMapping).forEach(function(key) {
                        // Cek apakah string kota dari API mengandung key mapping (case insensitive)
                        if (cityFromApi.toLowerCase().includes(key.toLowerCase()) || fullAddress.toLowerCase().includes(key.toLowerCase())) {
                            matchedKota = cityMapping[key];
                        }
                    });

                    if (matchedKota) {
                        selectKota.value = matchedKota;
                        console.log("Auto-selected:", matchedKota);
                    }
                }
            })
            .catch(error => console.error('Error fetching address:', error));
    }

    map.on('click', onMapClick);
</script>

<?php echo $this->endSection(); ?>