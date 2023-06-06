<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
Permintaan Obat
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
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="menunggu-konfirmasi-tab" data-bs-toggle="tab" href="#menunggu-konfirmasi" role="tab" aria-controls="menunggu-konfirmasi" aria-selected="true">
                        Menunggu Konfirmasi</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="kirim-obat-tab" data-bs-toggle="tab" href="#kirim-obat" role="tab" aria-controls="kirim-obat" aria-selected="false">
                        Kirim Obat</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pesanan-sukses-tab" data-bs-toggle="tab" href="#pesanan-sukses" role="tab" aria-controls="pesanan-sukses" aria-selected="false">
                        Permintaan Sukses</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="menunggu-konfirmasi" role="tabpanel" aria-labelledby="menunggu-konfirmasi-tab">
                    <div class="my-3">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
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
                                <?php foreach ($permintaanMenungguKonfirmasi as $p) : ?>
                                    <tr>
                                        <td><?= $p->kode_pemesanan ?></td>
                                        <td><?= $p->nama ?></td>
                                        <td><?= $p->name ?></td>
                                        <td><?= $p->qty ?></td>
                                        <td><?= $p->total_harga ?></td>
                                        <td><?= $p->created_at ?></td>
                                        <td><?= $p->updated_at ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="kirim-obat" role="tabpanel" aria-labelledby="kirim-obat-tab">
                    <div class="my-3">
                        <table class="table" id="table2">
                            <thead>
                                <tr>
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
                                <?php foreach ($permintaanKirimObat as $p) : ?>
                                    <tr>
                                        <td><?= $p->kode_pemesanan ?></td>
                                        <td><?= $p->nama ?></td>
                                        <td><?= $p->name ?></td>
                                        <td><?= $p->qty ?></td>
                                        <td><?= $p->total_harga ?></td>
                                        <td><?= $p->created_at ?></td>
                                        <td><?= $p->updated_at ?></td>
                                        <td>
                                            <div class="row">
                                                <?php if ($p->status == "TERKONFIRMASI") : ?>
                                                    <form class="col" action="<?= site_url('admin/permintaan-obat/' . $p->pemesanan_id) ?>" method="POST">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="_method" value="PUT" />
                                                        <input type="hidden" name="status" value="DIKIRIM" />
                                                        <button type="submit" class="btn btn-warning col" onClick="return confirm('Apakah anda yakin ingin mengubah status data ini?');"><i class="bi bi-send-fill"></i></button>
                                                    </form>
                                                <?php elseif ($p->status == "DIKIRIM") : ?>
                                                    <form class="col" action="<?= site_url('admin/permintaan-obat/' . $p->pemesanan_id) ?>" method="POST">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="_method" value="PUT" />
                                                        <input type="hidden" name="status" value="SELESAI" />
                                                        <button type="submit" class="btn btn-success col" onClick="return confirm('Apakah anda yakin ingin mengubah status data ini?');"><i class="bi bi-check"></i></button>
                                                    </form>
                                                <?php endif ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pesanan-sukses" role="tabpanel" aria-labelledby="pesanan-sukses-tab">
                    <div class="my-3">
                        <table class="table" id="table3">
                            <thead>
                                <tr>
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
                                <?php foreach ($permintaanSukses as $p) : ?>
                                    <tr>
                                        <td><?= $p->kode_pemesanan ?></td>
                                        <td><?= $p->nama ?></td>
                                        <td><?= $p->name ?></td>
                                        <td><?= $p->qty ?></td>
                                        <td><?= $p->total_harga ?></td>
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