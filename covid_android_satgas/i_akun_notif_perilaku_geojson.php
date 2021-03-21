<?php
session_start();



//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");







//ambil session
$kd = balikin($_SESSION['kd']);
$pkd = balikin($_SESSION['pkd']);







//detail
$qx = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
					"WHERE kd = '$pkd'");
$rowx = mysqli_fetch_assoc($qx);
$i_lat_x = balikin($rowx['lat_x']);
$i_lat_y = balikin($rowx['lat_y']);


echo "$i_lat_x, $i_lat_y";

?>