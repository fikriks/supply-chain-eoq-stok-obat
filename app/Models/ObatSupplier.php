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
    protected $allowedFields    = ['nama', 'kategori_obat', 'user_id', 'stok', 'harga'];

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

        $this->select("{$this->table}.*, auth_identities.name AS nama_supplier");

        $this->join('auth_identities', 'auth_identities.user_id = obat_supplier.user_id');

        return $this;
    }

    public function withRelationsById($id)
    {

        $this->select("{$this->table}.*, auth_identities.name AS nama_supplier");

        $this->join('auth_identities', "auth_identities.user_id = {$id}");

        return $this;
    }
}
