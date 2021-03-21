<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");




//nilai session
$sesiku = cegah($_SESSION['sesiku']);
$sesinama = cegah($_SESSION['sesinama']);
$kd = cegah($sesiku);
$panickd = cegah($_SESSION['sesiku_panic']);







//detail orang
$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
						"WHERE kd = '$sesiku'");
$rku = mysqli_fetch_assoc($qku);
$ku_nip = cegah($rku['nip']);
$ku_nama = cegah($rku['nama']);
$ku_tipe_user = cegah($rku['tipe_user']);
$ku_jabatan = cegah($rku['jabatan']);
$ku_tgl_lahir = cegah($rku['tgl_lahir']);
$ku_alamat = cegah($rku['alamat']);
$ku_telp = cegah($rku['telp']);
$ku_email = cegah($rku['email']);






$foldernya = "../filebox/panic/$kd/";
chmod($foldernya,0777);
			
			
//buat folder...
if (!file_exists('../filebox/panic/'.$kd.'')) {
    mkdir('../filebox/panic/'.$kd.'', 0777, true);
	}








//folder konversi /////////////////////////////////////////////////////////////////////////////////////
$foldernya = "../filebox/konversi/$panickd/";
chmod($foldernya,0777);
			
			
//buat folder...
if (!file_exists('../filebox/konversi/'.$panickd.'')) {
    mkdir('../filebox/konversi/'.$panickd.'', 0777, true);
	}














//konversikan ke folder khusus /////////////////////////////////////////////////////////////////////////////////////
//mambaca folder asal
$kode_ruas = "../filebox/panic/$kd/$panickd/";
chmod($kode_ruas,0777);




//baca list file video
$qyuk = mysqli_query($koneksi, "SELECT * FROM umum_sesi_video ".
									"WHERE umum_kd = '$sesiku' ".
									"AND panic_kd = '$panickd' ".
									"ORDER BY filex ASC");
$ryuk = mysqli_fetch_assoc($qyuk);

do
	{
	//nilai
	$yuk_file = balikin($ryuk['filex']);


	shell_exec("/usr/bin/ffmpeg -y -i \"$kode_ruas/$yuk_file\" -f mp4 -r 29.97 -vcodec libx264 -preset slow -filter:v scale=w=640:h=480 -b:v 1000k -aspect 4:3 -flags +loop -cmp chroma -b:v 1250k -maxrate 1500k -bufsize 4M -bt 256k -refs 1 -bf 3 -coder 1 -me_method umh -me_range 16 -subq 7 -partitions +parti4x4+parti8x8+partp8x8+partb8x8 -g 250 -keyint_min 25 -level 30 -qmin 10 -qmax 51 -qcomp 0.6 -trellis 2 -sc_threshold 40 -i_qfactor 0.71 -acodec aac -strict experimental -b:a 112k -ar 48000 -ac 2 \"../filebox/konversi/$panickd/$yuk_file\"");
	} 
while ($ryuk = mysqli_fetch_assoc($qyuk));






















//bikin list //////////////////////////////////////////////////////////////////////////////////////////
$kode_ruas = "../filebox/konversi/$panickd";
chmod($kode_ruas,0777);


//baca list file video
$qyuk = mysqli_query($koneksi, "SELECT * FROM umum_sesi_video ".
									"WHERE umum_kd = '$sesiku' ".
									"AND panic_kd = '$panickd' ".
									"ORDER BY filex ASC");
$ryuk = mysqli_fetch_assoc($qyuk);

do
	{
	//nilai
	$yuk_file = balikin($ryuk['filex']);

	echo "file '/var/www/html/filebox/konversi/$panickd/$yuk_file' \n";
	} 
while ($ryuk = mysqli_fetch_assoc($qyuk));



//isi
$isi = ob_get_contents();
ob_end_clean();




//bikin file
$pathku = "../filebox/konversi/$panickd/list.txt";
chmod($pathku,0777);

$myfile = fopen($pathku, "w") or die("Unable to open file!");
fwrite($myfile, $isi);
fwrite($myfile, $txt);
fclose($myfile);














//gabungkan ///////////////////////////////////////////////////////////////////////////////////////////
//mambaca list
$kode_ruas = "../filebox/konversi/$panickd/list.txt";
$target_ruas = "../filebox/videolive/$panickd.mp4";

$folder1 = "../filebox/konversi";
$folder2 = "../filebox/videolive";
chmod($folder1, 0777);
chmod($folder2, 0777);


shell_exec("/usr/bin/ffmpeg -f concat -safe 0 -i $kode_ruas -c copy $target_ruas");
//gabungkan ///////////////////////////////////////////////////////////////////////////////////////////








exit();
?>