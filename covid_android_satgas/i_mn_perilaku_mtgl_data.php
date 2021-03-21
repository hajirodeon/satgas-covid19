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







//masukin semua ke database ///////////////////////////////////////////////////////////////////////////
//list
$empQuery2 = "SELECT DISTINCT(DATE(postdate)) AS tglku ".
				"FROM e_perilaku_masyarakat ".
				"ORDER BY postdate ASC";
$empRecords2 = mysqli_query($koneksi, $empQuery2);

while ($row2 = mysqli_fetch_assoc($empRecords2)) 
	{
	//nilai
	$i_tglku = balikin($row2['tglku']);


	//insert
	$xyz = md5("$i_tglku");
	mysqli_query($koneksi, "INSERT INTO perilaku_lap_tgl(kd, tanggal, postdate) VALUES 
								('$xyz', '$i_tglku', '$today')");



	//hitung total
	$qyuk = mysqli_query($koneksi, "SELECT SUM(jml_masker_pake) AS total_masker_pake, ".
										"SUM(jml_masker_tidak_pake) AS total_masker_tidak, ".
										"SUM(jml_jaga_jarak) AS total_jaga_jarak, ".
										"SUM(jml_jaga_jarak_tidak) AS total_jaga_jarak_tidak, ".
										"SUM(jml_ingatkan) AS total_ingatkan, ".
										"SUM(jml_ingatkan_tidak) AS total_ingatkan_tidak ".
										"FROM e_perilaku_masyarakat ".
										"WHERE postdate LIKE '$i_tglku%'");
	$ryuk = mysqli_fetch_assoc($qyuk);
	$yuk_masker_pake = balikin($ryuk['total_masker_pake']);
	$yuk_masker_tidak = balikin($ryuk['total_masker_tidak']);
	$yuk_jaga_jarak = balikin($ryuk['total_jaga_jarak']);
	$yuk_jaga_jarak_tidak = balikin($ryuk['total_jaga_jarak_tidak']);
	$yuk_ingatkan = balikin($ryuk['total_ingatkan']);
	$yuk_ingatkan_tidak = balikin($ryuk['total_ingatkan_tidak']);
	$yuk_total_wong = $yuk_masker_pake + $yuk_masker_tidak + $yuk_jaga_jarak + $yuk_jaga_jarak_tidak + $yuk_ingatkan + $yuk_ingatkan_tidak;      
	


	
	
	//update
	mysqli_query($koneksi, "UPDATE perilaku_lap_tgl SET jml_masker = '$yuk_masker_pake', ".
								"jml_masker_tidak = '$yuk_masker_tidak', ".
								"jml_jagajarak = '$yuk_jaga_jarak', ".
								"jml_jagajarak_tidak = '$yuk_jaga_jarak_tidak', ".
								"jml_ingatkan = '$yuk_ingatkan', ".
								"jml_ingatkan_tidak = '$yuk_ingatkan_tidak', ".
								"jml_total = '$yuk_total_wong' ".
								"WHERE tanggal = '$i_tglku' ".
								"AND kd = '$xyz'");

	}
//masukin semua ke database ///////////////////////////////////////////////////////////////////////////








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
	$searchQuery = " and (tanggal like '%".$searchValue."%' or
		jml_masker like '%".$searchValue."%' or
		jml_masker_tidak like '%".$searchValue."%' or
		jml_jagajarak like '%".$searchValue."%' or
		jml_jagajarak_tidak like '%".$searchValue."%' or
		jml_ingatkan like '%".$searchValue."%' or
		jml_ingatkan_tidak like '%".$searchValue."%' or
		jml_total like '%".$searchValue."%' or
        postdate like'%".$searchValue."%' ) ";
}




	
## Total number of records without filtering
$sel = mysqli_query($koneksi,"select tanggal from perilaku_lap_tgl");
$records = mysqli_fetch_assoc($sel);
$totalRecords = mysqli_num_rows($sel);



## Total number of records with filtering
$sel = mysqli_query($koneksi,"select * from perilaku_lap_tgl ".
								"WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = mysqli_num_rows($sel);

 
 
 
 
 
 

## Fetch records
$empQuery = "select * from perilaku_lap_tgl ".
				"WHERE 1 ".$searchQuery." order by round(".$columnName.") ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($koneksi, $empQuery);

$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;
	$i_tglku = balikin($row['tanggal']);
	$i_nil1 = balikin($row['jml_masker']);
	$i_nil2 = balikin($row['jml_masker_tidak']);
	$i_nil3 = balikin($row['jml_jagajarak']);
	$i_nil4 = balikin($row['jml_jagajarak_tidak']);
	$i_nil5 = balikin($row['jml_ingatkan']);
	$i_nil6 = balikin($row['jml_ingatkan_tidak']);
	$i_nil7 = balikin($row['jml_total']);

	
    $data[] = array(
    	"tanggal"=>"$i_tglku", 
    	"jml_total"=>"<font color='red'>$i_nil7</font>", 
    	"jml_masker"=>"<font color='red'>$i_nil1</font>",
    	"jml_masker_tidak"=>"<font color='red'>$i_nil2</font>",
    	"jml_jagajarak"=>"<font color='red'>$i_nil3</font>",
    	"jml_jagajarak_tidak"=>"<font color='red'>$i_nil4</font>",
    	"jml_ingatkan"=>"<font color='red'>$i_nil5</font>",
    	"jml_ingatkan_tidak"=>"<font color='red'>$i_nil6</font>"
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