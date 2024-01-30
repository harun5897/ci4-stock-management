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
    <div class="page-barang-keluar">
        <br><br>
        <?php
            if ($session->has('failed')) :?>
            <div class="d-flex justify-content-center">
                <div class="alert alert-danger alert-dismissible fade show w-75" role="alert">
                    <strong>Gagal!</strong> <?= $session->getFlashdata('failed'); ?>.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php endif ?>
        <div class="d-flex justify-content-center">
        <div class="card w-75">
                <div class="card-header">
                    <h3 class="text-secondary">Barang Keluar</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex border-dark border-bottom py-3">
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#tambah-barang-keluar">
                            Tambah Barang Keluar
                        </button>
                        <button type="button" class="btn btn-primary" onclick="window.location.href='/barang-keluar/report'">
                            Cetak
                        </button>
                    </div>
                <table class="table table-hover" aria-describedby="table-barang-keluar">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Jumlah Barang</th>
                        <th scope="col">Tanggal Keluar</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
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
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $nama_barang; ?></td>
                            <td><?= $barang['jumlah_barang_keluar']; ?></td>
                            <td><?= $barang['tanggal_barang_keluar']; ?></td>
                            <td class="d-flex">
                                <a href="/hapus-barang-keluar/<?= $barang['id_barang_keluar'];?>" class="btn btn-danger btn-sm me-1">Hapus</a>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#detail-barang-keluar" onclick="getDetailBarangKeluar(<?= $barang['id_barang_keluar'];?>)">Edit</button>
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
    <!-- Modal Tambah Barang Keluar -->
    <div class="modal fade" id="tambah-barang-keluar" tabindex="-1" aria-labelledby="tambah-barang-keluar" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/tambah-barang-keluar" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Barang Keluar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <label for="id_barang" class="form-label">Nama Barang</label>
                            <select name="id_barang" id="id-barang" class="form-select">
                                <option value="">Pilih Barang</option>
                                <?php foreach ($dataBarang as $listBarang): ?>
                                    <option value="<?= $listBarang['id_barang'] ?>"><?= $listBarang['nama_barang'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="jumlah_barang_keluar" class="form-label mt-2">Jumlah Barang</label>
                            <input type="number" placeholder="Enter jumlah barang" name="jumlah_barang_keluar" id="jumlah-barang-keluar" class="form-control" required" oninput="getJumlahBarang()">
                            <label for="tanggal_barang_keluar" class="form-label mt-2">Tanggal Keluar</label>
                            <input type="date" name="tanggal_barang_keluar" id="tanggal-barang-keluar" class="form-control" required">
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
    <div class="modal fade" id="detail-barang-keluar" tabindex="-1" aria-labelledby="detail-barang-keluar" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/update-barang-keluar" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Barang Keluar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <input type="hidden" name='id_barang_keluar' id="detail-id-barang-keluar">
                            <input type="hidden" name='jumlah_barang_keluar_last' id="detail-jumlah-barang-keluar-last">
                            <label for="id_barang" class="form-label">Nama Barang</label>
                            <input type="hidden" name='id_barang' id="id-barang-temp">
                            <select id="detail-id-barang" class="form-select" disabled>
                                <option value="">Pilih Barang</option>
                                <?php foreach ($dataBarang as $listBarang): ?>
                                    <option value="<?= $listBarang['id_barang'] ?>"><?= $listBarang['nama_barang'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="jumlah_barang_keluar" class="form-label mt-2">Jumlah Barang</label>
                            <input type="number" placeholder="Enter jumlah barang" name="jumlah_barang_keluar" id="detail-jumlah-barang-keluar" class="form-control" required" oninput="getJumlahBarang()">
                            <label for="tanggal_barang_keluar" class="form-label mt-2">Tanggal Keluar</label>
                            <input type="date" name="tanggal_barang_keluar" id="detail-tanggal-barang-keluar" class="form-control" required">
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
        async function getDetailBarangKeluar(idBarangKeluar) {
            const responseDetailBarangKeluar = await fetch(`/detail-barang-keluar/${idBarangKeluar}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
            })
            .then(response => response.json())
            .catch(error => error.json())
            if(responseDetailBarangKeluar.success) {
                const data = responseDetailBarangKeluar.data
                document.getElementById('detail-id-barang-keluar').value = data.id_barang_keluar
                document.getElementById('detail-jumlah-barang-keluar-last').value = data.jumlah_barang_keluar
                const selectOption = document.getElementById('detail-id-barang');
                for (let i = 0; i < selectOption.options.length; i++) {
                    if (selectOption.options[i].value == data.id_barang) {
                        selectOption.selectedIndex = i;
                        break;
                    }
                }
                document.getElementById('id-barang-temp').value = data.id_barang
                document.getElementById('detail-jumlah-barang-keluar').value = data.jumlah_barang_keluar
                document.getElementById('detail-tanggal-barang-keluar').value = data.tanggal_barang_keluar
            }
        }
        function getJumlahBarang() {
            const jumlahBarang = document.getElementById('jumlah-barang-keluar').value
            document.getElementById('jumlah-barang-keluar').value = onlyNumber(jumlahBarang)
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
    </script>
</body>
</html>
