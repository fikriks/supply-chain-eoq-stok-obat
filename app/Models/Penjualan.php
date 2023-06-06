<?php

namespace App\Models;

use CodeIgniter\Model;

class Penjualan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'penjualan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode', 'user_id', 'tanggal', 'total_harga', 'bayar', 'kembalian'];

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
        $this->select('penjualan.*, users.*, penjualan_detail.*, obat.*');

        $data = $this->join('users', 'users.id = penjualan.user_id')
            ->join('penjualan_detail', 'penjualan_detail.penjualan_id = penjualan.id')
            ->join('obat', 'obat.id = penjualan_detail.obat_id')
            ->findAll();

        return $data;
    }
}
