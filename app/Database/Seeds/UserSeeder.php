<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'id_user'   => 1,
            'username'  => 'admin',
            'password'  => 'admin12345',
            'role'      => 'admin',

        ];
        $this->db->table('user')->insert($data);
    }
}
