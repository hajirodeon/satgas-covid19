<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_mn_panic_tolong.php";
$filenyax = "$sumber/covid_android_satgas/i_mn_panic_tolong.php";
$judul = "Data PANIC TOLONG";
$juduli = $judul;



//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];






?>

tolong