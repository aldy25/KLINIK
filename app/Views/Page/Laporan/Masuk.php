<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Data Obat Masuk</title>
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
        <h3 align="center">Laporan Data Biaya Pembelian Obat</h3>
        <table class="static" align="center" rules='all' border="1px" style="width: 95%;">
            <thead>
                <tr style="text-align: center;">
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Kode Obat</th>
                    <th>Jumlah Obat</th>
                    <th>Harga Satuan</th>
                    <th>Total Biaya</th>
                    <th>Satuan</th>
                    <th>Tanggal EXP</th>
                    <th>Sumber</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $a = 0;
                $this->db = \config\Database::connect();
                $sub = 0;
                foreach ($tampildata as $row) {
                    $a++;
                    $harga_satuan = $row->harga_satuan;
                    $jumlah = $row->jumlah_obat;

                    $total = $harga_satuan * $jumlah;
                    $sub += $total;
                ?>
                    <tr style="text-align: center;">
                        <td><?= $a ?></td>
                        <td><?= $row->nama_obat ?></td>
                        <td><?= $row->kode_obat ?></td>
                        <td><?= $row->jumlah_obat ?></td>
                        <td><?= number_format($row->harga_satuan) ?></td>
                        <td><?= number_format($sub)  ?></td>
                        <td><?= $row->satuan ?></td>
                        <td><?= $row->tanggal_exp ?></td>
                        <td><?= $row->sumber ?></td>
                        <td><?= $row->keterangan ?></td>
                        <td><?= $row->tanggal_masuk ?></td>
                    </tr>

                <?php } ?>
            </tbody>
            <tbody>


                <tr style="text-align: center;">
                    <td style="border-right: none;">Total Biaya</td>
                    <td style="border-right: none; border-left:none;"></td>
                    <td style="border-right: none; border-left:none;"></td>
                    <td style="border-right: none; border-left:none;"></td>
                    <td style="border-right: none; border-left:none;"></td>
                    <td style="border-right: none; border-left:none;">Rp, <?= number_format($sub); ?></td>
                    <td style="border-right: none; border-left:none;"></td>
                    <td style="border-right: none; border-left:none;"></td>
                    <td style="border-right: none; border-left:none;"></td>
                    <td style="border-right: none; border-left:none;"></td>
                    <td style=" border-left:none;"></td>
                </tr>


            </tbody>
        </table>
        <div class="container" style="width: 95%;">
            <p align="right">Jambi, <?= date("d M Y") ?></p>
            <p align="right" style="margin-right: 3%;margin-top:50px;">Pemilik</p>
        </div>

    </div>
    <script>
        window.print();
    </script>
</body>

</html>