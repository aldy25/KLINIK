<?php

namespace App\Controllers\back;

use App\Controllers\BaseController;
use App\Models\Modeldataobat;
use Config\Services;


class Obat extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'KLINIK DOKTER YANTI | DATA STOCK OBAT',
            'page' => 'OPERASI'
        ];
        return view('Page/Obat/Viewdata', $data);
    }
    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'tampildata' => $this->Obat->findAll()
            ];
            $msg = [
                'data' => view('Page/Obat/Data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Data Tidak di Temukan');
        }
    }
    public function listdata()
    {
        $request = Services::request();
        $datamodel = new Modeldataobat($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $rp = 'Rp';
                $tomboledit = "<button type=\"button\"title=\"Edit \" class=\"btn btn-info btn-sm\" onclick=\"edit('" . $list->id_obat    .
                    "')\"><i class=\"mdi mdi-transcribe\"></i></button>";
                $tombolhapus = " <button type=\"button\"title=\"Hapus \" class=\"btn btn-danger btn-sm\" onclick=\"hapus('" . $list->id_obat    .
                    "')\"><i class=\"fa fa-trash\"></i></button>";
                $row[] = $no;
                $row[] = $list->nama_obat;
                $row[] = $list->kode_obat;

                $row[] = $list->jumlah_obat;
                $row[] = $list->satuan;

                $row[] = $rp . " " . number_format($list->harga_satuan);
                $row[] = $list->keterangan;
                $row[] = $tomboledit . " " . $tombolhapus;
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
            $id_obat = $this->request->getVar('id_obat');
            $row = $this->Obat->find($id_obat);
            $data = [

                'id_obat' => $row['id_obat'],
                'nama_obat' => $row['nama_obat'],
                'kode_obat' => $row['kode_obat'],
                'jumlah_obat' => $row['jumlah_obat'],
                'harga_satuan' => $row['harga_satuan'],
                'satuan' => $row['satuan'],
                'keterangan' => $row['keterangan'],

            ];
            $msg = [
                'sukses' => view('Page/Obat/modaledit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatedata()
    {

        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $valid = $this->validate([

                'nama_obat' => [
                    'label' => 'nama obat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'kode_obat' => [
                    'label' => 'kode obat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],

                'jumlah_obat' => [
                    'label' => 'jumlah obat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],

                'harga_satuan' => [
                    'label' => 'harga satuan',
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

                        'nama_obat' => $validation->getError('nama_obat'),
                        'kode_obat' => $validation->getError('kode_obat'),

                        'jumlah_obat' => $validation->getError('jumlah_obat'),

                        'harga_satuan' => $validation->getError('harga_satuan'),
                        'satuan' => $validation->getError('satuan'),
                        'keterangan' => $validation->getError('keterangan'),

                    ]
                ];
            } else {

                $simpandata = [
                    'nama_obat' => $this->request->getPost('nama_obat'),
                    'kode_obat' => $this->request->getPost('kode_obat'),
                    'jumlah_obat' => $this->request->getPost('jumlah_obat'),
                    'harga_satuan' => $this->request->getPost('harga_satuan'),
                    'keterangan' => $this->request->getPost('keterangan')
                ];
                $id =  $this->request->getPost('id');
                $this->Obat->update($id, $simpandata);

                $msg = [
                    'sukses' => 'Data Obat berhasil di Update'
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
            $id = $this->request->getVar('id_obat');
            $this->Obat->delete($id);
            $msg = [
                'sukses' => "Data berhasil di hapus"
            ];
            echo json_encode($msg);
        } else {
            exit('maaf data tidak ditemukan');
        }
    }
}