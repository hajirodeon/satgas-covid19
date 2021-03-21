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
	$searchQuery = " and (tanggal like '%".$searchValue."%' or
        postdate like'%".$searchValue."%' ) ";
}




	
## Total number of records without filtering
$sel = mysqli_query($koneksi,"select tanggal from panic_kategori_masalah");
$records = mysqli_fetch_assoc($sel);
$totalRecords = mysqli_num_rows($sel);



## Total number of records with filtering
$sel = mysqli_query($koneksi,"select * from panic_kategori_masalah ".
								"WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = mysqli_num_rows($sel);

 
 
 
 
 
 

## Fetch records
$empQuery = "select * from panic_kategori_masalah ".
				"WHERE 1 ".$searchQuery." order by round(".$columnName.") ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($koneksi, $empQuery);

$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;
	$i_tglku = balikin($row['tanggal']);
	$i_nil1 = balikin($row['nil1']);
	$i_nil2 = balikin($row['nil2']);
	$i_nil3 = balikin($row['nil3']);
	$i_nil4 = balikin($row['nil4']);
	$i_nil5 = balikin($row['nil5']);
	$i_nil6 = balikin($row['nil6']);
	$i_nil7 = balikin($row['nil7']);
	$i_nil8 = balikin($row['nil8']);
	$i_nil9 = balikin($row['nil9']);
	$i_nil10 = balikin($row['nil10']);
	$i_nil11 = balikin($row['nil11']);
	$i_nil12 = balikin($row['nil12']);
	$i_nil13 = balikin($row['nil13']);

	
    $data[] = array(
    	"postdate"=>"$i_tglku", 
    	"nil1"=>"<font color='red'>$i_nil1</font>", 
    	"nil2"=>"<font color='red'>$i_nil2</font>",
    	"nil3"=>"<font color='red'>$i_nil3</font>",
    	"nil4"=>"<font color='red'>$i_nil4</font>",
    	"nil5"=>"<font color='red'>$i_nil5</font>",
    	"nil6"=>"<font color='red'>$i_nil6</font>",
    	"nil7"=>"<font color='red'>$i_nil7</font>", 
    	"nil8"=>"<font color='red'>$i_nil8</font>",
    	"nil9"=>"<font color='red'>$i_nil9</font>",
    	"nil10"=>"<font color='red'>$i_nil10</font>",
    	"nil11"=>"<font color='red'>$i_nil11</font>",
    	"nil12"=>"<font color='red'>$i_nil12</font>",
    	"nil13"=>"<font color='red'>$i_nil13</font>"
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