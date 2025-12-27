<?php echo $this->extend('layout/default'); ?>
<?php echo $this->section('judul'); ?>
    <title>View | Bansos </title>
<?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Hasil Perhitungan SPK (SAW)</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url('home'); ?>">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="<?php echo base_url('kartu-keluarga'); ?>">Kartu Keluarga</a>
            </div>
            <div class="breadcrumb-item">Data Keluarga Penerima Bansos</div>
        </div>
    </div>
    <div class="section-body">
        <?php if (isset($message)) { ?>
        <div class="alert alert-info"><?php echo esc($message); ?></div>
        <?php } ?>

        <?php if (!empty($results)) { ?>
        <div class="card">
            <div class="card-header">
                <h4>Perangkingan Kelayakan Bansos</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Ranking</th>
                                <th>Nomor KK</th>
                                <th>Alamat</th>
                                <th>C1 Pendapatan (X)</th>
                                <th>C2 Skala Rumah (X)</th>
                                <th>C3 Tanggungan (X)</th>
                                <th>Nilai Preferensi (V)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $rank = (($pager->getCurrentPage() - 1) * 10) + 1; ?>
                            <?php foreach ($results as $item) { ?>
                            <tr class="<?php echo $rank <= 5 ? 'table-success' : ''; ?>">
                                <td>
                                    <div class="badge badge-primary">#<?php echo $rank++; ?></div>
                                </td>
                                <td><?php echo esc($item['nomor_kk']); ?></td>
                                <td><?php echo esc($item['alamat']); ?></td>
                                <td>Rp <?php echo number_format($item['nilai_kriteria']['C1'], 0, ',', '.'); ?></td>
                                <td><?php echo number_format($item['nilai_kriteria']['C2'], 0, ',', '.'); ?></td>
                                <td><?php echo number_format($item['nilai_kriteria']['C3'], 0, ',', '.'); ?> Org
                                </td>
                                <td><?php echo number_format($item['nilai_v'], 4); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                <nav class="d-inline-block">
                    <?php echo $pager->links('default', 'pagination'); ?>

                </nav>
            </div>
        </div>
        <?php } ?>
    </div>
</section>
<?php echo $this->endSection(); ?>