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
            <h2>Laporan Barang Keluar</h2>
            <hr>
        </div>
        <div class="content">
            <p>Rincian Barang Keluar</p>
            <table aria-describedby="mydesc">
                <tr>
                    <th style="width: 20px">No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Tanggal Keluar</th>
                </tr>
                <?php
                    $no = 1;
                    foreach ($barangKeluar as $barang) :
                        $id_barang = $barang['id_barang'];
                        $filterBarangById = array_filter($dataBarang, function ($item) use ($id_barang) {
                            return $item['id_barang'] == $id_barang;
                        });
                        $filteredBarang = reset($filterBarangById);
                        $nama_barang = isset($filteredBarang['nama_barang']) ? $filteredBarang['nama_barang'] : 'Barang not found';
                ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $nama_barang; ?></td>
                        <td><?= $barang['jumlah_barang_keluar']; ?></td>
                        <td><?= $barang['tanggal_barang_keluar']; ?></td>
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

