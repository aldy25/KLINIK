<?php

namespace App\Models;

use CodeIgniter\Model;

class Modellayanan extends model
{
    protected $table = 'tbl_layanan';
    protected $primaryKey = 'id_layanan';
    protected $allowedFields = ['', 'nama_layanan', 'harga'];
}