<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
Obat Supplier
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="card">
<?php if (auth()->user()->inGroup('supplier')) { ?>
    <div class="card-header">
        <a href="<?= site_url('admin/obat-supplier/new') ?>" class="btn btn-primary">Tambah +</a>
    </div>
    <?php } ?>
    <div class="card-body">
        <table class="table" id="table1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Supplier</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <?php if (auth()->user()->inGroup('supplier')) { ?>
                    <th>Aksi</th>
                    <?php } ?>
                </tr>
            </thead>
            <?php $no = 1; ?>
            <tbody>

                <?php foreach ($ObatSupplier as $os) : ?>
                    <tr>

                        <td><?= $no++;  ?></td>
                        <td><?= $os->nama_supplier ?></td>
                        <td><?= $os->nama ?></td>
                        <td><?= $os->kategori_obat ?></td>
                        <td><?= $os->stok ?></td>
                        <td><?= $os->harga ?></td>
                        <?php if (auth()->user()->inGroup('supplier')) { ?>
                            <td>
                                <div class="row">
                                    <a href="<?= site_url('admin/obat-supplier/' . $os->id . '/edit') ?>" class="btn btn-warning col"><i class="bi bi-pencil-fill"></i></a>
                                    <form class="col" action="<?= site_url('admin/obat-supplier/' . $os->id) ?>" method="POST">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" class="btn btn-danger col" onClick="return confirm('Apakah anda yakin ingin menghapus data ini?');"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </div>
                            </td>
                        <?php } ?>
                    <?php endforeach ?>
                    </td>
                    </tr>

            </tbody>
        </table>
    </div>
</div>


<?= $this->endSection() ?>