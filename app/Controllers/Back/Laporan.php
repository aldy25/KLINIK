<?php

namespace App\Controllers\back;

use App\Controllers\BaseController;
use Config\Services;


class Laporan extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'KLINIK DOKTER YANTI | CETAK LAPORAN',
            'page' => 'LAPORAN'
        ];
        return view('Page/Laporan/Cetak', $data);
    }

    public function cetak()
    {
        $tanggal = $this->request->getPost('tanggal_awal');
        var_dump($tanggal);
    }

    public function proses()
    {
        $tanggal_awal = $this->request->getPost('tanggal_awal');
        $tanggal_akhir = $this->request->getPost('tanggal_akhir');
        $jenis_laporan = $this->request->getPost('jenis_laporan');
        $this->db = \config\Database::connect();
        if ($jenis_laporan == 1) {
            $query_cekuser = $this->db->query("SELECT * FROM `tbl_riwayat_transaksi` WHERE NOT total_bayar =''AND waktu BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
            $transaksi = $query_cekuser->getResult();
            $data = [
                'tampildata' => $transaksi,

            ];
            return view('Page/Laporan/Transaksi', $data);
        } elseif ($jenis_laporan == 2) {
            $query_cekuser = $this->db->query("SELECT * FROM `tbl_rekam_medis` WHERE  icd9 IS NOT NULL AND waktu BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
            $transaksi = $query_cekuser->getResult();
            $data = [
                'tampildata' => $transaksi,

            ];
            return view('Page/Laporan/Rm', $data);
        } elseif ($jenis_laporan == 3) {
            $query_cekuser = $this->db->query("SELECT * FROM `tbl_obat_keluar` WHERE  tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
            $transaksi = $query_cekuser->getResult();
            $data = [
                'tampildata' => $transaksi,

            ];
            return view('Page/Laporan/Keluar', $data);
        } elseif ($jenis_laporan == 4) {
            $query_cekuser = $this->db->query("SELECT * FROM `tbl_obat_masuk` WHERE  tanggal_masuk BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
            $transaksi = $query_cekuser->getResult();
            $data = [
                'tampildata' => $transaksi,

            ];
            return view('Page/Laporan/Masuk', $data);
        } elseif ($jenis_laporan == 5) {
            $query_cekuser = $this->db->query("SELECT *, COUNT(icd10) AS jum FROM tbl_rekam_medis WHERE icd10 IS NOT NULL AND waktu BETWEEN '$tanggal_awal' AND '$tanggal_akhir' GROUP BY icd10 ORDER BY COUNT(icd10) DESC LIMIT 0,10 ");
            $transaksi = $query_cekuser->getResult();
            $data = [
                'tampildata' => $transaksi,

            ];
            return view('Page/Laporan/ICD10', $data);
        } else {
            echo "data tidak ada";
        }
    }
    public function pasien()
    {

        $this->db = \config\Database::connect();
        $query_cekuser = $this->db->query("SELECT * FROM `tbl_pasien`");
        $transaksi = $query_cekuser->getResult();
        $data = [
            'tampildata' => $transaksi,

        ];
        return view('Page/Laporan/Pasien', $data);
    }

    public function obat()
    {
        $this->db = \config\Database::connect();
        $query_cekuser = $this->db->query("SELECT * FROM `tbl_obat`");
        $transaksi = $query_cekuser->getResult();
        $data = [
            'tampildata' => $transaksi,

        ];
        return view('Page/Laporan/Obat', $data);
    }
}
