<?php
session_start();

//ambil nilai
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/adm/perilaku/i_cari_nama.php";
$filenyax = "$sumber/adm/perilaku/i_cari_nama.php";
$judul = "cari nama";
$juduli = $judul;



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//nilai
$searchTerm = cegah($_GET['term']); 

$sql="SELECT * FROM m_orang ".
		"WHERE nama LIKE '%".$searchTerm."%' ".
		"OR nip LIKE '%".$searchTerm."%' ".
		"OR tipe_user LIKE '%".$searchTerm."%' ".
		"ORDER BY nama ASC LIMIT 0,5";
$hasil=mysqli_query($koneksi,$sql); 


while ($row = mysqli_fetch_array($hasil)) 
	{
	//user kd
	$kdku = nosql($row['kd']);
	$namaku = balikin($row['nama']);
	$userku = balikin($row['tipe_user']);
	$nikku = balikin($row['nip']);
	
	
	/*
	//koordinat terakhir..
	$qku = mysqli_query($koneksi, "SELECT * FROM orang_lokasi ".
							"WHERE orang_kd = '$kdku' ".
							"AND alamat <> '' ".
							"ORDER BY postdate DESC LIMIT 0,1");
	$ryuk = mysqli_fetch_assoc($qku);
	$yuk_lat_x = balikin($ryuk['lat_x']);
	$yuk_lat_y = balikin($ryuk['lat_y']);
	$yuk_alamat = balikin($ryuk['alamat']);
	*/

	
	//$nilku = $yuk_alamat;
	$data[] = array("value1"=>$kdku,"label"=>"$namaku [$userku][$nikku]");
	}


echo json_encode($data);


exit();
?>