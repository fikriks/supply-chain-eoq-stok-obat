<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKategoriObatTable extends Migration
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
                'constraint'     => 191
            ],
            'created_at' => [
                'type'       => 'DATETIME'
            ],
            'updated_at' => [
                'type'       => 'DATETIME'
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('kategori_obat');
    }

    public function down()
    {
        $this->forge->dropTable('kategori_obat');
    }
}
