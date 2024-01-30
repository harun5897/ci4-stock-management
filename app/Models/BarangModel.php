<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table            = 'barang';
    protected $primaryKey       = 'id_barang';
    protected $returnType       = 'array';
    protected $allowedFields    = ['nama_barang', 'harga_satuan', 'total_stok'];
    protected $useTimestamps    = false;
    protected $useAutoIncrement = true;
}
