<?php
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");


//nilai
$ekat = cegah($_GET['ekat']);

	

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = mysqli_real_escape_string($koneksi,cegah($_POST['search']['value'])); // Search value






## Search 
$searchQuery = " ";
if($searchValue != ''){
	$searchQuery = " and (umum_kode like '%".$searchValue."%' or
		umum_nama like '%".$searchValue."%' or 
		penolong_kode like '%".$searchValue."%' or  
        penolong_nama '%".$searchValue."%' or                                      
        postdate like'%".$searchValue."%' ) ";
}





	
	
## Total number of records without filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount from umum_sesi_penolong");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount from umum_sesi_penolong WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from umum_sesi_penolong WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($koneksi, $empQuery);

$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;;
	$i_kd = balikin($row['kd']);
	$i_postdate = balikin($row['postdate']);

    $data[] = array(	
    		"postdate"=>"$i_postdate",
    		"korban"=>"$i_korban",
    		"gps"=>"$i_gps",
    		"penolong"=>"$i_penolong",
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