<?php
$link_data = '?page=user';
$link_update = '?page=update_user';

$list_data = '';
$q = "select * from user order by id_user";
$q = mysqli_query($con, $q);
if (mysqli_num_rows($q) > 0) {
    while ($r = mysqli_fetch_array($q)) {
        $id = $r['id_user'];
        $list_data .= '
		<tr>
		<td></td>
		<td>' . $r['nama_user'] . '</td>
		<td>' . $r['username'] . '</td>
		<td>' . $r['level'] . '</td>
		<td>
            <a href="' . $link_update . '&id=' . $id . '&action=edit" class="btn btn-success btn-xs" title="Ubah">Ubah</a> &nbsp;
			<a href="#" data-href="' . $link_update . '&id=' . $id . '&action=delete" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-xs" title="Hapus">Hapus</a>
        </td>
		</tr>';
    }
}
?>
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Data User</h3>
        <div class="box-tools">
            <a href="<?php echo $link_update; ?>" class="btn btn-primary">Tambah User</a>
        </div>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="dataTables1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Username</th>
                        <th>Level</th>
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