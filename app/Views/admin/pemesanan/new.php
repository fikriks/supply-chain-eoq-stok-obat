<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
Tambah Pemesanan Obat
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Basic Tables start -->
<section class="section">
    <div class="card">
        <div class="card-header">
            <a href="<?= site_url('admin/pemesanan') ?>" class="btn btn-primary">Kembali</a>
        </div>
        <div class="card-body">
            <form action="<?= site_url('admin/pemesanan') ?>" method="POST" class="form form-horizontal">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Tanggal</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="date" class="form-control" name="tanggal" value="<?= old('tanggal') ?? date('Y-m-d') ?>" readonly required>
                        </div>
                        <div class="col-md-4">
                            <label>Kode Pemesanan</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" name="kode" placeholder="Kode Pemesanan" value="<?= $kode ?>" readonly required>
                        </div>
                        <div class="col-md-4">
                            <label>Supplier</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select name="supplier_id" id="supplier" class="form-control" required>
                                <option value="" selected disabled>-- Pilih --</option>
                                <?php foreach ($supplier as $s) : ?>
                                    <?php if ($s->group == 'supplier') : ?>
                                        <option value="<?= $s->id ?>" <?= old('supplier_id') == $s->id ? 'selected' : '' ?>><?= $s->name ?></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Obat</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select name="obat_id" id="obat" class="form-control" required>
                                <option value="" selected disabled>-- Pilih Data Supplier Terlebih Dahulu --</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label></label>
                        </div>
                        <div class="col-md-8 form-group">
                          <span id="keterangan"></span>
                        </div>
                        <div class="col-md-4">
                            <label>Qty</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="qty" placeholder="Qty" value="<?= old('qty') ?>" required>
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

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let kode_produk = [],
        kuantitas = [],
        harga = [],
        total = []
    no = 0;

    $(document).ready(function() {
        $('#supplier').on('change', () => {
            $.ajax({
                    url: "<?= site_url('admin/obat-supplier/rest-obat/') ?>" + $('#supplier').val(),
                    type: "GET",
                    dataType: "json",
                })
                .done(function(json) {
                   if(json.length > 0){
                    $('#obat').empty();
                    $('#obat').append("<option value='' selected disabled>-- Pilih --</option>");

                    for (i = 0; i < json.length; i++){
                        $('#obat').append("<option value='" + json[i].id+ "'>" + json[i].nama + "</option>");
                    }
                   } else {
                    $('#obat').empty();
                    $('#obat').append("<option value='' selected disabled>-- Tidak Terdapat Data Obat Pada Supplier Yang Dipilih --</option>");
                   }
                })
                .fail(function(xhr, status, errorThrown) {
                    alert("Sorry, there was a problem!");
                    console.log("Error: " + errorThrown);
                    console.log("Status: " + status);
                    console.dir(xhr);
                })
        })

        $('#obat').on('change', () => {
            $.ajax({
                    url: "<?= site_url('admin/obat-supplier/rest-obat-qty/') ?>" + $('#obat').val(),
                    type: "GET",
                    dataType: "json",
                })
                .done(function(json) {
                    $('#keterangan').html(`Stok data obat yang terdapat di supplier yaitu <b>${json.stok}</b>`);
                })
                .fail(function(xhr, status, errorThrown) {
                    alert("Sorry, there was a problem!");
                    console.log("Error: " + errorThrown);
                    console.log("Status: " + status);
                    console.dir(xhr);
                })
        })
    });
</script>
<?= $this->endSection() ?>