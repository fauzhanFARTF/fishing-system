<?php
//session_start();
error_reporting(0);
include "../config/session_admin.php";

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pemancingan Persada</title>
    <link rel="icon" href="../admin/assets/img/fishing-logob.png" />
    <!-- BOOTSTRAP STYLES-->
    <link href="../admin/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- ANIMATION STYLES-->
    <link href="../admin/assets/css/animate.min.css" rel="stylesheet" />
    <link href="../admin/assets/css/Chart.min.css" rel="stylesheet" />
    <!-- ALERT STYLES-->
    <link href="../admin/assets/css/sweetalert2.min.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="../admin/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="../admin/assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="../admin/assets/js/dataTables/dataTables.bootstrap.css" />

    <style>
        .swal2-popup {
            font-size: 1.6rem !important;
        }
    </style>

</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">PERSADA</a>
            </div>
            <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> &nbsp; <a href="../config/loguot.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center">
                        <!-- <img src="../admin/assets/img/fishing-logo1.png" class="user-image img-responsive" /> -->
                    </li>

                    <li>
                        <a href="?halaman=awal"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"></i> User dan Jenis Kolam<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="?halaman=manajemen_kolam"><i class="fa fa-external-link fa-3x"></i> Kolam</a>
                            </li>

                            <li>
                                <a href="?halaman=manajemen_user"><i class="fa fa-user fa-3x"></i> Users</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"></i> Pemesanan <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="?halaman=manajemen_pesanan"><i class="fa fa-external-link fa-3x"></i> Pemesanan</a>
                            </li>
                            <li>
                                <a href="?halaman=manajemen_pesananbatal"><i class="fa fa-user fa-3x"></i> Pemesanan Ditolak</a>
                            </li>
                        </ul>
                    </li>
                    <!-- <li>
                        <a href="?halaman=manajemen_pesanan"><i class="fa fa-envelope-o fa-3x"></i> Pesanan</a>
                    </li> -->
                    <li>
                        <a href="?halaman=manajemen_konfirmasi"><i class="fa fa-check-circle fa-3x"></i> Pembayaran <span class="badge badge-light" id="notif"></span></a>
                    </li>
                    <li>
                        <a href="?halaman=manajemen_laporan"><i class="fa fa-file fa-3x"></i> Laporan</a>
                    </li>
                    <li>
                        <a href="?halaman=manajemen_rekening"><i class="fa fa-credit-card fa-3x"></i> Rekening</a>
                    </li>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Page</h2>
                        <?php
                        include "content.php";
                        ?>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    
    <script src="../admin/assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="../admin/assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../admin/assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="../admin/assets/js/custom.js"></script>
    <!-- ALERT SCRIPTS -->
    <script src="../admin/assets/js/sweetalert2.min.js"></script>
    <script src="../admin/assets/js/Chart.min.js"></script>


    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type="text/javascript" src="../admin/assets/js/dataTables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="../admin/assets/js/dataTables/dataTables.bootstrap.js"></script>


</body>

</html>