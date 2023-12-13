<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
Edit Obat
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Basic Tables start -->
<section class="section">
    <div class="card">
        <div class="card-header">
            <a href="<?= site_url('admin/obat-supplier') ?>" class="btn btn-primary">Kembali</a>
        </div>
        <div class="card-body">
            <form action="<?= site_url('admin/obat-supplier/'. $obatSupplier->id) ?>" method="POST" class="form form-horizontal">
            <input type="hidden" name="_method" value="PUT" />

                <div class="form-body">
                    <div class="row">
                         <div class="col-md-4">
                            <label>Kode</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" name="kode" placeholder="Kode" value="<?= old('kode') ?? $obatSupplier->kode ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>Nama</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?= old('nama') ?? $obatSupplier->nama ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>Kategori</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select name="kategori_obat_id" class="form-control" required>
                                <option value="" selected disabled>-- Pilih --</option>
                                <?php foreach ($kategoriObat as $ko) : ?>
                                    <option value="<?= $ko->id ?>" <?= (old('kategori_obat_id') ?? $obatSupplier->kategori_obat_id) == $ko->id ? 'selected' : '' ?>><?= $ko->nama ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Satuan</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select name="satuan_id" class="form-control" required>
                                <option value="" selected disabled>-- Pilih --</option>
                                <?php foreach ($satuanObat as $s) : ?>
                                    <option value="<?= $s->id ?>" <?= (old('satuan_id') ?? $obatSupplier->satuan_id) == $s->id ? 'selected' : '' ?>><?= $s->nama ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Stok</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="stok" placeholder="Stok" value="<?= old('stok') ?? $obatSupplier->stok ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>Harga</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="harga" placeholder="Harga Jual" value="<?= old('harga') ?? $obatSupplier->harga ?>" required>
                        </div>
                         <div class="col-md-4">
                            <label>Expired</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="date" class="form-control" name="expired" value="<?= old('expired') ?? $obatSupplier->expired ?>" required>
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