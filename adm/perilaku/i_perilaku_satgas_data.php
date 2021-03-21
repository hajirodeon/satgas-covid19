<?php
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");


//nilai
$pkd = cegah($_GET['pkd']);



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
	$searchQuery = " and (orang_kode like '%".$searchValue."%' or
		orang_nama like '%".$searchValue."%' or
		orang_tipe like '%".$searchValue."%' or
		notif_postdate like '%".$searchValue."%' or
		tugaskan_postdate like '%".$searchValue."%' or
		statusnya_postdate like '%".$searchValue."%' or
        ket like '%".$searchValue."%' or 
        postdate like '%".$searchValue."%' ) ";
}







	
	
## Total number of records without filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount from perilaku_satgas ".
								"WHERE perilaku_kd = '$pkd'");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount from perilaku_satgas ".
								"WHERE perilaku_kd = '$pkd' ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from perilaku_satgas ".
				"WHERE perilaku_kd = '$pkd' ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($koneksi, $empQuery);

$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;;
	$e_kd = balikin($row['kd']);
	$e_penolong_kd = balikin($row['orang_kd']);
	$e_penolong_kode = balikin($row['orang_kode']);
	$e_penolong_nama = balikin($row['orang_nama']);
	$e_penolong_tipe = balikin($row['orang_tipe']);
	$e_tugaskan_postdate = balikin($row['tugaskan_postdate']);
	$e_proses_postdate = balikin($row['notif_postdate']);
	$e_statusnya = balikin($row['statusnya']);
	$e_statusnya_postdate = balikin($row['statusnya_postdate']);
	$e_postdate = balikin($row['postdate']);

	$e_ket = balikin($row['ket']);



	
	
	//jika sudah selesai, munculkan foto bukti
	if ($e_statusnya == "true")
		{		
		$namabaru = "$e_penolong_kd-$pkd.jpg";
		$filebukti = "$sumber/filebox/perilaku/$e_penolong_kd/$pkd/$namabaru";
		
		$e_statusnya_ket = "<img src='$filebukti' width='200' height='200'> <br>$e_statusnya_postdate";
		}
	else if ($e_statusnya == "false")
		{
		//cuekin aja... 
		}
	




		

    $data[] = array(	
    		"tugaskan_postdate"=>"$e_tugaskan_postdate",
    		"penolong_kode"=>"$e_penolong_kode",    		    		
    		"penolong_nama"=>"$e_penolong_nama", 	
    		"penolong_tipe"=>"$e_penolong_tipe", 
    		"notif_postdate"=>"$e_proses_postdate",
    		"statusnya_postdate"=>"$e_statusnya_ket",
    		"ket"=>"$e_ket"
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