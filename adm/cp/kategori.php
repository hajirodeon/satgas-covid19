<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");
require("../../inc/class/paging.php");


nocache;

//nilai
$filenya = "kategori.php";
$judul = "[SETTING] Kategori Artikel";
$judulku = "$judul";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$kunci = cegah($_REQUEST['kunci']);
$kd = nosql($_REQUEST['kd']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}



$limit = 10000;



//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//nek baru
if ($_POST['btnBR'])
	{
	//nilai
	$ke = "$filenya?s=baru&kd=$x";
	
	
	//re-direct
	xloc($ke);
	exit();
	}



//nek batal
if ($_POST['btnBTL'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}



//jika simpan
if ($_POST['btnSMP'])
	{
	$s = nosql($_POST['s']);
	$page = nosql($_POST['page']);
	$e_kd = nosql($_POST['e_kd']);
	$e_nama = cegah($_POST['e_nama']);
	
	//nek null
	if (empty($e_nama))
		{
		//re-direct
		$pesan = "Belum Ditulis. Harap Diulangi...!!";
		$ke = "$filenya?s=$s&kd=$e_kd";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//jika baru
		if ($s == "baru")
			{
			//insert
			mysqli_query($koneksi, "INSERT INTO cp_m_kategori(kd, nama, postdate) VALUES ".
							"('$e_kd', '$e_nama', '$today')");


			//re-direct
			xloc($filenya);
			exit();
			}
			
			
				
				
		//jika update
		if ($s == "edit")
			{
			mysqli_query($koneksi, "UPDATE cp_m_kategori SET nama = '$e_nama', ".
							"postdate = '$today' ".
							"WHERE kd = '$e_kd'");


			//re-direct
			xloc($filenya);
			exit();
			}
	
		}
	}

	
	
	

//jika hapus
if ($_POST['btnHPS'])
	{
	//ambil nilai
	$jml = nosql($_POST['jml']);
	$ke = $filenya;

	//ambil semua
	for ($i=1; $i<=$jml;$i++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$i";
		$kd = nosql($_POST["$yuhu"]);

		//del
		mysqli_query($koneksi, "DELETE FROM cp_m_kategori ".
						"WHERE kd = '$kd'");
		}


	//auto-kembali
	xloc($ke);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







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









//require
require("../../template/js/jumpmenu.js");
require("../../template/js/checkall.js");
require("../../template/js/swap.js");


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (($s == "baru") OR ($s == "edit"))
	{
	//edit
	$qx = mysqli_query($koneksi, "SELECT * FROM cp_m_kategori ".
						"WHERE kd = '$kd'");
	$rowx = mysqli_fetch_assoc($qx);
	$e_kd = nosql($rowx['kd']);
	$e_nama = balikin($rowx['nama']);

	
	echo '<div class="row">

		<div class="col-md-10">
		
		
		<form action="'.$filenya.'" method="post" name="formx2">
		
		<p>
		NAMA : 
		<br>
		<input name="e_nama" type="text" size="30" value="'.$e_nama.'" class="btn btn-warning">
		</p>
		
		
		<p>
		<hr>
		<input name="s" type="hidden" value="'.$s.'">
		<input name="e_kd" type="hidden" value="'.$kd.'">
		<input name="page" type="hidden" value="'.$page.'">
	
			
		<input name="btnSMP" type="submit" value="SIMPAN" class="btn btn-danger">
		<input name="btnBTL" type="submit" value="BATAL" class="btn btn-info">
		<hr>
		</p>
		
		
		</form>
		
		
		</div>
	
	
	</div>';
	}
	
	
else
	{
	//query
	$p = new Pager();
	$start = $p->findStart($limit);
	
	$sqlcount = "SELECT * FROM cp_m_kategori ".
					"ORDER BY nama ASC";
	$sqlresult = $sqlcount;
	
	$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysqli_fetch_array($result);




	
	echo '<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formx">
	
	<p>
	<input name="btnBR" type="submit" value="BUAT BARU" class="btn btn-danger">
	<hr>
	</p>
	
	<table id="example" class="table table-striped table-bordered row-border hover order-column" style="width:100%">
    <thead>
			<tr bgcolor="'.$warnaheader.'">
			<td width="16">&nbsp;</td>
			<td width="30">&nbsp;</td>
			<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
			</tr>

	    </thead>
	    <tbody>';
	
	if ($count != 0)
		{
		do {
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
	
			$nomer = $nomer + 1;
			$e_kd = nosql($data['kd']);
			$e_nama = balikin($data['nama']);
			$e_postdate = balikin($data['postdate']);

	
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			<input type="checkbox" name="item'.$nomer.'" value="'.$e_kd.'">
	        </td>
			<td>
			<a href="'.$filenya.'?s=edit&kd='.$e_kd.'"><img src="'.$sumber.'/template/img/edit.gif" width="16" height="16" border="0"></a>
			</td>
			<td>'.$e_nama.'</td>
	        </tr>';
			}
		while ($data = mysqli_fetch_assoc($result));
		}
	
	
	echo '</tbody>
	
		<tfoot>

			<tr bgcolor="'.$warnaheader.'">
			<td width="16">&nbsp;</td>
			<td width="30">&nbsp;</td>
			<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
			</tr>
	
		</tfoot>

	  </table>

		  
	<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td>
	<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$count.')" class="btn btn-primary">
	<input name="btnBTL" type="reset" value="BATAL" class="btn btn-success">
	<input name="btnHPS" type="submit" value="HAPUS" class="btn btn-danger">
	</td>
	</tr>
	</table>
	
	
	</form>';
	}
	







require("../template_bawah.php");





//null-kan
xclose($koneksi);
exit();
?>