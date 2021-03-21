<?php
//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
$tpl = LoadTpl("template/cp_depan.html");


nocache;

//nilai
$filenya = "index.php";
$judul = "SATGASCOVID-19 BIASAWAE";




//isi *START
ob_start();



require("i_terbaru.php");


//isi
$i_terbaru = ob_get_contents();
ob_end_clean();









require("inc/niltpl.php");


//diskonek
xclose($koneksi);
exit();
?>