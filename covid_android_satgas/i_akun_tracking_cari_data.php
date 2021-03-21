<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_akun_tracking_cari_data.php";
$filenyax = "$sumber/covid_android_satgas/i_akun_tracking_cari_data.php";
$judul = "tracking";
$juduli = $judul;



//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];




## Read value
$draw = cegah($_POST['draw']);
$row = cegah($_POST['start']);
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = mysqli_real_escape_string($koneksi,cegah($_POST['search']['value'])); // Search value

## Search 
$searchQuery = " ";
if($searchValue != ''){
	$searchQuery = " and (nama like '%".$searchValue."%' or 
        tipe_user like '%".$searchValue."%' ) ";
}


		
	
## Total number of records without filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount ".
								"FROM m_orang");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount  ".
								"FROM m_orang ".
								"WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * FROM m_orang ".
				"WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($koneksi, $empQuery);

$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;;
	$e_kd = balikin($row['kd']);
	$e_nip = balikin($row['nip']);
	$e_nama = balikin($row['nama']);
	$e_tipe_user = balikin($row['tipe_user']);
	$e_lat_postdate = balikin($row['lat_postdate']);

	$nil_foto1 = "$sumber/filebox/pegawai/$e_kd/$e_nip-1.jpg";
		
	
	
	
		
	
    $data[] = array(
    		"foto"=>"<img src=\"$nil_foto1\" width=\"50\">",
    		"nama"=>"$e_nama <hr> <a href='#' title='$e_nama' onclick=\"$('#iredirect').load('$sumber/covid_android_satgas/i_redirect.php?sesikode=carisatgas&kd=$e_kd');\" class='btn btn-block btn-danger'>CEK LOKASI >></a>",
    		"tipe_user"=>$e_tipe_user, 
    		"online"=>$e_lat_postdate
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
?>