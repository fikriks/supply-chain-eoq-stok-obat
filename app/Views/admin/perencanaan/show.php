<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
Detail Perencanaan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Basic Tables start -->
<section class="section">
    <div class="card">
        <div class="card-header">
            <a href="<?= site_url('admin/perencanaan') ?>" class="btn btn-primary">Kembali</a>
        </div>
        <div class="card-body">
            <form action="#" class="form form-horizontal">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Kode</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" name="kode" placeholder="Kode" value="<?= $perencanaan->kode_perencanaan ?>" readonly required>
                        </div>
                        <div class="col-md-4">
                            <label>Tanggal</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="date" class="form-control" name="tanggal" placeholder="Tanggal" value="<?= $perencanaan->tanggal ?>" readonly required>
                        </div>
                        <div class="col-md-4">
                            <label>Nama Obat</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" name="obat" placeholder="Nama Obat" value="<?= $perencanaan->nama_obat ?>" readonly required>
                        </div>
                        <div class="col-md-4">
                            <label>Harga</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="harga" placeholder="Harga" value="<?= $perencanaan->harga ?>" readonly required>
                        </div>
                        <div class="col-md-4">
                            <label>Permintaan/Tahun</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="permintaan" placeholder="Permintaan Pertahun" value="<?= $perencanaan->permintaan ?>" readonly required>
                        </div>
                        <div class="col-md-4">
                            <label>Biaya Pemesanan</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="biaya_pemesanan" placeholder="Biaya Pemesanan" value="<?= $perencanaan->biaya_pemesanan ?>" readonly required>
                        </div>
                        <div class="col-md-4">
                            <label>Biaya Penyimpanan</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="biaya_penyimpanan" placeholder="Biaya Penyimpanan" value="<?= $perencanaan->biaya_penyimpanan ?>" readonly required>
                        </div>
                        <div class="col-md-4">
                            <label>Lead Time</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="lead_time" placeholder="Lead Time" value="<?= $perencanaan->lead_time ?>" readonly required>
                        </div>
                        <div class="col-md-4">
                            <label>Avarange Use</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="avarange_use" placeholder="Avarange Use" value="<?= $perencanaan->avarange_use ?>" readonly required>
                        </div>
                        <div class="col-md-4">
                            <label>Penjualan Harian Tertinggi</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="penjualan_harian_tertinggi" placeholder="Penjualan Harian Tertinggi" value="<?= $perencanaan->penjualan_harian_tertinggi ?>" readonly required>
                        </div>
                        <div class="col-md-4">
                            <label>Lead Time Tertinggi</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="lead_time_tertinggi" placeholder="Lead Time Tertinggi" value="<?= $perencanaan->lead_time_tertinggi ?>" readonly required>
                        </div>
                        <div class="col-md-4">
                            <label>Rata-Rata Penjualan Harian</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="rata_rata_penjualan_harian" placeholder="Rata-Rata Penjualan Harian" value="<?= $perencanaan->rata_rata_penjualan_harian ?>" readonly required>
                        </div>
                        <div class="col-md-4">
                            <label>Rata-Rata Lead Time</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="rata_rata_lead_time" placeholder="Rata-Rata Lead Time" value="<?= $perencanaan->rata_rata_lead_time ?>" readonly required>
                        </div>
                        <div class="col-md-4">
                            <label>Daur Ulang Pemesanan</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="daur_ulang_pemesanan" placeholder="Daur Ulang Pemesanan" value="<?= $perencanaan->daur_ulang_pemesanan ?>" readonly required>
                        </div>
                        <div class="col-md-4">
                            <label>Safety Stok</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="safety_stok" placeholder="Safety Stok" value="<?= $perencanaan->safety_stok ?>" readonly required>
                        </div>
                        <div class="col-md-4">
                            <label>EOQ</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="eoq" placeholder="EOQ" value="<?= $perencanaan->eoq ?>" readonly required>
                        </div>
                        <div class="col-md-4">
                            <label>ROP</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="rop" placeholder="ROP" value="<?= $perencanaan->rop ?>" readonly required>
                        </div>
                        <div class="col-md-4">
                            <label>Maximum Inventory</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="maximum_inventory" placeholder="Maximum Inventory" value="<?= $perencanaan->maximum_inventory ?>" readonly required>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Basic Tables end -->
<?= $this->endSection() ?>