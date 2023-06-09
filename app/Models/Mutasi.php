<?php

namespace App\Models;

use CodeIgniter\Model;

class Mutasi extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mutasi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'author',
        'cabang',
        'dana',
        'kategori',
        'waktu',
        'nasabah',
        'created_at',
        'updated_at',
    ];

    // Dates
    protected $useTimestamps = false;
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

    function getAllAssociateData() 
    {
        return $this->db->table('mutasi')
            ->select('
                mutasi.*,
                cabang.nama_cabang as nama_cabang,
                cabang.kode_cabang as kode_cabang,
                users.name as name
            ')
            ->join('cabang', 'mutasi.cabang = cabang.kode_cabang')
            ->join('users', 'mutasi.author = users.id')
            ->get()
            ->getResultArray();
    }
}
