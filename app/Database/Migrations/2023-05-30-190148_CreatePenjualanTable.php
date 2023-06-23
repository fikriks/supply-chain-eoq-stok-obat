<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePenjualanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode' => [
                'type'       => 'VARCHAR',
                'constraint'     => 191
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint'     => 11,
                'unsigned'       => true
            ],
            'tanggal' => [
                'type'       => 'DATE'
            ],
            'total_harga' => [
                'type'       => 'INT',
                'constraint'     => 11
            ],
            'bayar' => [
                'type'       => 'INT',
                'constraint'     => 11
            ],
            'kembalian' => [
                'type'       => 'INT',
                'constraint'     => 11
            ],
            'created_at' => [
                'type'       => 'DATETIME'
            ],
            'updated_at' => [
                'type'       => 'DATETIME'
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('kode', false, true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('penjualan');
    }

    public function down()
    {
        $this->forge->dropTable('penjualan');
    }
}
