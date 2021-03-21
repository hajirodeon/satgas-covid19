<?php
//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
$tpl = LoadTpl("template/cp_tentang_kami.html");


nocache;

//nilai
$filenya = "tentang_kami.php";
$judul = "Tentang Kami";




//isi *START
ob_start();



//isi
$isi = ob_get_contents();
ob_end_clean();









require("inc/niltpl.php");


//diskonek
xclose($koneksi);
exit();
?>