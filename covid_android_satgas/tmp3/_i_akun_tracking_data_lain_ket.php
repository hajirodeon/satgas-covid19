<?php
ini_set('max_execution_time', 0);
error_reporting(0);


//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



//nilai
$sesikd = nosql($_REQUEST['sesikd']);
$idku = balikin($_REQUEST['idku']);


//pecah
$pecahku = explode(',', $idku);
$ilat1 = trim(strip_tags($pecahku[0]));

$pecahku2 = explode('(', $ilat1);
$ilaty = trim(strip_tags($pecahku2[1]));


$ilat2 = trim(strip_tags($pecahku[1]));
$pecahku2 = explode(')', $ilat2);
$ilatx = trim(strip_tags($pecahku2[0]));


//echo "$ilaty + $ilatx";




//detail terbaru
$qku2 = mysqli_query($koneksi, "SELECT * FROM orang_lokasi ".
						"WHERE lat_x = '$ilaty' ".
						"AND lat_y = '$ilatx' ".
						"ORDER BY postdate DESC");
$rku2 = mysqli_fetch_assoc($qku2);
$tku2 = mysqli_num_rows($qku2);
$ku2_orgkd = trim(balikin($rku2['orang_kd']));
$ku2_postdate = trim(balikin($rku2['postdate']));


//echo "-> $ku2_orgkd";




//detail
$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
						"WHERE kd = '$ku2_orgkd'");
$rku = mysqli_fetch_assoc($qku);
$ku_nip = balikin($rku['nip']);
$ku_nama = balikin($rku['nama']);
$ku_jabatan = balikin($rku['jabatan']);
$ku_tgl_lahir = balikin($rku['tgl_lahir']);
$ku_alamat = balikin($rku['alamat']);
$ku_telp = balikin($rku['telp']);
$ku_email = balikin($rku['email']);
$ku_filex = balikin($rku['filex1']);


$ku_filex1 = "$ku_nip-1.jpg";



echo '<hr>

Online Terakhir :
<br>
<b>'.$ku2_postdate.'</b>
<hr>
<p>
<img src="'.$sumber.'/filebox/pegawai/'.$ku2_orgkd.'/'.$ku_filex1.'" width="100">
</p>

<p>
NIK : 
<br>
<b>'.$ku_nip.'</b>

</p>


<p>
Nama : 
<br>
<b>'.$ku_nama.'</b>
</p>


<p>
Jabatan : 
<br>
<b>'.$ku_jabatan.'</b>
</p>


<p>
Tgl. Lahir : 
<br>
<b>'.$ku_tgl_lahir.'</b>
</p>



<p>
Telepon : 
<br>
<b>'.$ku_telp.'</b>
</p>



<p>
E-Mail : 
<br>
<b>'.$ku_email.'</b>
</p>';



exit();
?>