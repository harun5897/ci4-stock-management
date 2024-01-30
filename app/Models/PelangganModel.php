<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table            = 'pelanggan';
    protected $primaryKey       = 'id_pelanggan';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_pelanggan', 'nama_pelanggan', 'no_telp', 'alamat'];
    protected $useTimestamps    = false;
    protected $useAutoIncrement = true;
}
