<?php
session_start();


//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
require("inc/class/paging.php");
$tpl = LoadTpl("template/cp_artikel.html");



nocache;

//nilai
$artkd = nosql($_REQUEST['artkd']);
$filenya = "artikel.php?artkd=$artkd";
$filenyax = "i_index.php";
$filenya_ke = $sumber;






//update
mysqli_query($koneksi, "UPDATE cp_artikel SET jml_dilihat = jml_dilihat + 1 ".
				"WHERE kd = '$artkd'");

		

//rincian
$qku = mysqli_query($koneksi, "SELECT * FROM cp_artikel ".
						"WHERE kd = '$artkd'");
$rku = mysqli_fetch_assoc($qku);
$ku_judul = urldecode(balikin($rku['judul']));
$ku_isi = urldecode(balikin($rku['isi']));
$ku_filex = balikin($rku['filex']);
$ku_katkd = balikin($rku['kategori']);
$ku_jml_dilihat = nosql($rku['jml_dilihat']);
$ku_postdate = balikin($rku['postdate']);
$judul = $ku_judul;
$judulku = $judul;
$ku_filex2 = "$sumber/filebox/artikel/$artkd/$ku_filex";
$ku_filex21 = "filebox/artikel/$artkd/$ku_filex";



//kategori
$ku2_kategori = $ku_katkd;










//detail artikel ////////////////////////////////////////////////////////////////////////////////////////
ob_start();


echo '<div class="single-post">
      <div class="feature-img">
         <img class="img-fluid" src="'.$ku_filex2.'" alt="" width="100%">
      </div>
      <div class="blog_details">
         <h2>'.$ku_judul.'</h2>
         <ul class="blog-info-link mt-3 mb-4">
            <li><a href="kategori.php?katkd='.$ku_katkd.'"><i class="far fa-user"></i> '.$ku2_kategori.'</a></li>
            <li><a href="#"><i class="far fa-user"></i> '.$ku_postdate.'</a></li>
         </ul>
         <p>
            '.$ku_isi.'
         </p>
      </div>
   </div>

<br>
<br>
<br>

<hr>
<h3>ARTIKEL LAINNYA : </h3>';

			
//cari yang mirip
$katamirip = explode(" ", $ku_judul);
$mirip1 = balikin($katamirip[0]); 
$mirip2 = balikin($katamirip[1]);
$mirip2 = balikin($katamirip[2]);
$mirip3 = balikin($katamirip[3]);
$mirip4 = balikin($katamirip[4]);
$mirip5 = balikin($katamirip[5]);
$mirip6 = balikin($katamirip[6]);
$mirip7 = balikin($katamirip[7]);

$kata1 = "$mirip1 $mirip2";
$kata2 = "$mirip2 $mirip3";
$kata3 = "$mirip3 $mirip4";
$kata4 = "$mirip4 $mirip5";
$kata5 = "$mirip5 $mirip6";
$kata6 = "$mirip6 $mirip7";     


//jika ada
if (!empty($kata1))
	{
	$q_kata1 = "OR judul LIKE '%$kata1%'";
	}
	
if (!empty($kata2))
	{
	$q_kata2 = "OR judul LIKE '%$kata2%'";
	}
	
if (!empty($kata3))
	{
	$q_kata3 = "OR judul LIKE '%$kata3%'";
	}
	
if (!empty($kata4))
	{
	$q_kata4 = "OR judul LIKE '%$kata4%'";
	}
	
if (!empty($kata5))
	{
	$q_kata5 = "OR judul LIKE '%$kata5%'";
	}



//daftar artikel terkait
$qku = mysqli_query($koneksi, "SELECT * FROM cp_artikel ".
						"WHERE $q_kata1 ".
						"$q_kata2 ".	
						"$q_kata2 ".	
						"$q_kata3 ".	
						"$q_kata4 ".	
						"$q_kata5 ".	
						"ORDER BY postdate DESC LIMIT 0,3");
$rku = mysqli_fetch_assoc($qku);
$tku = mysqli_num_rows($qku);

//jika gak ada, kasi terbaru
if (empty($tku))
	{
	$qku = mysqli_query($koneksi, "SELECT * FROM cp_artikel ".
							"ORDER BY postdate DESC LIMIT 0,3");
	$rku = mysqli_fetch_assoc($qku);		
	}

	
	
	
do
	{
	//nilai
	$ku_kd = nosql($rku['kd']);
	$ku_judul = urldecode(balikin($rku['judul']));
	$ku_isi = urldecode(balikin($rku['isi']));
	$ku_filex = balikin($rku['filex']);
	$ku_katkd = balikin($rku['kategori']);
	$ku_postdate = balikin($rku['postdate']);
	$ku_filex2 = "$sumber/filebox/artikel/$ku_kd/$ku_filex";
	$ku_jml_dilihat = nosql($rku['jml_dilihat']);

	$yuk2_postdate = balikin($rku['postdate']);
	$yuk_judul2 = seo_friendly_url($ku_judul);
	

	echo '<b>
	<a href="'.$filenya.'?artkd='.$ku_kd.'&'.$yuk_judul2.'" title="'.$ku_judul.'">'.$ku_judul.'</a>
	</b>
	<br>
	<i>['.$yuk2_postdate.']</i>
	<hr>';
	}
while ($rku = mysqli_fetch_assoc($qku));



  



//isi
$isi = ob_get_contents();
ob_end_clean();























//isi *START
ob_start();

require("i_terbaru.php");

//isi
$i_terbaru = ob_get_contents();
ob_end_clean();








//isi *START
ob_start();

require("i_kategori.php");

//isi
$i_kategori = ob_get_contents();
ob_end_clean();









require("inc/niltpl.php");


//diskonek
xclose($koneksi);
exit();
?>
