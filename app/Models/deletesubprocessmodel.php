<?php
namespace App\Models;
use CodeIgniter\Model;
class deletesubprocessModel extends Model{
        // protected $DBGroup      = 'project';
        protected $table        = 'subprocess_tb';
        protected $primaryKey   = 'subprocess_id';
        protected $useAutoIncrement = true;
        protected $returnType       = 'array';
        protected $useSoftDeletes   = false;
        protected $protectFields    = false;
        protected $allowedFields    = [
            'process_id,job_id,subprocess_id'         
        ];

         // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
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

    function getProduct()
    {
       
        
    }
}
