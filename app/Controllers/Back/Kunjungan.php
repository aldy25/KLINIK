<?php

namespace App\Controllers\back;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\Modeldatakunjungan;

class Kunjungan extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'KLINIK DOKTER YANTI | DATA KUNJUNGAN',
            'page' => 'LAYANAN'
        ];
        return view('Page/Kunjungan/Viewdata', $data);
    }
    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'tampildata' => $this->Kunjungan->findAll()

            ];
            $msg = [
                'data' => view('Page/Kunjungan/Data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Data Tidak di Temukan');
        }
    }
    public function listdata()
    {
        $request = Services::request();
        $datamodel = new Modeldatakunjungan($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                $tombolhapus = " <button type=\"button\" title=\"Hapus \"class=\"btn btn-danger btn-sm\" onclick=\"hapus('" . $list->id_kunjungan .
                    "')\"><i class=\"fa fa-trash\"></i></button>";
                $row[] = $no;
                $row[] = $list->nama_pasien;
                $row[] = $list->nama_layanan;
                $row[] = $list->tanggal;
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





    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_kunjungan');
            $this->Kunjungan->delete($id);
            $msg = [
                'sukses' => "Data Kunjungan Pasien berhasil di hapus"
            ];
            echo json_encode($msg);
        } else {
            exit('maaf data tidak ditemukan');
        }
    }
}