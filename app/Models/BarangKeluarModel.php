<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangKeluarModel extends Model
{
    protected $table            = 'barang_keluar';
    protected $primaryKey       = 'id_barang_keluar';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_barang_keluar', 'id_barang', 'jumlah_barang_keluar', 'tanggal_barang_keluar'];
    protected $useTimestamps    = false;
    protected $useAutoIncrement = true;
}
