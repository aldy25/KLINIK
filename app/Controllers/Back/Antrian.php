<?php

namespace App\Controllers\back;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\Modeldataantrian;

class Antrian extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'KLINIK DOKTER YANTI | ANTRIAN TRANSAKSI',
            'page' => 'ANTRIAN TRANSAKSI'
        ];
        return view('Page/Antrian/Viewdata', $data);
    }
    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'tampildata' => $this->Riwayat->findAll()
            ];
            $msg = [
                'data' => view('Page/Antrian/Data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Data Tidak di Temukan');
        }
    }
    public function listdata()
    {
        $request = Services::request();
        $datamodel = new Modeldataantrian($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $rp = 'Rp';
                $no++;
                $row = [];
                $tomboledit = "<button type=\"button\" title=\"Proses \" class=\"btn btn-warning btn-sm\" onclick=\"edit('" . $list->id_riwayat .
                    "')\"><i class=\"mdi mdi-sync\"></i></button>";
                $row[] = $no;
                $row[] = $list->nama_pasien;
                $row[] = $list->nama_layanan;
                $row[] = $rp . ' ' . number_format($list->total_harga);
                $row[] = $tomboledit;
                $data[] = $row;
            }
            $output = [
                "draw" => $request->getPost('draw'),
                "recordsTotal" => $datamodel->count_all(),
                "recordsFiltered" => $datamodel->count_filtered(),
                "data" => $data
            ];
            echo json_encode($output);
        }
    }




    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $id_riwayat = $this->request->getVar('id_riwayat');
            $row = $this->Riwayat->find($id_riwayat);
            $layanan = $row['layanan'];
            $pasien = $row['pasien'];
            $datalayanan = $this->Layanan->find($layanan);
            $datapasien = $this->Pasien->find($pasien);
            if ($layanan == 1) {
                $data = [
                    'id_riwayat' => $id_riwayat,
                    'nama_pasien' => $datapasien['nama_pasien'],
                    'nama_layanan' => $datalayanan['nama_layanan'],
                    'total_harga' => $row['total_harga'],
                    'keterangan' => $row['keterangan'],
                ];
                $msg = [
                    'sukses' => view('Page/Antrian/modaleditrm', $data)
                ];
            } else {
                $data = [
                    'id_riwayat' => $id_riwayat,
                    'nama_pasien' => $datapasien['nama_pasien'],
                    'nama_layanan' => $datalayanan['nama_layanan'],
                    'total_harga' => $row['total_harga'],
                    'keterangan' => $row['keterangan'],
                ];
                $msg = [
                    'sukses' => view('Page/Antrian/modaledit', $data)
                ];
            }
            echo json_encode($msg);
        }
    }

    public function updatedata()
    {

        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $valid = $this->validate([

                'biaya_lainya' => [
                    'label' => 'Biaya Lainya',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'total_bayar' => [
                    'label' => 'total bayar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'keterangan' => [
                    'label' => 'keterangan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'biaya_lainya' => $validation->getError('biaya_lainya'),
                        'total_bayar' => $validation->getError('total_bayar'),
                        'keterangan' => $validation->getError('keterangan'),
                    ]
                ];
            } else {


                $id = $this->request->getVar('id');
                $session = \config\services::session();
                $id_user = $session->get('id_user');
                $transaksi = [
                    'kasir' => $id_user,
                    'biaya_lainya' => $this->request->getVar('biaya_lainya'),
                    'total_harga' =>  $this->request->getVar('total_harga'),
                    'total_bayar' =>  $this->request->getVar('total_bayar'),
                    'kembalian' => $this->request->getVar('kembalian'),
                    'keterangan' => $this->request->getVar('keterangan')
                ];
                $this->Riwayat->update($id, $transaksi);
                $msg = [
                    'sukses' => "Transaksi Berhasil Di Proses"
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf Data Tidak di Temukan');
        }
    }
    public function updatedataa()
    {

        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $valid = $this->validate([

                'biaya_lainya' => [
                    'label' => 'Biaya Lainya',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'total_bayar' => [
                    'label' => 'total bayar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'keterangan' => [
                    'label' => 'keterangan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'biaya_lainya' => $validation->getError('biaya_lainya'),
                        'total_bayar' => $validation->getError('total_bayar'),
                        'keterangan' => $validation->getError('keterangan'),
                    ]
                ];
            } else {


                $id = $this->request->getVar('id');
                $session = \config\services::session();


                $id_user = $session->get('id_user');
                $transaksi = [
                    'kasir' => $id_user,
                    'biaya_lainya' => $this->request->getVar('biaya_lainya'),
                    'total_harga' =>  $this->request->getVar('total_harga'),
                    'total_bayar' =>  $this->request->getVar('total_bayar'),
                    'kembalian' => $this->request->getVar('kembalian'),
                    'keterangan' => $this->request->getVar('keterangan')
                ];
                $this->Riwayat->update($id, $transaksi);
                $msg = [
                    'sukses' => "Transaksi Berhasil Di Proses"
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf Data Tidak di Temukan');
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_obat_keluar');
            $db   = \Config\Database::connect();
            $keluar = $db->query("SELECT * from tbl_obat_keluar WHERE id_obat_keluar ='$id'");
            $row = $keluar->getRow();
            $obat = $row->obat;
            $cek_obat = $db->query("SELECT * from tbl_obat WHERE id_obat ='$obat'");
            $lama = $cek_obat->getRow();
            $jumlama = $lama->jumlah_obat;
            $jumkeluar = $row->jumlah_keluar;
            $jumlah = $jumlama + $jumkeluar;
            $update = [
                'jumlah_obat' => $jumlah
            ];
            $this->Obat->update($obat, $update);
            $this->Keluar->delete($id);
            $msg = [
                'sukses' => "Data Obat Keluar berhasil di hapus"
            ];
            echo json_encode($msg);
        } else {
            exit('maaf data tidak ditemukan');
        }
    }
}
