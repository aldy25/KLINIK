<?php

namespace App\Controllers\back;

use App\Controllers\BaseController;
use Config\Services;

class Auth extends BaseController
{
    public function __construct()
    {

        $session = \config\services::session();
    }
    public function cekuser()
    {
        $this->db = \config\Database::connect();
        if ($this->request->isAJAX()) {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            $validation = \config\Services::validation();
            $valid = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'

                    ]
                ],
                'password' => [
                    'label' => 'password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diisi'
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'username' => $validation->getError('username'),
                        'password' => $validation->getError('password')
                    ]
                ];
            } else {

                $query_cekuser = $this->db->query("SELECT * from tbl_user  WHERE username='$username'");
                $result = $query_cekuser->getResult();

                if (count($result) > 0) {
                    $row = $query_cekuser->getRow();
                    $password_user = $row->password;
                    if (password_verify($password, $password_user)) {
                        $status = $row->status;
                        if ($status === 'off') {
                            $msg = [
                                'error' => [
                                    'pesan' => "Mohon maaf, Akun ini sudah tidak  aktif Lagi!"
                                ]
                            ];
                        } else {

                            $simpan_session = [
                                'login' => 'true',
                                'username' => $username,
                                'nama' => $row->nama_user,
                                'level' => $row->level,
                                'status' => $row->status,
                                'id_user' => $row->id_user,
                            ];
                            session()->set($simpan_session);
                            $msg = [
                                'sukses' => [
                                    'link' => '/Beranda'
                                ]
                            ];
                        }
                    } else {
                        $msg = [
                            'error' => [
                                'password' => "Password salah!!"
                            ]
                        ];
                    }
                } else {
                    $msg = [
                        'error' => [
                            'username' => 'maaf username tidak ditemukan'
                        ]
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit('Maaf Data Tidak di Temukan');
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}