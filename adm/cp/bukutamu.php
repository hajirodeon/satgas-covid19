<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");
require("../../inc/class/paging.php");


nocache;

//nilai
$filenya = "bukutamu.php";
$judul = "[SETTING]. Buku Tamu";
$judulku = "$judul";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$kd = nosql($_REQUEST['kd']);
$kdku = nosql($_REQUEST['kdku']);




$limit = 10000;



//jika daftar
if($_POST['btnDF'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}
	
	



//jika hapus data
if($_POST['btnHPS'])
	{
	//ambil nilai
	$katkd = nosql($_POST['katkd']);


	//ambil semua
	for ($i=1; $i<=$limit;$i++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$i";
		$kd = nosql($_POST["$yuhu"]);

		//del
		mysqli_query($koneksi, "DELETE FROM cp_bukutamu ".
						"WHERE kd = '$kd'");
		}



	//re-direct
	$ke = "$filenya?katkd=$katkd";
	xloc($ke);
	exit();
	}










require("../template_atas.php");



?>

	
<script>
$(document).ready(function() {
  		
	$.noConflict();
    
});
</script>
  


	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>




<!-- Datatable CSS -->
<link href='../../template/DataTables/datatables.min.css' rel='stylesheet' type='text/css'>

<!-- jQuery Library -->
<script src="../../template/js/jquery-3.3.1.min.js"></script>

<!-- Datatable JS -->
<script src="../../template/DataTables/datatables.min.js"></script>
    








<style>
table{
    width:100%;
}


td.highlight {
    background-color: whitesmoke !important;
}
</style>


<script>

$(document).ready(function() {

$.noConflict();
		 
    $('#example').DataTable( {
        "scrollY": "100%",
        "scrollX": true, 
		"language": {
					"url": "../Indonesian.json",
					"sEmptyTable": "Tidak ada data di database"
				}
    } );
    
    
    var table = $('#example').DataTable();
     
    $('#example tbody')
        .on( 'mouseenter', 'td', function () {
            var colIdx = table.cell(this).index().column;
 
            $( table.cells().nodes() ).removeClass( 'highlight' );
            $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
        } );



} );



</script>



<?php

//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/js/checkall.js");
require("../../inc/js/editor.js");





echo '<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formx">';

//query
$p = new Pager();
$start = $p->findStart($limit);

$sqlcount = "SELECT * FROM cp_bukutamu ".
				"ORDER BY postdate DESC";
$sqlresult = $sqlcount;

$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
$pages = $p->findPages($count, $limit);
$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
$pagelist = $p->pageList($_GET['page'], $pages, $target);
$data = mysqli_fetch_array($result);


if ($count != 0)
	{

	//view data
	echo '<table id="example" class="table table-striped table-bordered row-border hover order-column" style="width:100%">
    <thead>

	<tr bgcolor="'.$warnaheader.'">
	<td width="1">&nbsp;</td>
	<td width="100"><strong><font color="'.$warnatext.'">Postdate</font></strong></td>
	<td><strong><font color="'.$warnatext.'">Isi</font></strong></td>
	</tr>
	</thead>
	<tbody>';
	


	do
		{
		if ($warna_set ==0)
			{
			$warna = $warna01;
			$warna_set = 1;
			}
		else
			{
			$warna = $warna02;
			$warna_set = 0;
			}

		//nilai
		$nomer = $nomer + 1;
		$i_kd = nosql($data['kd']);
		$i_nama = balikin($data['nama']);
		$i_alamat = balikin($data['alamat']);
		$i_telp = balikin($data['telp']);
		$i_situs = balikin($data['situs']);
		$i_email = balikin($data['email']);
		$i_isi = balikin($data['isi']);
		$i_postdate = $data['postdate'];


		
		




		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td><input name="kd'.$nomer.'" type="hidden" value="'.$i_kd.'">
		<input type="checkbox" name="item'.$nomer.'" value="'.$i_kd.'">
		</td>
		<td>'.$i_postdate.'</td>
		<td>
		'.$i_isi.'
		<br>
		<br>
		
		Oleh : <b>'.$i_nama.'</b>, 
		
		Alamat : <b>'.$i_alamat.'</b>
		
		Telepon : <b>'.$i_telp.'</b>

		Situs/Blog/Sosmed : <b>'.$i_situs.'</b>
		
		E-Mail : <b>'.$i_email.'</b>
		
		</td>
		</tr>';
		}
	while ($data = mysqli_fetch_assoc($result));

	echo '</tbody>	
		<tfoot>
		
			<tr bgcolor="'.$warnaheader.'">
			<td width="1">&nbsp;</td>
			<td width="100"><strong><font color="'.$warnatext.'">Postdate</font></strong></td>
			<td><strong><font color="'.$warnatext.'">Isi</font></strong></td>
			</tr>
	
		</tfoot>

	  </table>



	<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td>
	<input name="jml" type="hidden" value="'.$limit.'">
	<input name="s" type="hidden" value="'.nosql($_REQUEST['s']).'">
	<input name="m" type="hidden" value="'.nosql($_REQUEST['m']).'">
	<input name="kdku" type="hidden" value="'.nosql($_REQUEST['kdku']).'">
	<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$limit.')" class="btn btn-success">
	<input name="btnBTL" type="reset" value="BATAL" class="btn btn-info">
	<input name="btnHPS" type="submit" value="HAPUS" class="btn btn-danger">


	</td>
	</tr>
	</table>';
	}
else
	{
	echo '<p>
	<font color="red">
	<strong>TIDAK ADA DATA.</strong>
	</font>
	</p>';
	}




echo '</form>';

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



require("../template_bawah.php");


//diskonek
xclose($koneksi);
exit();
?>