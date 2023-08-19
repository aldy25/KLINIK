<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Rekam Medis Pasien</title>
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
        <h3 align="center">Laporan Data Rekam Medis Pasien</h3>
        <table class="static" align="center" rules='all' border="1px" style="width: 95%;">
            <thead>
                <tr style="text-align: center;">
                    <th>No</th>
                    <th>Nama Pasien</th>
                    <th>Nama Dokter</th>
                    <th>Layanan</th>
                    <th>No Rm</th>
                    <th>TB</th>
                    <th>BB</th>
                    <th>TD</th>
                    <th>Anamnesa</th>
                    <th>ICD9</th>
                    <th>ICD10</th>
                    <th>Terapi</th>
                    <th>Rujukan</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $a = 0;
                $this->db = \config\Database::connect();
                foreach ($tampildata as $row) {
                    $a++;
                    $pas = $row->pasien;
                    $icd9 = $row->icd9;
                    $icd10 = $row->icd10;
                    $dok = $row->dokter;
                    $lay = $row->layanan;
                    $pasien = $this->db->query("SELECT * from tbl_pasien  WHERE id_pasien='$pas'");
                    $pasienn = $pasien->getRow();
                    $dokter = $this->db->query("SELECT * from tbl_user  WHERE id_user='$dok'");
                    $user = $dokter->getRow();
                    $layanan = $this->db->query("SELECT * from tbl_layanan  WHERE id_layanan='$lay'");
                    $datalayanan = $layanan->getRow();
                    $queriicd9 = $this->db->query("SELECT * from tbl_icd9  WHERE id_icd9='$icd9'");
                    $dataicd9 = $queriicd9->getRow();
                    $queriicd10 = $this->db->query("SELECT * from tbl_icd10  WHERE id_icd10='$icd10'");
                    $dataicd10 = $queriicd10->getRow();
                ?>
                    <tr style="text-align: center;">
                        <td><?= $a ?></td>
                        <td><?= $pasienn->nama_pasien ?></td>
                        <td><?= $user->nama_user ?></td>
                        <td><?= $datalayanan->nama_layanan ?></td>
                        <td><?= $row->no_rm ?></td>
                        <td><?= $row->tinggi_badan ?> Cm</td>
                        <td><?= $row->berat_badan ?> Kg</td>
                        <td><?= $row->tekanan_darah ?> mmHg</td>
                        <td><?= $row->anamnesa ?></td>
                        <td><?= $dataicd9->deskripsi ?></td>
                        <td><?= $dataicd10->diagnosa ?></td>
                        <td><?= $row->terapi ?></td>
                        <td><?= $row->rujukan ?></td>
                        <td><?= $row->keterangan ?></td>
                        <td><?= $row->waktu ?></td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
        <div class="container" style="width: 95%;">
            <p align="right">Jambi, <?= date("d M Y") ?></p>
            <p align="right" style="margin-right: 3%; margin-top:50px;">Pemilik</p>
        </div>

    </div>
    <script>
        window.print();
    </script>
</body>

</html>