<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
Validasi Pemesanan
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
        <div class="card-body">
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pemesanan as $p) : ?>
                        <tr>
                            <td><?= $p->tanggal ?></td>
                            <td><?= $p->kode_pemesanan ?></td>
                            <td><?= $p->nama ?></td>
                            <td><?= $p->name ?></td>
                            <td><?= $p->qty ?></td>
                            <td><?= $p->total_harga ?></td>
                            <td><?= $p->created_at ?></td>
                            <td><?= $p->updated_at ?></td>
                            <td>
                                <div class="row">
                                    <form class="col" action="<?= site_url('admin/validasi-pemesanan/' . $p->pemesanan_id) ?>" method="POST">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="PUT" />
                                        <input type="hidden" name="status" value="DIKIRIM" />
                                        <button type="submit" class="btn btn-success col" onClick="return confirm('Apakah anda yakin ingin mengubah status data ini?');"><i class="bi bi-check"></i></button>
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

<?= $this->section('scripts') ?>
<script>
    $("#table2").DataTable();
    $("#table3").DataTable();
</script>
<?= $this->endSection() ?>