<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
Satuan
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
            <a href="<?= site_url('admin/satuan/new') ?>" class="btn btn-primary">Tambah +</a>
        </div>
        <div class="card-body">
            <table class="table" id="table1">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Dibuat</th>
                        <th>Diedit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($satuan as $s) : ?>
                        <tr>
                            <td><?= $s->nama ?></td>
                            <td><?= $s->created_at ?></td>
                            <td><?= $s->updated_at ?></td>
                            <td>
                                <div class="row">
                                    <a href="<?= site_url('admin/satuan/' . $s->id . '/edit') ?>" class="btn btn-warning col-3">Edit</a>
                                    <form class="col-6" action="<?= site_url('admin/satuan/' . $s->id) ?>" method="POST">
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