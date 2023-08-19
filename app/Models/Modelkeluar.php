<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelkeluar extends model
{
    protected $table = 'tbl_obat_keluar';
    protected $primaryKey = 'id_obat_keluar';
    protected $allowedFields = ['', 'obat', 'jumlah_keluar', 'jenis_keluar', 'tanggal_keluar', 'keterangan'];
}