<?php

namespace App\Controllers\back;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\Modeldatamasuk;

class Masuk extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'KLINIK DOKTER YANTI | DATA OBAT MASUK',
            'page' => 'OBAT MASUK'
        ];
        return view('Page/Masuk/Viewdata', $data);
    }
    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'tampildata' => $this->Masuk->findAll()
            ];
            $msg = [
                'data' => view('Page/Masuk/Data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Data Tidak di Temukan');
        }
    }
    public function listdata()
    {
        $request = Services::request();
        $datamodel = new Modeldatamasuk($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {


                $no++;
                $row = [];
                $RP = "Rp";

                $row[] = $no;
                $row[] = $list->nama_obat;
                $row[] = $list->kode_obat;
                $row[] = $list->jumlah_obat;
                $row[] = $list->satuan;
                $row[] = $RP . " " . number_format($list->harga_satuan);
                $row[] = $list->tanggal_exp;
                $row[] = $list->sumber;
                $row[] = $list->tanggal_masuk;
                $row[] = $list->keterangan;
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
                'sukses' => view('Page/Masuk/modaltambah')
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
                'nama_obat' => [
                    'label' => 'nama obat ',
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
                'satuan' => [
                    'label' => 'satuan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'tanggal_exp' => [
                    'label' => 'tanggal exp',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'sumber' => [
                    'label' => 'sumber distribusi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'tanggal_masuk' => [
                    'label' => 'tanggal_masuk',
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
                        'tanggal_exp' => $validation->getError('tanggal_exp'),
                        'tanggal_masuk' => $validation->getError('tanggal_masuk'),
                        'keterangan' => $validation->getError('keterangan'),
                        'sumber' => $validation->getError('sumber'),
                    ]
                ];
            } else {



                $kode = $this->request->getPost('kode_obat');
                $db   = \Config\Database::connect();
                $obat = $db->query("SELECT * from tbl_obat WHERE kode_obat ='$kode'");
                $data = $obat->getResult();

                if (count($data) > 0) {
                    $row = $obat->getRow();
                    $id = $row->id_obat;
                    $jumlama = $row->jumlah_obat;
                    $jumbaru = $this->request->getPost('jumlah_obat');
                    $jumlah = $jumbaru + $jumlama;
                    $update = [
                        'jumlah_obat' => $jumlah
                    ];
                    $this->Obat->update($id, $update);
                    $simpandata = [
                        'nama_obat' => $this->request->getPost('nama_obat'),
                        'kode_obat' => $this->request->getPost('kode_obat'),
                        'jumlah_obat' => $this->request->getPost('jumlah_obat'),
                        'harga_satuan' => $this->request->getPost('harga_satuan'),
                        'satuan' => $this->request->getPost('satuan'),
                        'tanggal_exp' => $this->request->getPost('tanggal_exp'),
                        'sumber' => $this->request->getPost('sumber'),
                        'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
                        'keterangan' => $this->request->getPost('keterangan'),


                    ];
                    $this->Masuk->insert($simpandata);
                    $msg = [
                        'sukses' => 'Data Berhasil di Tambahkan'
                    ];
                } else {
                    $simpandata = [
                        'nama_obat' => $this->request->getPost('nama_obat'),
                        'kode_obat' => $this->request->getPost('kode_obat'),
                        'jumlah_obat' => $this->request->getPost('jumlah_obat'),
                        'harga_satuan' => $this->request->getPost('harga_satuan'),
                        'satuan' => $this->request->getPost('satuan'),
                        'tanggal_exp' => $this->request->getPost('tanggal_exp'),
                        'sumber' => $this->request->getPost('sumber'),
                        'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
                        'keterangan' => $this->request->getPost('keterangan'),


                    ];
                    $this->Masuk->insert($simpandata);

                    $update = [
                        'nama_obat' => $this->request->getPost('nama_obat'),
                        'kode_obat' => $this->request->getPost('kode_obat'),
                        'jumlah_obat' => $this->request->getPost('jumlah_obat'),
                        'harga_satuan' => $this->request->getPost('harga_satuan'),
                        'satuan' => $this->request->getPost('satuan'),
                        'keterangan' => $this->request->getPost('keterangan'),
                    ];
                    $this->Obat->insert($update);
                    $msg = [
                        'sukses' => 'Data Berhasil di Tambahkan'
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit('Maaf Data Tidak di Temukan');
        }
    }
}