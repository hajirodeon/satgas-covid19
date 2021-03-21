<?php
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");


//nilai
$panickd = cegah($_GET['panickd']);



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
	$searchQuery = " and (penolong_kode like '%".$searchValue."%' or
		penolong_nama like '%".$searchValue."%' or
		penolong_tipe like '%".$searchValue."%' or
		kategori like '%".$searchValue."%' or
		notif_postdate like '%".$searchValue."%' or
		tugaskan_postdate like '%".$searchValue."%' or
		statusnya_postdate like '%".$searchValue."%' or
        ket_dampak_korban like '%".$searchValue."%' or 
        ket_dampak_kerugian like '%".$searchValue."%' or   
        ket_kronologi like '%".$searchValue."%' or   
        ket_upaya_dilakukan like '%".$searchValue."%' or  
        ket_kendala like '%".$searchValue."%' or
        postdate like '%".$searchValue."%' ) ";
}







	
	
## Total number of records without filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount from umum_sesi_penolong ".
								"WHERE panic_kd = '$panickd'");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount from umum_sesi_penolong ".
								"WHERE panic_kd = '$panickd' ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from umum_sesi_penolong ".
				"WHERE panic_kd = '$panickd' ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($koneksi, $empQuery);

$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;;
	$e_kd = balikin($row['kd']);
	$e_penolong_kd = balikin($row['penolong_kd']);
	$e_penolong_kode = balikin($row['penolong_kode']);
	$e_penolong_nama = balikin($row['penolong_nama']);
	$e_penolong_tipe = balikin($row['penolong_tipe']);
	$e_kategori = balikin($row['kategori']);
	$e_tugaskan_postdate = balikin($row['tugaskan_postdate']);
	$e_proses_postdate = balikin($row['notif_postdate']);
	$e_statusnya = balikin($row['statusnya']);
	$e_statusnya_postdate = balikin($row['statusnya_postdate']);
	$e_postdate = balikin($row['postdate']);

	$e_ket_dampak_korban = balikin($row['ket_dampak_korban']);
	$e_ket_dampak_kerugian = balikin($row['ket_dampak_kerugian']);
	$e_ket_kronologi = balikin($row['ket_kronologi']);
	$e_ket_upaya_dilakukan = balikin($row['ket_upaya_dilakukan']);
	$e_ket_kendala = balikin($row['ket_kendala']);




	
	
	//jika sudah selesai, munculkan foto bukti
	if ($e_statusnya == "true")
		{		
		$namabaru = "$e_penolong_kd-$panickd.jpg";
		$filebukti = "$sumber/filebox/panic/$e_penolong_kd/$panickd/$namabaru";
		
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
    		"kategori"=>"$e_kategori",
    		"notif_postdate"=>"$e_proses_postdate",
    		"statusnya_postdate"=>"$e_statusnya_ket",
    		"ket_dampak_korban"=>"$e_ket_dampak_korban",
    		"ket_dampak_kerugian"=>"$e_ket_dampak_kerugian",
    		"ket_kronologi"=>"$e_ket_kronologi",
    		"ket_upaya_dilakukan"=>"$e_ket_upaya_dilakukan",
    		"ket_kendala"=>"$e_ket_kendala"
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