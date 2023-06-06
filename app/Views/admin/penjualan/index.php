<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
Penjualan
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
            <a href="<?= site_url('admin/penjualan/new') ?>" class="btn btn-primary">Tambah +</a>
        </div>
        <div class="card-body">
            <table class="table" id="table1">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($penjualan as $po) : ?>
                        <tr>
                            <td><?= $po->kode ?></td>
                            <td><?= $po->created_at ?></td>
                            <td>
                                <a href="<?= site_url('admin/penjualan/' . $po->id . '/show') ?>" class="btn btn-success"><i class="bi bi-eye-fill"></i></a>
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