<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Barang Masuk & Keluar</title>
</head>

<body>
    <center>
        <h3>Laporan Barang Masuk & Keluar</h3>
    </center>
    <table border="1" width="100%">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Obat</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Selisih</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Total Pembelian</th>
                <th>Total Penjualan</th>
                <th>Laba</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($obat as $o) : ?>
                <tr style="text-align: center;">
                    <td><?= $o->kode_obat ?></td>
                    <td><?= $o->nama_obat ?></td>
                    <td><?= $o->qty_pemesanan ?></td>
                    <td><?= $o->qty_penjualan_detail ?></td>
                    <td><?= $o->qty_pemesanan - $o->qty_penjualan_detail ?></td>
                    <td><?= $o->harga_beli ?></td>
                    <td><?= $o->harga_jual ?></td>
                    <td><?= $o->total_harga_pemesanan ?></td>
                    <td><?= $o->total_harga_penjualan_detail ?></td>
                    <td><?= $o->total_harga_penjualan_detail - $o->total_harga_pemesanan ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>