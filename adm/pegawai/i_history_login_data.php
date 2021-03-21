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
        postdate like'%".$searchValue."%' ) ";
}


	
	
## Total number of records without filtering
$sel = mysqli_query($koneksi,"select count(DISTINCT(orang_kd)) as allcount from orang_login");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($koneksi,"select count(DISTINCT(orang_kd)) as allcount from orang_login WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select DISTINCT(orang_kd) from orang_login WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($koneksi, $empQuery);

$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;;
	$e_kd = balikin($row['orang_kd']);
	
	$i_orang_kd = $e_kd;
	
	
	//detailkan
	$qkux = mysqli_query($koneksi, "SELECT * FROM orang_login ".
									"WHERE orang_kd = '$i_orang_kd' ".
									"ORDER BY postdate DESC LIMIT 0,5");
	$rkux = mysqli_fetch_assoc($qkux);
	$i_postdate = balikin($rkux['postdate']);
	$i_orang_kode = balikin($rkux['orang_kode']);
	$i_orang_nama = balikin($rkux['orang_nama']);
	$i_lat_x = balikin($rkux['lat_x']);
	$i_lat_y = balikin($rkux['lat_y']);
	$i_alamat = balikin($rkux['alamat']);
			
	//m_orang
	$qyuk3 = mysqli_query($koneksi, "SELECT * FROM m_orang ".
							"WHERE kd = '$i_orang_kd'");
	$ryuk3 = mysqli_fetch_assoc($qyuk3);
	$i_orang_tipe = balikin($ryuk3['tipe_user']);
	$i_orang_kode = balikin($ryuk3['nip']);
	$i_orang_nama = balikin($ryuk3['nama']);
	 

	//jika edit / baru
	$fotoku = "../../filebox/pegawai/$i_orang_kd/$i_orang_kode-1.jpg";
	
	//nek ada foto
	if (file_exists($fotoku))
		{
		$nil_foto1 = "../../filebox/pegawai/$i_orang_kd/$i_orang_kode-1.jpg";
		$nil_foto12 = "../../filebox/pegawai/$i_orang_kd/thumb-$i_orang_kode-1.jpg";
		$nil_foto13 = "../../filebox/pegawai/$i_orang_kd/marker$i_orang_kode-1.jpg";
		}
	else
		{
		$nil_foto1 = "../../img/foto_blank.png";
		}

	

	
    $data[] = array(	
    		"postdate"=>"$i_postdate",    		    		
    		"usernya"=>"$i_orang_kode . $i_orang_nama [$i_orang_tipe]"
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