<?php

namespace App\Controllers\back;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\Modeldatalayanan;

class Layanan extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'KLINIK DOKTER YANTI | DATA DAFTAR LAYANAN',
            'page' => 'LAYANAN'
        ];
        return view('Page/Layanan/Viewdata', $data);
    }
    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'tampildata' => $this->Layanan->findAll()

            ];
            $msg = [
                'data' => view('Page/Layanan/Data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Data Tidak di Temukan');
        }
    }
    public function listdata()
    {
        $request = Services::request();
        $datamodel = new Modeldatalayanan($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $tomboledit = "<button type=\"button\" title=\"Edit \" class=\"btn btn-info btn-sm\" onclick=\"edit('" . $list->id_layanan .
                    "')\"><i class=\"mdi mdi-transcribe\"></i></button>";
                $tombolhapus = " <button type=\"button\" title=\"Hapus \"class=\"btn btn-danger btn-sm\" onclick=\"hapus('" . $list->id_layanan .
                    "')\"><i class=\"fa fa-trash\"></i></button>";
                $rp = "Rp";
                $row[] = $no;
                $row[] = $list->nama_layanan;

                $row[] = $rp . " " . number_format($list->harga);

                $row[] = $tomboledit . ' ' . $tombolhapus;
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
                'data' => view('Page/Layanan/modaltambah')
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
                'nama_layanan' => [
                    'label' => 'Nama Layanan ',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'harga' => [
                    'label' => 'Harga ',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_layanan' => $validation->getError('nama_layanan'),
                        'harga' => $validation->getError('harga'),
                    ]
                ];
            } else {
                $this->db = \config\Database::connect();

                $simpandata = [
                    'nama_layanan' => $this->request->getPost('nama_layanan'),
                    'harga' => $this->request->getPost('harga'),
                ];
                $this->Layanan->insert($simpandata);
                $msg = [
                    'sukses' => 'Data Layanan Baru Berhasil di Tambahkan'
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
            $id_layanan = $this->request->getVar('id_layanan');
            $row = $this->Layanan->find($id_layanan);


            $data = [

                'id_layanan' => $row['id_layanan'],



                'nama_layanan' => $row['nama_layanan'],

                'harga' => $row['harga'],

            ];
            $msg = [
                'sukses' => view('Page/Layanan/modaledit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatedata()
    {

        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $valid = $this->validate([



                'nama_layanan' => [
                    'label' => 'Nama Layanan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],

                'harga' => [
                    'label' => 'Harga',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],


            ]);
            if (!$valid) {
                $msg = [
                    'error' => [

                        'nama_layanan' => $validation->getError('nama_layanan'),
                        'harga' => $validation->getError('harga'),


                    ]
                ];
            } else {

                $simpandata = [

                    'nama_layanan' => $this->request->getPost('nama_layanan'),
                    'harga' => $this->request->getPost('harga'),




                ];



                $id =  $this->request->getPost('id');


                $this->Layanan->update($id, $simpandata);

                $msg = [
                    'sukses' => 'Data Daftar Layanan berhasil di Update'
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
            $id = $this->request->getVar('id_layanan');
            $this->Layanan->delete($id);
            $msg = [
                'sukses' => "Data Layanan berhasil di hapus"
            ];
            echo json_encode($msg);
        } else {
            exit('maaf data tidak ditemukan');
        }
    }
}