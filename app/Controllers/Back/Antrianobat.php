<?php

namespace App\Controllers\back;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\Modeldataantrianobat;

class Antrianobat extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'KLINIK DOKTER YANTI | DATA ANTRIAN OBAT',
            'page' => 'ANTRIAN OBAT'
        ];
        return view('Page/Antrianoabat/Viewdata', $data);
    }
    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'tampildata' => $this->Riwayat->findAll()
            ];
            $msg = [
                'data' => view('Page/Antrianoabat/Data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Data Tidak di Temukan');
        }
    }
    public function listdata()
    {
        $request = Services::request();
        $datamodel = new Modeldataantrianobat($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $tomboledit = "<button type=\"button\" title=\"Proses \" class=\"btn btn-warning btn-sm\" onclick=\"edit('" . $list->id_riwayat .
                    "')\"><i class=\"mdi mdi-sync\"></i></button>";
                $row[] = $no;
                $row[] = $list->nama_pasien;
                $row[] = $list->nama_layanan;
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

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('Page/Pasien/modaltambah')
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Data Tidak di Temukan');
        }
    }

    public function simpandata()
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
                $this->Pasien->insert($simpandata);
                $msg = [
                    'sukses' => 'Data Pasien Berhasil di Tambahkan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf Data Tidak di Temukan');
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
            $data = [
                'id_riwayat' => $id_riwayat,
                'nama_pasien' => $datapasien['nama_pasien'],
                'nama_layanan' => $datalayanan['nama_layanan'],
                'total_harga' => $row['total_harga'],
                'keterangan' => $row['keterangan'],
            ];
            $msg = [
                'sukses' => view('Page/Antrianoabat/modaledit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatedata()
    {

        if ($this->request->isAJAX()) {



            $id = $this->request->getVar('id');
            $transaksi = [
                'status' => '2',

            ];
            $this->Riwayat->update($id, $transaksi);
            $msg = [
                'sukses' => "Resep Obat Berhasil Dikonfirmasi"
            ];

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
