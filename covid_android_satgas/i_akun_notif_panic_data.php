<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_akun_notif_panic_data.php";
$filenyax = "$sumber/covid_android_satgas/i_akun_notif_panic_data.php";
$judul = "notif";
$juduli = $judul;



//nilai session
$sesiku = cegah($_SESSION['sesiku']);
$sesinama = $_SESSION['sesinama'];





/*
//kasi forward semua //////////////////////////////////////////////////////////////////////////////////
//detail
$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
						"WHERE kd = '$sesiku'");
$rku = mysqli_fetch_assoc($qku);
$ku_nip = cegah($rku['nip']);
$ku_nama = cegah($rku['nama']);
$ku_tipe_user = cegah($rku['tipe_user']);
$ku_lat_x = balikin($rku['lat_x']);
$ku_lat_y = balikin($rku['lat_y']);
$ku_lat_alamat = cegah($rku['lat_alamat']);


	




//baca list
$qmboh = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
									"WHERE umum_kd <> '$sesiku' ".
									"ORDER BY postdate DESC");
$rmboh = mysqli_fetch_assoc($qmboh);

do
	{
	//nilai
	$mb_kd = nosql($rmboh['kd']);
	$mb_ukd = cegah($rmboh['umum_kd']);
	$mb_ukode = cegah($rmboh['umum_kode']);
	$mb_unama = cegah($rmboh['umum_nama']);
	$mb_utipe = cegah($rmboh['umum_tipe_user']);
	$mb_lat_x = balikin($rmboh['lat_x']);
	$mb_lat_y = balikin($rmboh['lat_y']);
	$mb_lat_alamat = cegah($rmboh['lat_alamat']);
	$mb_postdate = balikin($rmboh['postdate']);
	


	$xyz = md5("$mb_kd$sesiku");





	//masukin database
	mysqli_query($koneksi, "INSERT INTO umum_sesi_penolong (kd, panic_kd, penolong_kd, penolong_kode, ".
								"penolong_nama, penolong_tipe, penolong_lat_x, ".
								"penolong_lat_y, penolong_alamat, ".
								"korban_kd, korban_kode, korban_nama, korban_tipe, ".
								"alamat, lat_x, lat_y, ".
								"tkp_postdate, tugaskan, tugaskan_postdate, postdate) VALUES ".
								"('$xyz', '$mb_kd', '$sesiku', '$ku_nip', ".
								"'$ku_nama', '$ku_tipe_user', '$ku_lat_x', ".
								"'$ku_lat_y', '$ku_lat_alamat', ".
								"'$mb_ukd', '$mb_ukode', '$mb_unama', '$mb_utipe', ".
								"'$mb_lat_alamat', '$mb_lat_x', '$mb_lat_y', ".
								"'$mb_postdate', 'true', '$today', '$today')");


			 
	}
while ($rmboh = mysqli_fetch_assoc($qmboh));

//kasi forward semua //////////////////////////////////////////////////////////////////////////////////
*/









## Read value
$draw = cegah($_POST['draw']);
$row = cegah($_POST['start']);
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = cegah($_POST['order'][0]['dir']); // asc or desc
$searchValue = mysqli_real_escape_string($koneksi,cegah($_POST['search']['value'])); // Search value

## Search 
$searchQuery = " ";
if($searchValue != ''){
	$searchQuery = " and (tkp_postdate like '%".$searchValue."%' or
		tugaskan_postdate like '%".$searchValue."%' or
		statusnya like '%".$searchValue."%' or  
		korban_kode like '%".$searchValue."%' or
		korban_nama like '%".$searchValue."%' or
		lat_x like '%".$searchValue."%' or
		lat_y like '%".$searchValue."%' or
		statusnya like '%".$searchValue."%' or          
        alamat like '%".$searchValue."%' ) ";
}


	
	
## Total number of records without filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount ".
								"from umum_sesi_penolong ".
								"WHERE penolong_kd = '$sesiku' ".
								"AND tugaskan = 'true'");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount ".
								"from umum_sesi_penolong ".
								"WHERE penolong_kd = '$sesiku' ".
								"AND tugaskan = 'true' ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from umum_sesi_penolong ".
				"WHERE penolong_kd = '$sesiku' ".
				"AND tugaskan = 'true'  ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($koneksi, $empQuery);

