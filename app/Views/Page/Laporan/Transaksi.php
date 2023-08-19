<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pendapatan Layanan</title>
    <link rel="icon" href="<?= base_url() ?>/assets/images/logo.png">
    <style>
        table.static {
            position: relative;
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <div class="form-group">
        <h3 style="line-height: 1px;" align="center">KLINIK PRATAMA DOKTER YANTI</h3>
        <p style="line-height: 1px; font-style: italic;" align="center">Jl. Sersan Darphin No.96, Eka Jaya, Kec.
            Palmerah, Kota Jambi, Jambi</p>
        <hr>
        <h3 align="center">Laporan Data Pendapatan Layanan</h3>
        <table class="static" align="center" rules='all' border="1px" style="width: 95%;">
            <thead>
                <tr style="text-align: center;">
                    <th>No</th>
                    <th>Pasien</th>
                    <th>Layanan</th>
                    <th style="width: 15%;">Biaya Layanan</th>
                    <th style="width: 15%;">Biaya Lainya</th>
                    <th style="width: 15%;">Modal Obat</th>
                    <th>Keuntungan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $a = 0;
                $this->db = \config\Database::connect();
                $unn = 0;
                foreach ($tampildata as $row) {
                    $a++;
                    $pas = $row->pasien;
                    $lay = $row->layanan;
                    $id_transaksi = $row->id_riwayat;
                    $user = $row->kasir;
                    $pasien = $this->db->query("SELECT * from tbl_pasien  WHERE id_pasien='$pas'");
                    $pasienn = $pasien->getRow();
                    $layanan = $this->db->query("SELECT * from tbl_layanan  WHERE id_layanan='$lay'");
                    $layananann = $layanan->getRow();
                    $kasir = $this->db->query("SELECT * from tbl_user  WHERE id_user='$user'");
                    $kas = $kasir->getRow();


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
                ?>
                    <tr style="text-align: center;">
                        <td><?= $a ?></td>
                        <td><?= $pasienn->nama_pasien ?></td>
                        <td><?= $layananann->nama_layanan ?></td>
                        <td><?= $layananann->harga ?></td>
                        <td>Rp, <?= number_format($row->biaya_lainya) ?></td>
                        <td>Rp, <?= number_format($biayaobat) ?></td>
                        <td>Rp, <?= number_format($untung) ?></td>
                        <td><?= $row->waktu ?></td>
                    </tr>

                <?php
                    $unn += $untung;
                }


                ?>
            </tbody>
            <tbody>


                <tr style="text-align: center;">
                    <td style="border-right: none;">Total Keuntungan</td>
                    <td style="border-right: none; border-left:none;"></td>
                    <td style="border-right: none; border-left:none;"></td>
                    <td style="border-right: none; border-left:none;"></td>
                    <td style="border-right: none; border-left:none;"></td>
                    <td style="border-right: none; border-left:none;"></td>
                    <td style="border-right: none; border-left:none;">Rp, <?= number_format($unn); ?></td>
                    <td style=" border-left:none;"></td>
                </tr>


            </tbody>
        </table>
        <div class="container" style="width: 95%;">
            <p align="right">Jambi, <?= date("d M Y") ?></p>
            <p align="right" style="margin-top:50px; margin-right: 3%">Pemilik</p>
        </div>

    </div>
    <script>
        window.print();
    </script>
</body>

</html>