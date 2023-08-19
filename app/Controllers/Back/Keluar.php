<?php

namespace App\Controllers\back;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\Modeldatakeluar;

class Keluar extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'KLINIK DOKTER YANTI | DATA OBAT KELUAR',
            'page' => 'OBAT KELUAR'
        ];
        return view('Page/Keluar/Viewdata', $data);
    }
    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'tampildata' => $this->Keluar->findAll()
            ];
            $msg = [
                'data' => view('Page/Keluar/Data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Data Tidak di Temukan');
        }
    }
    public function listdata()
    {
        $request = Services::request();
        $datamodel = new Modeldatakeluar($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {

                if ($list->jenis_keluar == 'Berobat') {
                    $status = "<p class=\"on\">Berobat</p>";
                } else {
                    $status = "<p class=\"off\">Terjual</p>";
                }
                $no++;
                $row = [];
                $tomboledit = "<button type=\"button\" title=\"Edit \" class=\"btn btn-info btn-sm\" onclick=\"edit('" . $list->id_obat_keluar .
                    "')\"><i class=\"mdi mdi-transcribe\"></i></button>";
                $tombolhapus = " <button type=\"button\"title=\"Hapus \" class=\"btn btn-danger btn-sm\" onclick=\"hapus('" . $list->id_obat_keluar .
                    "')\"><i class=\"fa fa-trash\"></i></button>";
                $row[] = $no;
                $row[] = $list->nama_obat;
                $row[] = $list->kode_obat;
                $row[] = $list->jumlah_keluar;
                $row[] = $status;
                $row[] = $list->tanggal_keluar;
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

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'sukses' => view('Page/Keluar/modaltambah')
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
                'obat' => [
                    'label' => 'Obat ',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],

                'jumlah_keluar' => [
                    'label' => 'Jumlah Obat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'tanggal_keluar' => [
                    'label' => 'Tanggal Keluar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'keterangan' => [
                    'label' => 'Keterangan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],




            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'obat' => $validation->getError('obat'),
                        'jumlah_keluar' => $validation->getError('jumlah_keluar'),
                        'tanggal_keluar' => $validation->getError('tanggal_keluar'),
                        'keterangan' => $validation->getError('keterangan'),

                    ]
                ];
            } else {



                $id = $this->request->getPost('obat');
                $db   = \Config\Database::connect();
                $obat = $db->query("SELECT * from tbl_obat WHERE id_obat ='$id'");
                $row = $obat->getRow();
                $jumlama = $row->jumlah_obat;
                $jumbaru = $this->request->getPost('jumlah_keluar');

                if ($jumlama - $jumbaru < 0) {
                    $msg = [
                        'error' => [
                            'jumlah_keluar' => 'Stok Obat Kurang',
                        ]
                    ];
                } else {
                    $jumlah = $jumlama - $jumbaru;
                    $update = [
                        'jumlah_obat' => $jumlah
                    ];
                    $this->Obat->update($id, $update);
                    $simpandata = [
                        'obat' => $this->request->getPost('obat'),
                        'jumlah_keluar' => $this->request->getPost('jumlah_keluar'),
                        'jenis_keluar' => 'Jual',
                        'tanggal_keluar' => $this->request->getPost('tanggal_keluar'),
                        'keterangan' => $this->request->getPost('keterangan'),


                    ];
                    $this->Keluar->insert($simpandata);
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


    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $id_obat_keluar = $this->request->getVar('id_obat_keluar');
            $row = $this->Keluar->find($id_obat_keluar);
            $obat = $row['obat'];
            $pas = $this->Obat->find($obat);
            $data = [

                'id_obat_keluar' => $row['id_obat_keluar'],
                'obat' => $row['obat'],
                'nama_obat' => $pas['nama_obat'],
                'jumlah_keluar' => $row['jumlah_keluar'],
                'tanggal_keluar' => $row['tanggal_keluar'],
                'keterangan' => $row['keterangan'],
            ];
            $msg = [
                'sukses' => view('Page/Keluar/modaledit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatedata()
    {

        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $valid = $this->validate([

                'jumlah_keluar' => [
                    'label' => 'Jumlah Obat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'tanggal_keluar' => [
                    'label' => 'Tanggal Keluar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],

                'keterangan' => [
                    'label' => 'Keterangan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [

                        'jumlah_keluar' => $validation->getError('jumlah_keluar'),
                        'tanggal_keluar' => $validation->getError('tanggal_keluar'),
                        'keterangan' => $validation->getError('keterangan'),
                    ]
                ];
            } else {


                $id = $this->request->getPost('obat');
                $id_obat_keluar  = $this->request->getPost('id');
                $db   = \Config\Database::connect();
                $obat = $db->query("SELECT * from tbl_obat WHERE id_obat ='$id'");
                $keluar = $db->query("SELECT * from tbl_obat_keluar WHERE id_obat_keluar ='$id_obat_keluar'");
                $raw = $keluar->getRow();
                $row = $obat->getRow();
                $jumkeluar = $raw->jumlah_keluar;
                $jumlama = $row->jumlah_obat;
                $jumbaru = $this->request->getPost('jumlah_keluar');

                if ($jumkeluar > $jumbaru) {
                    $tot = $jumkeluar - $jumbaru;
                    $jumlah = $tot + $jumlama;
                    $update = [
                        'jumlah_obat' => $jumlah
                    ];
                    $this->Obat->update($id, $update);
                    $simpandata = [
                        'jumlah_keluar' => $this->request->getPost('jumlah_keluar'),
                        'tanggal_keluar' => $this->request->getPost('tanggal_keluar'),
                        'keterangan' => $this->request->getPost('keterangan'),
                    ];
                    $this->Keluar->update($id_obat_keluar, $simpandata);
                    $msg = [
                        'sukses' => 'Data Obat Keluar berhasil di Update'
                    ];
                } elseif ($jumkeluar < $jumbaru) {
                    $tot = $jumbaru - $jumkeluar;
                    if ($jumlama - $tot < 0) {
                        $msg = [
                            'error' => [
                                'jumlah_keluar' => 'Stok Obat Kurang',
                            ]
                        ];
                    } else {
                        $jumlah = $jumlama - $tot;
                        $update = [
                            'jumlah_obat' => $jumlah
                        ];
                        $this->Obat->update($id, $update);
                        $simpandata = [
                            'jumlah_keluar' => $this->request->getPost('jumlah_keluar'),
                            'tanggal_keluar' => $this->request->getPost('tanggal_keluar'),
                            'keterangan' => $this->request->getPost('keterangan'),


                        ];
                        $this->Keluar->update($id_obat_keluar, $simpandata);
                        $msg = [
                            'sukses' => 'Data Obat Keluar berhasil di Update'
                        ];
                    }
                } else {
                    $simpandata = [
                        'tanggal_keluar' => $this->request->getPost('tanggal_keluar'),
                        'keterangan' => $this->request->getPost('keterangan'),


                    ];
                    $this->Keluar->update($id_obat_keluar, $simpandata);
                    $msg = [
                        'sukses' => 'Data Obat Keluar berhasil di Update'
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit('Maaf Data Tidak di Temukan');
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_obat_keluar');
            $db   = \Config\Database::connect();
            $keluar = $db->query("SELECT * from tbl_obat_keluar WHERE id_obat_keluar ='$id'");
            $row = $keluar->getRow();
            $obat = $row->obat;
            $cek_obat = $db->query("SELECT * from tbl_obat WHERE id_obat ='$obat'");
            $lama = $cek_obat->getRow();
            $jumlama = $lama->jumlah_obat;
            $jumkeluar = $row->jumlah_keluar;
            $jumlah = $jumlama + $jumkeluar;
            $update = [
                'jumlah_obat' => $jumlah
            ];
            $this->Obat->update($obat, $update);
            $this->Keluar->delete($id);
            $msg = [
                'sukses' => "Data Obat Keluar berhasil di hapus"
            ];
            echo json_encode($msg);
        } else {
            exit('maaf data tidak ditemukan');
        }
    }
}