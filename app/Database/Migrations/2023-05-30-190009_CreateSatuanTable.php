<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSatuanTable extends Migration
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
            ],
            'deleted_at' => [
                'type'       => 'DATETIME'
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('satuan');
    }

    public function down()
    {
        $this->forge->dropTable('satuan');
    }
}
