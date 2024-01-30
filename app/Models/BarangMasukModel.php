<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangMasukModel extends Model
{
    protected $table            = 'barang_masuk';
    protected $primaryKey       = 'id_barang_masuk';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_barang_masuk', 'id_barang', 'jumlah_barang_masuk', 'tanggal_barang_masuk'];
    protected $useTimestamps    = false;
    protected $useAutoIncrement = true;
}
