<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table            = 'supplier';
    protected $primaryKey       = 'id_supplier';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_supplier', 'nama_supplier', 'no_telp', 'alamat'];
    protected $useTimestamps    = false;
    protected $useAutoIncrement = true;
}
