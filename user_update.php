<?php
$link_data = '?page=user';
$link_update = '?page=update_user';

$nama_user = '';
$username = '';
$password = '';
$level = '';

if (isset($_POST['save'])) {
    $error = '';
    $id = $_POST['id'];
    $action = $_POST['action'];
    $nama_user = $_POST['nama_user'];
    $username = $_POST['username'];
    $level = $_POST['level'];

    if ($action == 'add') {
        if (mysqli_num_rows(mysqli_query($con, "select * from user where username='" . $username . "'")) > 0) {
            $error = 'Username sudah ada';
        } else {
            $password = $_POST['password'];
            $q = "insert into user(username,password,nama_user,level) values ('" . $username . "','" . $password . "','" . $nama_user . "','" . $level . "')";
            mysqli_query($con, $q);
            exit("<script>location.href='" . $link_data . "';</script>");
        }
    }
    if ($action == 'edit') {
        $q = mysqli_query($con, "select * from user where id_user='" . $id . "'");
        $r = mysqli_fetch_array($q);
        $username_tmp = $r['username'];
        if (mysqli_num_rows(mysqli_query($con, "select * from user where username='" . $username . "' and username<>'" . $username_tmp . "'")) > 0) {
            $error = 'Username sudah ada';
        } else {
            $q = "update user set username='" . $username . "',nama_user='" . $nama_user . "',level='" . $level . "' where id_user='" . $id . "'";
            mysqli_query($con, $q);
            exit("<script>location.href='" . $link_data . "';</script>");
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
        $q = mysqli_query($con, "select * from user where id_user='" . $id . "'");
        $r = mysqli_fetch_array($q);
        $nama_user = $r['nama_user'];
        $username = $r['username'];
        $level = $r['level'];
    }
    if ($action == 'delete') {
        $id = $_GET['id'];
        mysqli_query($con, "delete from user where id_user='" . $id . "'");
        exit("<script>location.href='" . $link_data . "';</script>");
    }
}
?>
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Data User</h3>
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
                <label for="nama_user" class="col-sm-2 control-label">Nama User</label>
                <div class="col-sm-4">
                    <input name="nama_user" id="nama_user" class="form-control" required type="text" value="<?php echo $nama_user; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-4">
                    <input name="username" id="username" class="form-control" required type="text" value="<?php echo $username; ?>">
                </div>
            </div>
            <?php if ($action == "add") : ?>
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-4">
                        <input name="password" id="password" required type="password" class="form-control" value="<?php echo $password; ?>">
                    </div>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="level" class="col-sm-2 control-label">Level</label>
                <div class="col-sm-4">
                    <select name="level" id="level" class="form-control" required>
                        <option value="">- Pilih -</option>
                        <option value="Admin" <?php echo $level == 'Admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="Teknisi" <?php echo $level == 'Teknisi' ? 'selected' : '' ?>>Teknisi</option>
                    </select>
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