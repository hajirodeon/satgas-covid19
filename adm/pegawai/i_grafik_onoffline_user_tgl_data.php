<?php
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");

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
        lat_x like '%".$searchValue."%' or 
        lat_y like '%".$searchValue."%' or 
        status like '%".$searchValue."%' or
        alamat like '%".$searchValue."%' or     
        postdate like'%".$searchValue."%' ) ";
}


	
	
## Total number of records without filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount from orang_lokasi");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount from orang_lokasi WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from orang_lokasi WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($koneksi, $empQuery);

$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;;
	$e_kd = balikin($row['kd']);
	$e_lat_x = balikin($row['lat_x']);
	$e_lat_y = balikin($row['lat_y']);
	$e_orang_kd = balikin($row['orang_kd']);
	$e_orang_kode = balikin($row['orang_kode']);
	$e_orang_nama = balikin($row['orang_nama']);
	$e_status = balikin($row['status']);
	$e_alamat = balikin($row['alamat']);
	$e_postdate = balikin($row['postdate']);
	 

	//jika edit / baru
	$fotoku = "../../filebox/pegawai/$e_orang_kd/$e_orang_kode-1.jpg";
	
	//nek ada foto
	if (file_exists($fotoku))
		{
		$nil_foto1 = "../../filebox/pegawai/$e_orang_kd/$e_orang_kode-1.jpg";
		$nil_foto12 = "../../filebox/pegawai/$e_orang_kd/thumb-$e_orang_kode-1.jpg";
		$nil_foto13 = "../../filebox/pegawai/$e_orang_kd/marker$e_orang_kode-1.jpg";
		}
	else
		{
		$nil_foto1 = "../../img/foto_blank.png";
		}

	

	
    $data[] = array(	
    		"postdate"=>"$e_postdate",    		    		
    		"orang_kode"=>"$e_orang_kode . $e_orang_nama",
    		"status"=>$e_status,
    		"lat_x"=>"$e_lat_x , $e_lat_y",
    		"alamat"=>$e_alamat
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