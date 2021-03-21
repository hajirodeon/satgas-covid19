<?php
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
	
nocache;




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//lihat gambar
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'lihat'))
	{
	//ambil nilai
	$kd = nosql($_GET['kd']);
	
	//edit
	$qx = mysqli_query($koneksi, "SELECT * FROM m_orang ".
						"WHERE kd = '$kd'");
	$rowx = mysqli_fetch_assoc($qx);
	$e_nip = balikin($rowx['nip']);
	$e_filex1 = balikin($rowx['filex1']);





	//jika edit / baru
	$fotoku = "$sumber/filebox/pegawai/$kd/$e_nip-1.jpg";
	
	//nek ada foto
	if (file_exists($fotoku))
		{
		$nil_foto = "$sumber/filebox/pegawai/$kd/$e_nip-1.jpg";
		}
	else
		{
		$nil_foto = "$sumber/img/foto_blank.png";
		}




	echo '<img src="'.$nil_foto.'" height="200">';
	}
	
	
	

?>