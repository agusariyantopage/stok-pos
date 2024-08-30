<?php
// Variabel Klien
$BASE_URL = "http://localhost/pos/";
$APP_TITLE = "APP POS";
$APP_VERSION = "1.0";
$APP_VERSION_LAST_UPDATE = "30 Agustus 2024";
$APP_COMPANY_NAME = "Bali Tekno Abadi";
$APP_COMPANY_ADDRESS = "DPS (GUDANG)";
$APP_COMPANY_PHONE = "082144096051";
$APP_COMPANY_EMAIL = "info@baliteknoabadi.com";
$APP_LOGO = "dist/img/logo.jpg";
$APP_ICO = "dist/img/logo_eclipse.png";

// Setting Default
$ENABLE_EDIT_HARGA_JUAL = true;
date_default_timezone_set('Asia/Makassar');

$whitelist = array(
    '127.0.0.1',
    '::1'
);

if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
    // Variabel Koneksi Lokal
    $servername     = "localhost";
    $database       = "dbpos";
    $username       = "root";
    $password       = "";
} else {
    // Variabel Koneksi Online
    $servername     ="localhost";
    $database       ="balx9336_dbpos";
    $username       ="balx9336_keuangan";
    $password       ="Doommaster@21";
}




// Koneksi Ke Database
$koneksi = mysqli_connect($servername, $username, $password, $database);
$mysqli = new mysqli($servername, $username, $password, $database); // OOP Style
$mysqli->select_db($database);
$mysqli->query("SET NAMES 'utf8'");


// Cek apakah koneksi berhasil
if (!$koneksi) {
    die("koneksi Ke Database Gagal :" . mysqli_connect_error());
} else {
    //echo "Koneksi Ke Database Berhasil";
}
