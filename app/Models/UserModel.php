<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'id_user';
    protected $returnType       = 'array';
    protected $allowedFields    = ['username', 'password', 'role'];
    protected $useTimestamps    = false;
    protected $useAutoIncrement = true;
}
