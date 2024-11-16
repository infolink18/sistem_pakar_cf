<?php
$link_data = '?page=gejala_kerusakan';
$link_update = '?page=update_gejala_kerusakan';

$combo_kode_kerusakan = '';
$combo_kode_kerusakan .= '<select class="selectpicker form-control" data-live-search="true" name="kode_kerusakan" id="kode_kerusakan" required><option value="">Pilih...</option>';
$q = "select * from kerusakan order by kode_kerusakan";
$q = mysqli_query($con, $q);
while ($r = mysqli_fetch_array($q)) {
    $combo_kode_kerusakan .= '<option value="' . $r['kode_kerusakan'] . '" data-tokens="' . $r['nama_kerusakan'] . '">' . $r['kode_kerusakan'] . ' - ' . $r['nama_kerusakan'] . '</option>';
}
$combo_kode_kerusakan .= '</select>';
$combo_kode_gejala = '';
$combo_kode_gejala .= '<select class="selectpicker form-control" data-live-search="true" name="kode_gejala" id="kode_gejala" required><option value="">Pilih...</option>';
$q = "select * from gejala order by kode_gejala";
$q = mysqli_query($con, $q);
while ($r = mysqli_fetch_array($q)) {
    $combo_kode_gejala .= '<option value="' . $r['kode_gejala'] . '" data-tokens="' . $r['nama_gejala'] . '">' . $r['kode_gejala'] . ' - ' . $r['nama_gejala'] . '</option>';
}
$combo_kode_gejala .= '</select>';
$nilai_mb = '';
$nilai_md = '';

if (isset($_POST['save'])) {
    $error = '';
    $id = $_POST['id'];
    $action = $_POST['action'];
    $kode_kerusakan = $_POST['kode_kerusakan'];
    $kode_gejala = $_POST['kode_gejala'];
    $nilai_mb = $_POST['nilai_mb'];
    $nilai_md = $_POST['nilai_md'];

    if (empty($error)) {
        if ($action == 'add') {
            $q = "insert into gejala_kerusakan(kode_kerusakan,kode_gejala,nilai_mb,nilai_md) values ('" . $kode_kerusakan . "','" . $kode_gejala . "','" . $nilai_mb . "','" . $nilai_md . "')";
            mysqli_query($con, $q);
            exit("<script>location.href='" . $link_data . "';</script>");
        }
        if ($action == 'edit') {
            $q = "update gejala_kerusakan set kode_kerusakan='" . $kode_kerusakan . "',kode_gejala='" . $kode_gejala . "',nilai_mb='" . $nilai_mb . "',nilai_md='" . $nilai_md . "' where id_gejala_kerusakan='" . $id . "'";
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
        $q = mysqli_query($con, "select * from gejala_kerusakan where id_gejala_kerusakan='" . $id . "'");
        $r = mysqli_fetch_array($q);
        $combo_kode_kerusakan = '';
        $combo_kode_kerusakan .= '<select class="selectpicker form-control" data-live-search="true" name="kode_kerusakan" id="kode_kerusakan" required><option value="">Pilih...</option>';
        $qcmb = "select * from kerusakan order by kode_kerusakan";
        $qcmb = mysqli_query($con, $qcmb);
        while ($rcmb = mysqli_fetch_array($qcmb)) {
            if ($rcmb['kode_kerusakan'] == $r['kode_kerusakan']) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $combo_kode_kerusakan .= '<option value="' . $rcmb['kode_kerusakan'] . '" data-tokens="' . $rcmb['nama_kerusakan'] . '" ' . $selected . '>' . $rcmb['kode_kerusakan'] . ' - ' . $rcmb['nama_kerusakan'] . '</option>';
        }
        $combo_kode_kerusakan .= '</select>';
        $combo_kode_gejala = '';
        $combo_kode_gejala .= '<select class="selectpicker form-control" data-live-search="true" name="kode_gejala" id="kode_gejala" required><option value="">Pilih...</option>';
        $qcmb = "select * from gejala order by kode_gejala";
        $qcmb = mysqli_query($con, $qcmb);
        while ($rcmb = mysqli_fetch_array($qcmb)) {
            if ($rcmb['kode_gejala'] == $r['kode_gejala']) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $combo_kode_gejala .= '<option value="' . $rcmb['kode_gejala'] . '" data-tokens="' . $rcmb['nama_gejala'] . '" ' . $selected . '>' . $rcmb['kode_gejala'] . ' - ' . $rcmb['nama_gejala'] . '</option>';
        }
        $combo_kode_gejala .= '</select>';
        $nilai_mb = $r['nilai_mb'];
        $nilai_md = $r['nilai_md'];
    }
    if ($action == 'delete') {
        $id = $_GET['id'];
        mysqli_query($con, "delete from gejala_kerusakan where id_gejala_kerusakan='" . $id . "'");
        exit("<script>location.href='" . $link_data . "';</script>");
    }
}
?>
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Data Gejala Kerusakan</h3>
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
                    <?php echo $combo_kode_kerusakan; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="kode_gejala" class="col-sm-2 control-label">Kode Gejala</label>
                <div class="col-sm-4">
                    <?php echo $combo_kode_gejala; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="nilai_mb" class="col-sm-2 control-label">Nilai MB</label>
                <div class="col-sm-4">
                    <input name="nilai_mb" id="nilai_mb" required type="number" step="0.01" min="0" class="form-control" value="<?php echo $nilai_mb; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="nilai_md" class="col-sm-2 control-label">Nilai MD</label>
                <div class="col-sm-4">
                    <input name="nilai_md" id="nilai_md" required type="number" step="0.01" min="0" class="form-control" value="<?php echo $nilai_md; ?>">
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