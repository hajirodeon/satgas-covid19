<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");



$iro_propinsi = nosql($_POST['iro_propinsi']);
$iro_kota  = nosql($_POST['iro_kota']);
$iro_kec = nosql($_POST['iro_kec']);





if(isset($_POST["iro_propinsi"]) && !empty($_POST["iro_propinsi"]))
	{
	echo '<option value="" selected></option>';
	
	$qku = mysqli_query($koneksi, "SELECT * FROM m_ikabkota ".
							"WHERE id_propinsi = '$iro_propinsi' ".
  							"ORDER BY nama_kabkota ASC");
	$rku = mysqli_fetch_assoc($qku);

	do
		{
		$ku_idkab = nosql($rku['id_kabkota']);
		$ku_nama = balikin($rku['nama_kabkota']);

		echo '<option value="'.$ku_idkab.'">'.$ku_nama.'</option>';
		}
	while ($rku = mysqli_fetch_assoc($qku));

	
	exit();
  	}




if(isset($_POST["iro_kota"]) && !empty($_POST["iro_kota"]))
	{
	echo '<option value="" selected></option>';
	
	$qku = mysqli_query($koneksi, "SELECT * FROM m_ikecamatan ".
							"WHERE id_kabkota = '$iro_kota' ".
  							"ORDER BY nama_kecamatan ASC");
	$rku = mysqli_fetch_assoc($qku);

	do
		{
		$ku_idkec = nosql($rku['id_kecamatan']);
		$ku_nama = balikin($rku['nama_kecamatan']);

		echo '<option value="'.$ku_idkec.'">'.$ku_nama.'</option>';
		}
	while ($rku = mysqli_fetch_assoc($qku));
	
	exit();
  	}





if(isset($_POST["iro_kec"]) && !empty($_POST["iro_kec"]))
	{
	echo '<option value="" selected></option>';
	
	$qku = mysqli_query($koneksi, "SELECT * FROM m_ikelurahan ".
							"WHERE id_kecamatan = '$iro_kec' ".
  							"ORDER BY nama_kelurahan ASC");
	$rku = mysqli_fetch_assoc($qku);

	do
		{
		$ku_idkec = nosql($rku['id_kelurahan']);
		$ku_nama = balikin($rku['nama_kelurahan']);

		echo '<option value="'.$ku_idkec.'">'.$ku_nama.'</option>';
		}
	while ($rku = mysqli_fetch_assoc($qku));
	
	exit();
  	}








exit();
?>