<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
Pemesanan
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
            <table class="table" id="table1">
                <thead>
                    <tr>
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
                    <?php foreach ($pemesanan as $p) : ?>
                        <tr>
                            <td><?= $p->kode_pemesanan ?></td>
                            <td><?= $p->nama ?></td>
                            <td><?= $p->name ?></td>
                            <td><?= $p->qty ?></td>
                            <td><?= $p->total_harga ?></td>
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

</section>
<!-- Basic Tables end -->
<?= $this->endSection() ?>