<?php

namespace App\Controllers\back;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\Modeldatatransaksi;

class Transaksi extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'KLINIK DOKTER YANTI | DATA RIWAYAT TRANSAKSI',
            'page' => 'RIWAYAT TRANSAKSI'
        ];
        return view('Page/Riwayat/Viewdata', $data);
    }
    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'tampildata' => $this->Riwayat->findAll()
            ];
            $msg = [
                'data' => view('Page/Riwayat/Dataa', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Data Tidak di Temukan');
        }
    }
    public function listdata()
    {

        $request = Services::request();
        $datamodel = new Modeldatatransaksi($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {


                $no++;
                $row = [];
                $Rp = "Rp";
                $row[] = $no;
                $row[] = $list->nama_pasien;
                $row[] = $list->nama_layanan;
                $row[] = $list->nama_user;
                $row[] = $Rp . " " . $list->biaya_lainya;
                $row[] = $Rp . " " . $list->total_harga;
                $row[] = $Rp . " " . $list->total_bayar;
                $row[] = $Rp . " " . $list->kembalian;
                $row[] = $list->keterangan;
                $row[] = $list->waktu;
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
            $id_pasien = $this->request->getVar('id_pasien');
            $row = $this->Pasien->find($id_pasien);
            $data = [
                'id_pasien' => $row['id_pasien'],
                'nama_pasien' => $row['nama_pasien'],
                'jk_pasien' => $row['jk_pasien'],
                'umur_pasien' => $row['umur_pasien'],
                'alamat_pasien' => $row['alamat_pasien'],
            ];
            $msg = [
                'sukses' => view('Page/Pasien/modaledit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatedata()
    {

        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $valid = $this->validate([


                'nama_pasien' => [
                    'label' => 'Nama Pasien ',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'jk_pasien' => [
                    'label' => 'Jenis Kelamin ',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'umur_pasien' => [
                    'label' => 'Umur Pasien',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'alamat_pasien' => [
                    'label' => 'Alamat Pasien',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ]


            ]);
            if (!$valid) {
                $msg = [
                    'error' => [

                        'nama_pasien' => $validation->getError('nama_pasien'),
                        'jk_pasien' => $validation->getError('jk_pasien'),
                        'umur_pasien' => $validation->getError('umur_pasien'),
                        'alamat_pasien' => $validation->getError('alamat_pasien'),

                    ]
                ];
            } else {

                $simpandata = [
                    'nama_pasien' => $this->request->getPost('nama_pasien'),
                    'jk_pasien' => $this->request->getPost('jk_pasien'),
                    'umur_pasien' => $this->request->getPost('umur_pasien'),
                    'alamat_pasien' => $this->request->getPost('alamat_pasien'),
                ];


                $id =  $this->request->getPost('id');


                $this->Pasien->update($id, $simpandata);

                $msg = [
                    'sukses' => 'Data Pasien berhasil di Update'
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
            $id = $this->request->getVar('id_pasien');
            $this->Pasien->delete($id);
            $msg = [
                'sukses' => "Data Akun dengan id $id berhasil di hapus"
            ];
            echo json_encode($msg);
        } else {
            exit('maaf data tidak ditemukan');
        }
    }

    public function detail($id_pasien)
    {

        $row = $this->Pasien->find($id_pasien);
        $data = [
            'id_pasien' => $row['id_pasien'],
            'nama_pasien' => $row['nama_pasien'],
            'jk_pasien' => $row['jk_pasien'],
            'umur_pasien' => $row['umur_pasien'],
            'alamat_pasien' => $row['alamat_pasien'],
            'title' => 'KLINIK DOKTER YANTI | DETAIL DATA PASIEN',
            'page' => 'DETAIL DATA'
        ];

        return view('Page/Pasien/Detail', $data);
    }
}