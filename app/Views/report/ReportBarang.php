<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Mega Mulia Perkasa</title>
</head>
<?php
$session = session();
if(!$session->has('auth')) {
    header("Location: /login");
    exit();
}
?>
<body>
    <div id='report'>
        <div class="header">
            <h1>CV Mega Mulia Perkasa</h1>
            <h2>Laporan Data Barang</h2>
            <hr>
        </div>
        <div class="content">
            <p>Rincian Data Barang</p>
            <table aria-describedby="mydesc">
                <tr>
                    <th style="width: 20px">No</th>
                    <th>Nama Barang</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah Stok</th>
                </tr>
                <?php
                    $no = 1;
                    foreach ($dataBarang as $barang) :
                ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $barang['nama_barang']; ?></td>
                        <td><?= $barang['harga_satuan']; ?></td>
                        <td><?= ($barang['total_stok']) ? $barang['total_stok'] : 0; ?></td>
                    </tr>
                <?php
                    $no++;
                    endforeach;
                ?>
            </table>
            <br><br>
            <div class="footer">
                <p>Tanjung Pinang, <span id="date"></span></p>
                <p>Penanggung Jawab</p>
                <br>
                <br>
                <p>Manajer</p>
            </div>
        </div>
    </div>
    
</body>
<script>
    const today = new Date();
    const yyyy = today.getFullYear();
    let mm = today.getMonth() + 1;
    let dd = today.getDate();
    if (dd < 10) dd = '0' + dd;
    if (mm < 10) mm = '0' + mm;
    const formattedToday = dd + '/' + mm + '/' + yyyy;
    document.getElementById('date').innerHTML = formattedToday;
</script>
<style type="text/css">
    .header {
        text-align: center;
    }
    .footer {
        text-align: left;
    }
    @media print {
        @page {
        size: A4;
        margin-top: 10px;
        margin-bottom: 0px;
        margin-left: 0px;
        margin-right: 0px;
        }
        hr {
            border-top: 1.5px solid black;
            height: 1.5px;
            margin: 5px 0px 10px 0px!important;
        }
    }
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    td, th {
        border: 1px solid black;
        text-align: left;
        padding: 8px;
    }
</style>
</html>

