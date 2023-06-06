<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
Edit Pemesanan Obat
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Basic Tables start -->
<section class="section">
    <div class="card">
        <div class="card-header">
            <a href="<?= site_url('admin/pemesanan') ?>" class="btn btn-primary">Kembali</a>
        </div>
        <div class="card-body">
            <form action="<?= site_url('admin/pemesanan/' . $pemesanan->id) ?>" method="POST" class="form form-horizontal">
                <input type="hidden" name="_method" value="PUT" />

                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Tanggal</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="date" class="form-control" name="tanggal" value="<?= $pemesanan->tanggal ?? date('Y-m-d') ?>" readonly required>
                        </div>
                        <div class="col-md-4">
                            <label>Kode Pemesanan</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" name="kode" placeholder="Kode Pemesanan" value="<?= $pemesanan->kode ?>" readonly required>
                        </div>
                        <div class="col-md-4">
                            <label>Obat</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select name="obat_id" class="form-control" required>
                                <option value="" selected disabled>-- Pilih --</option>
                                <?php foreach ($obat as $o) : ?>
                                    <option value="<?= $o->id ?>" <?= ($pemesanan->obat_id ?? old('obat_id')) == $o->id ? 'selected' : '' ?>><?= $o->nama ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Supplier</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select name="supplier_id" class="form-control" required>
                                <option value="" selected disabled>-- Pilih --</option>
                                <?php foreach ($supplier as $s) : ?>
                                    <?php if ($s->group == 'supplier') : ?>
                                        <option value="<?= $s->id ?>" <?= ($pemesanan->supplier_id ?? old('supplier_id')) == $s->id ? 'selected' : '' ?>><?= $s->name ?></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Qty</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="qty" placeholder="Qty" value="<?= $pemesanan->qty ?? old('qty') ?>" required>
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
        </div>
    </div>
</section>
<!-- Basic Tables end -->
<?= $this->endSection() ?>