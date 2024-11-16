<?php
$link_data = '?page=kerusakan';
$link_update = '?page=update_kerusakan';

$list_data = '';
$q = "select * from kerusakan order by kode_kerusakan";
$q = mysqli_query($con, $q);
if (mysqli_num_rows($q) > 0) {
    while ($r = mysqli_fetch_array($q)) {
        $id = $r['kode_kerusakan'];
        $list_data .= '
		<tr>
		<td></td>
		<td>' . $r['kode_kerusakan'] . '</td>
		<td>' . $r['nama_kerusakan'] . '</td>
		<td>
		<a href="' . $link_update . '&id=' . $id . '&action=edit" class="btn btn-success btn-xs" title="Ubah">Ubah</a> &nbsp;
		<a href="#" data-href="' . $link_update . '&id=' . $id . '&action=delete" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-xs" title="Hapus">Hapus</a></td>
		</tr>';
    }
}
?>
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Data Kerusakan</h3>
        <div class="box-tools">
            <a href="<?php echo $link_update; ?>" class="btn btn-primary">Tambah Kerusakan</a>
        </div>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="dataTables1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Kerusakan</th>
                        <th>Nama Kerusakan</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $list_data; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>