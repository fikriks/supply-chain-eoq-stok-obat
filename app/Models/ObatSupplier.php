<?php

namespace App\Models;

use CodeIgniter\Model;

class ObatSupplier extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'obat_supplier';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode', 'nama', 'kategori_obat_id', 'user_id','satuan_id', 'stok', 'harga', 'expired'];

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

        $this->select("{$this->table}.*, auth_identities.name AS nama_supplier,satuan.nama AS nama_satuan, kategori_obat.nama AS nama_kategori_obat");

        $this->join('kategori_obat', "kategori_obat.id = obat_supplier.kategori_obat_id")
        ->join('satuan', "satuan.id = obat_supplier.satuan_id")
        ->join('auth_identities', 'auth_identities.user_id = obat_supplier.user_id');

        return $this;
    }

    public function withRelationsById($id)
    {

        $this->select("{$this->table}.*, auth_identities.name AS nama_supplier, satuan.nama AS nama_satuan, kategori_obat.nama AS nama_kategori_obat");
        
        $this->join('kategori_obat', "kategori_obat.id = obat_supplier.kategori_obat_id")
        ->join('satuan', "satuan.id = obat_supplier.satuan_id")
        ->join('auth_identities', "auth_identities.user_id = {$id}")
        ->where('obat_supplier.user_id', $id);

        return $this;
    }
}
