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
    <div class="page-supplier">
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
                    <h3 class="text-secondary">Data Supplier</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex border-dark border-bottom py-3">
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#tambah-data-supplier">
                            Tambah Supplier
                        </button>
                    </div>
                <table class="table table-hover" aria-describedby="table-supplier">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Supplier</th>
                        <th scope="col">No Telpon</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            foreach ($dataSupplier as $supplier) :
                        ?>
                        <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $supplier['nama_supplier']; ?></td>
                            <td><?= $supplier['no_telp']; ?></td>
                            <td><?= $supplier['alamat']; ?></td>
                            <td class="d-flex">
                                <a href="/hapus-supplier/<?= $supplier['id_supplier'];?>" class="btn btn-danger btn-sm me-1">Hapus</a>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#detail-data-supplier" onclick="getDetailSupplier(<?= $supplier['id_supplier'];?>)">Edit</button>
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
    <div class="modal fade" id="tambah-data-supplier" tabindex="-1" aria-labelledby="tambah-data-supplier" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/tambah-supplier" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Supplier</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <label for="nama_supplier" class="form-label">Nama Supplier</label>
                            <input type="text" placeholder="Enter nama supplier" name="nama_supplier" id="nama-supplier" class="form-control" required oninput="getNamaSupplier()">
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
    <div class="modal fade" id="detail-data-supplier" tabindex="-1" aria-labelledby="detail-data-supplier" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/update-supplier" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Supplier</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <input type="hidden" name='id_supplier' id="detail-id-supplier">
                            <label for="nama_supplier" class="form-label">Nama Supplier</label>
                            <input type="text" placeholder="Enter nama supplier" name="nama_supplier" id="detail-nama-supplier" class="form-control" required oninput="getNamaSupplier()">
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
        async function getDetailSupplier(idSupplier) {
            const responseDetailSupplier = await fetch(`/detail-supplier/${idSupplier}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
            })
            .then(response => response.json())
            .catch(error => error.json())
            if(responseDetailSupplier.success) {
                const data = responseDetailSupplier.data
                document.getElementById('detail-id-supplier').value = data.id_supplier
                document.getElementById('detail-nama-supplier').value = data.nama_supplier
                document.getElementById('detail-no-telp').value = data.no_telp
                document.getElementById('detail-alamat').value = data.alamat
            }
        }
        function getNamaSupplier() {
            const namaSupplier = document.getElementById('nama-supplier').value
            document.getElementById('nama-supplier').value = onlyAlphabet(namaSupplier)
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
