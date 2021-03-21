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
$sel = mysqli_query($koneksi,"select DISTINCT DATE(postdate) from panic_kec_total ".
								"ORDER BY postdate DESC");
$records = mysqli_fetch_assoc($sel);
$totalRecords = mysqli_num_rows($sel);



## Total number of records with filtering
$sel = mysqli_query($koneksi,"select * from panic_kec_total ".
								"WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = mysqli_num_rows($sel);

 
 
 
 
 
 

## Fetch records
$empQuery = "select * from panic_kec_total ".
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
	$i_nil14 = balikin($row['nil14']);
	$i_nil15 = balikin($row['nil15']);
	$i_nil16 = balikin($row['nil16']);
	$i_nil17 = balikin($row['nil17']);
	$i_nil18 = balikin($row['nil18']);
	$i_nil19 = balikin($row['nil19']);
	$i_nil20 = balikin($row['nil20']);



	//korban
	$qyuu = mysqli_query($koneksi, "select * from panic_kec_korban ".
									"WHERE tanggal = '$i_tglku' ".
									"ORDER BY postdate DESC");
	$ryuu = mysqli_fetch_assoc($qyuu);
	$tyuu = mysqli_num_rows($qyuu);
	$i_mnil1 = intval(balikin($ryuu['nil1']));
	$i_mnil2 = intval(balikin($ryuu['nil2']));
	$i_mnil3 = intval(balikin($ryuu['nil3']));
	$i_mnil4 = intval(balikin($ryuu['nil4']));
	$i_mnil5 = intval(balikin($ryuu['nil5']));
	$i_mnil6 = intval(balikin($ryuu['nil6']));
	$i_mnil7 = intval(balikin($ryuu['nil7']));
	$i_mnil8 = intval(balikin($ryuu['nil8']));
	$i_mnil9 = intval(balikin($ryuu['nil9']));
	$i_mnil10 = intval(balikin($ryuu['nil10']));
	$i_mnil11 = intval(balikin($ryuu['nil11']));
	$i_mnil12 = intval(balikin($ryuu['nil12']));
	$i_mnil13 = intval(balikin($ryuu['nil13']));
	$i_mnil14 = intval(balikin($ryuu['nil14']));
	$i_mnil15 = intval(balikin($ryuu['nil15']));
	$i_mnil16 = intval(balikin($ryuu['nil16']));
	$i_mnil17 = intval(balikin($ryuu['nil17']));
	$i_mnil18 = intval(balikin($ryuu['nil18']));
	$i_mnil19 = intval(balikin($ryuu['nil19']));
	$i_mnil20 = intval(balikin($ryuu['nil20']));
	







	//penolong
	$qyuu = mysqli_query($koneksi, "select * from panic_kec_penolong ".
									"WHERE tanggal = '$i_tglku' ".
									"ORDER BY postdate DESC");
	$ryuu = mysqli_fetch_assoc($qyuu);
	$tyuu = mysqli_num_rows($qyuu);
	$i_mtnil1 = intval(balikin($ryuu['nil1']));
	$i_mtnil2 = intval(balikin($ryuu['nil2']));
	$i_mtnil3 = intval(balikin($ryuu['nil3']));
	$i_mtnil4 = intval(balikin($ryuu['nil4']));
	$i_mtnil5 = intval(balikin($ryuu['nil5']));
	$i_mtnil6 = intval(balikin($ryuu['nil6']));
	$i_mtnil7 = intval(balikin($ryuu['nil7']));
	$i_mtnil8 = intval(balikin($ryuu['nil8']));
	$i_mtnil9 = intval(balikin($ryuu['nil9']));
	$i_mtnil10 = intval(balikin($ryuu['nil10']));
	$i_mtnil11 = intval(balikin($ryuu['nil11']));
	$i_mtnil12 = intval(balikin($ryuu['nil12']));
	$i_mtnil13 = intval(balikin($ryuu['nil13']));
	$i_mtnil14 = intval(balikin($ryuu['nil14']));
	$i_mtnil15 = intval(balikin($ryuu['nil15']));
	$i_mtnil16 = intval(balikin($ryuu['nil16']));
	$i_mtnil17 = intval(balikin($ryuu['nil17']));
	$i_mtnil18 = intval(balikin($ryuu['nil18']));
	$i_mtnil19 = intval(balikin($ryuu['nil19']));
	$i_mtnil20 = intval(balikin($ryuu['nil20']));

	
	
	
	
	
	
	

	//tolong
	$qyuu = mysqli_query($koneksi, "select * from panic_kec_tolong ".
									"WHERE tanggal = '$i_tglku' ".
									"ORDER BY postdate DESC");
	$ryuu = mysqli_fetch_assoc($qyuu);
	$tyuu = mysqli_num_rows($qyuu);
	$i_jjnil1 = intval(balikin($ryuu['nil1']));
	$i_jjnil2 = intval(balikin($ryuu['nil2']));
	$i_jjnil3 = intval(balikin($ryuu['nil3']));
	$i_jjnil4 = intval(balikin($ryuu['nil4']));
	$i_jjnil5 = intval(balikin($ryuu['nil5']));
	$i_jjnil6 = intval(balikin($ryuu['nil6']));
	$i_jjnil7 = intval(balikin($ryuu['nil7']));
	$i_jjnil8 = intval(balikin($ryuu['nil8']));
	$i_jjnil9 = intval(balikin($ryuu['nil9']));
	$i_jjnil10 = intval(balikin($ryuu['nil10']));
	$i_jjnil11 = intval(balikin($ryuu['nil11']));
	$i_jjnil12 = intval(balikin($ryuu['nil12']));
	$i_jjnil13 = intval(balikin($ryuu['nil13']));
	$i_jjnil14 = intval(balikin($ryuu['nil14']));
	$i_jjnil15 = intval(balikin($ryuu['nil15']));
	$i_jjnil16 = intval(balikin($ryuu['nil16']));
	$i_jjnil17 = intval(balikin($ryuu['nil17']));
	$i_jjnil18 = intval(balikin($ryuu['nil18']));
	$i_jjnil19 = intval(balikin($ryuu['nil19']));
	$i_jjnil20 = intval(balikin($ryuu['nil20']));
	











	//tolong tidak
	$qyuu = mysqli_query($koneksi, "select * from panic_kec_tolong_tidak ".
									"WHERE tanggal = '$i_tglku' ".
									"ORDER BY postdate DESC");
	$ryuu = mysqli_fetch_assoc($qyuu);
	$tyuu = mysqli_num_rows($qyuu);
	$i_jtnil1 = intval(balikin($ryuu['nil1']));
	$i_jtnil2 = intval(balikin($ryuu['nil2']));
	$i_jtnil3 = intval(balikin($ryuu['nil3']));
	$i_jtnil4 = intval(balikin($ryuu['nil4']));
	$i_jtnil5 = intval(balikin($ryuu['nil5']));
	$i_jtnil6 = intval(balikin($ryuu['nil6']));
	$i_jtnil7 = intval(balikin($ryuu['nil7']));
	$i_jtnil8 = intval(balikin($ryuu['nil8']));
	$i_jtnil9 = intval(balikin($ryuu['nil9']));
	$i_jtnil10 = intval(balikin($ryuu['nil10']));
	$i_jtnil11 = intval(balikin($ryuu['nil11']));
	$i_jtnil12 = intval(balikin($ryuu['nil12']));
	$i_jtnil13 = intval(balikin($ryuu['nil13']));
	$i_jtnil14 = intval(balikin($ryuu['nil14']));
	$i_jtnil15 = intval(balikin($ryuu['nil15']));
	$i_jtnil16 = intval(balikin($ryuu['nil16']));
	$i_jtnil17 = intval(balikin($ryuu['nil17']));
	$i_jtnil18 = intval(balikin($ryuu['nil18']));
	$i_jtnil19 = intval(balikin($ryuu['nil19']));
	$i_jtnil20 = intval(balikin($ryuu['nil20']));








	

	
    $data[] = array(
    	"postdate"=>"$i_tglku
    					<br><font color='red'>TOTAL_KEJADIAN:</font> 
    					<br><font color='green'>KORBAN:</font> 
    					<br><font color='orange'>PENOLONG:</font>
    					<br><font color='purple'>DITOLONG:</font>
    					<br><font color='blue'>TIDAK_DITOLONG:</font>", 
    	"nil1"=>"<br><font color='red'>$i_nil1</font> 
    					<br><font color='green'>$i_mnil1</font> 
    					<br><font color='orange'>$i_mtnil1</font>
    					<br><font color='purple'>$i_jjnil1</font>
    					<br><font color='blue'>$i_jtnil1</font>", 
    	"nil2"=>"<br><font color='red'>$i_nil2</font> 
    					<br><font color='green'>$i_mnil2</font> 
    					<br><font color='orange'>$i_mtnil2</font>
    					<br><font color='purple'>$i_jjnil2</font>
    					<br><font color='blue'>$i_jtnil2</font>",
    	"nil3"=>"<br><font color='red'>$i_nil3</font> 
    					<br><font color='green'>$i_mnil3</font> 
    					<br><font color='orange'>$i_mtnil3</font>
    					<br><font color='purple'>$i_jjnil3</font>
    					<br><font color='blue'>$i_jtnil3</font>",
    	"nil4"=>"<br><font color='red'>$i_nil4</font> 
    					<br><font color='green'>$i_mnil4</font> 
    					<br><font color='orange'>$i_mtnil4</font>
    					<br><font color='purple'>$i_jjnil4</font>
    					<br><font color='blue'>$i_jtnil4</font>",
    	"nil5"=>"<br><font color='red'>$i_nil5</font> 
    					<br><font color='green'>$i_mnil5</font> 
    					<br><font color='orange'>$i_mtnil5</font>
    					<br><font color='purple'>$i_jjnil5</font>
    					<br><font color='blue'>$i_jtnil5</font>",
    	"nil6"=>"<br><font color='red'>$i_nil6</font> 
    					<br><font color='green'>$i_mnil6</font> 
    					<br><font color='orange'>$i_mtnil6</font>
    					<br><font color='purple'>$i_jjnil6</font>
    					<br><font color='blue'>$i_jtnil6</font>",
    	"nil7"=>"<br><font color='red'>$i_nil7</font> 
    					<br><font color='green'>$i_mnil7</font> 
    					<br><font color='orange'>$i_mtnil7</font>
    					<br><font color='purple'>$i_jjnil7</font>
    					<br><font color='blue'>$i_jtnil7</font>", 
    	"nil8"=>"<br><font color='red'>$i_nil8</font> 
    					<br><font color='green'>$i_mnil8</font> 
    					<br><font color='orange'>$i_mtnil8</font>
    					<br><font color='purple'>$i_jjnil8</font>
    					<br><font color='blue'>$i_jtnil8</font>",
    	"nil9"=>"<br><font color='red'>$i_nil9</font> 
    					<br><font color='green'>$i_mnil9</font> 
    					<br><font color='orange'>$i_mtnil9</font>
    					<br><font color='purbple'>$i_jjnil9</font>
    					<br><font color='blue'>$i_jtnil9</font>",
    	"nil10"=>"<br><font color='red'>$i_nil10</font> 
    					<br><font color='green'>$i_mnil10</font> 
    					<br><font color='orange'>$i_mtnil10</font>
    					<br><font color='purple'>$i_jjnil10</font>
    					<br><font color='blue'>$i_jtnil10</font>",
    	"nil11"=>"<br><font color='red'>$i_nil11</font> 
    					<br><font color='green'>$i_mnil11</font> 
    					<br><font color='orange'>$i_mtnil11</font>
    					<br><font color='purple'>$i_jjnil11</font>
    					<br><font color='blue'>$i_jtnil11</font>",
    	"nil12"=>"<br><font color='red'>$i_nil12</font> 
    					<br><font color='green'>$i_mnil12</font> 
    					<br><font color='orange'>$i_mtnil12</font>
    					<br><font color='purple'>$i_jjnil12</font>
    					<br><font color='blue'>$i_jtnil12</font>",
    	"nil13"=>"<br><font color='red'>$i_nil13</font> 
    					<br><font color='green'>$i_mnil13</font> 
    					<br><font color='orange'>$i_mtnil13</font>
    					<br><font color='purple'>$i_jjnil13</font>
    					<br><font color='blue'>$i_jtnil13</font>",
    	"nil14"=>"<br><font color='red'>$i_nil14</font> 
    					<br><font color='green'>$i_mnil14</font> 
    					<br><font color='orange'>$i_mtnil14</font>
    					<br><font color='purple'>$i_jjnil14</font>
    					<br><font color='blue'>$i_jtnil14</font>",
    	"nil15"=>"<br><font color='red'>$i_nil15</font> 
    					<br><font color='green'>$i_mnil15</font> 
    					<br><font color='orange'>$i_mtnil15</font>
    					<br><font color='purple'>$i_jjnil15</font>
    					<br><font color='blue'>$i_jtnil15</font>",
    	"nil16"=>"<br><font color='red'>$i_nil16</font> 
    					<br><font color='green'>$i_mnil16</font> 
    					<br><font color='orange'>$i_mtnil16</font>
    					<br><font color='purple'>$i_jjnil16</font>
    					<br><font color='blue'>$i_jtnil16</font>",
    	"nil17"=>"<br><font color='red'>$i_nil17</font> 
    					<br><font color='green'>$i_mnil17</font> 
    					<br><font color='orange'>$i_mtnil17</font>
    					<br><font color='purple'>$i_jjnil17</font>
    					<br><font color='blue'>$i_jtnil17</font>",
    	"nil18"=>"<br><font color='red'>$i_nil18</font> 
    					<br><font color='green'>$i_mnil18</font> 
    					<br><font color='orange'>$i_mtnil18</font>
    					<br><font color='purple'>$i_jjnil18</font>
    					<br><font color='blue'>$i_jtnil18</font>",
    	"nil19"=>"<br><font color='red'>$i_nil19</font> 
    					<br><font color='green'>$i_mnil19</font> 
    					<br><font color='orange'>$i_mtnil19</font>
    					<br><font color='purple'>$i_jjnil19</font>
    					<br><font color='blue'>$i_jtnil19</font>",
    	"nil20"=>"<br><font color='red'>$i_nil20</font> 
    					<br><font color='green'>$i_mnil20</font> 
    					<br><font color='orange'>$i_mtnil20</font>
    					<br><font color='purple'>$i_jjnil20</font>
    					<br><font color='blue'>$i_jtnil20</font>"
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