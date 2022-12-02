<?php

error_reporting(0);

include '../../../config/koneksi.php';

$nik = $_GET['nik'];

$edit    = "SELECT * FROM tm_user WHERE nik = '$nik'";
$hasil   = mysqli_query($conn, $edit) or die(mysqli_error($conn));
$data    = mysqli_fetch_array($hasil);
?>

<div class="col-md-10">
    <h3>
        <div align="center">Edit Info User</div>
    </h3>
    <br><br><br>
    <form class="form-horizontal" action="..\admin\modul\mod_user\update_user.php" method="POST">
        <input type="hidden" name="nik" value="<?php echo $nik ?>">
        <div class="form-group">
            <label class="control-label col-sm-4" for="username">Username :</label>
            <div class="col-sm-6">
                <input type="username" class="form-control" name="username" value="<?php echo $data['username']; ?>">
            </div>
        </div>
        <!-- <div class="form-group">
            <label class="control-label col-sm-4" for="password">Password :</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" name="password" value="<?php echo $data['password']; ?>">
            </div>
        </div> -->
        <div class="form-group">
            <label class="control-label col-sm-4" for="nama_lengkap">Nama Lengkap :</label>
            <div class="col-sm-6">
                <textarea type="text" class="form-control" name="nama_lengkap"><?php echo $data['nama_lengkap']; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="email">Email :</label>
            <div class="col-sm-6">
                <input type="email" class="form-control" name="email" value="<?php echo $data['email']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="alamat">Alamat :</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="alamat" value="<?php echo $data['alamat']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="no_telp">No.Telp :</label>
            <div class="col-sm-6">
                <input type="tel" class="form-control" name="no_telp" value="<?php echo $data['no_telp']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="no_telp">Level</label>
            <div class="col-sm-6">
                <select type="level" class="form-control" name="level" ?>">
                    <option><?= $data['level']; ?></option>
                    <option>admin</option>
                    <option>member</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4"></label>
            <div class="col-sm-6" align="right">
                <button class="btn btn-danger">Update</button>
            </div>
        </div>
    </form>
</div>