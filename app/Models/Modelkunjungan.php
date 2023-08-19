<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelkunjungan extends model
{
    protected $table = 'tbl_kunjungan';
    protected $primaryKey = 'id_kunjungan';
    protected $allowedFields = ['', 'pasien', 'layanan', 'tanggal'];
}