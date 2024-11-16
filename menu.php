<?php
$page = '';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
?>
<li <?php if ($page == "") echo 'class="active"'; ?>><a href="index.php"><i class="fa fa-home fa-fw"></i> <span>Dashboard</span></a></li>

<?php if ($_SESSION['LOG_LEVEL'] == 'Admin') : ?>
    <li <?php if ($page == "gejala" || $page == "update_gejala") echo 'class="active"'; ?>><a href="?page=gejala"><i class="fa fa-tags fa-fw"></i> <span>Data Gejala</span></a></li>
    <li <?php if ($page == "kerusakan" || $page == "update_kerusakan") echo 'class="active"'; ?>><a href="?page=kerusakan"><i class="fa fa-list fa-fw"></i> <span>Data Kerusakan</span></a></li>
    <li <?php if ($page == "gejala_kerusakan" || $page == "update_gejala_kerusakan") echo 'class="active"'; ?>><a href="?page=gejala_kerusakan"><i class="fa fa-book fa-fw"></i> <span>Gejala Kerusakan</span></a></li>
    <li <?php if ($page == "konsultasi" || $page == "proses_konsultasi") echo 'class="active"'; ?>><a href="?page=konsultasi"><i class="fa fa-check fa-fw"></i> <span>Diagnosa</span></a></li>
    <li <?php if ($page == "user" || $page == "update_user") echo 'class="active"'; ?>><a href="?page=user"><i class="fa fa-user fa-fw"></i> <span>Data User</span></a></li>

<?php elseif ($_SESSION['LOG_LEVEL'] == 'Teknisi') : ?>
    <li <?php if ($page == "konsultasi" || $page == "proses_konsultasi") echo 'class="active"'; ?>><a href="?page=konsultasi"><i class="fa fa-check fa-fw"></i> <span>Diagnosa</span></a></li>
<?php endif; ?>

<li <?php if ($page == "password") echo 'class="active"'; ?>><a href="?page=password"><i class="fa fa-unlock-alt fa-fw"></i> <span>Ubah Password</span></a></li>
<li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> <span>Logout</span></a></li>