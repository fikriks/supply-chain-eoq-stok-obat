<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePerencanaanTable extends Migration
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
            'tanggal' => [
                'type'          => 'DATE'
            ],
            'obat_id' => [
                'type'       => 'INT',
                'constraint'     => 11,
                'unsigned'       => true
            ],
            'permintaan' => [
                'type'       => 'INT',
                'constraint' => 11
            ],
            'harga' => [
                'type'       => 'INT',
                'constraint' => 11
            ],
            'biaya_pemesanan' => [
                'type'       => 'INT',
                'constraint' => 11
            ],
            'biaya_penyimpanan' => [
                'type'       => 'INT',
                'constraint' => 11
            ],
            'lead_time' => [
                'type'       => 'INT',
                'constraint' => 11
            ],
            'avarange_use' => [
                'type'       => 'INT',
                'constraint' => 11
            ],
            'penjualan_harian_tertinggi' => [
                'type'       => 'INT',
                'constraint' => 11
            ],
            'lead_time_tertinggi' => [
                'type'       => 'INT',
                'constraint' => 11
            ],
            'rata_rata_penjualan_harian' => [
                'type'       => 'INT',
                'constraint' => 11
            ],
            'rata_rata_lead_time' => [
                'type'       => 'INT',
                'constraint' => 11
            ],
            'daur_ulang_pemesanan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null' => true
            ],
            'safety_stok' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null' => true
            ],
            'eoq' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null' => true
            ],
            'rop' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null' => true
            ],
            'maximum_inventory' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null' => true
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
        $this->forge->createTable('perencanaan');
    }

    public function down()
    {
        $this->forge->dropTable('perencanaan');
    }
}
