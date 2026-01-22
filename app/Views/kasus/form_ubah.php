<?php echo $this->extend('layout/default'); ?>

<?php echo $this->section('judul'); ?>
<title>Edit | Kasus</title>
<?php echo $this->endSection(); ?>

<?php echo $this->section('form_tambah'); ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?php echo base_url('kasus'); ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Edit Kasus</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url('home'); ?>">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="<?php echo base_url('kasus'); ?>">Kasus</a></div>
            <div class="breadcrumb-item">Edit Kasus</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Data Kasus</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url('kasus/'.$kasus->id); ?>" method="post" autocomplete="off">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="lat" id="lat" value="<?php echo $kasus->lat; ?>">
                            <input type="hidden" name="long" id="long" value="<?php echo $kasus->long; ?>">

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alamat Kasus</label>
                                        <input type="text" name="lokasi" class="form-control" value="<?php echo $kasus->lokasi; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Wilayah Kota</label>
                                        <select class="form-control" name="kota">
                                            <option value="Jakarta Pusat" <?php echo ($kasus->kota == 'Jakarta Pusat') ? 'selected' : ''; ?>>Jakarta Pusat</option>
                                            <option value="Jakarta Utara" <?php echo ($kasus->kota == 'Jakarta Utara') ? 'selected' : ''; ?>>Jakarta Utara</option>
                                            <option value="Jakarta Barat" <?php echo ($kasus->kota == 'Jakarta Barat') ? 'selected' : ''; ?>>Jakarta Barat</option>
                                            <option value="Jakarta Selatan" <?php echo ($kasus->kota == 'Jakarta Selatan') ? 'selected' : ''; ?>>Jakarta Selatan</option>
                                            <option value="Jakarta Timur" <?php echo ($kasus->kota == 'Jakarta Timur') ? 'selected' : ''; ?>>Jakarta Timur</option>
                                            <option value="Kepulauan Seribu" <?php echo ($kasus->kota == 'Kepulauan Seribu') ? 'selected' : ''; ?>>Kepulauan Seribu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                id="radio_laki" value="LAKI-LAKI" <?php echo ($kasus->jenis_kelamin == 'LAKI-LAKI') ? 'checked' : ''; ?> required>
                                            <label class="form-check-label" for="radio_laki">Laki-laki</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                id="radio_perempuan" value="PEREMPUAN" <?php echo ($kasus->jenis_kelamin == 'PEREMPUAN') ? 'checked' : ''; ?> required>
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
                                                id="radio_aktif" value="aktif" <?php echo ($kasus->status == 'aktif') ? 'checked' : ''; ?> required>
                                            <label class="form-check-label" for="radio_aktif">Aktif</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="radio_sembuh" value="sembuh" <?php echo ($kasus->status == 'sembuh') ? 'checked' : ''; ?> required>
                                            <label class="form-check-label" for="radio_sembuh">Sembuh</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Kasus</label>
                                        <input type="date" name="tanggal_kasus" class="form-control" value="<?php echo $kasus->tanggal_kasus; ?>" required>
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
                                    <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
                                </div>
                            </div>

                        </form>

                    </div>


                </div>
            </div>
</section>


<script>
    var lat = <?php echo ($kasus->lat) ? $kasus->lat : -6.2088; ?>;
    var lng = <?php echo ($kasus->long) ? $kasus->long : 106.8456; ?>;

    var map = L.map('map').setView([lat, lng], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    setTimeout(function() {
        map.invalidateSize();
    }, 500);

    var marker = L.marker([lat, lng]).addTo(map)
        .bindPopup('Lokasi Saat Ini').openPopup();

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

        marker.bindPopup('Lokasi Baru:<br>Lat: ' + lat + '<br>Lng: ' + lng).openPopup();

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
