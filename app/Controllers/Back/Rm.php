<?php

namespace App\Controllers\back;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\Modeldatarm;

class Rm extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'KLINIK DOKTER YANTI | DATA REKAM MEDIS',
            'page' => 'REKAM MEDIS'
        ];
        return view('Page/Rm/Viewdata', $data);
    }
    public function ambildata($id_pasien)
    {
        if ($this->request->isAJAX()) {

            $data = [
                'tampildata' => $this->Rm->findAll(),
                'id_pasien' => $id_pasien

            ];
            $msg = [
                'data' => view('Page/Rm/Data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Data Tidak di Temukan');
        }
    }
    public function listdata($id_pasien)
    {
        $request = Services::request();
        $datamodel = new Modeldatarm($request, $id_pasien);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                $kg = "Kg";
                $cm = "Cm";
                $row[] = $no;
                $row[] = $list->nama_user;
                $row[] = $list->nama_layanan;
                $row[] = $list->no_rm;
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

    public function formtambah($id_pasien)
    {
        if ($this->request->isAJAX()) {

            $row = $this->Pasien->find($id_pasien);
            $data = [
                'id_pasien' => $id_pasien,
                'nama_pasien' => $row['nama_pasien'],
            ];

            $msg = [
                'sukses' => view('Page/Rm/modaltambah', $data)
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
                'dokter' => [
                    'label' => 'Dokter',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'layanan' => [
                    'label' => 'Layanan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'tinggi_badan' => [
                    'label' => 'Tinggi Badan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'berat_badan' => [
                    'label' => 'Berat Badan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'tekanan_darah' => [
                    'label' => 'Tekanan Darah',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],

                'keluhan' => [
                    'label' => 'Anamnesa',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'waktu' => [
                    'label' => 'Waktu',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],


            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'dokter' => $validation->getError('dokter'),
                        'layanan' => $validation->getError('layanan'),
                        'no_rm' => $validation->getError('no_rm'),
                        'tinggi_badan' => $validation->getError('tinggi_badan'),
                        'berat_badan' => $validation->getError('berat_badan'),
                        'tekanan_darah' => $validation->getError('tekanan_darah'),

                        'keluhan' => $validation->getError('keluhan'),
                        'waktu' => $validation->getError('waktu'),
                    ]
                ];
            } else {
                $pasien = $this->request->getPost('id_pasien');
                $this->db = \config\Database::connect();
                $query_pasien = $this->db->query("SELECT * from tbl_pasien WHERE id_pasien ='$pasien'");
                $get = $query_pasien->getRow();
                $no_rm = $get->no_rm;
                $simpandata = [
                    'pasien' => $this->request->getPost('id_pasien'),
                    'dokter' => $this->request->getPost('dokter'),
                    'layanan' => $this->request->getPost('layanan'),
                    'no_rm' => $no_rm,
                    'tinggi_badan' => $this->request->getPost('tinggi_badan'),
                    'berat_badan' => $this->request->getPost('berat_badan'),
                    'tekanan_darah' => $this->request->getPost('tekanan_darah'),

                    'anamnesa' => $this->request->getPost('keluhan'),
                    'waktu' => $this->request->getPost('waktu'),
                    'keterangan' => $this->request->getPost('keterangan'),
                ];
                $this->Rm->insert($simpandata);
                $simpan = [
                    'pasien' => $this->request->getPost('id_pasien'),
                    'layanan' => $this->request->getPost('layanan'),
                    'tanggal' => $this->request->getPost('waktu')
                ];
                $this->Kunjungan->insert($simpan);
                $msg = [
                    'sukses' => 'Data Rekam Medis Berhasil Ditambahkan...'
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
            $id_pasien = $this->request->getVar('id_pasien');
            $row = $this->Pasien->find($id_pasien);
            $data = [
                'id_pasien' => $row['id_pasien'],
                'nama_pasien' => $row['nama_pasien'],
                'jk_pasien' => $row['jk_pasien'],

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

                        'alamat_pasien' => $validation->getError('alamat_pasien'),

                    ]
                ];
            } else {

                $simpandata = [
                    'nama_pasien' => $this->request->getPost('nama_pasien'),
                    'jk_pasien' => $this->request->getPost('jk_pasien'),

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

            'alamat_pasien' => $row['alamat_pasien'],
            'title' => 'KLINIK DOKTER YANTI | DETAIL DATA PASIEN',
            'page' => 'DETAIL DATA'
        ];

        return view('Page/Pasien/Detail', $data);
    }
}
