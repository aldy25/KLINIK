<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class Modeldataantrian extends Model
{
    protected $table = "tbl_riwayat_transaksi";
    protected $column_order = array(null, 'pasien', 'layanan', 'total_harga', null);
    protected $column_search = array('pasien', 'layanan', 'total_harga');
    protected $order = array('id_riwayat' => 'asc');
    protected $request;
    protected $id_pasien;
    protected $db;
    protected $dt;

    function __construct(RequestInterface $request)
    {

        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $total_bayar = 'total_bayar';
        $this->dt = $this->db->table($this->table)->select('*')->where($total_bayar, '')->join('tbl_pasien', 'pasien=id_pasien')->join('tbl_layanan', 'layanan=id_layanan');
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