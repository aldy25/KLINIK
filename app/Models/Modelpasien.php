<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelpasien extends model
{
    protected $table = 'tbl_pasien';
    protected $primaryKey = 'id_pasien';
    protected $allowedFields = ['', 'no_rm', 'nik', 'nama_pasien', 'jk_pasien', 'tanggal_lahir', 'alamat_pasien', 'agama', 'pekerjaan', 'pendidikan', 'status_perkawinan'];
}