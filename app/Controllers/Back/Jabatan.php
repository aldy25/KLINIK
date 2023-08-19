<?php

namespace App\Controllers\back;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\Modeldatajabatan;

class Jabatan extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'KLINIK DOKTER YANTI | DATA JABATAN',
            'page' => 'JABATAN'
        ];
        return view('Page/Jabatan/Viewdata', $data);
    }
    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'tampildata' => $this->Jabatan->findAll()

            ];
            $msg = [
                'data' => view('Page/Jabatan/Data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Data Tidak di Temukan');
        }
    }
    public function listdata()
    {
        $request = Services::request();
        $datamodel = new Modeldatajabatan($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $tomboledit = "<button type=\"button\" title=\"Edit \" class=\"btn btn-info btn-sm\" onclick=\"edit('" . $list->id_jabatan .
                    "')\"><i class=\"mdi mdi-transcribe\"></i></button>";
                $tombolhapus = " <button type=\"button\" title=\"Hapus \"class=\"btn btn-danger btn-sm\" onclick=\"hapus('" . $list->id_jabatan .
                    "')\"><i class=\"fa fa-trash\"></i></button>";
                $rp = "Rp";
                $row[] = $no;
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
                'data' => view('Page/Jabatan/modaltambah')
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
                'nama_jabatan' => [
                    'label' => 'Nama Jabatan ',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_jabatan' => $validation->getError('nama_jabatan'),

                    ]
                ];
            } else {


                $simpandata = [
                    'nama_jabatan' => $this->request->getPost('nama_jabatan'),

                ];
                $this->Jabatan->insert($simpandata);
                $msg = [
                    'sukses' => 'Data Jabatan Baru Berhasil di Tambahkan'
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
            $id_jabatan  = $this->request->getVar('id_jabatan');
            $row = $this->Jabatan->find($id_jabatan);
            $data = [
                'id_jabatan' => $row['id_jabatan'],
                'nama_jabatan' => $row['nama_jabatan'],
            ];
            $msg = [
                'sukses' => view('Page/Jabatan/modaledit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatedata()
    {

        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $valid = $this->validate([



                'nama_jabatan' => [
                    'label' => 'Nama Jabatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],



            ]);
            if (!$valid) {
                $msg = [
                    'error' => [

                        'nama_jabatan' => $validation->getError('nama_jabatan'),



                    ]
                ];
            } else {

                $simpandata = [

                    'nama_jabatan' => $this->request->getPost('nama_jabatan'),





                ];



                $id =  $this->request->getPost('id');


                $this->Jabatan->update($id, $simpandata);

                $msg = [
                    'sukses' => 'Data Jabatan berhasil di Update'
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
            $id = $this->request->getVar('id_jabatan');
            $this->Jabatan->delete($id);
            $msg = [
                'sukses' => "Data Jabatan berhasil di hapus"
            ];
            echo json_encode($msg);
        } else {
            exit('maaf data tidak ditemukan');
        }
    }
}