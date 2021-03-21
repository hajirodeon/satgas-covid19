<?php
session_start();

require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



$iro_kec = cegah($_POST['iro_kec']);



if(isset($_POST["iro_kec"]) && !empty($_POST["iro_kec"]))
	{
	echo '<option value="" selected></option>';
	
	$qku = mysqli_query($koneksi, "SELECT * FROM p_m_produk ".
							"WHERE kategori = '$iro_kec' ".
  							"ORDER BY nama ASC");
	$rku = mysqli_fetch_assoc($qku);

	do
		{
		$ku_nama = balikin($rku['nama']);

		echo '<option value="'.$ku_nama.'">'.$ku_nama.'</option>';
		}
	while ($rku = mysqli_fetch_assoc($qku));

	
	exit();
  	}






exit();
?>