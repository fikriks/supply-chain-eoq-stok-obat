<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
</head>

<body>
    <center>
        <h3>Laporan Penjualan</h3>
    </center>
    <table border="1" width="100%">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kode</th>
                <th>Nama Obat</th>
                <th>Qty</th>
                <th>Modal</th>
                <th>Jual</th>
                <th>Laba</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($penjualan as $po) : ?>
                <tr style="text-align: center;">
                    <td><?= $po->tanggal ?></td>
                    <td><?= $po->penjualan_kode ?></td>
                    <td><?= $po->nama_obat ?></td>
                    <td><?= $po->qty ?></td>
                    <td><?= $po->harga_jual ?></td>
                    <td><?= $po->harga_beli ?></td>
                    <td><?= $po->harga_beli - $po->harga_jual ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>