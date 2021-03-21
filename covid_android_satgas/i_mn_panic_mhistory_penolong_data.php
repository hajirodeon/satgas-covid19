<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;




//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];




## Read value
$draw = cegah($_POST['draw']);
$row = cegah($_POST['start']);
$rowperpage = cegah($_POST['length']); // Rows display per page
$columnIndex = cegah($_POST['order'][0]['column']); // Column index
$columnName = cegah($_POST['columns'][$columnIndex]['data']); // Column name
$columnSortOrder = cegah($_POST['order'][0]['dir']); // asc or desc
$searchValue = mysqli_real_escape_string($koneksi,cegah($_POST['search']['value'])); // Search value

## Search 
$searchQuery = " ";
if($searchValue != ''){
	$searchQuery = " and (orang_kode like '%".$searchValue."%' or 
        orang_nama like '%".$searchValue."%' or  
        postdate like'%".$searchValue."%' ) ";
}


	
	
## Total number of records without filtering
$sel = mysqli_query($koneksi,"SELECT count(*) as allcount FROM umum_sesi_penolong ".
								"WHERE statusnya = 'true'");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($koneksi,"SELECT count(*) as allcount FROM umum_sesi_penolong ".
								"WHERE statusnya = 'true' ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from umum_sesi_penolong ".
				"WHERE statusnya = 'true' ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($koneksi, $empQuery);

$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;;
	$e_kd = balikin($row['kd']);
	$e_postdate = balikin($row['statusnya_postdate']);
	$e_orang_kd = balikin($row['penolong_kd']);
	$e_orang_kode = balikin($row['penolong_kode']);
	$e_orang_nama = balikin($row['penolong_nama']);
	$e_kategori = balikin($row['kategori']);
	$e_ket = balikin($row['ket']);
	$e_korban_kd = balikin($row['korban_kd']);
	$e_korban_kode = balikin($row['korban_kode']);
	$e_korban_nama = balikin($row['korban_nama']);
	$e_solusi = balikin($row['solusi']);


	
    $data[] = array(	
    		"postdate"=>"$e_postdate",    		    		
    		"penolong"=>"$e_orang_kode . $e_orang_nama",	
    		"kategori"=>"$e_kategori",	
    		"solusi"=>"$e_solusi", 		
    		"korban"=>"$e_korban_kode. $e_korban_nama",
    		"gps"=>"$e_gps"
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