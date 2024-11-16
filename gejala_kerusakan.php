<?php
$link_data = '?page=gejala_kerusakan';
$link_update = '?page=update_gejala_kerusakan';

$list_data = '';
$q = "select * from gejala_kerusakan order by id_gejala_kerusakan";
$q = mysqli_query($con, $q);
if (mysqli_num_rows($q) > 0) {
    while ($r = mysqli_fetch_array($q)) {
        $id = $r['id_gejala_kerusakan'];
        $r_kerusakan = mysqli_fetch_array(mysqli_query($con, "select * from kerusakan where kode_kerusakan='" . $r['kode_kerusakan'] . "'"));
        $r_gejala = mysqli_fetch_array(mysqli_query($con, "select * from gejala where kode_gejala='" . $r['kode_gejala'] . "'"));
        $list_data .= '
		<tr>
		<td></td>
		<td>' . $r_kerusakan['kode_kerusakan'] . ' - ' . $r_kerusakan['nama_kerusakan'] . '</td>
		<td>' . $r_gejala['kode_gejala'] . ' - ' . $r_gejala['nama_gejala'] . '</td>
		<td>' . $r['nilai_mb'] . '</td>
		<td>' . $r['nilai_md'] . '</td>
		<td>
		<a href="' . $link_update . '&id=' . $id . '&action=edit" class="btn btn-success btn-xs" title="Ubah">Ubah</a> &nbsp;
		<a href="#" data-href="' . $link_update . '&id=' . $id . '&action=delete" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-xs" title="Hapus">Hapus</a></td>
		</tr>';
    }
}
?>
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Data Gejala Kerusakan</h3>
        <div class="box-tools">
            <a href="<?php echo $link_update; ?>" class="btn btn-primary">Tambah Gejala Kerusakan</a>
        </div>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="dataTables1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Kerusakan</th>
                        <th>Kode Gejala</th>
                        <th>Nilai MB</th>
                        <th>Nilai MD</th>
                        <th width="80">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $list_data; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>