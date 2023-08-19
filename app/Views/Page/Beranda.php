<?= $this->extend('Base/Main') ?>
<?= $this->extend('Base/Menu') ?>
<?= $this->section('Konten') ?>
<?php

// echo 'Default Timezone: ' . date('d-m-Y H:i:s') . '</br>';
date_default_timezone_set('Asia/Jakarta');
// echo 'Indonesian Timezone: ' . date('d-m-Y H:i:s');
// echo date_default_timezone_get();
// die();


$session = \config\services::session();
$id_user = $session->get('id_user');
$username = $session->get('username');
$level = $session->get('level');
$nama = $session->get('nama_user');
$this->db = \config\Database::connect();
$pasien = $this->db->table('tbl_pasien')->countAllResults();
$obat = $this->db->table('tbl_obat')->countAllResults();
$transaksi = $this->db->table('tbl_riwayat_transaksi')->countAllResults();
$pengguna = $this->db->table('tbl_user')->countAllResults();

if ($level == 'Administrator') {
?>
<div class="row">
    <!-- Column -->
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        <?php
                            $kunjungan = $this->db->table('tbl_kunjungan')->countAllResults();
                            ?>
                        JUMLAH KUNJUNGAN BULAN INI
                    </div>

                </div>

                <div class="d-flex flex-row">

                    <div class="col-12 align-self-center text-center">
                        <div class="m-l-10">
                            <h6 class="mt-0 round-inner"> <i class="mdi mdi-account "></i> <?= $kunjungan ?> Orang</h6>

                        </div>
                    </div>

                </div>
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        <?= date('d-m-Y'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        <?php

                            $this->db = \config\Database::connect();


                            $mont = date('Y-m-d');
                            $datatransaksi = $this->db->query("SELECT * FROM tbl_riwayat_transaksi where waktu='$mont'");
                            $tampildata = $datatransaksi->getResult();
                            $unn = 0;
                            foreach ($tampildata as $row) {
                                $lay = $row->layanan;
                                $id_transaksi = $row->id_riwayat;
                                $layanan = $this->db->query("SELECT * from tbl_layanan  WHERE id_layanan='$lay'");
                                $layananann = $layanan->getRow();
                                $resep = $this->db->query("SELECT * from tb_resep  WHERE transaksi='$id_transaksi'");
                                $dataresep = $resep->getResult();
                                $biayaobat = 0;
                                foreach ($dataresep as $dataobat) {
                                    $id_obat = $dataobat->obat;
                                    $cekobat = $this->db->query("SELECT * from tbl_obat  WHERE id_obat='$id_obat'");
                                    $rowobat = $cekobat->getRow();
                                    $biayaobat += $rowobat->harga_satuan;
                                }
                                $un = $layananann->harga + $row->biaya_lainya;
                                $untung = $un - $biayaobat;
                                $unn += $untung;
                            }
                            ?>
                        TOTAL PENDAPATAN LAYANAN HARI INI
                    </div>

                </div>

                <div class="d-flex flex-row">

                    <div class="col-12 align-self-center text-center">
                        <div class="m-l-10">
                            <h6 class="mt-0 round-inner"> <i class="mdi mdi-database "></i> Rp,
                                <?= number_format($unn) ?></h6>

                        </div>
                    </div>

                </div>
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        <?= date('d-m-Y'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        <?php

                            $this->db = \config\Database::connect();
                            $total_bayar = 'total_bayar';
                            $dataantrian = $this->db->table('tbl_riwayat_transaksi')->select('*')->where($total_bayar, '')->countAllResults();
                            ?>
                        JUMLAH ANTRIAN TRANSAKSI
                    </div>

                </div>

                <div class="d-flex flex-row">

                    <div class="col-12 align-self-center text-center">
                        <div class="m-l-10">
                            <h6 class="mt-0 round-inner"> <i class="mdi mdi-account "></i>
                                <?= $dataantrian ?> Orang</h6>

                        </div>
                    </div>

                </div>
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        <?= date('d-m-Y'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->

</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-body">

                <h2 class="mt-0 header-title">DATA 10 PENYAKIT YANG PALING SERING MUNCUL BULAN INI </h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>KODE ICD10</th>
                                <th>JENIS PENYAKIT</th>
                                <th>JUMLAH</th>

                                <th>KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $this->db = \config\Database::connect();
                                $mont = date('m');

                                $query = $this->db->query("SELECT *, COUNT(icd10) AS jum FROM tbl_rekam_medis WHERE icd10 IS NOT NULL AND month(waktu)='$mont' GROUP BY icd10 ORDER BY COUNT(icd10) DESC LIMIT 0,10 ");
                                $icd10 = $query->getResult();
                                $i = 0;
                                foreach ($icd10 as $row) {
                                    $id_icd10 = $row->icd10;
                                    $queri = $this->db->query("SELECT * FROM tbl_icd10 WHERE id_icd10 = '$id_icd10'");
                                    $dataicd10 = $queri->getRow();


                                    $i++
                                ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $dataicd10->kode ?></td>
                                <td><?= $dataicd10->diagnosa ?></td>
                                <td style="color: red;"><?= $row->jum ?></td>
                                <td><?= $row->keterangan ?></td>
                            </tr>
                            <?php
                                }
                                ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

} elseif ($level == 'Dokter') {
?>
<div class="row">
    <!-- Column -->
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        <?php

                            $this->db = \config\Database::connect();
                            $diagnosa = 'icd10';
                            $dokter = 'dokter';
                            $databerobat =  $this->db->table('tbl_rekam_medis')->where($dokter, $id_user)->where($diagnosa, NULL)->countAllResults();

                            ?>
                        JUMLAH ANTRIAN BEROBAT
                    </div>

                </div>

                <div class="d-flex flex-row">

                    <div class="col-12 align-self-center text-center">
                        <div class="m-l-10">
                            <h6 class="mt-0 round-inner"> <i class="mdi mdi-account "></i>
                                <?= $databerobat ?> Orang</h6>

                        </div>
                    </div>

                </div>
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        <?= date('d-m-Y'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
<?php


} elseif ($level == 'Apoteker') {
?>
<div class="row">
    <!-- Column -->
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">


                        <?php
                            $this->db = \config\Database::connect();

                            $mont = date('m');
                            $datatransaksi = $this->db->query("SELECT * FROM tbl_obat_masuk where month(tanggal_masuk)='$mont'");
                            $tampildata = $datatransaksi->getResult();
                            $totalpembelian = 0;
                            foreach ($tampildata as $row) {
                                $hargasatuan = $row->harga_satuan;
                                $jumlahmasuk = $row->jumlah_obat;
                                $total = $hargasatuan * $jumlahmasuk;

                                $totalpembelian += $total;
                            }
                            ?>
                        TOTAL PEMBELIAN OBAT BULAN INI
                    </div>

                </div>

                <div class="d-flex flex-row">

                    <div class="col-12 align-self-center text-center">
                        <div class="m-l-10">
                            <h6 class="mt-0 round-inner"> <i class="mdi mdi-database "></i> RP,
                                <?= number_format($totalpembelian); ?></h6>

                        </div>
                    </div>

                </div>
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        <?= date('d-m-Y'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        JUMLAH KEUNTUNGAN PENJUALAN OBAT BULAN INI
                        <?php
                            $this->db = \config\Database::connect();

                            $mont = date('m');
                            $datatransaksi = $this->db->query("SELECT * FROM tbl_obat_keluar where month(tanggal_keluar)='$mont'");
                            $tampildata = $datatransaksi->getResult();
                            $keuntunganobat = 0;
                            foreach ($tampildata as $row) {

                                $jumlahkeluar = $row->jumlah_keluar;
                                $id_obat = $row->obat;
                                $dataobat = $this->db->query("SELECT * FROM tbl_obat where id_obat='$id_obat'");
                                $datastokobat = $dataobat->getRow();

                                $hargajual = $datastokobat->harga_satuan;
                                $kode_obat = $datastokobat->kode_obat;
                                $dataobatbeli = $this->db->query("SELECT * FROM tbl_obat_masuk where kode_obat='$kode_obat'");
                                $dataobatmasuk = $dataobatbeli->getRow();
                                $hargabeli = $dataobatmasuk->harga_satuan;
                                $totalbeli = $hargabeli * $jumlahkeluar;
                                $totaljual = $hargajual * $jumlahkeluar;
                                $keuntungan = $totaljual - $totalbeli;

                                $keuntunganobat += $keuntungan;
                            }
                            ?>
                    </div>

                </div>

                <div class="d-flex flex-row">

                    <div class="col-12 align-self-center text-center">
                        <div class="m-l-10">
                            <h6 class="mt-0 round-inner"> <i class="mdi mdi-database "></i>Rp,
                                <?= number_format($keuntunganobat) ?></h1>

                        </div>
                    </div>

                </div>
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        <?= date('d-m-Y'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-body">

                <h2 class="mt-0 header-title">DATA 10 OBAT YANG PALING SERING TERJUAL BULAN INI </h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>KODE OBAT</th>
                                <th>NAMA OBAT</th>
                                <th>JUMLAH</th>
                                <th>KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $this->db = \config\Database::connect();
                                $mont = date('m');

                                $query = $this->db->query("SELECT *, COUNT(obat) AS jum FROM tbl_obat_keluar WHERE   month(tanggal_keluar)='$mont' GROUP BY obat ORDER BY COUNT(obat) DESC LIMIT 0,10 ");
                                $icd10 = $query->getResult();
                                $i = 0;
                                foreach ($icd10 as $row) {
                                    $obat = $row->obat;
                                    $queri = $this->db->query("SELECT * FROM tbl_obat WHERE id_obat = '$obat'");
                                    $dataicd10 = $queri->getRow();


                                    $i++
                                ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $dataicd10->kode_obat ?></td>
                                <td><?= $dataicd10->nama_obat ?></td>
                                <td style="color: red;"><?= $row->jum ?></td>
                                <td><?= $row->keterangan ?></td>
                            </tr>
                            <?php
                                }
                                ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-body">

                <h2 class="mt-0 header-title">DATA STOK OBAT <span style="color: red;"> KURANG DARI 30</span></h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>KODE OBAT</th>
                                <th>NAMA OBAT</th>
                                <th>STOCK OBAT</th>
                                <th>HARGA SATUAN</th>
                                <th>SATUAN</th>
                                <th>KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $this->db = \config\Database::connect();
                                $query = $this->db->query("SELECT * FROM tbl_obat WHERE jumlah_obat <='30'");
                                $obat = $query->getResult();
                                $i = 0;
                                foreach ($obat as $row) {
                                    $i++
                                ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $row->kode_obat ?></td>
                                <td><?= $row->nama_obat ?></td>
                                <td style="color: red;"><?= $row->jumlah_obat ?></td>
                                <td><?= $row->harga_satuan ?></td>
                                <td><?= $row->satuan ?></td>
                                <td><?= $row->keterangan ?></td>
                            </tr>
                            <?php
                                }
                                ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
} else {
?>
<!-- Column -->
<div class="row">

    <?php

        $this->db = \config\Database::connect();


        $montini = date('m');
        $datatransaksiini = $this->db->query("SELECT * FROM tbl_riwayat_transaksi where month(waktu)='$montini'");
        $tampildataini = $datatransaksiini->getResult();
        $unnini = 0;
        foreach ($tampildataini as $rowini) {
            $layini = $rowini->layanan;
            $id_transaksiini = $rowini->id_riwayat;
            $layananini = $this->db->query("SELECT * from tbl_layanan  WHERE id_layanan='$layini'");
            $layananannini = $layananini->getRow();
            $resepini = $this->db->query("SELECT * from tb_resep  WHERE transaksi='$id_transaksiini'");
            $dataresepini = $resepini->getResult();
            $biayaobatini = 0;
            foreach ($dataresepini as $dataobatini) {
                $id_obatini = $dataobatini->obat;
                $cekobatini = $this->db->query("SELECT * from tbl_obat  WHERE id_obat='$id_obatini'");
                $rowobatini = $cekobatini->getRow();
                $biayaobatini += $rowobatini->harga_satuan;
            }
            $unini = $layananannini->harga + $rowini->biaya_lainya;
            $untungini = $unini - $biayaobatini;
            $unnini += $untungini;
        }
        $montlalu = date('m');
        $bulanlalu = $montlalu - 1;
        if ($bulanlalu == 0) {
            $bulansekaranglalu = 12;
        } else {
            $bulansekaranglalu = $bulanlalu;
        }
        $datatransaksilalu = $this->db->query("SELECT * FROM tbl_riwayat_transaksi where month(waktu)='$bulansekaranglalu'");
        $tampildatalalu = $datatransaksilalu->getResult();
        $unnlalu = 0;
        foreach ($tampildatalalu as $rowlalu) {
            $laylalu = $rowlalu->layanan;
            $id_transaksilalu = $rowlalu->id_riwayat;
            $layananlalu = $this->db->query("SELECT * from tbl_layanan  WHERE id_layanan='$laylalu'");
            $layananannlalu = $layananlalu->getRow();
            $reseplalu = $this->db->query("SELECT * from tb_resep  WHERE transaksi='$id_transaksilalu'");
            $datareseplalu = $reseplalu->getResult();
            $biayaobatlalu = 0;
            foreach ($datareseplalu as $dataobatlalu) {
                $id_obatlalu = $dataobatlalu->obat;
                $cekobatlalu = $this->db->query("SELECT * from tbl_obat  WHERE id_obat='$id_obatlalu'");
                $rowobatlalu = $cekobatlalu->getRow();
                $biayaobatlalu += $rowobatlalu->harga_satuan;
            }
            $unlalu = $layananannlalu->harga + $rowlalu->biaya_lainya;
            $untunglalu = $unlalu - $biayaobatlalu;
            $unnlalu += $untunglalu;
        }
        ?>
    <!-- Column -->

    <div class="col-md-6 col-lg-6 col-xl-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        PERBANDINGAN PENDAPATAN DARI LAYANAN BULAN INI DAN BULAN SEBELUMNYA
                    </div>

                </div>

                <div class="d-flex flex-row">
                    <div class="col-6 align-self-center text-center">

                        <div class="m-l-10">
                            <h6> TOTAL PENDAPATAN BULAN INI</h6>
                        </div>
                    </div>
                    <div class="col-6 align-self-center text-center">
                        <div class="m-l-10">
                            <h6> TOTAL PENDAPATAN BULAN LALU</h6>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row">
                    <div class="col-6 align-self-center text-center">

                        <div class="m-l-10">
                            <h2 style="font-weight:bold;"> <i class="mdi mdi-database "></i> Rp,
                                <?= number_format($unnini) ?></h2>
                        </div>

                    </div>


                    <div class="col-6 align-self-center text-center">
                        <div class="m-l-10">
                            <h2 style="font-weight:bold;"> <i class="mdi mdi-database "></i> Rp,
                                <?= number_format($unnlalu) ?></h2>


                        </div>
                    </div>
                </div>



                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        <h6>KETERANGAN</h6>

                    </div>
                </div>


                <?php
                    if ($unnini == $unnlalu) {
                    ?>
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        <h3>PENDAPATAN ANDA STABIL TIDAK MENGALAMI PENURUAN MAUPUN KENAIKAN</h3>

                    </div>
                </div>
                <?php
                    } elseif ($unnini < $unnlalu) {

                        $selisi = $unnlalu - $unnini;
                        $persen = $selisi / $unnini;
                        $totalpersen = $persen * 100;
                    ?>
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        <h3>PENDAPATAN ANDA MENGALAMI <p style="color:red"> PENURUNAN SEBESAR
                                <?= round($totalpersen) ?>
                                % </p>
                        </h3>

                    </div>
                </div>
                <?php
                    } else {
                        $selisi = $unnini - $unnlalu;

                        if ($unnlalu == 0) {
                            $totalpersen = $selisi * 100;
                        } else {
                            $persen = $selisi / $unnini;
                            $totalpersen = $persen * 100;
                        }


                    ?>
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        <h3>PENDAPATAN ANDA MENGALAMI <p style="color:orange;"> KENAIKAN SEBESAR
                                <?= round($totalpersen) ?> % </p>
                        </h3>

                    </div>
                </div>
                <?php

                    }


                    ?>



                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        <?= date('d-m-Y'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->



    <!-- Column -->
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        <?php

                            $kunjungan = $this->db->table('tbl_kunjungan')->countAllResults();

                            ?>
                        JUMLAH KUNJUNGAN BULAN INI
                    </div>

                </div>

                <div class="d-flex flex-row">

                    <div class="col-12 align-self-center text-center">
                        <div class="m-l-10">
                            <h6 class="mt-0 round-inner"> <i class="mdi mdi-account "></i> <?= $kunjungan ?> Orang
                            </h6>

                        </div>
                    </div>

                </div>
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        <?= date('d-m-Y'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->

    <!-- Column -->
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        <?php

                            $kunjungan = $this->db->table('tbl_kunjungan')->countAllResults();

                            ?>
                        JUMLAH PENGGUNA SISTEM
                    </div>

                </div>

                <div class="d-flex flex-row">

                    <div class="col-12 align-self-center text-center">
                        <div class="m-l-10">
                            <h6 class="mt-0 round-inner"> <i class="mdi mdi-account "></i> <?= $pengguna ?> Orang
                            </h6>

                        </div>
                    </div>

                </div>
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        <?= date('d-m-Y'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->

    <!-- Column -->
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        <?php

                            $this->db = \config\Database::connect();


                            $mont = date('Y-m-d');
                            $datatransaksi = $this->db->query("SELECT * FROM tbl_riwayat_transaksi where waktu='$mont'");
                            $tampildata = $datatransaksi->getResult();
                            $unn = 0;
                            foreach ($tampildata as $row) {
                                $lay = $row->layanan;
                                $id_transaksi = $row->id_riwayat;
                                $layanan = $this->db->query("SELECT * from tbl_layanan  WHERE id_layanan='$lay'");
                                $layananann = $layanan->getRow();
                                $resep = $this->db->query("SELECT * from tb_resep  WHERE transaksi='$id_transaksi'");
                                $dataresep = $resep->getResult();
                                $biayaobat = 0;
                                foreach ($dataresep as $dataobat) {
                                    $id_obat = $dataobat->obat;
                                    $cekobat = $this->db->query("SELECT * from tbl_obat  WHERE id_obat='$id_obat'");
                                    $rowobat = $cekobat->getRow();
                                    $biayaobat += $rowobat->harga_satuan;
                                }
                                $un = $layananann->harga + $row->biaya_lainya;
                                $untung = $un - $biayaobat;
                                $unn += $untung;
                            }
                            ?>
                        TOTAL PENDAPATAN LAYANAN HARI INI
                    </div>

                </div>

                <div class="d-flex flex-row">

                    <div class="col-12 align-self-center text-center">
                        <div class="m-l-10">
                            <h6 class="mt-0 round-inner"> <i class="mdi mdi-database "></i> Rp,
                                <?= number_format($unn) ?></h6>

                        </div>
                    </div>

                </div>
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        <?= date('d-m-Y'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">


                        <?php
                            $this->db = \config\Database::connect();

                            $mont = date('m');
                            $datatransaksi = $this->db->query("SELECT * FROM tbl_obat_masuk where month(tanggal_masuk)='$mont'");
                            $tampildata = $datatransaksi->getResult();
                            $totalpembelian = 0;
                            foreach ($tampildata as $row) {
                                $hargasatuan = $row->harga_satuan;
                                $jumlahmasuk = $row->jumlah_obat;
                                $total = $hargasatuan * $jumlahmasuk;

                                $totalpembelian += $total;
                            }
                            ?>
                        TOTAL PEMBELIAN OBAT BULAN INI
                    </div>

                </div>

                <div class="d-flex flex-row">

                    <div class="col-12 align-self-center text-center">
                        <div class="m-l-10">
                            <h6 class="mt-0 round-inner"> <i class="mdi mdi-database "></i> RP,
                                <?= number_format($totalpembelian); ?></h6>

                        </div>
                    </div>

                </div>
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        <?= date('d-m-Y'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        JUMLAH KEUNTUNGAN PENJUALAN OBAT BULAN INI
                        <?php
                            $this->db = \config\Database::connect();

                            $mont = date('m');
                            $datatransaksi = $this->db->query("SELECT * FROM tbl_obat_keluar where month(tanggal_keluar)='$mont'");
                            $tampildata = $datatransaksi->getResult();
                            $keuntunganobat = 0;
                            foreach ($tampildata as $row) {

                                $jumlahkeluar = $row->jumlah_keluar;
                                $id_obat = $row->obat;
                                $dataobat = $this->db->query("SELECT * FROM tbl_obat where id_obat='$id_obat'");
                                $datastokobat = $dataobat->getRow();

                                $hargajual = $datastokobat->harga_satuan;
                                $kode_obat = $datastokobat->kode_obat;
                                $dataobatbeli = $this->db->query("SELECT * FROM tbl_obat_masuk where kode_obat='$kode_obat'");
                                $dataobatmasuk = $dataobatbeli->getRow();
                                $hargabeli = $dataobatmasuk->harga_satuan;
                                $totalbeli = $hargabeli * $jumlahkeluar;
                                $totaljual = $hargajual * $jumlahkeluar;
                                $keuntungan = $totaljual - $totalbeli;

                                $keuntunganobat += $keuntungan;
                            }
                            ?>
                    </div>

                </div>

                <div class="d-flex flex-row">

                    <div class="col-12 align-self-center text-center">
                        <div class="m-l-10">
                            <h6 class="mt-0 round-inner"> <i class="mdi mdi-database "></i>Rp,
                                <?= number_format($keuntunganobat) ?></h1>

                        </div>
                    </div>

                </div>
                <div class="d-flex flex-row">
                    <div style="text-align: center; font-weight:bold;" class="col-12 align-self-center">
                        <?= date('d-m-Y'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-body">

                <h2 class="mt-0 header-title">DATA 10 PENYAKIT YANG PALING SERING MUNCUL BULAN INI </h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>KODE ICD10</th>
                                <th>JENIS PENYAKIT</th>
                                <th>JUMLAH</th>

                                <th>KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $this->db = \config\Database::connect();
                                $mont = date('m');

                                $query = $this->db->query("SELECT *, COUNT(icd10) AS jum FROM tbl_rekam_medis WHERE icd10 IS NOT NULL AND month(waktu)='$mont' GROUP BY icd10 ORDER BY COUNT(icd10) DESC LIMIT 0,10 ");
                                $icd10 = $query->getResult();
                                $i = 0;
                                foreach ($icd10 as $row) {
                                    $id_icd10 = $row->icd10;
                                    $queri = $this->db->query("SELECT * FROM tbl_icd10 WHERE id_icd10 = '$id_icd10'");
                                    $dataicd10 = $queri->getRow();


                                    $i++
                                ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $dataicd10->kode ?></td>
                                <td><?= $dataicd10->diagnosa ?></td>
                                <td style="color: red;"><?= $row->jum ?></td>
                                <td><?= $row->keterangan ?></td>
                            </tr>
                            <?php
                                }
                                ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-body">

                <h2 class="mt-0 header-title">DATA 10 OBAT YANG PALING SERING TERJUAL BULAN INI </h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>KODE OBAT</th>
                                <th>NAMA OBAT</th>
                                <th>JUMLAH</th>
                                <th>KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $this->db = \config\Database::connect();
                                $mont = date('m');

                                $query = $this->db->query("SELECT *, COUNT(obat) AS jum FROM tbl_obat_keluar WHERE   month(tanggal_keluar)='$mont' GROUP BY obat ORDER BY COUNT(obat) DESC LIMIT 0,10 ");
                                $icd10 = $query->getResult();
                                $i = 0;
                                foreach ($icd10 as $row) {
                                    $obat = $row->obat;
                                    $queri = $this->db->query("SELECT * FROM tbl_obat WHERE id_obat = '$obat'");
                                    $dataicd10 = $queri->getRow();


                                    $i++
                                ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $dataicd10->kode_obat ?></td>
                                <td><?= $dataicd10->nama_obat ?></td>
                                <td style="color: red;"><?= $row->jum ?></td>
                                <td><?= $row->keterangan ?></td>
                            </tr>
                            <?php
                                }
                                ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-body">

                <h2 class="mt-0 header-title">DATA STOK OBAT <span style="color: red;"> KURANG DARI 30</span></h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>KODE OBAT</th>
                                <th>NAMA OBAT</th>
                                <th>STOCK OBAT</th>
                                <th>HARGA SATUAN</th>
                                <th>SATUAN</th>
                                <th>KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $this->db = \config\Database::connect();
                                $query = $this->db->query("SELECT * FROM tbl_obat WHERE jumlah_obat <='30'");
                                $obat = $query->getResult();
                                $i = 0;
                                foreach ($obat as $row) {
                                    $i++
                                ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $row->kode_obat ?></td>
                                <td><?= $row->nama_obat ?></td>
                                <td style="color: red;"><?= $row->jumlah_obat ?></td>
                                <td><?= $row->harga_satuan ?></td>
                                <td><?= $row->satuan ?></td>
                                <td><?= $row->keterangan ?></td>
                            </tr>
                            <?php
                                }
                                ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
?>
<?= $this->endsection() ?>