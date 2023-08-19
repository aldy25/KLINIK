<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Keuntungan Penjualan Obat</title>
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
        <p align="center">Laporan Data Pendapatan Penjualan Obat</p>
        <table class="static" align="center" rules='all' border="1px" style="width: 95%;">
            <thead>
                <tr style="text-align: center;">
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Jumlah</th>
                    <th>Harga Jual</th>
                    <th>Harga Beli</th>
                    <th>Total Keuntungan</th>
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
                    $id_obat = $row->obat;
                    $obat = $this->db->query("SELECT * from tbl_obat  WHERE id_obat='$id_obat'");
                    $data_obat = $obat->getRow();
                    $kode_obat = $data_obat->kode_obat;
                    $modaljual = $this->db->query("SELECT * from tbl_obat_masuk  WHERE kode_obat='$kode_obat'");
                    $datamodal = $modaljual->getRow();
                    $hargajual = $data_obat->harga_satuan;
                    $hargabeli = $datamodal->harga_satuan;
                    $untung = $hargajual - $hargabeli;
                    $jumlah = $row->jumlah_keluar;
                    $total_untung = $untung * $jumlah;
                    $sub += $total_untung;
                ?>
                    <tr style="text-align: center;">
                        <td><?= $a ?></td>
                        <td><?= $data_obat->nama_obat ?></td>
                        <td><?= $row->jumlah_keluar ?></td>
                        <td>Rp, <?= number_format($hargajual)  ?></td>
                        <td>Rp, <?= number_format($hargabeli)  ?></td>
                        <td>Rp, <?= number_format($total_untung)  ?></td>
                        <td><?= $row->tanggal_keluar ?></td>
                    </tr>

                <?php } ?>
            </tbody>
            <tbody>


                <tr style="text-align: center;">
                    <td style="border-right: none;">Total Keuntungan</td>
                    <td style="border-right: none; border-left:none;"></td>
                    <td style="border-right: none; border-left:none;"></td>
                    <td style="border-right: none; border-left:none;"></td>
                    <td style="border-right: none; border-left:none;"></td>

                    <td style="border-right: none; border-left:none;">Rp, <?= number_format($sub); ?></td>
                    <td style=" border-left:none;"></td>
                </tr>


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