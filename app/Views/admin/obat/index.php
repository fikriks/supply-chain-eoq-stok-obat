<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
Obat
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

        </div>
        <div class="card-body">
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <a href="<?= site_url('admin/obat/new') ?>" class="btn btn-primary">Tambah +</a>
        </div>
        <div class="card-body">
            <table class="table" id="table1">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Kategori Obat</th>
                        <th>Satuan</th>
                        <th>Supplier</th>
                        <th>Stok</th>
                        <th>Expired</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Dibuat</th>
                        <th>Diedit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($obat as $o) : ?>
                        <tr>
                            <td><?= $o->kode ?></td>
                            <td><?= $o->nama ?></td>
                            <td><?= $o->nama_kategori_obat ?></td>
                            <td><?= $o->stok ?></td>
                            <td><?= $o->expired ?></td>
                            <td><?= $o->created_at ?></td>
                            <td><?= $o->updated_at ?></td>
                            <td>
                                <div class="row">
                                    <a href="<?= site_url('admin/obat/' . $o->id . '/edit') ?>" class="btn btn-warning col-3">Edit</a>
                                    <form class="col-6" action="<?= site_url('admin/obat/' . $o->id) ?>" method="POST">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" class="btn btn-danger" onClick="return confirm('Apakah anda yakin ingin menghapus data ini?');"> Hapus</button>
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