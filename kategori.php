<?php
session_start();


//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
require("inc/class/paging.php");
$tpl = LoadTpl("template/cp_kategori.html");



nocache;

//nilai
$katkd = nosql($_REQUEST['katkd']);
$filenya = "kategori.php?katkd=$katkd";
$filenyax = "i_index.php";
$filenya_ke = $sumber;






//kategori
$qku2 = mysqli_query($koneksi, "SELECT * FROM cp_m_kategori ".
						"WHERE nama = '$katkd'");
$rku2 = mysqli_fetch_assoc($qku2);
$ku2_kategori = urldecode(balikin($rku2['nama']));
$judul = "KATEGORI : $ku2_kategori"; 
$judulku = $judul; 










//detail artikel ////////////////////////////////////////////////////////////////////////////////////////
ob_start();

		
//list artikel
$qyuk2 = mysqli_query($koneksi, "SELECT * FROM cp_artikel ".
						"WHERE kategori = '$katkd' ".
						"ORDER BY postdate DESC");
$ryuk2 = mysqli_fetch_assoc($qyuk2);


do
	{
	//nilai
	$yuk2_kd = nosql($ryuk2['kd']);
	$yuk2_filex = balikin($ryuk2['filex']);
	$yuk2_judul = urldecode(balikin($ryuk2['judul']));
	$yuk2_isi = urldecode(balikin($ryuk2['isi']));
	$yuk2_jml_dilihat = nosql($ryuk2['jml_dilihat']);
	
	$yuk2_postdate = balikin($ryuk2['postdate']);
	$yuk_judul2 = seo_friendly_url($yuk_judul);
	
	
	
	echo '<a href="artikel.php?artkd='.$yuk2_kd.'&'.$yuk2_judul2.'" title="'.$yuk2_judul.'">'.$yuk2_judul.'</a><br> <i>'.$yuk2_postdate.'</i>
	<hr>';
	}
while ($ryuk2 = mysqli_fetch_assoc($qyuk2));


        
//isi
$isi = ob_get_contents();
ob_end_clean();















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
