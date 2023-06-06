<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
Edit Perencanaan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Basic Tables start -->
<section class="section">
    <div class="card">
        <div class="card-header">
            <a href="<?= site_url('admin/perencanaan') ?>" class="btn btn-primary">Kembali</a>
        </div>
        <div class="card-body">
            <form action="<?= site_url('admin/perencanaan/' . $perencanaan->perencanaan_id) ?>" method="POST" class="form form-horizontal">
                <input type="hidden" name="_method" value="PUT" />

                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Kode</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" name="kode" placeholder="Kode" value="<?= $perencanaan->kode_perencanaan ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>Tanggal</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="date" class="form-control" name="tanggal" placeholder="Tanggal" value="<?= $perencanaan->tanggal ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>Obat</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select name="obat_id" id="produk" class="form-control" required>
                                <option value="" selected disabled>-- Pilih --</option>
                                <?php foreach ($obat as $o) : ?>
                                    <option value="<?= $o->id ?>" <?= (old('obat_id') ?? $perencanaan->obat_id) == $o->id ? 'selected' : '' ?>><?= $o->nama ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Harga</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?= $perencanaan->harga ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>Permintaan/Tahun</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="permintaan" placeholder="Permintaan Pertahun" value="<?= $perencanaan->permintaan ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>Biaya Pemesanan</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="biaya_pemesanan" placeholder="Biaya Pemesanan" value="<?= $perencanaan->biaya_pemesanan ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>Biaya Penyimpanan</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="biaya_penyimpanan" placeholder="Biaya Penyimpanan" value="<?= $perencanaan->biaya_penyimpanan ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>Lead Time</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="lead_time" placeholder="Lead Time" value="<?= $perencanaan->lead_time ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>Avarange Use</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="avarange_use" placeholder="Avarange Use" value="<?= $perencanaan->avarange_use ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>Penjualan Harian Tertinggi</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="penjualan_harian_tertinggi" placeholder="Penjualan Harian Tertinggi" value="<?= $perencanaan->penjualan_harian_tertinggi ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>Lead Time Tertinggi</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="lead_time_tertinggi" placeholder="Lead Time Tertinggi" value="<?= $perencanaan->lead_time_tertinggi ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>Rata-Rata Penjualan Harian</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="rata_rata_penjualan_harian" placeholder="Rata-Rata Penjualan Harian" value="<?= $perencanaan->rata_rata_penjualan_harian ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>Rata-Rata Lead Time</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="rata_rata_lead_time" placeholder="Rata-Rata Lead Time" value="<?= $perencanaan->rata_rata_lead_time ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>Daur Ulang Pemesanan</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="daur_ulang_pemesanan" placeholder="Daur Ulang Pemesanan" value="<?= $perencanaan->daur_ulang_pemesanan ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>Safety Stok</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="safety_stok" placeholder="Safety Stok" value="<?= $perencanaan->safety_stok ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>EOQ</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="eoq" placeholder="EOQ" value="<?= $perencanaan->eoq ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>ROP</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="rop" placeholder="ROP" value="<?= $perencanaan->rop ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>Maximum Inventory</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="maximum_inventory" placeholder="Maximum Inventory" value="<?= $perencanaan->maximum_inventory ?>" required>
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