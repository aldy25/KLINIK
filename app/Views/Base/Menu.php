<?= $this->extend('Base/Main') ?>
<?= $this->section('Menu') ?>
<?php
$session = \config\services::session();
$this->db = \config\Database::connect();
$level = $session->get('level');
$id_user = $session->get('id_user');
$query_cekuser = $this->db->query("SELECT * from tbl_user  WHERE id_user='$id_user'");
$row = $query_cekuser->getRow();
$role1 = $row->role1;
$role2 = $row->role2;
if ($level == 'Web Master') {
?>
    <li>
        <a href="<?= base_url() ?>/Beranda" class="waves-effect">
            <i class="mdi mdi-airplay"></i>
            <span> BERANDA <span class="badge badge-pill badge-primary float-right"></span></span>
        </a>
    </li>

    <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account"></i> <span> AKUN </span>
            <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
        <ul class="list-unstyled">
            <li>
                <a href="<?= base_url() ?>/View-akun">
                    DATA AKUN
                </a>
            </li>
        </ul>

    </li>
    <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart"></i> <span> KASIR </span>
            <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
        <ul class="list-unstyled">

            <li>
                <a href="<?= base_url() ?>/Riwayat">
                    RIWAYAT TRANSAKSI
                </a>
            </li>
        </ul>

    </li>
    </li>
    <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-chart-bar"></i> <span> LAPORAN </span>
            <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
        <ul class="list-unstyled">
            <li>
                <a href="<?= base_url() ?>/Laporan">
                    CETAK LAPORAN
                </a>
            </li>
        </ul>

    </li>
<?php

} elseif ($level == 'Administrator') {
?>
    <li>
        <a href="<?= base_url() ?>/Beranda" class="waves-effect">
            <i class="mdi mdi-airplay"></i>
            <span> BERANDA <span class="badge badge-pill badge-primary float-right"></span></span>
        </a>
    </li>
    <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-database"></i> <span> MASTER DATA
            </span>
            <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
        <ul class="list-unstyled">
            <li>
                <a href="<?= base_url() ?>/View-pegawai">
                    DATA PEGAWAI
                </a>
            </li>
            <li>
                <a href="<?= base_url() ?>/View-pasien">
                    DATA PASIEN
                </a>
            </li>
            <li>
                <a href="<?= base_url() ?>/View-obat">
                    DATA OBAT
                </a>
            </li>
            <li>
                <a href="<?= base_url() ?>/View-jabatan">
                    DATA JABATAN
                </a>
            </li>
            <li>
                <a href="<?= base_url() ?>/View-layanan">
                    DATA LAYANAN
                </a>
            </li>
            <li>
                <a href="<?= base_url() ?>/View-kunjungan">
                    DATA KUNJUNGAN PASIEN
                </a>
            </li>
            <li>
                <a href="<?= base_url() ?>/View-rekam-medis">
                    DATA REKAM MEDIS PASIEN
                </a>
            </li>
        </ul>

    </li>
    <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart"></i> <span> KASIR </span>
            <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
        <ul class="list-unstyled">
            <li>
                <a href="<?= base_url() ?>/Antrian">
                    ANTRIAN TRANSAKSI
                </a>
            </li>
            <li>
                <a href="<?= base_url() ?>/Riwayat">
                    RIWAYAT TRANSAKSI
                </a>
            </li>
        </ul>

    </li>
    <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-chart-bar"></i> <span> LAPORAN </span>
            <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
        <ul class="list-unstyled">
            <li>
                <a href="<?= base_url() ?>/Laporan">
                    CETAK LAPORAN
                </a>
            </li>
        </ul>

    </li>
    <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-arrow-right-bold-circle "></i> <span> Layanan
            </span>
            <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
        <ul class="list-unstyled">
            <li>
                <a href="<?= base_url() ?>/Proses-berobat">
                    PENDAFTARAN PASIEN
                </a>
                <?php

                if ($role1 == 'Dokter') {
                ?>

                    <a href="<?= base_url() ?>/Berobatt">
                        PEMERIKSAAN UMUM
                    </a>
                <?php
                }
                ?>
                <?php
                if ($role2 == 'Dokter') {
                ?>
                    <a href="<?= base_url() ?>/Berobatt">
                        PEMERIKSAAN UTAMA
                    </a>
                <?php
                }
                ?>
                <a href="<?= base_url() ?>/Pengkodeanrm">
                    PENGKODEAN REKAM MEDIS
                </a>
            </li>
        </ul>

    </li>

    <?php
    if ($role1 == 'Apoteker') {
    ?>

        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-pill"></i> <span> OBAT </span>
                <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">

                <li>
                    <a href="<?= base_url() ?>/View-obat-keluar">
                        TRANSAKSI OBAT
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>/View-obat">
                        STOK OBAT
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>/Antrian-obat">
                        ANTRIAN RESEP OBAT
                    </a>
                </li>
            </ul>

        </li>


    <?php } ?>
    <?php
    if ($role2 == 'Apoteker') {
    ?>

        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-pill"></i> <span> OBAT </span>
                <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">
                <li>
                    <a href="<?= base_url() ?>/View-obat-masuk">
                        RIWAYAT OBAT MASUK
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>/View-obat-keluar">
                        RIWAYAT OBAT KELUAR
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>/View-obat">
                        STOK OBAT
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>/Antrian-obat">
                        ANTRIAN RESEP OBAT
                    </a>
                </li>
            </ul>

        </li>

    <?php

    }
    ?>
<?php

} elseif ($level == 'Apoteker') {
?>
    <li>
        <a href="<?= base_url() ?>/Beranda" class="waves-effect">
            <i class="mdi mdi-airplay"></i>
            <span> BERANDA <span class="badge badge-pill badge-primary float-right"></span></span>
        </a>
    </li>
    <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-pill"></i> <span> OBAT </span>
            <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
        <ul class="list-unstyled">
            <li>
                <a href="<?= base_url() ?>/View-obat-masuk">
                    RIWAYAT OBAT MASUK
                </a>
            </li>
            <li>
                <a href="<?= base_url() ?>/View-obat-keluar">
                    RIWAYAT OBAT KELUAR
                </a>
            </li>
            <li>
                <a href="<?= base_url() ?>/View-obat">
                    STOK OBAT
                </a>
            </li>
            <li>
                <a href="<?= base_url() ?>/Antrian-obat">
                    ANTRIAN RESEP OBAT
                </a>
            </li>
        </ul>

    </li>
    <?php
    if ($role1 == 'Administrator') {
    ?>

        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-database"></i> <span> MASTER DATA
                </span>
                <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">
                <li>
                    <a href="<?= base_url() ?>/View-pasien">
                        DATA PASIEN
                    </a>
                </li>




                <li>
                    <a href="<?= base_url() ?>/View-layanan">
                        DATA LAYANAN
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>/View-kunjungan">
                        DATA KUNJUNGAN PASIEN
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>/View-rekam-medis">
                        DATA REKAM MEDIS PASIEN
                    </a>
                </li>
            </ul>

        </li>

        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-arrow-right-bold-circle "></i> <span> Layanan
                </span>
                <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">
                <li>
                    <a href="<?= base_url() ?>/Proses-berobat">
                        PENDFATARAN PASIEN
                    </a>


                </li>
            </ul>

        </li>
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart"></i> <span> KASIR</span>
                <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">
                <li>
                    <a href="<?= base_url() ?>/Antrian">
                        ANTRIAN TRANSAKSI
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>/Riwayat">
                        RIWAYAT TRANSAKSI
                    </a>
                </li>
            </ul>

        </li>
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-chart-bar"></i> <span> LAPORAN </span>
                <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">
                <li>
                    <a href="<?= base_url() ?>/Laporan">
                        CETAK LAPORAN
                    </a>
                </li>
            </ul>

        </li>

    <?php

    } elseif ($role1 == 'Dokter') {
    ?>


        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-arrow-right-bold-circle "></i> <span> Layanan
                </span>
                <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">
                <li>
                    <a href="<?= base_url() ?>/Berobat">
                        PEMERIKSAAN PASIEN
                    </a>
                </li>
            </ul>

        </li>
    <?php
    }
    ?>

    <?php
    if ($role2 == 'Administrator') {
    ?>

        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-database"></i> <span> MASTER DATA
                </span>
                <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">
                <li>
                    <a href="<?= base_url() ?>/View-pasien">
                        DATA PASIEN
                    </a>
                </li>




                <li>
                    <a href="<?= base_url() ?>/View-layanan">
                        DATA LAYANAN
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>/View-kunjungan">
                        DATA KUNJUNGAN PASIEN
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>/View-rekam-medis">
                        DATA REKAM MEDIS PASIEN
                    </a>
                </li>
            </ul>

        </li>

        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-arrow-right-bold-circle "></i> <span> Layanan
                </span>
                <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">
                <li>
                    <a href="<?= base_url() ?>/Proses-berobat">
                        PEMERIKSAAN PASIEN
                    </a>


                </li>
            </ul>

        </li>
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart"></i> <span> KASIR </span>
                <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">
                <li>
                    <a href="<?= base_url() ?>/Antrian">
                        ANTRIAN TRANSAKSI
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>/Riwayat">
                        RIWAYAT TRANSAKSI
                    </a>
                </li>
            </ul>

        </li>
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-chart-bar"></i><span> LAPORAN </span>
                <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">
                <li>
                    <a href="<?= base_url() ?>/Laporan">
                        CETAK LAPORAN
                    </a>
                </li>
            </ul>

        </li>
    <?php

    } elseif ($role2 == 'Dokter') {
    ?>


        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-arrow-right-bold-circle "></i> <span> Layanan
                </span>
                <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">
                <li>
                    <a href="<?= base_url() ?>/Berobat">
                        PEMERIKSAAN PASIEN
                    </a>
                </li>
            </ul>

        </li>
    <?php
    }
    ?>
<?php
} else {
?>
    <li>
        <a href="<?= base_url() ?>/Beranda" class="waves-effect">
            <i class="mdi mdi-airplay"></i>
            <span> BERANDA <span class="badge badge-pill badge-primary float-right"></span></span>
        </a>
    </li>

    <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-arrow-right-bold-circle "></i> <span> Layanan
            </span>
            <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
        <ul class="list-unstyled">
            <li>
                <a href="<?= base_url() ?>/Berobat">
                    PEMERIKSAAN PASIEN
                </a>
            </li>
        </ul>

    </li>
    <?php
    if ($role1 == 'Administrator') {
    ?>

        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-database"></i> <span> MASTER DATA
                </span>
                <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">
                <li>
                    <a href="<?= base_url() ?>/View-pasien">
                        DATA PASIEN
                    </a>
                </li>




                <li>
                    <a href="<?= base_url() ?>/View-layanan">
                        DATA LAYANAN
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>/View-kunjungan">
                        DATA KUNJUNGAN PASIEN
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>/View-rekam-medis">
                        DATA REKAM MEDIS PASIEN
                    </a>
                </li>
            </ul>

        </li>

        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-arrow-right-bold-circle "></i> <span> Layanan
                </span>
                <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">
                <li>
                    <a href="<?= base_url() ?>/Proses-berobat">
                        PENDAFTARAN PASIEN
                    </a>


                </li>
            </ul>

        </li>
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart"></i> <span> KASIR </span>
                <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">
                <li>
                    <a href="<?= base_url() ?>/Antrian">
                        ANTRIAN TRANSAKSI
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>/Riwayat">
                        RIWAYAT TRANSAKSI
                    </a>
                </li>
            </ul>

        </li>
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-chart-bar"></i> <span> LAPORAN </span>
                <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">
                <li>
                    <a href="<?= base_url() ?>/Laporan">
                        CETAK LAPORAN
                    </a>
                </li>
            </ul>

        </li>

    <?php

    } elseif ($role1 == 'Apoteker') {
    ?>


        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-pill"></i> <span> OBAT </span>
                <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">
                <li>
                    <a href="<?= base_url() ?>/View-obat-masuk">
                        RIWAYAT OBAT MASUK
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>/View-obat-keluar">
                        RIWAYAT OBAT KELUAR
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>/View-obat">
                        STOK OBAT
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>/Antrian-obat">
                        ANTRIAN RESEP OBAT
                    </a>
                </li>
            </ul>

        </li>
    <?php
    }
    ?>

    <?php
    if ($role2 == 'Administrator') {
    ?>

        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-database"></i> <span> MASTER DATA
                </span>
                <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">
                <li>
                    <a href="<?= base_url() ?>/View-pasien">
                        DATA PASIEN
                    </a>
                </li>




                <li>
                    <a href="<?= base_url() ?>/View-layanan">
                        DATA LAYANAN
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>/View-kunjungan">
                        DATA KUNJUNGAN PASIEN
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>/View-rekam-medis">
                        DATA REKAM MEDIS PASIEN
                    </a>
                </li>
            </ul>

        </li>

        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-arrow-right-bold-circle "></i> <span> Layanan
                </span>
                <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">
                <li>
                    <a href="<?= base_url() ?>/Proses-berobat">
                        PENDAFTARAN PASIEN
                    </a>


                </li>
            </ul>

        </li>
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart"></i> <span> KASIR</span>
                <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">
                <li>
                    <a href="<?= base_url() ?>/Antrian">
                        ANTRIAN TRANSAKSI
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>/Riwayat">
                        RIWAYAT TRANSAKSI
                    </a>
                </li>
            </ul>

        </li>
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-chart-bar"></i><span> LAPORAN </span>
                <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">
                <li>
                    <a href="<?= base_url() ?>/Laporan">
                        CETAK LAPORAN
                    </a>
                </li>
            </ul>

        </li>
    <?php

    } elseif ($role2 == 'Apoteker') {
    ?>


        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-pill"></i> <span> OBAT </span>
                <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="list-unstyled">
                <li>
                    <a href="<?= base_url() ?>/View-obat-masuk">
                        RIWAYAT OBAT MASUK
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>/View-obat-keluar">
                        RIWAYAT OBAT KELUAR
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>/View-obat">
                        STOK OBAT
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>/Antrian-obat">
                        ANTRIAN RESEP OBAT
                    </a>
                </li>
            </ul>

        </li>
    <?php
    }
    ?>
<?php
}
?>




<?= $this->endsection() ?>