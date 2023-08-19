<?php

namespace App\Controllers\back;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\Modeldatarekam;

class Datarm extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'KLINIK DOKTER YANTI | DATA REKAM MEDIS',
            'page' => 'REKAM MEDIS'
        ];
        return view('Page/Datarm/Viewdata', $data);
    }
    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'tampildata' => $this->Rm->findAll()

            ];
            $msg = [
                'data' => view('Page/Datarm/Data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Data Tidak di Temukan');
        }
    }
    public function listdata()
    {
        $request = Services::request();
        $datamodel = new Modeldatarekam($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $tombolhapus = " <button type=\"button\" title=\"Hapus \"class=\"btn btn-danger btn-sm\" onclick=\"hapus('" . $list->id_rm .
                    "')\"><i class=\"fa fa-trash\"></i></button>";
                $no++;
                $row = [];

                $kg = "Kg";
                $cm = "Cm";
                $row[] = $no;
                $row[] = $list->no_rm;
                $row[] = $list->nama_pasien;
                $row[] = $list->nama_user;
                $row[] = $list->nama_layanan;
                $row[] = $list->tinggi_badan . " " . $cm;
                $row[] = $list->berat_badan . " " . $kg;
                $row[] = $list->tekanan_darah;

                $row[] = $list->anamnesa;
                $row[] = $list->deskripsi;
                $row[] = $list->diagnosa;
                $row[] = $list->terapi;
                $row[] = $list->edukasi;
                $row[] = $list->rujukan;
                $row[] = $list->waktu;
                $row[] = $list->keterangan;
                $row[] = $tombolhapus;
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
                'tanggal_lahir' => $row['tanggal_lahir'],
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
                'tanggal_lahir' => [
                    'label' => 'Tanggal Lahir',
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
                        'tanggal_lahir' => $validation->getError('tanggal_lahir'),
                        'alamat_pasien' => $validation->getError('alamat_pasien'),

                    ]
                ];
            } else {

                $simpandata = [
                    'nama_pasien' => $this->request->getPost('nama_pasien'),
                    'jk_pasien' => $this->request->getPost('jk_pasien'),
                    'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
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
            $id = $this->request->getVar('id_rm');
            $this->Rm->delete($id);
            $msg = [
                'sukses' => "Data berhasil di hapus"
            ];
            echo json_encode($msg);
        } else {
            exit('maaf data tidak ditemukan');
        }
    }
}
