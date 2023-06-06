<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePemesananTable extends Migration
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
            'tanggal' => [
                'type'       => 'DATE'
            ],
            'kode' => [
                'type'       => 'VARCHAR',
                'constraint'     => 191
            ],
            'obat_id' => [
                'type'       => 'INT',
                'constraint'     => 11,
                'unsigned'       => true
            ],
            'supplier_id' => [
                'type'       => 'INT',
                'constraint'     => 11,
                'unsigned'       => true
            ],
            'qty' => [
                'type'       => 'INT',
                'constraint' => 11
            ],
            'total_harga' => [
                'type'       => 'INT',
                'constraint' => 11
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 191
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
        $this->forge->addKey('kode', false, true);
        $this->forge->addForeignKey('obat_id', 'obat', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('supplier_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pemesanan');
    }

    public function down()
    {
        $this->forge->dropTable('pemesanan');
    }
}
