<?php
if (isset($_POST['proses'])) {

    $link_konsultasi = '?page=konsultasi';
    $jml_nol_koma = 3; //jumlah angka dibelakang koma
    $hasil = array();
    $x = 0;
    $base_domain = "http://localhost/sistem_pakar_cf"; //base domain untuk keperluan load CSS cetak hasil konsultasi

    // -------- perhitungan metode certainty factor (CF) ---------
    // --------------------- START ------------------------
    $sqlkerusakan = mysqli_query($con, "SELECT * FROM kerusakan order by kode_kerusakan");
    while ($rkerusakan = mysqli_fetch_array($sqlkerusakan)) {
        $kode_kerusakan = $rkerusakan['kode_kerusakan'];
        $cf_old = 0;
        $cf = 0;

        $sql = mysqli_query($con, "SELECT * FROM gejala_kerusakan where kode_kerusakan='{$kode_kerusakan}'");
        while ($rgejala = mysqli_fetch_array($sql)) {
            for ($i = 0; $i < count($_POST['gejala']); $i++) {
                $gejala = $_POST['gejala'][$i];

                if ($rgejala['kode_gejala'] == $gejala) {
                    $cf = $rgejala['nilai_mb'] - $rgejala['nilai_md'];

                    if ($i > 0) {
                        $cf_old = $cf_old + $cf * (1 - $cf_old);
                    } else {
                        $cf_old = $cf;
                    }
                }
            }
        }

        if ($cf_old > 0) {
            $hasil[$x]["kode_kerusakan"] = $kode_kerusakan;
            $hasil[$x]["nilai"] = $cf_old * 100;
            $x++;
        }
    }
    // --------------------- END -------------------------

    // fungsi untuk mengurutkan nilai berdasarkan nilai terbesar
    function array_sort_by_column(&$arr, $col, $dir = SORT_DESC)
    {
        $sort_col = array();
        foreach ($arr as $key => $row) {
            $sort_col[$key] = $row[$col];
        }
        array_multisort($sort_col, $dir, $arr);
    }
    array_sort_by_column($hasil, 'nilai');

    //tampilkan hasil kedalam tabel
    $no = 0;
    $list_rekomendasi = '';
    $tbl_penanganan = '';
    foreach ($hasil as $arr) {
        $no++;
        $rkerusakan = mysqli_fetch_array(mysqli_query($con, "select * from kerusakan where kode_kerusakan='" . $arr['kode_kerusakan'] . "'"));
        if ($arr['nilai'] > 0) {
            $list_rekomendasi .= '
		<tr>
			<td>' . $no . '</td>
			<td>' . $rkerusakan['nama_kerusakan'] . '</td>
			<td>' . round($arr['nilai'], $jml_nol_koma) . ' %</td>
		</tr>
		';
        }
        if ($tbl_penanganan == '') {
            $tbl_penanganan .= '
		<tr>
			<td width="120">Hasil Kerusakan</td>
			<td><strong>' . $rkerusakan['kode_kerusakan'] . ' - ' . $rkerusakan['nama_kerusakan'] . '</strong></td>
		</tr>
        <tr>
			<td>Penanganan</td>
			<td style="white-space: pre-wrap; word-wrap: break-word;">' . $rkerusakan['keterangan'] . '</td>
		</tr>
		';
        }
    }

    //tabel gejala yang dipilih
    $list_data = '';
    for ($i = 0; $i < count($_POST['gejala']); $i++) {
        $no = $i + 1;
        $kode_gejala = $_POST['gejala'][$i];
        $rgejala = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM gejala where kode_gejala = '{$kode_gejala}'"));
        $list_data .= '
	<tr>
		<td>' . $no . '</td>
		<td>' . $rgejala['kode_gejala'] . ' - ' . $rgejala['nama_gejala'] . '</td>
	</tr>
	';
    }
?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#btnCetak').on("click", function() {
                $(".cetak").printThis({
                    loadCSS: "<?php echo $base_domain; ?>/assets/css/bootstrap.min.css",
                    importStyle: true
                });
            });
        });
    </script>
<div class="box box-default">
        <div class="box-header with-border">
        <h3 class="box-title cetak">  <table width = "100%">
     </table >
    </h3>
            <h3 class="box-title cetak">
            <table align="right" border="0" cellpadding="1">
<tr>
<td>
    <img src="<?php echo $base_domain; ?>/assets/images/logo.png" width="250" height="100">
    <td width="250">
    <td>
<font size="4" align="Right"><b>PT. SIBER TECH INDONESIA</b></font><br>
<font size="1" align="Right">Jl. Raya Tanjung Lesung Km. 01 Panimbangjaya, Panimbang,Pandeglang Banten 42281</font><br>
<font size="1" align="Right">Email : info@siber.net.id Phone : 08111436444 Website : www.siber.net.id</font><br>
</tr>
</table>
</h3></div>
<div class="box box-default">
        <div class="box-header with-border">
        <h3 class="box-title cetak">  <table width = "100%">
     </table >
    </h3>
            <h3 class="box-title cetak">Hasil Diagnosa</h3>
        </div>
        <div class="box-body">
            <div class='table-responsive'>
                <table class='table table-striped table-bordered cetak'>
                    <thead>
                        <tr>
                            <th width="40">No</th>
                            <th>Gejala yang dipiilh</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $list_data; ?>
                    </tbody>
                </table>
            </div>
            <h3 class="page-header cetak">Hasil Penilaian</h3>
            
            <div class='table-responsive'>
                <table class='table table-bordered cetak'>
                    <tbody>
                        <?php echo $tbl_penanganan; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box box-default">
        <div class="box-header with-border">
        <h5 class="box-title cetak">  <table width = "80%">
            <table align=right border=0 cellpadding=20>                            
                            <tr>
                            <td> <class=text align=center>Mengetahui,<br>Kepala Teknisi<br><br><br><br><br><br>
                            SUKANTA
                            <tr>
                            <table>
                            <tr>
    </table>
    </h5>
        <div class="box-footer">
            <div class="text-center col-sm-12">
                <a href="<?php echo $link_konsultasi; ?>" class="btn btn-danger">Ulangi Diagnosa</a> &nbsp;
                <a id="btnCetak" href="#" class="btn btn-success">Cetak</a>
            </div>
        </div>
    </div>
<?php } ?>