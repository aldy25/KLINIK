<?php

namespace App\Controllers\back;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\Modeldataberobat;
use App\Models\Modeldataberobatt;

class Berobat extends BaseController
{

    public function indexx()
    {
        $data = [
            'title' => 'KLINIK DOKTER YANTI | ANTRIAN BEROBAT',
            'page' => 'ANTRIAN BEROBAT'
        ];
        return view('Page/Berobat/Viewdataa', $data);
    }
    public function index()
    {
        $data = [
            'title' => 'KLINIK DOKTER YANTI | ANTRIAN BEROBAT',
            'page' => 'ANTRIAN BEROBAT'
        ];
        return view('Page/Berobat/Viewdata', $data);
    }
    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'tampildata' => $this->Rm->findAll()
            ];
            $msg = [
                'data' => view('Page/Berobat/Data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Data Tidak di Temukan');
        }
    }
    public function ambildataa()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'tampildata' => $this->Rm->findAll()
            ];
            $msg = [
                'data' => view('Page/Berobat/Dataa', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Data Tidak di Temukan');
        }
    }
    public function listdata()
    {
        $request = Services::request();
        $datamodel = new Modeldataberobat($request);
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
                $row[] = $list->tinggi_badan . " " . $cm;
                $row[] = $list->berat_badan . " " . $kg;
                $row[] = $list->tekanan_darah;

                $row[] = $list->anamnesa;

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


    public function listdataa()
    {
        $request = Services::request();
        $datamodel = new Modeldataberobatt($request);
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
                $row[] = $list->tinggi_badan . " " . $cm;
                $row[] = $list->berat_badan . " " . $kg;
                $row[] = $list->tekanan_darah;

                $row[] = $list->anamnesa;
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
                'sukses' => view('Page/Berobat/modaledit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatedata()
    {

        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $valid = $this->validate([

                'tindakan' => [
                    'label' => 'Tindakan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'diagnosa' => [
                    'label' => 'Diagnosa',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'terapi' => [
                    'label' => 'terapi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'edukasi' => [
                    'label' => 'edukasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'rujukan' => [
                    'label' => 'rujukan',
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
                        'tindakan' => $validation->getError('tindakan'),
                        'diagnosa' => $validation->getError('diagnosa'),
                        'terapi' => $validation->getError('terapi'),
                        'edukasi' => $validation->getError('edukasi'),
                        'rujukan' => $validation->getError('rujukan'),
                        'keterangan' => $validation->getError('keterangan'),
                    ]
                ];
            } else {


                $id = $this->request->getVar('id');
                $id_pasien = $this->request->getVar('id_pasien');
                $this->db = \config\Database::connect();
                $rm = $this->db->query("SELECT * from tbl_rekam_medis WHERE id_rm ='$id'");
                $row = $rm->getRow();
                $id_layanan = $row->layanan;
                $layanan = $this->db->query("SELECT * from tbl_layanan WHERE id_layanan ='$id_layanan'");
                $lay = $layanan->getRow();
                $transaksi = [
                    'pasien' => $id_pasien,
                    'layanan' => $id_layanan,
                    'biaya_lainya' => '0',
                    'total_harga' => $lay->harga,
                    'kembalian' => '',
                    'keterangan' => $this->request->getVar('keterangan'),
                    'waktu' => $row->waktu,
                    'status' => '1'
                ];
                $this->Riwayat->insert($transaksi);
                $update = [
                    'tindakan' => $this->request->getVar('tindakan'),
                    'diagnosa' => $this->request->getVar('diagnosa'),
                    'terapi' => $this->request->getVar('terapi'),
                    'edukasi' => $this->request->getVar('edukasi'),
                    'rujukan' => $this->request->getVar('rujukan'),
                    'keterangan' => $this->request->getVar('keterangan'),
                ];
                $this->Rm->update($id, $update);
                $tran = $this->db->query("SELECT * FROM tbl_riwayat_transaksi ORDER BY id_riwayat DESC LIMIT 1");
                $raw = $tran->getRow();
                $id_riwayat = $raw->id_riwayat;
                $obat = $this->request->getVar('obat');
                $resep = $this->request->getVar('resep');
                $jumlah = $this->request->getVar('jumlah');
                $jmldata = count($obat);

                for ($i = 0; $i < $jmldata; $i++) {
                    $this->Resep->insert([
                        'transaksi' => $id_riwayat,
                        'obat' => $obat[$i],
                        'resep' => $resep[$i],
                        'jumlah' => $jumlah[$i],
                    ]);
                }
                $res = $this->db->query("SELECT * FROM tb_resep WHERE transaksi ='$id_riwayat'");
                $hasil = $res->getResult();
                foreach ($hasil as $resepp) {
                    $obatt = $resepp->obat;
                    $jumbaru = $resepp->jumlah;
                    $i = $this->db->query("SELECT * FROM tbl_obat WHERE id_obat ='$obatt'");
                    $b = $i->getRow();
                    $jumlama = $b->jumlah_obat;
                    $jum = $jumlama - $jumbaru;
                    $updateobat = [
                        'jumlah_obat' => $jum
                    ];
                    $this->Obat->update($obatt, $updateobat);
                    $keluar = [
                        'obat' => $obatt,
                        'jumlah_keluar' => $jumbaru,
                        'jenis_keluar' => 'Berobat',
                        'tanggal_keluar' => $row->waktu,
                        'keterangan' => '-'
                    ];
                    $this->Keluar->insert($keluar);
                }
                $msg = [
                    'sukses' => "Data Berhasil Disimpan"
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