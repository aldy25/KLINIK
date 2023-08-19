<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelpegawai extends model
{
    protected $table = 'tbl_pegawai';
    protected $primaryKey = 'id_pegawai';
    protected $allowedFields = ['', 'nama_pegawai', 'foto', 'no_hp', 'email', 'alamat', 'jabatan'];
}