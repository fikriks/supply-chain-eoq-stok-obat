<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanDetail extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'penjualan_detail';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['penjualan_id', 'obat_id', 'qty', 'harga', 'total_harga'];

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

    function withRelations($id = '')
    {
        $this->select('penjualan_detail.*, penjualan_detail.total_harga AS total_harga_penjualan_detail, penjualan.*, penjualan.kode as penjualan_kode, penjualan.total_harga AS total_harga_penjualan, users.*, obat.*, obat.kode AS kode_obat, obat.nama AS nama_obat');

        $data = $this->join('penjualan', 'penjualan.id = penjualan_detail.penjualan_id')
            ->join('users', 'users.id = penjualan.user_id')
            ->join('obat', 'obat.id = penjualan_detail.obat_id')
            ->where('penjualan.id', $id)
            ->findAll();

        return $data;
    }
}
