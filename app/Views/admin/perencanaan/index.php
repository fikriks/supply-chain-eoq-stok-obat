<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
Perencanaan
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
            <form action="<?= site_url('admin/perencanaan') ?>" method="POST" class="form form-horizontal">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Kode</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" name="kode" placeholder="Kode" value="<?= $kode ?>" readonly required>
                        </div>
                        <div class="col-md-4">
                            <label>Tanggal</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="date" class="form-control" name="tanggal" placeholder="Tanggal" value="<?= date('Y-m-d') ?>" readonly required>
                        </div>
                        <div class="col-md-4">
                            <label>Obat</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select name="obat_id" id="produk" class="form-control" required>
                                <option value="" selected disabled>-- Pilih --</option>
                                <?php foreach ($obat as $o) : ?>
                                    <option value="<?= $o->id ?>" <?= old('obat_id') == $o->id ? 'selected' : '' ?>><?= $o->nama ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Harga</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="harga" placeholder="Harga" id="harga" value="<?= old('harga') ?>" readonly required>
                        </div>

                        <div class="col-md-4">
                        </div>
                        <div class="col-sm-8 d-flex justify-content-start mt-3">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                        </div>
                    </div>
                </div>
            </form>

            <table class="table" id="table1">
                <thead>
                    <tr>
                        <th>Kode Perencanaan</th>
                        <th>Tanggal</th>
                        <th>Kode Obat</th>
                        <th>Nama Obat</th>
                        <th>Supplier</th>
                        <th>Safety Stok</th>
                        <th>EOQ</th>
                        <th>ROP</th>
                        <th>Dibuat</th>
                        <th>Diedit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($perencanaan as $p) : ?>
                        <tr>
                            <td><?= $p->kode_perencanaan ?></td>
                            <td><?= $p->tanggal ?></td>
                            <td><?= $p->kode_obat ?></td>
                            <td><?= $p->nama_obat ?></td>
                            <td><?= $p->name ?></td>
                            <td><?= $p->safety_stok ?></td>
                            <td><?= $p->eoq ?></td>
                            <td><?= $p->rop ?></td>
                            <td><?= $p->created_at ?></td>
                            <td><?= $p->updated_at ?></td>
                            <td>
                                <div class="row">
                                    <a href="<?= site_url('admin/perencanaan/' . $p->perencanaan_id . '/show') ?>" class="btn btn-success col me-2"><i class="bi bi-eye-fill"></i></a>
                                    <a href="<?= site_url('admin/perencanaan/' . $p->perencanaan_id . '/edit') ?>" class="btn btn-warning col"><i class="bi bi-pencil-fill"></i></a>
                                    <form class="col" action="<?= site_url('admin/perencanaan/' . $p->perencanaan_id) ?>" method="POST">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" class="btn btn-danger" onClick="return confirm('Apakah anda yakin ingin menghapus data ini?');"><i class="bi bi-trash-fill"></i></button>
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
    $('#produk').on('change', () => {
        $.ajax({
                url: "<?= site_url('admin/obat/') ?>" + $('#produk').val() + "/show",
                type: "GET",
                dataType: "json",
            })
            .done(function(json) {
                $('#harga').val(json.harga_beli)
            })
            .fail(function(xhr, status, errorThrown) {
                alert("Sorry, there was a problem!");
                console.log("Error: " + errorThrown);
                console.log("Status: " + status);
                console.dir(xhr);
            })
    })
</script>
<?= $this->endSection() ?>