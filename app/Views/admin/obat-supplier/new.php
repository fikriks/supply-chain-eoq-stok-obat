<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
Tambah Obat
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Basic Tables start -->
<section class="section">
    <div class="card">
        <div class="card-header">
            <a href="<?= site_url('admin/obat-supplier') ?>" class="btn btn-primary">Kembali</a>
        </div>
        <div class="card-body">
            <form action="<?= site_url('admin/obat-supplier') ?>" method="POST" class="form form-horizontal">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nama</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?= old('nama') ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>Kategori</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" name="kategori_obat" placeholder="Kategori Obat" value="<?= old('kategori_obat') ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>Stok</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="stok" placeholder="Stok" value="<?= old('stok') ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>Harga</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="harga" placeholder="Harga Jual" value="<?= old('harga') ?>" required>
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