<?php

namespace App\Controllers\back;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\Modeldatakode;


class Kode extends BaseController
{


    public function index()
    {
        $data = [
            'title' => 'KLINIK DOKTER YANTI | PENGKODEAN REKAM MEDIS',
            'page' => 'PENGKODEAN REKAM MEDIS'
        ];
        return view('Page/Kode/Viewdata', $data);
    }
    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'tampildata' => $this->Rm->findAll()
            ];
            $msg = [
                'data' => view('Page/Kode/Data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Data Tidak di Temukan');
        }
    }

    public function listdata()
    {
        $request = Services::request();
        $datamodel = new Modeldatakode($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                $kg = "Kg";
                $cm = "Cm";
                $tomboledit = "<button type=\"button\" title=\"Proses \" class=\"btn btn-warning btn-sm\" onclick=\"edit('" . $list->id_rm .
                    "')\"><i class=\"mdi mdi-sync\"></i></button>";
                $row[] = $no;
                $row[] = $list->nama_pasien;
                $row[] = $list->nama_layanan;
                $row[] = $list->no_rm;
                $row[] = $list->anamnesa;
                $row[] = $list->tindakan;
                $row[] = $list->diagnosa;
                $row[] = $list->waktu;
                $row[] = $list->keterangan;
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
            $id_rm = $this->request->getVar('id_rm');
            $row = $this->Rm->find($id_rm);
            $pasien = $row['pasien'];
            $layanan = $row['layanan'];
            $lay = $this->Layanan->find($layanan);
            $pas = $this->Pasien->find($pasien);
            $data = [
                'id_rm' => $id_rm,
                'id_pasien' => $pas['id_pasien'],
                'nama_pasien' => $pas['nama_pasien'],
                'nama_layanan' => $lay['nama_layanan'],
                'keterangan' => $row['keterangan'],
            ];
            $msg = [
                'sukses' => view('Page/Kode/modaledit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $valid = $this->validate([

                'icd9' => [
                    'label' => 'ICD9',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'icd10' => [
                    'label' => 'ICD10',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],


            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'icd9' => $validation->getError('icd9'),
                        'icd10' => $validation->getError('icd10'),

                    ]
                ];
            } else {
                $id = $this->request->getVar('id');
                $update = [
                    'icd9' => $this->request->getVar('icd9'),
                    'icd10' => $this->request->getVar('icd10'),
                ];
                $this->Rm->update($id, $update);
                $msg = [
                    'sukses' => "Data Berhasil Disimpan"
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf Data Tidak di Temukan');
        }
    }
}