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
    protected $allowedFields    = ['kode', 'nama', 'kategori_obat_id', 'stok', 'expired'];

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

    public function withKategoriObat()
    {
        $this->select("{$this->table}.*, kategori_obat.nama AS nama_kategori_obat");

        return $this->join('kategori_obat', 'kategori_obat.id = obat.kategori_obat_id');
    }
}
