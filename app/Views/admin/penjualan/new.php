<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
Tambah Penjualan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Basic Tables start -->
<section class="section">
    <div class="card">
        <div class="card-header">
            <a href="<?= site_url('admin/penjualan') ?>" class="btn btn-primary">Kembali</a>
        </div>
        <div class="card-body">
            <form action="<?= site_url('admin/penjualan') ?>" method="POST" class="form" enctype="multipart/form-data" id="addData">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="first-name-column">No Invoice</label>
                            <input type="text" name="kode" id="first-name-column" class="form-control" placeholder="No Invoice" value="<?= $kode ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="last-name-column">Tanggal</label>
                            <input type="date" name="tanggal" id="last-name-column" class="form-control" placeholder="Tanggal" value="<?= date('Y-m-d') ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="city-column">Produk</label>
                            <select name="obat" class="form-control" id="produk" required>
                                <option value="" selected disabled>-- Pilih --</option>
                                <?php foreach ($obat as $o) : ?>
                                    <option value="<?= $o->id ?>" <?= old('obat') == $o->id ? 'selected' : '' ?>><?= $o->nama ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="text" id="harga" class="form-control" name="harga" placeholder="Harga" readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="text" id="stok" class="form-control" name="stok" placeholder="Stok" readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="kode">Kode Produk</label>
                            <input type="text" id="kode-produk" class="form-control" placeholder="Kode" readonly>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button id="tambah" class="btn btn-primary me-1 mb-1">Tambah</button>
                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                    </div>
                </div>

                <table class="table mt-4 table-responsive">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-4">
                        <label>Total Harga</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input type="number" class="form-control" name="total_harga" id="total-harga" placeholder="Total Harga" readonly required>
                    </div>
                    <div class="col-md-4">
                        <label>Bayar</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input type="number" id="nominal-bayar" class="form-control" name="bayar" placeholder="Nominal Bayar" onchange="hitungKembalian()" required>
                    </div>
                    <div class="col-md-4">
                        <label>Kembalian</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input type="text" id="kembalian" class="form-control" name="kembalian" placeholder="Kembalian" readonly required>
                        <span id="keterangan"></span>
                    </div>

                    <div class="col-md-4">
                    </div>
                    <div class="col-sm-8 d-flex justify-content-start mt-3">
                        <button type="submit" class="btn btn-primary me-1 mb-1 w-100">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
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
        $('#produk').on('change', () => {
            $.ajax({
                    url: "<?= site_url('admin/penjualan/rest-obat/') ?>" + $('#produk').val(),
                    type: "GET",
                    dataType: "json",
                })
                .done(function(json) {
                    $('#harga').val(json.harga_jual)
                    $('#stok').val(json.stok)
                    $('#kode-produk').val(json.kode)
                })
                .fail(function(xhr, status, errorThrown) {
                    alert("Sorry, there was a problem!");
                    console.log("Error: " + errorThrown);
                    console.log("Status: " + status);
                    console.dir(xhr);
                })
        })

        $('#tambah').on('click', (e) => {
            e.preventDefault();

            if ($('#produk').val() == null) {
                alert("Silahkan pilih produk terlebih dahulu!")
                e.preventDefault();
            }

            let markup = '';
            let kodeProduk = $("#kode-produk").val();
            let produk = $("#produk :selected").text();
            let harga = $('#harga').val();

            markup = `<tr id="row-${no}" class="data">
            <td>${kodeProduk}</td>
            <td><input type="text" value="${produk}" name="produk[]" class="form-control" readonly/></td>
            <td><input type="text" value="${harga}" id="harga-${kodeProduk}-${no}" name="harga[]" class="form-control" readonly/></td>
            <td><input type="number" value="0" name="qty[]" id="qty-${kodeProduk}-${no}" class="form-control" onchange="totalHargaRow('${kodeProduk}-${no}')"/></td>
            <td><input type="number" value="0" name="total[]" id="total-${kodeProduk}-${no}" class="form-control" readonly/></td>
            <td><button type="button" class="btn btn-danger" onclick="deleteRow(${no})"><i class="bi bi-trash-fill"></i></button></td>
            </tr>`;

            $("table tbody").append(markup);

            no++;
        })

        $('#addData').submit(function(e) {
            e.preventDefault();

            let table = $('.table tr.data');
            let subTotal = 0;
            let i = 0;

            let form = document.getElementById('addData');
            let formData = new FormData(form);

            if (table.length > 0) {
                table.each(function() {
                    formData.append('kode_produk[]', this.cells[0].innerHTML);
                    formData.append('kuantitas[]', $('#qty-' + kode_produk[i] + "-" + i).val());
                    formData.append("harga[]", $('#harga-' + kode_produk[i] + "-" + i).val());
                    formData.append("total[]", $('#total-' + kode_produk[i] + "-" + i).val());
                    i++;
                })
            }

            $.ajax({
                url: '<?= site_url('admin/penjualan') ?>',
                type: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(response) {
                    data = JSON.parse(response);

                    if (data.code == "200") {
                        Swal.fire(
                            'Sudah tersimpan!',
                            'Data sudah berhasil disimpan.',
                            'success'
                        )
                        setInterval(function() {
                            window.location.href = "<?= site_url('admin/penjualan') ?>"
                        }, 1000);
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Data tidak berhasil disimpan.',
                            'error'
                        )
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        })
    });

    function deleteRow(index) {
        $("#row-" + index).remove();
    }

    function totalHargaRow(kodeProduk) {
        let total = 0;
        let kuantitas = $('#qty-' + kodeProduk).val();
        let harga = $('#harga-' + kodeProduk).val();

        if (parseInt(kuantitas) > 0) {
            total = kuantitas * harga;
        } else {
            total = harga;
        }

        $('#total-' + kodeProduk).val(total);

        sumTotalHargaTable();
    }

    function sumTotalHargaTable() {
        let table = $('.table tr.data');
        let subTotal = 0;
        let i = 0;

        if (table.length > 0) {
            table.each(function() {
                kode_produk[i] = this.cells[0].innerHTML;
                kuantitas[i] = $('#qty-' + kode_produk[i] + "-" + i).val();
                harga[i] = $('#harga-' + kode_produk[i] + "-" + i).val();
                total[i] = $('#total-' + kode_produk[i] + "-" + i).val();
                i++;
            })
        }

        for (i = 0; i < total.length; i++) {
            subTotal = subTotal + parseInt(total[i]);
        }

        $('#total-harga').val(subTotal);
    }

    function hitungKembalian() {
        let HargaTotal = $('#total-harga').val();
        let UangBayar = $('#nominal-bayar').val();
        let hasil = 0;

        hasil = parseInt(UangBayar) - parseInt(HargaTotal);

        if (hasil < 0) {
            $('#keterangan').html("Uang Kurang");
            $('#kembalian').val(hasil * -1);
        } else if (hasil > 0) {
            $('#keterangan').html("Uang Kembalian");
            $('#kembalian').val(hasil);
        } else {
            $('#keterangan').html("Uang Kembalian");
            $('#kembalian').val(0);
        }

    }
</script>
<?= $this->endSection() ?>