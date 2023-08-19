<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelmasuk extends model
{
    protected $table = 'tbl_obat_masuk';
    protected $primaryKey = 'id_obat_masuk';
    protected $allowedFields = ['', 'nama_obat', 'kode_obat', 'jumlah_obat', 'harga_satuan', 'satuan', 'tanggal_exp', 'sumber', 'tanggal_masuk', 'keterangan'];
}