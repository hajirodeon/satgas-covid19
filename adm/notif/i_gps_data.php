<?php
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");

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
	$searchQuery = " and (nip like '%".$searchValue."%' or 
        nama like '%".$searchValue."%' or  
        tipe_user like '%".$searchValue."%' or 
        jabatan like '%".$searchValue."%' or 
        tgl_lahir like '%".$searchValue."%' or 
        alamat like '%".$searchValue."%' or 
        telp like '%".$searchValue."%' or 
        email like '%".$searchValue."%' or 
        ket like '%".$searchValue."%' or  
        lat_x like '%".$searchValue."%' or
        lat_y like '%".$searchValue."%' or    
        postdate like'%".$searchValue."%' ) ";
}


	
	
## Total number of records without filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount from m_orang");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount from m_orang WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from m_orang WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($koneksi, $empQuery);

$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;;
	$e_kd = balikin($row['kd']);
	$e_nip = balikin($row['nip']);
	$e_nama = balikin($row['nama']);
	$e_filex = balikin($row['filex1']);
	$e_tipe = balikin($row['tipe_user']);
	$e_jabatan = balikin($row['jabatan']);
	$e_tgl_lahir = balikin($row['tgl_lahir']);
	 

	//jika edit / baru
	$fotoku = "../../filebox/pegawai/$e_kd/$e_nip-1.jpg";
	
	//nek ada foto
	if (file_exists($fotoku))
		{
		$nil_foto1 = "../../filebox/pegawai/$e_kd/$e_nip-1.jpg";
		$nil_foto12 = "../../filebox/pegawai/$e_kd/thumb-$e_nip-1.jpg";
		$nil_foto13 = "../../filebox/pegawai/$e_kd/marker$e_nip-1.jpg";
		}
	else
		{
		$nil_foto1 = "../../img/foto_blank.png";
		}

	
	
	
	//detail gps terakhir..
	$qku = mysqli_query($koneksi, "SELECT * FROM orang_lokasi ".
									"WHERE orang_kd = '$e_kd' ".
									"ORDER BY postdate DESC LIMIT 0,1");
	$rku = mysqli_fetch_assoc($qku);
	$e_alamat = balikin($rku['alamat']);
	$e_lat_x = balikin($rku['lat_x']);
	$e_lat_y = balikin($rku['lat_y']);
	$e_ket = balikin($rku['status']);
	$e_postdate = balikin($rku['postdate']);


	
    $data[] = array(
	
    		"postdate"=>$e_postdate, 
    		
    		"nip"=>"$e_nip",
    		    		
    		"nama"=>"$e_nama",
    		
    		"image"=>"<img src=\"$nil_foto1\" width=\"50\">",
    		"tipe_user"=>$e_tipe,
    		"ket"=>$e_ket,
    		"alamat"=>"$e_lat_x, $e_lat_y <br>$e_alamat"
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