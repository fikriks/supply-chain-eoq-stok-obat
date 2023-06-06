<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemesanan</title>
</head>

<body>
    <center>
        <h3>Laporan Pemesanan</h3>
    </center>
    <table border="1" width="100%">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kode</th>
                <th>Nama Obat</th>
                <th>Qty</th>
                <th>ED</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pemesanan as $po) : ?>
                <tr style="text-align: center;">
                    <td><?= $po->tanggal ?></td>
                    <td><?= $po->pemesanan_kode ?></td>
                    <td><?= $po->nama_obat ?></td>
                    <td><?= $po->qty ?></td>
                    <td><?= $po->expired ?></td>
                    <td><?= $po->harga_beli ?></td>
                    <td><?= $po->harga_beli * $po->qty ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>