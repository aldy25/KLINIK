<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class Modeldatarekam extends Model
{
    protected $table = "tbl_rekam_medis";
    protected $column_order = array(NULL, 'no_rm', 'nama_pasien', 'nama_user', 'nama_layanan', 'tinggi_badan', 'berat_badan', 'tekanan_darah', 'anamnesa', 'icd9', 'icd10', 'terapi', 'edukasi', 'rujukan', 'waktu', 'keterangan', NULL);
    protected $column_search = array('no_rm', 'nama_pasien', 'nama_user', 'nama_layanan', 'tinggi_badan', 'berat_badan', 'tekanan_darah', 'anamnesa', 'icd9', 'icd10', 'terapi', 'edukasi', 'rujukan', 'waktu', 'keterangan');
    protected $order = array('id_rm' => 'desc');
    protected $request;

    protected $db;
    protected $dt;

    function __construct(RequestInterface $request)
    {

        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;

        $this->dt = $this->db->table($this->table)->select('*')->join('tbl_pasien', 'pasien=id_pasien')->join('tbl_user', 'dokter=id_user')->join('tbl_layanan', 'layanan=id_layanan')->join('tbl_icd9', 'icd9=id_icd9')->join('tbl_icd10', 'icd10=id_icd10');
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
