<?php

error_reporting(0);

include '../../../config/koneksi.php';

$no_rek = $_GET['no_rek'];

$edit    = "SELECT * FROM tm_rekening WHERE no_rek = '$no_rek'";
$hasil   = mysqli_query($conn, $edit) or die(mysqli_error($conn));
$data    = mysqli_fetch_array($hasil);
?>

<div class="col-md-10">
    <h3>
        <div align="center">Edit Info Rekening</div>
    </h3>
    <br><br><br>
    <form class="form-horizontal" action="..\admin\modul\mod_rekening\update_rekening.php" method="POST">
        <div class="form-group">
            <label class="control-label col-sm-4" for="no_rek">No.Rekening :</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="no_rek" value="<?php echo $data['no_rek']; ?>" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="bank">Nama Bank :</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="bank" value="<?php echo $data['bank']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="atas_nama">Atas Nama :</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="atas_nama" value="<?php echo $data['atas_nama']; ?>">
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