<?php
$session = \config\services::session()
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?= $title; ?></title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>


    <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->

    <link rel="icon" href="<?= base_url() ?>/assets/images/logo.png">
    <link href="<?= base_url() ?>/assets/plugins/morris/morris.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>/assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>/assets/plugins/package/dist/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <script src="<?= base_url() ?>/assets/plugins/package/dist/sweetalert2.all.min.js"></script>


</head>


<body class="fixed-left">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                <i class="ion-close"></i>
            </button>

            <!-- LOGO -->
            <div class="topbar-left m-b-5">
                <div class="text-center">
                    <a href="<?= base_url() ?>/Beranda" class="logo">KLINIK DR. YANTI</a><a
                        style="font-weight:bold;"></a>

                    <!-- <a href="index.html" class="logo"><img src="assets/images/logo.png" height="24" alt="logo"></a> -->
                </div>
            </div>

            <div class="sidebar-inner slimscrollleft">

                <div id="sidebar-menu">
                    <ul>
                        <li class="menu-title">MENU UTAMA</li>

                        <?= $this->renderSection('Menu') ?>

                    </ul>
                </div>
                <div class="clearfix"></div>
            </div> <!-- end sidebarinner -->
        </div>
        <!-- Left Sidebar End -->

        <!-- Start right Content here -->

        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                <!-- Top Bar Start -->
                <div class="topbar">

                    <nav class="navbar-custom">

                        <ul class="list-inline float-right mb-0">
                            <li class="list-inline-item dropdown notification-list">

                                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user"
                                    data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                    aria-expanded="false">

                                    <?php
                                    $this->db = \config\Database::connect();
                                    $session = \config\services::session();
                                    $id_user = $session->get('id_user');
                                    $query_cekuser = $this->db->query("SELECT * from tbl_user  WHERE id_user='$id_user'");
                                    $row = $query_cekuser->getRow();

                                    ?>
                                    <span style="color: dimgray;" class="mr-2 d-none d-lg-inline text-gray-600 small">
                                        Welcome!, <?= $row->nama_user ?></span>
                                    <img src="<?= base_url() ?>/assets/images/profil/<?= $row->foto ?>" alt="user"
                                        class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        Welcome
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?= base_url() ?>/Logout"><i
                                            class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                                </div>
                            </li>

                        </ul>

                        <ul class="list-inline menu-left mb-0">
                            <li class="float-left">
                                <button class="button-menu-mobile open-left waves-light waves-effect">
                                    <i class="mdi mdi-menu"></i>
                                </button>
                            </li>

                        </ul>

                        <div class="clearfix"></div>

                    </nav>

                </div>
                <!-- Top Bar End -->

                <div class="page-content-wrapper ">

                    <div class="container-fluid">

                        <!-- conten -->
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <div class="btn-group float-right">
                                        <ol class="breadcrumb hide-phone p-0 m-0">
                                            <li style="color:#2148C0;" class="breadcrumb-item">SISTEM</li>
                                            <li style="color:#2148C0;" class="breadcrumb-item active"><?= $page ?>
                                            </li>
                                        </ol>
                                    </div>
                                    <h4 style="font-weight: 600;" class="page-title">SISTEM INFORMASI KLINIK DR.YANTI
                                    </h4>
                                </div>

                            </div>

                        </div>
                        <?= $this->renderSection('Konten') ?>


                        <!-- conten end -->
                        <!-- end page title end breadcrumb -->

                    </div><!-- container -->

                </div> <!-- Page content Wrapper -->

            </div> <!-- content -->


            <footer class="footer">
                © 2022 Klinik Dr.yanti
            </footer>

        </div>
        <!-- End Right content here -->

    </div>
    <!-- END wrapper -->


    <!-- jQuery  -->

    <script src="<?= base_url() ?>/assets/js/popper.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/modernizr.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/detect.js"></script>
    <script src="<?= base_url() ?>/assets/js/fastclick.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery.slimscroll.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery.blockUI.js"></script>
    <script src="<?= base_url() ?>/assets/js/waves.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery.nicescroll.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery.scrollTo.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/skycons/skycons.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/raphael/raphael-min.js"></script>


    <!-- App js -->
    <script src="<?= base_url() ?>/assets/js/app.js"></script>

</body>

</html>