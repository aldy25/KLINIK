<?php

namespace App\Controllers\back;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\Modeldataakun;

class Akun extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'KLINIK DOKTER YANTI | DATA AKUN',
            'page' => 'AKUN'
        ];
        return view('Page/Akun/Viewakun', $data);
    }
    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'tampildata' => $this->Akun->findAll()
            ];
            $msg = [
                'data' => view('Page/Akun/Dataakun', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Data Tidak di Temukan');
        }
    }
    public function listdata()
    {
        $request = Services::request();
        $datamodel = new Modeldataakun($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {

                if ($list->status == 'on') {
                    $status = "<p class=\"on\">On</p>";
                } else {
                    $status = "<p class=\"off\">Off</p>";
                }
                $no++;
                $row = [];
                $tomboledit = "<button type=\"button\" title=\"Edit \"  class=\"btn btn-info btn-sm\" onclick=\"edit('" . $list->id_user .
                    "')\"><i class=\"mdi mdi-transcribe\"></i></button>";
                $tombolhapus = " <button type=\"button\" title=\"Hapus \"  class=\"btn btn-danger btn-sm\" onclick=\"hapus('" . $list->id_user .
                    "')\"><i class=\"fa fa-trash\"></i></button>";
                $foto = " <button type=\"button\")\"><img class=\"foto\" src=assets/images/profil/$list->foto></button>";
                $row[] = $no;
                $row[] = $list->level;
                $row[] = $list->role1;
                $row[] = $list->role2;
                $row[] = $list->nama_user;
                $row[] = $status;
                $row[] = $list->username;
                $row[] = $foto;
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
                'data' => view('Page/Akun/modaltambah')
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
                'level' => [
                    'label' => 'Role ',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus di pilih'

                    ]
                ],
                'nama' => [
                    'label' => 'Nama ',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'status' => [
                    'label' => 'Status',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus di Pilih'

                    ]
                ],
                'username' => [
                    'label' => 'username',
                    'rules' => 'required|is_unique[tbl_user.username]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field}vtidak boleh ada yang sama'

                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'repassword' => [
                    'label' => 'retype password',
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'matches' => '{field} tidak sama!!'
                    ]
                ],
                'foto' => [
                    'label' => 'Foto',
                    'rules' => 'uploaded[foto]|mime_in[foto,image/png,image/jpeg]|is_image[foto]',
                    'errors' => [
                        'uploaded' => '{field} wajib diisi',
                        'mime_in' => 'Harus dalam bentuk gambar, jangan file yang lain'
                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'level' => $validation->getError('level'),
                        'nama' => $validation->getError('nama'),
                        'status' => $validation->getError('status'),
                        'username' => $validation->getError('username'),
                        'password' => $validation->getError('password'),
                        'repassword' => $validation->getError('repassword'),
                        'foto' => $validation->getError('foto'),
                    ]
                ];
            } else {
                $pw = $this->request->getPost('password');
                $password = password_hash($pw, PASSWORD_DEFAULT);
                $file = $this->request->getFile('foto');
                $namafoto = $file->getRandomName();
                $file->move('assets/images/profil/', $namafoto);
                $simpandata = [
                    'level' => $this->request->getPost('level'),
                    'role1' => $this->request->getPost('role1'),
                    'role2' => $this->request->getPost('role2'),
                    'nama_user' => $this->request->getPost('nama'),
                    'status' => $this->request->getPost('status'),
                    'foto' => $namafoto,
                    'username' => $this->request->getPost('username'),
                    'password' => $password
                ];
                $this->Akun->insert($simpandata);
                $msg = [
                    'sukses' => 'Akun baru Berhasil di Tambahkan'
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
            $id_user = $this->request->getVar('id_user');
            $row = $this->Akun->find($id_user);
            $data = [
                'id_user' => $row['id_user'],
                'level' => $row['level'],
                'role1' => $row['role1'],
                'role2' => $row['role2'],
                'nama_user' => $row['nama_user'],
                'status' => $row['status'],
                'username' => $row['username'],
            ];
            $msg = [
                'sukses' => view('Page/Akun/modaledit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatedata()
    {

        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $valid = $this->validate([


                'repassword' => [
                    'label' => 'retype password',
                    'rules' => 'matches[password]',
                    'errors' => [

                        'matches' => '{field} tidak sama!!'
                    ]
                ],


            ]);
            if (!$valid) {
                $msg = [
                    'error' => [


                        'repassword' => $validation->getError('repassword'),

                    ]
                ];
            } else {
                $password = $this->request->getPost('password');


                if (empty($password)) {
                    $simpandata = [
                        'level' => $this->request->getPost('level'),
                        'role1' => $this->request->getPost('role1'),
                        'role2' => $this->request->getPost('role2'),
                        'nama_user' => $this->request->getPost('nama'),
                        'status' => $this->request->getPost('status'),
                        'username' => $this->request->getPost('username'),

                    ];
                } else {
                    $pas = password_hash($password, PASSWORD_DEFAULT);
                    $simpandata = [
                        'level' => $this->request->getPost('level'),
                        'role1' => $this->request->getPost('role1'),
                        'role2' => $this->request->getPost('role2'),
                        'nama_user' => $this->request->getPost('nama'),
                        'status' => $this->request->getPost('status'),
                        'username' => $this->request->getPost('username'),
                        'password' => $pas,

                    ];
                }

                $id =  $this->request->getPost('id');
                $this->Akun->update($id, $simpandata);

                $msg = [
                    'sukses' => 'Data Akun berhasil di Update'
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
            $id = $this->request->getVar('id_user');
            $this->Akun->delete($id);
            $msg = [
                'sukses' => "Data Akun dengan id $id berhasil di hapus"
            ];
            echo json_encode($msg);
        } else {
            exit('maaf data tidak ditemukan');
        }
    }
}