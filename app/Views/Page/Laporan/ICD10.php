<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data 10 Penyakit Terbanyak</title>
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
        <h3 align="center">Laporan Data 10 Penyakit Terbanyak</h3>
        <table class="static" align="center" rules='all' border="1px" style="width: 95%;">
            <thead>
                <tr style="text-align: center;">
                    <th>No</th>
                    <th>Kode ICD10</th>
                    <th>Jenis Penyakit</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>

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

                    <tr style="text-align: center;">
                        <th scope="row"><?= $i ?></th>
                        <td><?= $dataicd10->kode ?></td>
                        <td><?= $dataicd10->diagnosa ?></td>
                        <td style="color: red;"><?= $row->jum ?></td>
                        <td><?= $row->keterangan ?></td>
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