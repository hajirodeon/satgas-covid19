<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;



//ambil nilai
$ekd = cegah($_GET['ekd']);



echo "akuhajir era : $ekd";
?>