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
    <div class="page-pelanggan">
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
                    <h3 class="text-secondary">Data Pelanggan</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex border-dark border-bottom py-3">
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#tambah-data-pelanggan">
                            Tambah Pelanggan
                        </button>
                    </div>
                <table class="table table-hover" aria-describedby="table-pelanggan">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Pelanggan</th>
                        <th scope="col">No Telpon</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            foreach ($dataPelanggan as $pelanggan) :
                        ?>
                        <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $pelanggan['nama_pelanggan']; ?></td>
                            <td><?= $pelanggan['no_telp']; ?></td>
                            <td><?= $pelanggan['alamat']; ?></td>
                            <td class="d-flex">
                                <a href="/hapus-pelanggan/<?= $pelanggan['id_pelanggan'];?>" class="btn btn-danger btn-sm me-1">Hapus</a>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#detail-data-pelanggan" onclick="getDetailPelanggan(<?= $pelanggan['id_pelanggan'];?>)">Edit</button>
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
    <div class="modal fade" id="tambah-data-pelanggan" tabindex="-1" aria-labelledby="tambah-data-pelanggan" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/tambah-pelanggan" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pelanggan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                            <input type="text" placeholder="Enter nama pelanggan" name="nama_pelanggan" id="nama-pelanggan" class="form-control" required oninput="getNamaPelanggan()">
                            <label for="no_telp" class="form-label mt-2">No Telp</label>
                            <input type="number" placeholder="Enter no telp" name="no_telp" id="no-telp" class="form-control" required oninput="getNoTelp()">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" placeholder="Enter alamat" name="alamat" id="alamat" class="form-control" required>
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
    <div class="modal fade" id="detail-data-pelanggan" tabindex="-1" aria-labelledby="detail-data-pelanggan" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/update-pelanggan" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Pelanggan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <input type="hidden" name='id_pelanggan' id="detail-id-pelanggan">
                            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                            <input type="text" placeholder="Enter nama pelanggan" name="nama_pelanggan" id="detail-nama-pelanggan" class="form-control" required oninput="getNamaPelanggan()">
                            <label for="no_telp" class="form-label mt-2">No Telp</label>
                            <input type="number" placeholder="Enter no telp" name="no_telp" id="detail-no-telp" class="form-control" required oninput="getNoTelp()">
                            <label for="alamat" class="form-label mt-2">Alamat</label>
                            <input type="text" placeholder="Enter alamat" name="alamat" id="detail-alamat" class="form-control" required>
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
        async function getDetailPelanggan(idPelanggan) {
            const responseDetailPelanggan = await fetch(`/detail-pelanggan/${idPelanggan}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
            })
            .then(response => response.json())
            .catch(error => error.json())
            if(responseDetailPelanggan.success) {
                const data = responseDetailPelanggan.data
                document.getElementById('detail-id-pelanggan').value = data.id_pelanggan
                document.getElementById('detail-nama-pelanggan').value = data.nama_pelanggan
                document.getElementById('detail-no-telp').value = data.no_telp
                document.getElementById('detail-alamat').value = data.alamat
            }
        }
        function getNamaPelanggan() {
            const namaPelanggan = document.getElementById('nama-pelanggan').value
            document.getElementById('nama-pelanggan').value = onlyAlphabet(namaPelanggan)
        }
        function getNoTelp() {
            const noTelp = document.getElementById('no-telp').value
            document.getElementById('no-telp').value = onlyNumber(noTelp)
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
