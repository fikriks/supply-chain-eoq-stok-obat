<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
Laporan Penjualan
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
            <h4>Laporan Penjualan Berdasarkan Periode</h4>
        </div>
        <div class="card-body">
            <form action="<?= site_url('admin/laporan-penjualan') ?>" method="GET" class="form form-horizontal">
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
        <div class="card-body">
            <table class="table" id="table1">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kode</th>
                        <th>Nama Obat</th>
                        <th>Qty</th>
                        <th>Modal</th>
                        <th>Jual</th>
                        <th>Laba</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($penjualan as $po) : ?>
                        <tr>
                            <td><?= $po->tanggal ?></td>
                            <td><?= $po->penjualan_kode ?></td>
                            <td><?= $po->nama_obat ?></td>
                            <td><?= $po->qty ?></td>
                            <td><?= $po->harga_jual ?></td>
                            <td><?= $po->harga_beli ?></td>
                            <td><?= $po->harga_beli - $po->harga_jual ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

</section>
<!-- Basic Tables end -->
<?= $this->endSection() ?>