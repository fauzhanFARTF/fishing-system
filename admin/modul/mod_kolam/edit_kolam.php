<?php

error_reporting(0);

include '../../../config/koneksi.php';

$id_kolam = $_GET['id_kolam'];

$edit    = "SELECT id_kolam, title, detail, pic, harga, kapasitas FROM tm_kolam WHERE id_kolam = '$id_kolam'";
$hasil   = mysqli_query($conn, $edit) or die(mysqli_error($conn));
$data    = mysqli_fetch_array($hasil);
?>

<div class="col-md-10">
    <h3>
        <div align="center">Edit Info kolam</div>
    </h3>
    <br><br><br>
    <form enctype="multipart/form-data" class="form-horizontal" action="..\admin\modul\mod_kolam\update_kolam.php" method="POST">
        <input type="hidden" name="id_kolam" value="<?php echo $id_kolam ?>">
        <div class="form-group">
            <label class="control-label col-sm-4" for="title">Title :</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="title" value="<?php echo $data['title']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="detail">Detail :</label>
            <div class="col-sm-6">
                <textarea rows='3' type="text" class="form-control" name="detail" value=""><?php echo $data['detail']; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="pic">Picture :</label>
            <div class="col-sm-6">
                <img src="../uploads/<?php echo $data['pic']; ?>" class="img-thumbnail" alt="Cinque Terre"><br><br>
                <p3>Pilih Gambar :</p3><br><br>
                <input type="file" class="form-control" name="pic" id="pic">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="harga">Harga :</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="harga" value="<?php echo $data['harga']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="kapasitas">Kapasitas :</label>
            <div class="col-sm-6">
                <input type="number" class="form-control" name="kapasitas" value="<?php echo $data['kapasitas']; ?>" readonly="on">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4"></label>
            <div class="col-sm-6" align="right">
                <button class="btn btn-danger" name="submit">Update</button>
            </div>
        </div>
    </form>
</div>