$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;;
	$e_kd = balikin($row['kd']);
	$i_panickd = cegah($row['panic_kd']);
	$i_pkd = cegah($row['penolong_kd']);
	$i_pkode = cegah($row['penolong_kode']);
	$i_pnama = cegah($row['penolong_nama']);
	$i_ptipe = cegah($row['penolong_tipe']);
	$i_kkd = cegah($row['korban_kd']);
	$i_tkp_postdate = balikin($row['tkp_postdate']);
	$i_kkode = balikin($row['korban_kode']);
	$i_knama = balikin($row['korban_nama']);
	$i_ktipe = balikin($row['korban_tipe']);
	$e_korban = "$i_knama [$i_kkode]. [$i_ktipe].";
	
	
	$i_kategori = balikin($row['kategori']);
	$i_ket_dampak_korban = balikin($row['ket_dampak_korban']);
	$i_ket_dampak_kerugian = balikin($row['ket_dampak_kerugian']);
	$i_ket_kronologi = balikin($row['ket_kronologi']);
	$i_ket_upaya_dilakukan = balikin($row['ket_upaya_dilakukan']);
	$i_ket_kendala = balikin($row['ket_kendala']);
	
	
										
	
	$i_latx = balikin($row['lat_x']);
	$i_laty = balikin($row['lat_y']);
	$i_alamat = balikin($row['alamat']);
	$e_lokasi = "[$i_latx]. [$i_laty]. $i_alamat";
	
	
	//ambil detail orang lagi...
	$qyuk = mysqli_query($koneksi, "SELECT * FROM m_orang ".
										"WHERE kd = '$i_kkd' LIMIT 0,1");
	$ryuk = mysqli_fetch_assoc($qyuk);
	$yuk_kode = cegah($ryuk['nip']);
	$yuk_nama = cegah($ryuk['nama']);
	$yuk_tipe = cegah($ryuk['tipe_user']);
	
	
	//update
	mysqli_query($koneksi, "UPDATE umum_sesi_penolong SET korban_kode = '$yuk_kode', ".
									"korban_nama = '$yuk_nama', ".
									"korban_tipe = '$yuk_tipe' ".
									"WHERE kd = '$e_kd' ".
									"AND panic_kd = '$i_panickd'");


	
	
	
	
	//jika null, ambil sumber panic
	if (empty($i_latx))
		{
		//baca
		$qku = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
											"WHERE kd = '$i_panickd' LIMIT 0,1");
		$rku = mysqli_fetch_assoc($qku);
		$i_latx = balikin($rku['lat_x']);
		$i_laty = balikin($rku['lat_y']);
		$i_alamat = balikin($rku['alamat']);
		$i_alamatx = cegah($rku['alamat']);
		$e_lokasi = "[$i_latx]. [$i_laty]. <br>$i_alamat";
							
				
			
		//update
		mysqli_query($koneksi, "UPDATE umum_sesi_penolong SET lat_x = '$i_latx', ".
									"lat_y = '$i_laty', ".
									"alamat = '$i_alamatx' ".
									"WHERE kd = '$e_kd' ".
									"AND panic_kd = '$i_panickd'");					
		}
	
	
	
	
	$e_tugaskan_postdate = balikin($row['tugaskan_postdate']);
	$e_notif = balikin($row['notif']);
	$e_notif_postdate = balikin($row['notif_postdate']);
	$e_statusnya = balikin($row['statusnya']);
	$e_statusnya_postdate = balikin($row['statusnya_postdate']);

	
	
	//jika belum proses
	if ($e_notif == "false")
		{
		$e_notif_postdatenya = "<a href='#' onclick=\"$('#iredirect').load('$sumber/covid_android_satgas/i_redirect.php?sesikode=panicdetail&panickd=$i_panickd&pkd=$i_pkd');\" class='btn btn-block btn-danger'>BERI BANTUAN >></a>";
		}
	else if ($e_notif == "true")
		{
		$e_notif_postdatenya = "$e_notif_postdate ";			
		}

	
	
	
	
	
	//jika sudah selesai, munculkan foto bukti
	if ($e_statusnya == "true")
		{		
		$namabaru = "$sesiku-$i_panickd.jpg";
		$filebukti = "$sumber/filebox/panic/$sesiku/$i_panickd/$namabaru";
		
		$e_statusnya_ket = "<img src='$filebukti' width='200' height='200'> <br>$e_statusnya_postdate";
		}
	else if ($e_statusnya == "false")
		{
		//cuekin aja... 
		}
	
		


	
    $data[] = array(
    		"tugaskan_postdate"=>"$e_tugaskan_postdate",
    		"korban_nama"=>"$e_korban",
    		"kategori"=>"$i_kategori <hr width='100'>",
    		"alamat"=>"$e_lokasi <hr width='200'>",
    		"notif_postdate"=>"$e_notif_postdatenya  <hr width='200'>", 
    		"statusnya_postdate"=>"$e_statusnya_ket  <hr width='200'>", 
    		"ket_dampak_korban"=>"$i_ket_dampak_korban  <hr width='200'>", 
    		"ket_dampak_kerugian"=>"$i_ket_dampak_kerugian  <hr width='200'>", 
    		"ket_kronologi"=>"$i_ket_kronologi  <hr width='200'>", 
    		"ket_upaya_dilakukan"=>"$i_ket_upaya_dilakukan  <hr width='200'>",
    		"ket_kendala"=>"$i_ket_kendala  <hr width='200'>"
    	);
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);



exit();
?>