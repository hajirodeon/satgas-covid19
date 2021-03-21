<?php
session_start();

require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



$iro_kec = nosql($_POST['iro_kec']);



if(isset($_POST["iro_kec"]) && !empty($_POST["iro_kec"]))
	{
	echo '<option value="" selected></option>';
	
	$qku = mysqli_query($koneksi, "SELECT * FROM m_ikelurahan ".
							"WHERE id_kecamatan = '$iro_kec' ".
  							"ORDER BY nama_kelurahan ASC");
	$rku = mysqli_fetch_assoc($qku);

	do
		{
		$ku_idkab = nosql($rku['id_kelurahan']);
		$ku_nama = balikin($rku['nama_kelurahan']);

		echo '<option value="'.$ku_idkab.'">'.$ku_nama.'</option>';
		}
	while ($rku = mysqli_fetch_assoc($qku));

	
	exit();
  	}






exit();
?>