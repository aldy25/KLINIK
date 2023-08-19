<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Homepage extends BaseController
{
    public function index()
    {
        $session = \config\services::session();
        $login = $session->get('login');
        if (empty($login)) {
            $data = ['title' => 'KLINIK DOKTER YANTI | HALAMAN LOGIN'];
            return view('Auth/Login', $data);
        } else {
            $data = [
                'title' => 'KLINIK DOKTER YANTI | BERANDA SISTEM',
                'page' => 'BERANDA'
            ];
            return view('Page/Beranda', $data);
        }
    }
}