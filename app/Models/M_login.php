<?php

namespace App\Models;

use CodeIgniter\Model;

class M_login extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'username', 'password'];
}
