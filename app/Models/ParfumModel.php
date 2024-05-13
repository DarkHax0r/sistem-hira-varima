<?php

namespace App\Models;

use CodeIgniter\Model;

class ParfumModel extends Model
{
    protected $table = 'data_parfum';
    protected $primaryKey = 'id';

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = ['tanggal', 'pendapatan', 'modal'];
}
