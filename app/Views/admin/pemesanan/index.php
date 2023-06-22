<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
Pemesanan Obat
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
            <a href="<?= site_url('admin/pemesanan/new') ?>" class="btn btn-primary">Tambah +</a>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="menunggu-konfirmasi-tab" data-bs-toggle="tab" href="#menunggu-konfirmasi" role="tab" aria-controls="menunggu-konfirmasi" aria-selected="true">
                        Menunggu Konfirmasi</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pesanan-dikirim-tab" data-bs-toggle="tab" href="#pesanan-dikirim" role="tab" aria-controls="pesanan-dikirim" aria-selected="false">
                        Pesanan Dikirim</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pesanan-diterima-tab" data-bs-toggle="tab" href="#pesanan-diterima" role="tab" aria-controls="pesanan-diterima" aria-selected="false">
                        Pesanan Diterima</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="menunggu-konfirmasi" role="tabpanel" aria-labelledby="menunggu-konfirmasi-tab">
                    <div class="my-3">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kode</th>
                                    <th>Obat</th>
                                    <th>Supplier</th>
                                    <th>Qty</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Dibuat</th>
                                    <th>Diedit</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($permintaanMenungguKonfirmasi as $p) : ?>
                                    <tr>
                                        <td><?= $p->tanggal ?></td>
                                        <td><?= $p->kode_pemesanan ?></td>
                                        <td><?= $p->nama ?></td>
                                        <td><?= $p->name ?></td>
                                        <td><?= $p->qty ?></td>
                                        <td><?= number_format($p->total_harga, 2, ',', '.') ?></td>
                                        <td><?= str_replace('_', ' ', $p->status) ?></td>
                                        <td><?= $p->created_at ?></td>
                                        <td><?= $p->updated_at ?></td>
                                        <td>
                                            <div class="row">
                                                <a href="<?= site_url('admin/pemesanan/' . $p->pemesanan_id . '/edit') ?>" class="btn btn-warning col"><i class="bi bi-pencil-fill"></i></a>
                                                <form class="col" action="<?= site_url('admin/pemesanan/' . $p->pemesanan_id) ?>" method="POST">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    <button type="submit" class="btn btn-danger col" onClick="return confirm('Apakah anda yakin ingin menghapus data ini?');"><i class="bi bi-trash-fill"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pesanan-dikirim" role="tabpanel" aria-labelledby="pesanan-dikirim-tab">
                    <div class="my-3">
                        <table class="table" id="table2">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kode</th>
                                    <th>Obat</th>
                                    <th>Supplier</th>
                                    <th>Qty</th>
                                    <th>Total Harga</th>
                                    <th>Dibuat</th>
                                    <th>Diedit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pesananDikirim as $p) : ?>
                                    <tr>
                                        <td><?= $p->tanggal ?></td>
                                        <td><?= $p->kode_pemesanan ?></td>
                                        <td><?= $p->nama ?></td>
                                        <td><?= $p->name ?></td>
                                        <td><?= $p->qty ?></td>
                                        <td><?= number_format($p->total_harga, 2, ',', '.') ?></td>
                                        <td><?= $p->created_at ?></td>
                                        <td><?= $p->updated_at ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pesanan-diterima" role="tabpanel" aria-labelledby="pesanan-diterima-tab">
                    <div class="my-3">
                        <table class="table" id="table3">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kode</th>
                                    <th>Obat</th>
                                    <th>Supplier</th>
                                    <th>Qty</th>
                                    <th>Total Harga</th>
                                    <th>Dibuat</th>
                                    <th>Diedit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pesananDiterima as $p) : ?>
                                    <tr>
                                        <td><?= $p->tanggal ?></td>
                                        <td><?= $p->kode_pemesanan ?></td>
                                        <td><?= $p->nama ?></td>
                                        <td><?= $p->name ?></td>
                                        <td><?= $p->qty ?></td>
                                        <td><?= number_format($p->total_harga, 2, ',', '.') ?></td>
                                        <td><?= $p->created_at ?></td>
                                        <td><?= $p->updated_at ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Basic Tables end -->
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $("#table2").DataTable();
    $("#table3").DataTable();
</script>
<?= $this->endSection() ?>