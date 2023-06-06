<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
Detail Penjualan
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
            <a href="<?= site_url('admin/penjualan') ?>" class="btn btn-primary mb-3">Kembali</a>
            <h4>No Invoice:</h4>
            <h4><?= $penjualan->kode ?></h4>
            <h4>Tanggal:</h4>
            <h4><?= $penjualan->tanggal ?></h4>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($penjualanDetail as $p) : ?>
                        <tr>
                            <td><?= $p->kode_obat ?></td>
                            <td><?= $p->nama_obat ?></td>
                            <td><?= $p->harga_jual ?></td>
                            <td><?= $p->qty ?></td>
                            <td><?= $p->total_harga_penjualan_detail ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <div class="d-flex justify-content-end">
                <div>
                    <h5>Total: <?= $penjualan->total_harga ?></h5>
                    <h5>Bayar: <?= $penjualan->bayar ?></h5>
                    <h5>Kembalian: <?= $penjualan->kembalian ?></h5>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- Basic Tables end -->
<?= $this->endSection() ?>