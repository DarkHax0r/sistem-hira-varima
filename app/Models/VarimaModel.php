<?php

namespace App\Models;

use CodeIgniter\Model;

class VarimaModel extends Model
{
    protected $table = 'data_parfum';
    protected $allowedFields = ['pendapatan', 'modal'];

    public function getData()
    {
        return $this->findAll();
    }

    public function getPendapatan()
    {
        return $this->select('pendapatan')->findAll();
    }
}
