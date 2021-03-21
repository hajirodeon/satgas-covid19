<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_akun_notif_perilaku_data.php";
$filenyax = "$sumber/covid_android_satgas/i_akun_notif_perilaku_data.php";
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
		perilaku_kategori_tempat like '%".$searchValue."%' or
		perilaku_tipe_laporan like '%".$searchValue."%' or
		perilaku_alamat_googlemap like '%".$searchValue."%' or
		lat_x like '%".$searchValue."%' or
		lat_y like '%".$searchValue."%' ) ";
}


	
	
## Total number of records without filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount ".
								"from perilaku_satgas ".
								"WHERE orang_kd = '$sesiku' ".
								"AND tugaskan = 'true'");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount ".
								"from perilaku_satgas ".
								"WHERE orang_kd = '$sesiku' ".
								"AND tugaskan = 'true' ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from perilaku_satgas ".
				"WHERE orang_kd = '$sesiku' ".
				"AND tugaskan = 'true'  ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($koneksi, $empQuery);

$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;;
	$e_kd = balikin($row['kd']);
	$i_pkd = balikin($row['perilaku_kd']);
	$i_pnama = balikin($row['perilaku_nama_lokasi']);
	$i_palamat = balikin($row['perilaku_alamat_googlemap']);
	$i_pkategori = balikin($row['perilaku_kategori_tempat']);
	$i_ptipe = balikin($row['perilaku_tipe_laporan']);
	$i_pkontributor = balikin($row['perilaku_kontributor']);



	//jika null, ambil dari sumber lagi...
	$qsel = mysqli_query($koneksi,"select * FROM e_perilaku_masyarakat ".
									"WHERE kd = '$i_pkd'");
	$rsel = mysqli_fetch_assoc($qsel);
	$sel_nama_lokasi = cegah($rsel['nama_lokasi']);
	$sel_alamat = cegah($rsel['alamat_googlemap']);
	$sel_kategori = cegah($rsel['kategori_tempat']);
	$sel_tipe = cegah($rsel['tipe_laporan']);
	$sel_knik = cegah($rsel['kontributor_nik']);
	$sel_knama = cegah($rsel['kontributor_nama']);
	$sel_ktipe = cegah($rsel['kontributor_tipe']);
	$sel_kkontak = cegah($rsel['kontributor_kontak']);
	$sel_kontributor = "$sel_knama [$sel_ktipe : $sel_knik]. [Telp : $sel_kkontak].";
	

	//update
	mysqli_query($koneksi, "UPDATE perilaku_satgas SET perilaku_nama_lokasi = '$sel_nama_lokasi', ".
								"perilaku_alamat_googlemap = '$sel_alamat', ".
								"perilaku_kategori_tempat = '$sel_kategori', ".
								"perilaku_tipe_laporan = '$sel_ktipe', ".
								"perilaku_kontributor = '$sel_kontributor' ".
								"WHERE orang_kd = '$sesiku' ".
								"AND kd = '$e_kd'");


	
	
	$i_latx = balikin($row['lat_x']);
	$i_laty = balikin($row['lat_y']);
	$i_alamat = balikin($row['alamat']);
	$e_lokasi = "[$i_latx]. [$i_laty]. $i_alamat";
	
	$e_postdate = balikin($row['postdate']);
	$e_tugaskan_postdate = balikin($row['tugaskan_postdate']);
	$e_notif_postdate = balikin($row['notif_postdate']);
	$e_statusnya = balikin($row['statusnya']);
	$e_statusnya_postdate = balikin($row['statusnya_postdate']);
	$e_ket = balikin($row['ket']);

	



	//jika belum ada aksi
	if ($e_statusnya == "false")
		{
		$e_statusnya_ket = "Belum Ada Aksi";
		$e_lokasinya = "$i_pnama <br> <a href='#' onclick=\"$('#iredirect').load('$sumber/covid_android_satgas/i_redirect.php?sesikode=perilakudetail&kd=$e_kd&pkd=$i_pkd');\" class='btn btn-block btn-danger'>CEK LOKASI >></a>";
		}
	else if ($e_statusnya == "true")
		{
		$e_statusnya_ket = "$e_statusnya_postdate";
		$e_lokasinya = "$i_pnama";
		}

	
						
										
    $data[] = array(
    		"tugaskan_postdate"=>"$e_tugaskan_postdate",
    		"perilaku_nama_lokasi"=>"$e_lokasinya",
    		"perilaku_kategori_tempat"=>"$i_pkategori",
    		"perilaku_alamat_googlemap"=>"$i_palamat <hr width='400px'>",
    		"perilaku_tipe_laporan"=>"$sel_tipe",
    		"notif_postdate"=>"$e_notif_postdate",
    		"statusnya_postdate"=>"$e_statusnya_postdate",
    		"ket"=>$e_ket
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