<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelobat extends model
{
    protected $table = 'tbl_obat';
    protected $primaryKey = 'id_obat';
    protected $allowedFields = ['', 'nama_obat', 'kode_obat', 'jumlah_obat', 'harga_satuan', 'satuan', 'keterangan'];
}