<?php
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");

/*

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



//echo json_encode($response);

echo json_encode($data);
*/



/*
?>



{
"columns": [
        [ "Name" ],
        [ "Position" ],
        [ "Office" ],
        [ "Extn." ],
        [ "Start date" ],
        [ "Salary" ]
    ],
  "data": [
    [
      "Tiger Nixon",
      "System Architect",
      "Edinburgh",
      "5421",
      "2011/04/25",
      "$320,800"
    ],
    [
      "Garrett Winters",
      "Accountant",
      "Tokyo",
      "8422",
      "2011/07/25",
      "$170,750"
    ],
    [
      "Ashton Cox",
      "Junior Technical Author",
      "San Francisco",
      "1562",
      "2009/01/12",
      "$86,000"
    ],
    [
      "Cedric Kelly",
      "Senior Javascript Developer",
      "Edinburgh",
      "6224",
      "2012/03/29",
      "$433,060"
    ],
    [
      "Airi Satou",
      "Accountant",
      "Tokyo",
      "5407",
      "2008/11/28",
      "$162,700"
    ],
    [
      "Brielle Williamson",
      "Integration Specialist",
      "New York",
      "4804",
      "2012/12/02",
      "$372,000"
    ],
    [
      "Herrod Chandler",
      "Sales Assistant",
      "San Francisco",
      "9608",
      "2012/08/06",
      "$137,500"
    ],
    [
      "Rhona Davidson",
      "Integration Specialist",
      "Tokyo",
      "6200",
      "2010/10/14",
      "$327,900"
    ],
    [
      "Colleen Hurst",
      "Javascript Developer",
      "San Francisco",
      "2360",
      "2009/09/15",
      "$205,500"
    ]
  ]
}
*/
?> 







{
"columns": [
        [ "KD" ],
        [ "POSTDATE" ]
    ],
  "data": [

<?php
$qku = mysqli_query($koneksi, "SELECT * FROM orang_lokasi ".
								"ORDER BY postdate DESC");
$rku = mysqli_fetch_assoc($qku);

do
	{
	//nilai
	$ku_kd = balikin($rku['kd']);
	$ku_postdate = balikin($rku['postdate']);
	
	?>
    [
      "<?php echo $ku_kd;?>",
      "<?php echo $ku_postdate;?>"
    ],
   	<?php
	}
while ($rku = mysqli_fetch_assoc($qku));



//end
$qku = mysqli_query($koneksi, "SELECT * FROM orang_lokasi ".
								"ORDER BY postdate ASC LIMIT 0,1");
$rku = mysqli_fetch_assoc($qku);
$ku_kd = balikin($rku['kd']);
$ku_postdate = balikin($rku['postdate']);
?>
    [
      "<?php echo $ku_kd;?>",
      "<?php echo $ku_postdate;?>"
    ]
    
    
    
  ]
}
