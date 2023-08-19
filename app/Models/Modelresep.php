<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelresep extends model
{
    protected $table = 'tb_resep';
    protected $primaryKey = 'id_resep';
    protected $allowedFields = ['', 'transaksi', 'obat', 'resep', 'jumlah'];
}