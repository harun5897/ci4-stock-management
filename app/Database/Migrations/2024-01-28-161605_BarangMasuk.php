<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BarangMasuk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_barang_masuk' => [
                'type'           => 'INT',
                'constraint'     => 9,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_barang' => [
                'type'       => 'INT',
                'constraint' => 9,
            ],
            'jumlah_barang_masuk' => [
                'type'       => 'INT',
                'constraint' => 9,
            ],
            'tanggal_barang_masuk' => [
                'type'       => 'DATE',
            ],
        ]);
        $this->forge->addKey('id_barang_masuk', true);
        $this->forge->createTable('barang_masuk');
    }

    public function down()
    {
        $this->forge->dropTable('barang_masuk');
    }
}
