<?php

namespace App\Models;

use CodeIgniter\Model;

class Modeljabatan extends model
{
    protected $table = 'tbl_jabatan';
    protected $primaryKey = 'id_jabatan ';
    protected $allowedFields = ['', 'nama_jabatan'];
}