<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");
require("../../inc/class/paging.php");


nocache;

//nilai
$filenya = "artikel.php";
$judul = "[SETTING]. Data Artikel";
$judulku = "$judul";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$kd = nosql($_REQUEST['kdku']);
$kdku = nosql($_REQUEST['kdku']);
$kunci = cegah($_REQUEST['kunci']);
$kunci2 = balikin($_REQUEST['kunci']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}





$limit = 10000;










//jika baru
if ($_POST['btnBARU'])
	{
	//re-direct
	$ke = "$filenya?s=baru&kdku=$x";
	xloc($ke);
	exit();
	}
	
	
	
	
	

//jika daftar
if($_POST['btnBTL'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}
	
	





//jika daftar
if($_POST['btnDF'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}
	
	

//jika simpan
if($_POST['btnSMP'])
	{
	$s = nosql($_POST['s']);		
	$kdku = nosql($_POST['kdku']);
	$e_judul = cegah($_POST['e_judul']);
	$e_isi = cegah2($_POST['editor']);
	$e_kategori2 = cegah($_POST['e_kategori2']);

	$namabaru = "$kdku-1.png";

	
	//nek null
	if ((empty($e_kategori2)) OR (empty($e_judul)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		$ke = "$filenya?s=baru&kdku=$kdku";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//jika baru
		if ((empty($s)) OR ($s == "baru"))
			{
			//query
			mysqli_query($koneksi, "INSERT INTO cp_artikel(kd, kategori, judul, isi, postdate, filex) VALUES ".
							"('$kdku', '$e_kategori2', '$e_judul', '$e_isi', '$today', '$namabaru')");

			//re-direct
			xloc($filenya);
			exit();
			}
		else 
			{
			//query
			mysqli_query($koneksi, "UPDATE cp_artikel SET judul = '$e_judul', ".
							"isi = '$e_isi', ".
							"kategori = '$e_kategori2', ".
							"filex = '$namabaru', ".
							"postdate = '$today' ".
							"WHERE kd = '$kdku'");

			//re-direct
			xloc($filenya);
			exit();
			}
		}


	exit();
	}






//jika hapus data
if($_POST['btnHPS'])
	{
	//ambil semua
	for ($i=1; $i<=$limit;$i++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$i";
		$kd = nosql($_POST["$yuhu"]);

		//del
		mysqli_query($koneksi, "DELETE FROM cp_artikel ".
						"WHERE kd = '$kd'");
		}



	//re-direct
	xloc($filenya);
	exit();
	}









//jika cari
if ($_POST['btnCARI'])
	{
	//nilai
	$kunci = cegah($_POST['kunci']);


	//re-direct
	$ke = "$filenya?kunci=$kunci";
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





<script type="text/javascript" src="<?php echo $sumber;?>/inc/class/ckeditor/ckeditor.js"></script>



<?php
//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/js/checkall.js");




//jika edit
//tampilkan form
if (($s == 'baru') OR ($s == 'edit'))
	{
	$foldernya = "../../filebox/artikel/$kd/";
				
				
	//buat folder...
	if (!file_exists('../../filebox/artikel/'.$kd.'')) {
	    mkdir('../../filebox/artikel/'.$kd.'', 0777, true);
		}
	

	chmod($foldernya,0777);



	//query
	$qx = mysqli_query($koneksi, "SELECT * FROM cp_artikel ".
						"WHERE kd = '$kdku'");
	$rowx = mysqli_fetch_assoc($qx);
	$e_judul = balikin($rowx['judul']);
	$e_isi = balikin2($rowx['isi']);
	$e_kategori = balikin($rowx['kategori']);
	$e_postdate = $rowx['postdate'];

	//pecah titik - titik
	$e_isi2 = pathasli2($e_isi);
	
	
	
	echo '<h2>Entri Baru/Edit</h2>

	';
	?>
	
	
	
		
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
	
	
		<style type="text/css">
		.thumb-image{
		 float:left;
		 width:150px;
		 height:150px;
		 position:relative;
		 padding:5px;
		}
		</style>
		
		
		
		
			<table border="0" cellspacing="0" cellpadding="3">
			<tr valign="top">
			<td width="100">
				<div id="image-holder"></div>
			</td>
			
	
			</tr>
			</table>
		
		<script>
		$(document).ready(function() {
			
			
		        $("#image_upload").on('change', function() {
	          //Get count of selected files
	          var countFiles = $(this)[0].files.length;
	          var imgPath = $(this)[0].value;
	          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
	          var image_holder = $("#image-holder");
	          image_holder.empty();
	          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
	            if (typeof(FileReader) != "undefined") {
	              //loop for each file selected for uploaded.
	              for (var i = 0; i < countFiles; i++) 
	              {
	                var reader = new FileReader();
	                reader.onload = function(e) {
	                  $("<img />", {
	                    "src": e.target.result,
	                    "class": "thumb-image"
	                  }).appendTo(image_holder);
	                }
	                image_holder.show();
	                reader.readAsDataURL($(this)[0].files[i]);
	              }
	              
	
		    
	            } else {
	              alert("This browser does not support FileReader.");
	            }
	          } else {
	            alert("Pls select only images");
	          }
	        });
	        
	        
	
	
	        
	        
	        
	      });
	</script>
	
	<?php
	echo '<div id="loading" style="display:none">
	<img src="'.$sumber.'/template/img/progress-bar.gif" width="100" height="16">
		</div>
		
		
	   <form method="post" id="upload_image" enctype="multipart/form-data">
	<input type="file" name="image_upload" id="image_upload" class="btn btn-warning" />
	
	   </form>';
	
	?>
	
	
	<script>  
	$(document).ready(function(){
		
		
		
	       $('#image-holder').load("<?php echo $sumber;?>/adm/cp/i_artikel.php?aksi=lihat1&kd=<?php echo $kd;?>");
	
	
	
	        
	    $('#upload_image').on('change', function(event){
	     event.preventDefault();
	     
			$('#loading').show();
	
	
		
		     $.ajax({
		      url:"i_artikel_upload.php?kd=<?php echo $kd;?>",
		      method:"POST",
		      data:new FormData(this),
		      contentType:false,
		      cache:false,
		      processData:false,
		      success:function(data){
				$('#loading').hide();
		       $('#preview').load("<?php echo $sumber;?>/adm/cp/i_artikel.php?aksi=lihat&kd=<?php echo $kd;?>");
		       	
		      }
		     })
		    });
		    
		    
	});  
	</script>


	<?php	
	echo '<p>
	NB. File Image dengan Resolusi 400 x 400 pixel
	</p>
	
	
	<hr>
	
	
	<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formx2">
		
	<p>
	Judul : 
	<br>
	<input name="e_judul" id="e_judul" type="text" value="'.$e_judul.'" size="50" class="btn-warning" required>
	</p>
	
	<p>
	Isi : 
	<br>
	<textarea id="editor" name="editor" rows="20" cols="80" style="width: 100%" class="btn-warning">'.$e_isi2.'</textarea>
	</p>
	<br>
	
	<p>
	Kategori :
	<br>
	<select name="e_kategori2" id="e_kategori2" class="btn btn-warning" required>';
	
	//terpilih
	$qstx2 = mysqli_query($koneksi, "SELECT * FROM cp_m_kategori ".
							"WHERE kd = '$katkd'");
	$rowstx2 = mysqli_fetch_assoc($qstx2);
	$stx2_kd = cegah($rowstx2['nama']);
	$stx2_nama1 = balikin($rowstx2['nama']);
	
	echo '<option value="'.$stx2_kd.'" selected>--'.$stx2_nama1.'--</option>';
	
	$qst = mysqli_query($koneksi, "SELECT * FROM cp_m_kategori ".
							"ORDER BY nama ASC");
	$rowst = mysqli_fetch_assoc($qst);
	
	do
		{
		$st_kd = cegah($rowst['nama']);
		$st_nama1 = balikin($rowst['nama']);
	
		//query
		$q = mysqli_query($koneksi, "SELECT * FROM cp_artikel ".
							"WHERE kategori = '$st_kd'");
		$row = mysqli_fetch_assoc($q);
		$total = mysqli_num_rows($q);
	
	
	
		echo '<option value="'.$st_kd.'">'.$st_nama1.' [Jumlah : '.$total.'].</option>';
		}
	while ($rowst = mysqli_fetch_assoc($qst));
	
	echo '</select>
	</p>
	
	

	<p>
	<input name="kdku" id="kdku" type="hidden" value="'.$kdku.'">
	<input name="s" type="hidden" value="'.$s.'">
	
	<button name="btnSMP" id="btnSMP" type="submit" value="SIMPAN" class="btn btn-danger">SIMPAN</button>
	<button name="btnBTL" id="btnBTL" type="submit" value="BATAL" class="btn btn-info">BATAL</button>
	</p>
	
	
	</form>';
	
	
	?>
	
	
		
	<script type="text/javascript">
	//<![CDATA[
	var roxyFileman = '<?php echo $sumber;?>/inc/class/ckeditor/plugins/fileman/index.html';
	 
	$(function(){
    CKEDITOR.replace( 'editor',{filebrowserBrowseUrl:roxyFileman,
                         filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                         removeDialogTabs: 'link:upload;image:upload'}); 
	});


	//]]>
	</script>
	
	<?php
	}







else 
	{
	$target = "$filenya?s=$s&kunci=$kunci";
	
	
	
	//jika null
	if (empty($kunci))
		{
		//query
		$p = new Pager();
		$start = $p->findStart($limit);
	
		$sqlcount = "SELECT * FROM cp_artikel ".
						"ORDER BY postdate DESC";
		$sqlresult = $sqlcount;
	
		$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysqli_fetch_array($result);
		}
	else 
		{
		//query
		$p = new Pager();
		$start = $p->findStart($limit);
	
		$sqlcount = "SELECT * FROM cp_artikel ".
						"WHERE kategori LIKE '%$kunci%' ".
						"OR judul LIKE '%$kunci%' ".
						"ORDER BY postdate DESC";
		$sqlresult = $sqlcount;
	
		$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysqli_fetch_array($result);
		}



	echo '<form action="'.$filenya.'" method="post" name="formxx">
	<p>
	<input name="btnBARU" type="submit" value="ENTRI BARU" class="btn btn-danger">
	</p>
	<br>
	
	</form>';
		

	if ($count != 0)
		{
		echo '<form action="'.$filenya.'" method="post" name="formx">';

		//view data
		echo '<table id="example" class="table table-striped table-bordered row-border hover order-column" style="width:100%">
	    <thead>

		<tr bgcolor="'.$warnaheader.'">
		<td width="1">&nbsp;</td>
		<td width="1">&nbsp;</td>
		<td width="50"><strong><font color="'.$warnatext.'">POSTDATE</font></strong></td>
		<td width="150"><strong><font color="'.$warnatext.'">KATEGORI</font></strong></td>
		<td width="150"><strong><font color="'.$warnatext.'">FOTO</font></strong></td>
		<td><strong><font color="'.$warnatext.'">JUDUL</font></strong></td>
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
			$i_judul = balikin($data['judul']);
			$i_isi = balikin($data['isi']);
			$i_postdate = $data['postdate'];
			$i_kategori = balikin($data['kategori']);
			$i_filex = balikin($data['filex']);
			
			//$nil_foto = "$sumber/filebox/artikel/$i_kd/thumb-$i_filex";
			$nil_foto = "$sumber/filebox/artikel/$i_kd/$i_filex";
			
			


			//pecah titik - titik
			$i_isi2 = pathasli2($i_isi);




			$namabaru = "$i_kd-1.png";


			//query
			mysqli_query($koneksi, "UPDATE cp_artikel SET filex = '$namabaru' ".
							"WHERE kd = '$i_kd'");


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td><input name="kd'.$nomer.'" type="hidden" value="'.$i_kd.'">
			<input type="checkbox" name="item'.$nomer.'" value="'.$i_kd.'">
    		</td>
			<td>
			<a href="'.$filenya.'?s=edit&kdku='.$i_kd.'" title="EDIT..."><img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"></a>
			</td>
			<td>'.$i_postdate.'</td>
			<td>'.$i_kategori.'</td>
			<td>
			<img src="'.$nil_foto.'" height="100">
			</td>
			<td>'.$i_judul.'</td>
    		</tr>';
			}
		while ($data = mysqli_fetch_assoc($result));

		echo '</tbody>
			<tfoot>

				<tr bgcolor="'.$warnaheader.'">
				<td width="1">&nbsp;</td>
				<td width="1">&nbsp;</td>
				<td width="50"><strong><font color="'.$warnatext.'">POSTDATE</font></strong></td>
				<td width="150"><strong><font color="'.$warnatext.'">KATEGORI</font></strong></td>
				<td width="150"><strong><font color="'.$warnatext.'">FOTO</font></strong></td>
				<td><strong><font color="'.$warnatext.'">JUDUL</font></strong></td>
				</tr>
			</tfoot>
			
		  </table>


		<table width="100%" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td>
		<input name="jml" type="hidden" value="'.$limit.'">
		<input name="s" type="hidden" value="'.nosql($_REQUEST['s']).'">
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
	}




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

require("../template_bawah.php");






//diskonek
xclose($koneksi);
exit();
?>