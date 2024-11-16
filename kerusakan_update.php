<?php
$link_data = '?page=kerusakan';
$link_update = '?page=update_kerusakan';

$kode_kerusakan = '';
$nama_kerusakan = '';
$keterangan = '';

if (isset($_POST['save'])) {
    $error = '';
    $id = $_POST['id'];
    $action = $_POST['action'];
    $kode_kerusakan = $_POST['kode_kerusakan'];
    $nama_kerusakan = $_POST['nama_kerusakan'];
    $keterangan = $_POST['keterangan'];

    if (empty($error)) {
        if ($action == 'add') {
            if (mysqli_num_rows(mysqli_query($con, "select * from kerusakan where kode_kerusakan='" . $kode_kerusakan . "'")) > 0) {
                $error = 'Kode Kerusakan sudah ada';
            } else {
                $q = "insert into kerusakan(kode_kerusakan,nama_kerusakan) values ('" . $kode_kerusakan . "','" . $nama_kerusakan . "','" . $keterangan . "')";
                mysqli_query($con, $q);
                exit("<script>location.href='" . $link_data . "';</script>");
            }
        }
        if ($action == 'edit') {
            $q = mysqli_query($con, "select * from kerusakan where kode_kerusakan='" . $id . "'");
            $r = mysqli_fetch_array($q);
            $kode_kerusakan_tmp = $r['kode_kerusakan'];
            if (mysqli_num_rows(mysqli_query($con, "select * from kerusakan where kode_kerusakan='" . $kode_kerusakan . "' and kode_kerusakan<>'" . $kode_kerusakan_tmp . "'")) > 0) {
                $error = 'Kode Kerusakan sudah ada';
            } else {
                $q = "update kerusakan set kode_kerusakan='" . $kode_kerusakan . "',nama_kerusakan='" . $nama_kerusakan . "',keterangan='" . $keterangan . "' where kode_kerusakan='" . $id . "'";
                mysqli_query($con, $q);
                exit("<script>location.href='" . $link_data . "';</script>");
            }
        }
    }
} else {
    if (empty($_GET['action'])) {
        $action = 'add';
    } else {
        $action = $_GET['action'];
    }
    if ($action == 'edit') {
        $id = $_GET['id'];
        $q = mysqli_query($con, "select * from kerusakan where kode_kerusakan='" . $id . "'");
        $r = mysqli_fetch_array($q);
        $kode_kerusakan = $r['kode_kerusakan'];
        $nama_kerusakan = $r['nama_kerusakan'];
        $keterangan = $r['keterangan'];
    }
    if ($action == 'delete') {
        $id = $_GET['id'];
        mysqli_query($con, "delete from kerusakan where kode_kerusakan='" . $id . "'");
        exit("<script>location.href='" . $link_data . "';</script>");
    }
}
?>
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Data Kerusakan</h3>
    </div>
    <form class="form-horizontal" action="<?php echo $link_update; ?>" method="post">
        <input name="id" type="hidden" value="<?php echo $id; ?>">
        <input name="action" type="hidden" value="<?php echo $action; ?>">
        <div class="box-body">
            <?php
            if (!empty($error)) {
                echo '<div class="alert bg-danger" role="alert">' . $error . '</div>';
            }
            ?>
            <div class="form-group">
                <label for="kode_kerusakan" class="col-sm-2 control-label">Kode Kerusakan</label>
                <div class="col-sm-4">
                    <input name="kode_kerusakan" id="kode_kerusakan" class="form-control" required type="text" value="<?php echo $kode_kerusakan; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="nama_kerusakan" class="col-sm-2 control-label">Nama Kerusakan</label>
                <div class="col-sm-4">
                    <input name="nama_kerusakan" id="nama_kerusakan" class="form-control" required type="text" value="<?php echo $nama_kerusakan; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="keterangan" class="col-sm-2 control-label">Penanganan</label>
                <div class="col-sm-4">
                    <textarea name="keterangan" id="keterangan" class="form-control" required rows="5"><?php echo $keterangan; ?></textarea>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="text-center col-sm-6">
                <button type="submit" name="save" class="btn btn-success">Simpan</button>
                <a href="<?php echo $link_data; ?>" class="btn btn-danger">Batal</a>
            </div>
        </div>
    </form>
</div>