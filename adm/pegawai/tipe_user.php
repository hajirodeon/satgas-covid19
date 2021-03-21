<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");
require("../../inc/class/paging.php");



nocache;

//nilai
$filenya = "tipe_user.php";
$judul = "[USER] Tipe User";
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
	$e_no = cegah($_POST['e_no']);
	$e_nama = cegah($_POST['e_nama']);
	$e_warna = cegah($_POST['e_warna']);
	
	//nek null
	if (empty($e_nama) OR (empty($e_no)) OR (empty($e_warna)))
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
			mysqli_query($koneksi, "INSERT INTO m_tipe_user(kd, no, nama, warna, postdate) VALUES ".
							"('$e_kd', '$e_no', '$e_nama', '$e_warna', '$today')");


			//re-direct
			xloc($filenya);
			exit();
			}
			
			
				
				
		//jika update
		if ($s == "edit")
			{
			mysqli_query($koneksi, "UPDATE m_tipe_user SET no = '$e_no', ".
							"nama = '$e_nama', ".
							"warna = '$e_warna', ".
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
		mysqli_query($koneksi, "DELETE FROM m_tipe_user ".
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
  



<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap.min.css">


    
    








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
	$qx = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
						"WHERE kd = '$kd'");
	$rowx = mysqli_fetch_assoc($qx);
	$e_kd = nosql($rowx['kd']);
	$e_no = balikin($rowx['no']);
	$e_nama = balikin($rowx['nama']);
	$e_warna = balikin($rowx['warna']);

	
	echo '<div class="row">

		<div class="col-md-10">
		
		
		<form action="'.$filenya.'" method="post" name="formx2">
		
		<p>
		NO.URUT : 
		<br>
		<input name="e_no" type="text" size="5" value="'.$e_no.'" class="btn btn-warning" required>
		</p>
		
		<p>
		NAMA : 
		<br>
		<input name="e_nama" type="text" size="30" value="'.$e_nama.'" class="btn btn-warning" required>
		</p>
		
		
		<p>
		KODE WARNA : 
		<br>
		<input name="e_warna" type="text" size="10" value="'.$e_warna.'" class="btn btn-warning" required>
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
	
	$sqlcount = "SELECT * FROM m_tipe_user ".
					"ORDER BY round(no) ASC";
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
			<td width="50"><strong><font color="'.$warnatext.'">NO</font></strong></td>
			<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
			<td width="100"><strong><font color="'.$warnatext.'">KODE WARNA</font></strong></td>
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
			$e_no = balikin($data['no']);
			$e_nama = balikin($data['nama']);
			$e_warna = balikin($data['warna']);
			$e_postdate = balikin($data['postdate']);


			//jika ada warna
			if (!empty($e_nama))
				{
				$e_warna_ket = "<i class=\"fa fa-square\" style=\"font-size:24px;color:$e_warna\"></i>";	
				}
			else
				{
				$e_warna_ket = "";
				}

			
				
				
				
				
	
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			<input type="checkbox" name="item'.$nomer.'" value="'.$e_kd.'">
	        </td>
			<td>
			<a href="'.$filenya.'?s=edit&kd='.$e_kd.'"><img src="'.$sumber.'/template/img/edit.gif" width="16" height="16" border="0"></a>
			</td>
			<td>'.$e_no.'</td>
			<td>'.$e_nama.'</td>
			<td>
			'.$e_warna.' '.$e_warna_ket.'
			</td>
	        </tr>';
			}
		while ($data = mysqli_fetch_assoc($result));
		}
	
	
	echo '</tbody>
	
		<tfoot>

			<tr bgcolor="'.$warnaheader.'">
			<td width="16">&nbsp;</td>
			<td width="30">&nbsp;</td>
			<td><strong><font color="'.$warnatext.'">NO</font></strong></td>
			<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
			<td><strong><font color="'.$warnatext.'">KODE WARNA</font></strong></td>
			</tr>
	
		</tfoot>

	  </table>

		  
	<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td>
	<input name="jml" type="hidden" value="'.$count.'">
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