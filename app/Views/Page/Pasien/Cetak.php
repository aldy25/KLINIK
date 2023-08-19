<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Kartu Pasien</title>
    <link rel="icon" href="<?= base_url() ?>/assets/images/logo.png">
    <style>
        table.static {
            position: relative;
            border: 1px solid black;
        }

        #nomer_surat {
            text-align: center;
        }

        .nama_surat {
            text-transform: uppercase;
            text-decoration: underline;
            font-weight: bolder;
        }


        #surat div {
            margin: 4px;
        }

        #par_pembuka {
            text-align: justify;
        }

        #content_surat {
            position: auto;
            overflow: auto;
            padding-left: 30px;
        }

        #content_surat div {
            position: relative;
            padding: 1px;
        }

        .isian_surat {
            position: absolute;
            left: 170px;
            width: auto;
        }
    </style>
</head>
<?php
$this->db = \config\Database::connect();
$query_pasien = $this->db->query("SELECT * from tbl_pasien  WHERE id_pasien='$id'");
$pasien_row = $query_pasien->getRow();
?>

<body style="width:400px; height:240px; border:1px solid black; background-color:#2148C0;">
    <div class="form-group">
        <h3 style="line-height: 1px;" align="center">KLINIK PRATAMA DOKTER YANTI</h3>
        <p style="line-height: 1px; font-style: italic;" align="center">Jl. Sersan Darphin No.96, Eka Jaya, Kec.
            Palmerah, </p>
        <p style="line-height: 1px; font-style: italic;" align="center"> Kota Jambi, Jambi</p>
        <hr>
        <h3 align="center">Kartu Pasien</h3>

        <div id="content_surat">
            <div>
                <label class="l_form">No RM
                </label>
                <label class="isian_surat">: <?php echo $pasien_row->no_rm ?></label>
            </div>
            <div>
                <label class="l_form">NIK
                </label>
                <label class="isian_surat">: <?php echo $pasien_row->nik ?></label>
            </div>
            <div>
                <label class="l_form">Nama
                </label>
                <label class="isian_surat">: <?php echo $pasien_row->nama_pasien ?></label>
            </div>
            <div>
                <label class="l_form">Jenis Kelamin
                </label>
                <label class="isian_surat">: <?php echo $pasien_row->jk_pasien ?></label>
            </div>

            <div>
                <label class="l_form">Alamat
                </label>
                <label class="isian_surat">: <?php echo $pasien_row->alamat_pasien  ?></label>
            </div>
        </div>

    </div>
    <script>
        window.print();
    </script>
</body>

</html>