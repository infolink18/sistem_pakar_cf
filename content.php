<?php
switch ($page) {
    case 'gejala':
        include "gejala.php";
        break;
    case 'update_gejala':
        include "gejala_update.php";
        break;
    case 'user':
        include "user.php";
        break;
    case 'update_user':
        include "user_update.php";
        break;
    case 'kerusakan':
        include "kerusakan.php";
        break;
    case 'update_kerusakan':
        include "kerusakan_update.php";
        break;
    case 'gejala_kerusakan':
        include "gejala_kerusakan.php";
        break;
    case 'update_gejala_kerusakan':
        include "gejala_kerusakan_update.php";
        break;
    case 'konsultasi':
        include "konsultasi.php";
        break;
    case 'proses_konsultasi':
        include "konsultasi_proses.php";
        break;
    case 'password':
        include "password.php";
        break;

    default:
        include "beranda.php";
        break;
}
