<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelakun extends model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['', 'level', 'role1', 'role2', 'nama_user', 'status', 'username', 'password', 'foto'];
}