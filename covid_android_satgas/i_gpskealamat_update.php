<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");


nocache;


//nilai
$dataku = cegah($_GET['dataku']);
$filenya = "$sumber/covid_android_satgas/i_gpskealamat_update.php";



//pecah
$pecahku = explode("xkommax", $dataku);
$data1 = balikin(trim($pecahku[0]));
$data2 = balikin(trim($pecahku[1]));
$data3 = cegah(trim($pecahku[2]));


//echo "[$dataku].[$data1].[$data2].[$data3].";



//update alamat orang
mysqli_query($koneksi, "UPDATE m_orang SET lat_alamat = '$data3' ".
							"WHERE lat_x = '$data1' ".
							"AND lat_y = '$data2'");



//update alamatnya
mysqli_query($koneksi, "UPDATE orang_lokasi SET alamat = '$data3' ".
							"WHERE lat_x = '$data1' ".
							"AND lat_y = '$data2'");
?>