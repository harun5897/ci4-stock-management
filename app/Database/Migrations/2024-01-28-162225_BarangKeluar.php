<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BarangKeluar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_barang_keluar' => [
                'type'           => 'INT',
                'constraint'     => 9,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_barang' => [
                'type'       => 'INT',
                'constraint' => 9,
            ],
            'jumlah_barang_keluar' => [
                'type'       => 'INT',
                'constraint' => 9,
            ],
            'tanggal_barang_keluar' => [
                'type'       => 'DATE',
            ],
        ]);
        $this->forge->addKey('id_barang_keluar', true);
        $this->forge->createTable('barang_keluar');
    }

    public function down()
    {
        $this->forge->dropTable('barang_keluar');
    }
}
