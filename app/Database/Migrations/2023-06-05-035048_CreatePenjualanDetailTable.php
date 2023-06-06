<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePenjualanDetailTable extends Migration
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
            'penjualan_id' => [
                'type'       => 'INT',
                'constraint'     => 11,
                'unsigned'       => true
            ],
            'obat_id' => [
                'type'       => 'INT',
                'constraint'     => 11,
                'unsigned'       => true
            ],
            'qty' => [
                'type'       => 'INT',
                'constraint' => 11
            ],
            'harga' => [
                'type'       => 'INT',
                'constraint' => 11
            ],
            'total_harga' => [
                'type'       => 'INT',
                'constraint' => 11
            ],
            'created_at' => [
                'type'       => 'DATETIME'
            ],
            'updated_at' => [
                'type'       => 'DATETIME'
            ],
            'deleted_at' => [
                'type'       => 'DATETIME'
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('penjualan_id', 'penjualan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('obat_id', 'obat', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('penjualan_detail');
    }

    public function down()
    {
        $this->forge->dropTable('penjualan_detail');
    }
}
