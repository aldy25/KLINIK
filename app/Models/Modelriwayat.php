<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelriwayat extends model
{
    protected $table = 'tbl_riwayat_transaksi';
    protected $primaryKey = 'id_riwayat';
    protected $allowedFields = ['', 'pasien', 'layanan', 'kasir', 'biaya_lainya', 'total_harga', 'total_bayar', 'kembalian', 'keterangan', 'waktu', 'status'];
}
