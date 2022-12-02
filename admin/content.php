<?php
include "../config/koneksi.php";
//include "../config/session_admin.php";

if (isset($_GET['halaman'])) $halaman = $_GET['halaman'];
else $halaman = "index";

if ($halaman == 'awal')
    include 'awal.php';

elseif ($halaman == 'manajemen_user')
    include '../admin/modul/mod_user/info_user.php';

elseif ($halaman == 'manajemen_konfirmasi')
    include '../admin/modul/mod_konfirmasi/info_konfirmasi.php';

elseif ($halaman == 'manajemen_kolam')
    include '../admin/modul/mod_kolam/info_kolam.php';

elseif ($halaman == 'manajemen_rekening')
    include '../admin/modul/mod_rekening/info_rekening.php';

elseif ($halaman == 'manajemen_pesanan')
    include '../admin/modul/mod_pesanan/info_pesanan.php';

elseif ($halaman == 'manajemen_pesananbatal')
    include '../admin/modul/mod_pesanan/pesanan_batal.php';

elseif ($halaman == 'manajemen_laporan')
    include '../admin/modul/mod_laporan/info_laporan.php';

elseif ($halaman == 'cetak')
    include '../admin/modul/mod_laporan/cetak_laporan.php';



//halaman edit
elseif ($halaman == 'edit_user')
    include '../admin/modul/mod_user/edit_user.php';
elseif ($halaman == 'edit_kolam')
    include '../admin/modul/mod_kolam/edit_kolam.php';
elseif ($halaman == 'edit_rekening')
    include '../admin/modul/mod_rekening/edit_rekening.php';
elseif ($halaman == 'edit_pesanan')
    include '../admin/modul/mod_pesanan/edit_pesanan.php';
elseif ($halaman == 'edit_konfirmasi')
    include 'edit_konfirmasi.php';
elseif ($halaman == 'konfirmasi')
    include '../admin/modul/mod_konfirmasi/konfirmasi.php';
