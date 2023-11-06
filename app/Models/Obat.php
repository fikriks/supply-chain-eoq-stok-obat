<?php

namespace App\Models;

use CodeIgniter\Model;

class Obat extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'obat';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode', 'nama', 'kategori_obat_id', 'supplier_id', 'satuan_id', 'stok', 'harga_beli', 'harga_jual', 'expired'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function withRelations()
    {

        $this->select("{$this->table}.*, kategori_obat.nama AS nama_kategori_obat, satuan.nama AS nama_satuan, auth_identities.name AS nama_supplier");

        $this->join('kategori_obat', 'kategori_obat.id = obat.kategori_obat_id')
            ->join('satuan', 'satuan.id = obat.satuan_id')
            ->join('auth_identities', 'auth_identities.user_id = obat.supplier_id');

        return $this;
    }

    public function withRelationsMasukKeluar()
    {
        $this->select("{$this->table}.*, obat.kode AS kode_obat, obat.nama AS nama_obat, pemesanan.*, pemesanan.qty AS qty_pemesanan, pemesanan.total_harga AS total_harga_pemesanan, penjualan_detail.*, penjualan_detail.qty AS qty_penjualan_detail, penjualan_detail.total_harga AS total_harga_penjualan_detail");

        $data = $this->join('pemesanan', 'pemesanan.obat_id = obat.id')
            ->join('penjualan_detail', 'penjualan_detail.obat_id = obat.id')
            ->findAll();

        return $data;
    }
}
