<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateObatSupplierTable extends Migration
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
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 191
            ],
            'kategori_obat' => [
                'type'       => 'VARCHAR',
                'constraint' => 191
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint'     => 11,
                'unsigned'       => true
            ],
            'stok' => [
                'type'       => 'INT',
                'constraint'     => 11
            ],
            'harga' => [
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
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('obat_supplier');
    }

    public function down()
    {
        $this->forge->dropTable('obat_supplier');
    }
}
