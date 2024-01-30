<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Mega Mulia Perkasa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php
$session = session();
if(!$session->has('auth')) {
    header("Location: /login");
    exit();
}
?>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-secondary" href="/">CV Mega Mulia Perkasa</a>
            <div class="dropdown dropstart">
            <?php
            if (!$session->has('auth')) :?>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false" disabled>
                    Menu
                </button>
            <?php else: ?>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                    Menu
                </button>
            <?php endif ?>
                <ul class="dropdown-menu bg-light" aria-labelledby="dropdownMenu2">
                    <li><button onclick="window.location.href='/data-barang'" class="dropdown-item" type="button">Data Barang</button></li>
                    <li><button onclick="window.location.href='/data-supplier'" class="dropdown-item" type="button">Data Supplier</button></li>
                    <li><button onclick="window.location.href='/data-pelanggan'" class="dropdown-item" type="button">Data Pelanggan</button></li>
                    <li><button onclick="window.location.href='/barang-masuk'" class="dropdown-item" type="button">Barang Masuk</button></li>
                    <li><button onclick="window.location.href='/barang-keluar'" class="dropdown-item" type="button">Barang Keluar</button></li>
                    <hr>
                    <li><button onclick="window.location.href='/logout'" class="dropdown-item" type="button">Logout</button></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="page-data-barang">
        <br><br>
        <?php
            if ($session->has('failed')) :?>
            <div class="d-flex justify-content-center">
                <div class="alert alert-danger alert-dismissible fade show w-50" role="alert">
                    <strong>Gagal!</strong> <?= $session->getFlashdata('failed'); ?>.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php endif ?>
        <div class="d-flex justify-content-center">
        <div class="card w-75">
                <div class="card-header">
                    <h3 class="text-secondary">Data Barang</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex border-dark border-bottom py-3">
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#tambah-data-barang">
                            Tambah Barang
                        </button>
                        <button type="button" class="btn btn-primary" onclick="window.location.href='/data-barang/report'">
                            Cetak
                        </button>
                    </div>
                <table class="table table-hover" aria-describedby="table-data-barang">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Harga Satuan</th>
                        <th scope="col">Jumlah Stok</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            foreach ($dataBarang as $barang) :
                        ?>
                        <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $barang['nama_barang']; ?></td>
                            <td><?= $barang['harga_satuan']; ?></td>
                            <td><?= ($barang['total_stok']) ? $barang['total_stok'] : 0; ?></td>
                            <td class="d-flex">
                                <a href="/hapus-barang/<?= $barang['id_barang'];?>" class="btn btn-danger btn-sm me-1">Hapus</a>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#detail-data-barang" onclick="getDetailBarang(<?= $barang['id_barang'];?>)">Edit</button>
                            </td>
                        </tr>
                        <?php
                            $no++;
                            endforeach;
                        ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Data Barang -->
    <div class="modal fade" id="tambah-data-barang" tabindex="-1" aria-labelledby="tambah-data-barang" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/tambah-barang" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" placeholder="Enter nama barang" name="nama_barang" id="nama-barang" class="form-control" required oninput="getNamaBarang()">
                            <label for="harga_satuan" class="form-label mt-2">Harga Satuan</label>
                            <input type="number" placeholder="Enter harga satuan" name="harga_satuan" id="harga-satuan" class="form-control" required oninput="getHargaSatuan()">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Edit Data Barang -->
    <div class="modal fade" id="detail-data-barang" tabindex="-1" aria-labelledby="detail-data-barang" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/update-barang" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Data Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <input type="hidden" name='id_barang' id="detail-id-barang">
                            <input type="hidden" name='total_stok' id="detail-total-stok">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" placeholder="Enter nama barang" name="nama_barang" id="detail-nama-barang" class="form-control" required oninput="getNamaBarang()">
                            <label for="harga_satuan" class="form-label mt-2">Harga Satuan</label>
                            <input type="number" placeholder="Enter harga satuan" name="harga_satuan" id="detail-harga-satuan" class="form-control" required oninput="getHargaSatuan()">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script>
        async function getDetailBarang(idBarang) {
            const responseDetailBarang = await fetch(`/detail-barang/${idBarang}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
            })
            .then(response => response.json())
            .catch(error => error.json())
            if(responseDetailBarang.success) {
                const data = responseDetailBarang.data
                document.getElementById('detail-id-barang').value = data.id_barang
                document.getElementById('detail-total-stok').value = data.total_stok
                document.getElementById('detail-nama-barang').value = data.nama_barang
                document.getElementById('detail-harga-satuan').value = data.harga_satuan
            }
        }
        function getHargaSatuan() {
            const hargaSatuan = document.getElementById('harga-satuan').value
            document.getElementById('harga-satuan').value = onlyNumber(hargaSatuan)
        }
        function getNamaBarang() {
            const namaBarang = document.getElementById('nama-barang').value
            document.getElementById('nama-barang').value = onlyAlphabet(namaBarang)
        }
        function onlyNumber(val) {
            const regex = /^[0-9]+$/
            const split = val.split('')
            if(split.length != 0) {
            if(regex.test(split[split.length - 1])) {
                const joinValue = split.slice(0, split.length)
                return joinValue.join('')
            } else {
                const joinValue = split.slice(0, split.length-1)
                return joinValue.join('')
            }
            } else {
            return ''
            }
        }
        function onlyAlphabet(val) {
            const regex = /^[a-zA-Z\s0-9_#]+$/
            const split = val.split('')
            if(split.length != 0) {
            if(regex.test(split[split.length - 1])) {
                const joinValue = split.slice(0, split.length)
                return joinValue.join('')
            } else {
                const joinValue = split.slice(0, split.length-1)
                return joinValue.join('')
            }
            } else {
            return ''
            }
        }
    </script>
</body>
</html>
