<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php if (auth()->user()->inGroup('admin', 'manajer')) { ?>
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Barang Masuk</h6>
                                    <h6 class="font-extrabold mb-0"><?= count($barangMasuk) ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Barang Keluar</h6>
                                    <h6 class="font-extrabold mb-0"><?= count($barangKeluar) ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Transaksi</h6>
                                    <h6 class="font-extrabold mb-0"><?= count($barangMasuk) + count($barangKeluar) ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Barang Masuk dan Barang Keluar Tahun <?= date('Y') ?></h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-barang-masuk-barang-keluar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="<?= base_url('assets/images/faces/2.jpg') ?>" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold"><?= auth()->user()->identities[0]->name ?></h5>
                            <h6 class="text-muted mb-0">@<?= auth()->user()->username ?></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Stok Obat</h4>
                </div>
                <div class="card-body">
                    <div id="chart-stok-obat"></div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<?php if (auth()->user()->inGroup('staff')) { ?>
    <section class="row">
        <div class="col-12 col-lg-12">
            <?php if (!empty($namaObatSafetyStok)) : ?>
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                        Obat yang mendekati safety stok:
                        <ul>
                            <?php foreach ($namaObatSafetyStok as $obatSs) : ?>
                                <li><?= $obatSs ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            <?php endif ?>
            <div class="row">
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Barang Masuk</h6>
                                    <h6 class="font-extrabold mb-0"><?= count($barangMasuk) ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Barang Keluar</h6>
                                    <h6 class="font-extrabold mb-0"><?= count($barangKeluar) ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body py-4 px-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl">
                                    <img src="<?= base_url('assets/images/faces/2.jpg') ?>" alt="Face 1">
                                </div>
                                <div class="ms-3 name">
                                    <h5 class="font-bold"><?= auth()->user()->identities[0]->name ?></h5>
                                    <h6 class="text-muted mb-0">@<?= auth()->user()->username ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Barang Masuk dan Barang Keluar Tahun <?= date('Y') ?></h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-barang-masuk-barang-keluar"></div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Stok Obat</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-stok-obat"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
<?php } ?>

<?php if (auth()->user()->inGroup('supplier')) { ?>
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Menunggu Konfirmasi</h6>
                                    <h6 class="font-extrabold mb-0"><?= $konfirmasi ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Pesanan Dikirim</h6>
                                    <h6 class="font-extrabold mb-0"><?= $dikirim ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Pesanan Sukses</h6>
                                    <h6 class="font-extrabold mb-0"><?= $sukses ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Pesanan Dibatalkan</h6>
                                    <h6 class="font-extrabold mb-0"><?= $dibatalkan ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?php if (auth()->user()->inGroup('admin', 'manajer', 'staff')) { ?>
    <script>
        var optionsBarangMasukBarangKeluar = {
            annotations: {
                position: 'back'
            },
            dataLabels: {
                enabled: false
            },
            chart: {
                type: 'bar',
                height: 300
            },
            fill: {
                opacity: 1
            },
            plotOptions: {},
            series: [{
                name: 'Total Barang Masuk dan Keluar',
                data: <?= json_encode($totalBarangMasukKeluar) ?>
            }],
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            },
            colors: '#435ebe',
        };

        let optionsStokObat = {
            series: <?= json_encode($stokObat) ?>,
            labels: <?= json_encode($namaObat) ?>,
            chart: {
                type: 'donut',
                width: '100%',
                height: '350px'
            },
            legend: {
                position: 'bottom'
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '30%'
                    }
                }
            }
        }

        var chartBarangMasukBarangKeluar = new ApexCharts(document.querySelector("#chart-barang-masuk-barang-keluar"), optionsBarangMasukBarangKeluar);
        var chartStokObat = new ApexCharts(document.getElementById('chart-stok-obat'), optionsStokObat)

        chartBarangMasukBarangKeluar.render();
        chartStokObat.render();
        <?php } ?>
    </script>
    <?= $this->endSection() ?>