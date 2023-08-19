<?php

namespace App\Controllers\back;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\Modeldatapegawai;

class Pegawai extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'KLINIK DOKTER YANTI | DATA PEGAWAI',
            'page' => 'LAYANAN'
        ];
        return view('Page/Pegawai/Viewdata', $data);
    }
    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'tampildata' => $this->Pegawai->findAll()

            ];
            $msg = [
                'data' => view('Page/Pegawai/Data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Data Tidak di Temukan');
        }
    }
    public function listdata()
    {
        $request = Services::request();
        $datamodel = new Modeldatapegawai($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $tomboledit = "<button type=\"button\" title=\"Edit \" class=\"btn btn-info btn-sm\" onclick=\"edit('" . $list->id_pegawai .
                    "')\"><i class=\"mdi mdi-transcribe\"></i></button>";
                $tombolhapus = " <button type=\"button\" title=\"Hapus \"class=\"btn btn-danger btn-sm\" onclick=\"hapus('" . $list->id_pegawai  .
                    "')\"><i class=\"fa fa-trash\"></i></button>";

                $row[] = $no;
                $row[] = $list->nama_pegawai;
                $row[] = $list->no_hp;
                $row[] = $list->email;
                $row[] = $list->alamat;
                $row[] = $list->nama_jabatan;
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
                'data' => view('Page/Pegawai/modaltambah')
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
                'nama_pegawai' => [
                    'label' => 'Nama Pegawai ',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'no_hp' => [
                    'label' => 'No HP ',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'email' => [
                    'label' => 'Email ',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'alamat' => [
                    'label' => 'Alamat ',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'jabatan' => [
                    'label' => 'Jabatan ',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_pegawai' => $validation->getError('nama_pegawai'),
                        'no_hp' => $validation->getError('no_hp'),
                        'email' => $validation->getError('email'),
                        'alamat' => $validation->getError('alamat'),
                        'jabatan ' => $validation->getError('jabatan '),
                    ]
                ];
            } else {
                $simpandata = [
                    'nama_pegawai' => $this->request->getPost('nama_pegawai'),
                    'no_hp' => $this->request->getPost('no_hp'),
                    'email' => $this->request->getPost('email'),
                    'alamat' => $this->request->getPost('alamat'),
                    'jabatan' => $this->request->getPost('jabatan'),
                ];
                $this->Pegawai->insert($simpandata);
                $msg = [
                    'sukses' => 'Data Pegawai Baru Berhasil di Tambahkan'
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