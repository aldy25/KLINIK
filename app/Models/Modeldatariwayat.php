<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class Modeldatariwayat extends Model
{
    protected $table = "tbl_riwayat_transaksi";
    protected $column_order = array(NULL, 'layanan', 'kasir', 'biaya_lainya', 'total_harga', 'total_bayar', 'kembalian', 'keterangan', 'waktu');
    protected $column_search = array('pasien', 'layanan', 'kasir', 'total_harga', 'keterangan', 'waktu');
    protected $order = array('id_riwayat' => 'desc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct(RequestInterface $request, $id_pasien)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $pasien = 'pasien';
        $this->dt = $this->db->table($this->table)->like($pasien, $id_pasien)->like('total_bayar', '0')->join('tbl_pasien', 'pasien=id_pasien')->join('tbl_layanan', 'layanan=id_layanan')->join('tbl_user', 'kasir=id_user');
    }
    private function _get_datatables_query()
    {
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }
    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }
    function count_filtered()
    {
        $this->_get_datatables_query();
        return $this->dt->countAllResults();
    }
    public function count_all()
    {
        $tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
    }
}