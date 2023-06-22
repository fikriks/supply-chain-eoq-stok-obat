<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
Laporan Pemesanan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php if (session('error') !== null) : ?>
    <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
<?php endif ?>

<?php if (session('message') !== null) : ?>
    <div class="alert alert-success" role="alert"><?= session('message') ?></div>
<?php endif ?>

<!-- Basic Tables start -->
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>Laporan Barang Masuk dan Keluar</h4>
        </div>
        <div class="card-body">
            <form action="<?= site_url('admin/laporan-pemesanan') ?>" method="GET" class="form form-horizontal">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-2">
                            <label>Dari Tanggal</label>
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="date" class="form-control" name="dari_tanggal" value="<?= request()->getGet('dari_tanggal') ?>" required>
                        </div>
                        <div class="col-md-2">
                            <label>Sampai Tanggal</label>
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="date" class="form-control" name="sampai_tanggal" value="<?= request()->getGet('sampai_tanggal') ?>" required>
                        </div>

                        <div class="col-md-4">
                        </div>
                        <div class="col-sm-8 d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Filter</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <a href="<?= site_url('admin/laporan-barang-masuk-keluar/pdf') ?>" class="btn btn-primary">Export PDF</a>
        </div>
        <div class="card-body">
            <table class="table" id="table1">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Obat</th>
                        <th>Masuk</th>
                        <th>Keluar</th>
                        <th>Selisih</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Total Pembelian</th>
                        <th>Total Penjualan</th>
                        <th>Laba</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($obat as $o) : ?>
                        <tr>
                            <td><?= $o->kode_obat ?></td>
                            <td><?= $o->nama_obat ?></td>
                            <td><?= $o->qty_pemesanan ?></td>
                            <td><?= $o->qty_penjualan_detail ?></td>
                            <td><?= $o->qty_pemesanan - $o->qty_penjualan_detail ?></td>
                            <td><?= number_format($o->harga_beli, 2, ',', '.') ?></td>
                            <td><?= number_format($o->harga_jual, 2, ',', '.') ?></td>
                            <td><?= number_format($o->total_harga_pemesanan, 2, ',', '.') ?></td>
                            <td><?= number_format($o->total_harga_penjualan_detail, 2, ',', '.') ?></td>
                            <td><?= number_format($o->total_harga_penjualan_detail - $o->total_harga_pemesanan, 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

</section>
<!-- Basic Tables end -->
<?= $this->endSection() ?>