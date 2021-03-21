<?php
session_start();


//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_akun_foto_thumb.php";
$filenyax = "$sumber/covid_android_satgas/i_akun_foto_thumb.php";
$judul = "thumb";
$juduli = $judul;



//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];
$kd = cegah($sesiku);





//detail
$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
						"WHERE kd = '$sesiku'");
$rku = mysqli_fetch_assoc($qku);
$ku_nip = cegah($rku['nip']);
$ku_nama = cegah($rku['nama']);
$ku_tipe_user = cegah($rku['tipe_user']);
$ku_jabatan = cegah($rku['jabatan']);














$foldernya = "../filebox/pegawai/$kd/";
chmod($foldernya,0777);
			
			
//buat folder...
if (!file_exists('../filebox/pegawai/'.$kd.'')) {
    mkdir('../filebox/pegawai/'.$kd.'', 0777, true);
	}








$pathku = "../filebox/pegawai/$sesiku/$ku_filex1";
$new_image_kecil = "thumb-$ku_nip.jpg";
$new_image_marker = "marker-$ku_nip.jpg";




//ketahui kode warna
$qx = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
					"WHERE nama = '$ku_tipe_user'");
$rowx = mysqli_fetch_assoc($qx);
$e_warna = balikin($rowx['warna']);


//pecah kode
$ewarna1 = substr($e_warna, 1,2);
$ewarna2 = substr($e_warna, 3,2);
$ewarna3 = substr($e_warna, 5,2);


//echo "$e_warna -> $ewarna1, $ewarna2, $ewarna3";
	
	
	

$pathkecil = "../filebox/pegawai/$sesiku/$new_image_kecil";
$pathkecil2 = "../filebox/pegawai/$sesiku/$new_image_marker";





//bikin image kecil //////////////////////////////////////////////////////////////////////////////////
header('Content-type: image/jpeg');
$file = $pathku;

$new_width = 32;
$new_height = 32;
list($old_width, $old_height) = getimagesize($file);

$new_image = imagecreatetruecolor($new_width, $new_height);
$old_image = imagecreatefromjpeg($file);

imagecopyresampled($new_image, $old_image, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);

imagejpeg($new_image, $pathkecil);


//echo "$pathkecil <hr>";






/*
//kasi border /////////////////////////////////////////////////////////////////////////////////////////
$img_src = $pathku;
$img = imagecreatefromjpeg($img_src);
$nil1 = hexdec($ewarna1);
$nil2 = hexdec($ewarna2);
$nil3 = hexdec($ewarna3);

$color = imagecolorallocate($img, $nil1, $nil2, $nil3);
$borderThickness = 5;

drawBorder($img, $color, $borderThickness);


    function drawBorder(&$img, &$color, $thickness)
    {
        $x1 = 0;
        $y1 = 0;
        $x2 = imagesx($img) - 1;
        $y2 = imagesy($img) - 1;

        for($i = 0; $i < $thickness; $i++)
        {

            imagerectangle($img, $x1++, $y1++, $x2--, $y2--, $color);
        }

    }

header('Content-type: image/jpeg');
imagejpeg($img, $pathkecil2);



echo "$pathkecil2 <hr>";
*/




	














	
	

	

exit();	
?>