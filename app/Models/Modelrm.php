<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelrm extends model
{
    protected $table = 'tbl_rekam_medis';
    protected $primaryKey = 'id_rm';
    protected $allowedFields = ['', 'pasien', 'dokter', 'layanan', 'no_rm', 'tinggi_badan', 'berat_badan', 'tekanan_darah', 'anamnesa', 'icd9', 'icd10', 'tindakan', 'diagnosa', 'terapi', 'edukasi', 'rujukan', 'waktu', 'keterangan'];
}