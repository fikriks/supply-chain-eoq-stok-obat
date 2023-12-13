<?php

namespace App\Models;

use CodeIgniter\Model;

class Pemesanan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pemesanan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['tanggal', 'kode', 'obat_id', 'supplier_id', 'user_id', 'qty', 'total_harga', 'status'];

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

    function withRelations()
    {
        $this->select('pemesanan.*, pemesanan.id as pemesanan_id, pemesanan.kode AS pemesanan_kode, obat_supplier.*, obat_supplier.nama AS nama_obat, auth_identities.*, auth_identities.name AS nama_supplier, pemesanan.kode AS kode_pemesanan');

        $data = $this->join('obat_supplier', 'obat_supplier.id = pemesanan.obat_id')
            ->join('auth_identities', 'auth_identities.user_id = obat_supplier.user_id')
            ->findAll();

        return $data;
    }
}
