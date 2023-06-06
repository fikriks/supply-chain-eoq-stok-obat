<?php

namespace App\Models;

use CodeIgniter\Model;

class Perencanaan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'perencanaan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode', 'tanggal', 'obat_id', 'permintaan', 'harga', 'biaya_pemesanan', 'biaya_penyimpanan', 'lead_time', 'avarange_use', 'penjualan_harian_tertinggi', 'lead_time_tertinggi', 'rata_rata_penjualan_harian', 'rata_rata_lead_time', 'daur_ulang_pemesanan', 'safety_stok', 'eoq', 'rop', 'maximum_inventory'];

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
        $this->select("{$this->table}.*, perencanaan.kode AS kode_perencanaan, perencanaan.id AS perencanaan_id, obat.*, obat.kode AS kode_obat, obat.nama AS nama_obat, auth_identities.*");

        $data = $this->join('obat', 'obat.id = perencanaan.obat_id')
            ->join('auth_identities', 'auth_identities.user_id = obat.supplier_id')
            ->findAll();

        return $data;
    }

    public function withRelationsById($id)
    {
        $this->select("{$this->table}.*, perencanaan.kode AS kode_perencanaan, perencanaan.id AS perencanaan_id, obat.*, obat.kode AS kode_obat, obat.nama AS nama_obat, auth_identities.*");

        $data = $this->join('obat', 'obat.id = perencanaan.obat_id')
            ->join('auth_identities', 'auth_identities.user_id = obat.supplier_id')
            ->where('perencanaan.id', $id)
            ->first();

        return $data;
    }
}
