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
	$searchQuery = " and (postdate like '%".$searchValue."%' or
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
	$i_kkode = balikin($row['korban_kode']);
	$i_knama = balikin($row['korban_nama']);
	$i_ktipe = balikin($row['korban_tipe']);
	$e_korban = "$i_knama [$i_ktipe]. [$i_kkode].";
	
	
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
		$e_lokasi = "[$i_latx]. [$i_laty]. $i_alamat";
							
				
			
		//update
		mysqli_query($koneksi, "UPDATE umum_sesi_penolong SET lat_x = '$i_latx', ".
									"lat_y = '$i_laty', ".
									"alamat = '$i_alamatx' ".
									"WHERE kd = '$e_kd' ".
									"AND panic_kd = '$i_panickd'");					
		}
	
	
	
	
	$e_postdate = balikin($row['postdate']);
	$e_statusnya = balikin($row['statusnya']);
	$e_statusnya_postdate = balikin($row['statusnya_postdate']);

	
	
	//jika belum ada aksi
	if (empty($e_statusnya))
		{
		$e_statusnya_ket = "Belum Ada Aksi";
		
		$e_postdatenya = "$e_postdate <br> <a href='akun_panic_tolong.html' class='btn btn-block btn-danger'>BERI BANTUAN >></a>";
		}
	else
		{
		$e_statusnya_ket = "$e_statusnya_postdate <br> $e_statusnya";
		$e_postdatenya = "$e_postdate ";			
		}

	
	
    $data[] = array(
    		"postdate"=>"$e_postdatenya",
    		"korban_nama"=>"$e_korban <hr width='200'>",
    		"alamat"=>"$e_lokasi <hr width='300'>",
    		"statusnya"=>"$e_statusnya_ket  <hr width='200'>"
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