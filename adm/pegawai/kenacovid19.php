<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");

nocache;

//nilai
$filenya = "kenacovid19.php";
$judul = "Kena Covid-19";
$judulku = "[USER] $judul";
$judulx = $judul;
$kd = nosql($_REQUEST['kd']);
$s = nosql($_REQUEST['s']);
$kunci = cegah($_REQUEST['kunci']);
$kunci2 = balikin($_REQUEST['kunci']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}






//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika simpan
if ($_POST['btnSMP'])
	{
	$s = nosql($_POST['s']);
	$kd = nosql($_POST['kd']);
	$page = nosql($_POST['page']);
	$e_nip = cegah($_POST['e_nip']);
	$e_nama = cegah($_POST['e_nama']);
	$e_tipe = cegah($_POST['e_tipe']);
	$e_tipe2 = balikin($_POST['e_tipe']);
	$e_jabatan = cegah($_POST['e_jabatan']);
	$e_tgl_lahir = cegah($_POST['e_tgl_lahir']);
	$e_tgl1 = cegah($_POST['e_tgl1']);
	$e_tgl2 = cegah($_POST['e_tgl2']);
	$e_email = cegah($_POST['e_email']);
	$e_telp = cegah($_POST['e_telp']);
	$e_alamat = cegah($_POST['e_alamat']);

		
	
	$namabaru = "$e_nip-1.jpg";





	//jika edit / baru
	$fotoku = "../../filebox/pegawai/$kd/$e_nip-1.jpg";
	
	
	//nek ada foto
	if (file_exists($fotoku))
		{
		$nil_foto = "../../filebox/pegawai/$kd/$e_nip-1.jpg";
		}
	else
		{
		$nil_foto = "../../img/foto_blank.jpg";
		
		//mengkopi file
		copy($nil_foto,"../../filebox/pegawai/$kd/$e_nip-1.jpg");
		}







	//update
	mysqli_query($koneksi, "UPDATE m_orang SET kenacovid_tgl_awal = '$e_tgl1', ".
					"kenacovid_tgl_akhir = '$e_tgl2', ".
					"kenacovid_postdate = '$today' ".
					"WHERE kd = '$kd'");

	//re-direct
	xloc($filenya);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





require("../template_atas.php");


//require
require("../../template/js/jumpmenu.js");
require("../../template/js/checkall.js");
require("../../template/js/swap.js");



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika edit
if (($s == "baru") OR ($s == "edit"))
	{
	$kdx = nosql($_REQUEST['kd']);

	$foldernya = "../../filebox/pegawai/$kdx/";
			
				
	//buat folder...
	if (!file_exists('../../filebox/pegawai/'.$kdx.'')) {
	    mkdir('../../filebox/pegawai/'.$kdx.'', 0777, true);
		}
		
	
	
	
	//query
	$qx = mysqli_query($koneksi, "SELECT * FROM m_orang ".
						"WHERE kd = '$kdx'");
	$rowx = mysqli_fetch_assoc($qx);
	$e_nip = balikin($rowx['nip']);
	$e_nama = balikin($rowx['nama']);
	$e_tipe = balikin($rowx['tipe_user']);
	$e_tipe2 = cegah($rowx['tipe_user']);
	$e_jabatan = balikin($rowx['jabatan']);
	$e_tgl_lahir = balikin($rowx['tgl_lahir']);
	$e_alamat = balikin($rowx['alamat']);
	$e_telp = balikin($rowx['telp']);
	$e_email = balikin($rowx['email']);
	$e_filex1 = balikin($rowx['filex1']);


	$namabaru = "$kdx-1.jpg";



	//update
	mysqli_query($koneksi, "UPDATE m_orang SET filex1 = '$namabaru', ".
					"postdate = '$today' ".
					"WHERE kd = '$kdx'");




	//jika edit / baru
	$fotoku = "$sumber/filebox/pegawai/$kd/$e_nip-1.jpg";
	
	//nek ada foto
	if (file_exists($fotoku))
		{
		$nil_foto = "$sumber/filebox/pegawai/$kd/$e_nip-1.jpg";
		}
	else
		{
		$nil_foto = "$sumber/img/foto_blank.png";
		
		
		$nil_foto = "../../img/foto_blank.jpg";
		
		//mengkopi file
		copy($nil_foto,"../../filebox/pegawai/$kd/$e_nip-1.jpg");
		}

		
		
		
		
		

	$nil_foto = "../../filebox/pegawai/$kd/$e_nip-1.jpg";
	$pathkecil = "../../filebox/pegawai/$kd/thumb-$e_nip-1.jpg";
	$pathkecil2 = "../../filebox/pegawai/$kd/marker$e_nip-1.jpg";



	
	//bikin image kecil //////////////////////////////////////////////////////////////////////////////////
	header('Content-type: image/jpeg');
	$file = $nil_foto;
	
	$new_width = 32;
	$new_height = 32;
	list($old_width, $old_height) = getimagesize($file);
	
	$new_image = imagecreatetruecolor($new_width, $new_height);
	$old_image = imagecreatefromjpeg($file);
	
	imagecopyresampled($new_image, $old_image, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);
	
	imagejpeg($new_image, $pathkecil);
	
	

	








		

	?>
	
	
	
	<div class="row">

	<div class="col-md-6">
		
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
	
	
	$.noConflict();
	
	    $('#e_tgl_lahir').datepicker({
	        format: 'dd/mm/yyyy',
	        todayHighlight: true,
	        autoclose: true,
	    })
			
	});
	
	</script>
	

	<?php
	echo '<form action="'.$filenya.'" method="post" name="formx2">
	
	
	<p>
	NIK : 
	<br>
	<b>'.$e_nip.'</b>
	</p>
	<br>
	
	
	
	<p>
	Nama : 
	<br>
	<b>'.$e_nama.'</b>
	</p>
	<br>
	
	
	<p>
	Tipe User : 
	<br>
	<b>'.$e_tipe.'</b>
	</p>
	<br>

	
	
	
	<p>
	Jabatan : 
	<br>
	<b>'.$e_jabatan.'</b>
	</p>
	<br>
	
	
	
	
	<p>
	Tgl. Lahir : 
	<br>
	<b>'.$e_tgl_lahir.'</b>
	</p>
	
	
	<p>
	Alamat : 
	<br>
	<b>'.$e_alamat.'</b>
	</p>
	
	
	<p>
	Telepon : 
	<br>
	<b>'.$e_telp.'</b>
	</p>
	
	
	<p>
	E-Mail : 
	<br>
	<b>'.$e_email.'</b>
	</p>
	
	
	
	<hr>
	
	
	<p>
	Kena Covid-19 Sejak Tanggal : 
	<br>
	<input name="e_tgl1" id="e_tgl1" type="text" value="'.$e_tgl1.'" size="10" class="btn-warning">
	</p>
	
	
	<p>
	Karantina 14 Hari sampai Tanggal : 
	<br>
	<input name="e_tgl2" id="e_tgl2" type="text" value="'.$e_tgl2.'" size="10" class="btn-warning">
	</p>
	
	</hr>
	
	
	
	
	<p>
	<input name="jml" type="hidden" value="'.$count.'">
	<input name="s" type="hidden" value="'.$s.'">
	<input name="kd" type="hidden" value="'.$kdx.'">
	<input name="page" type="hidden" value="'.$page.'">
	
	<input name="btnSMP" type="submit" value="SIMPAN" class="btn btn-danger">
	<input name="btnBTL" type="submit" value="BATAL" class="btn btn-info">
	</p>
	
	
	</form>';



	?>
		
	
	
	</div>
	
	<div class="col-md-6">
	

	
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
	
	
   <hr>';
	
	?>
	
	
	<script>  
	$(document).ready(function(){
		
		
		
	       $('#image-holder').load("<?php echo $sumber;?>/adm/pegawai/i_pegawai.php?aksi=lihat&kd=<?php echo $kd;?>");

	
	
	        
	    $('#upload_image').on('change', function(event){
	     event.preventDefault();
	     
			$('#loading').show();
	
	
		
		     $.ajax({
		      url:"<?php echo $sumber;?>/adm/pegawai/i_pegawai_upload.php?kd=<?php echo $kd;?>",
		      method:"POST",
		      data:new FormData(this),
		      contentType:false,
		      cache:false,
		      processData:false,
		      success:function(data){
				$('#loading').hide();
		       $('#preview').load("<?php echo $sumber;?>/adm/pegawai/i_pegawai.php?aksi=lihat&kd=<?php echo $kd;?>");
		       	
		      }
		     })
		    });
		    
		    
	});  
	</script>




	</div>
	
	</div>


	<?php
	}
	



















//jika ketahui map terakhir
else if ($s == "mapnya")
	{
	?>
	<div class="row">

	<div class="col-md-12">
		

	<?php
	//ketahui
	$kdx = nosql($_REQUEST['kd']);

	//orang
	$qx = mysqli_query($koneksi, "SELECT * FROM m_orang ".
						"WHERE kd = '$kdx'");
	$rowx = mysqli_fetch_assoc($qx);
	$e_nip = balikin($rowx['nip']);
	$e_nama = balikin($rowx['nama']);
	$e_tipe = balikin($rowx['tipe_user']);
	$e_jabatan = balikin($rowx['jabatan']);


	//detail peta
	$qx = mysqli_query($koneksi, "SELECT * FROM orang_lokasi ".
						"WHERE orang_kd = '$kdx' ".
						"ORDER BY postdate DESC");
	$rowx = mysqli_fetch_assoc($qx);
	$e_status = balikin($rowx['status']);
	$e_latx = balikin($rowx['lat_x']);
	$e_laty = balikin($rowx['lat_y']);
	$e_alamat = balikin($rowx['alamat']);


    $latitude = $e_latx;
    $longitude = $e_laty;

	$lat = $e_latx;
	$long = $e_laty; 

		
	
	echo "<a href='$filenya' class='btn btn-danger'>LIHAT DAFTAR LAINNYA</a>
	<hr>
	<p>
	[$e_nip. $e_nama]. [$e_tipe : $e_jabatan].
	</p>
	
	<p>
	<hr>
	KOORDINAT : <b>[$latitude]. [$longitude].</b>
	<br>
	
	<i>$e_alamat</i> 
	<hr>
	</p>"; 
	?>


		
		<style>
		  #map {
		    height: 100%;
		  }
		</style>
		
		  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&&callback=initMap&key=<?php echo $keyku;?>"></script>
		
		
		
		
		
		<style>
		 #map-canvas {
		        width: 100%;
		        height: 400px;
		        margin: 0px;
		        padding: 0px
		      }
		    </style>
		    <script>
		var map;
		function initialize() {
		        var myLatLng = {lat: <?php echo $latitude;?>, lng: <?php echo $longitude;?>};
		
		        var map = new google.maps.Map(document.getElementById('map-canvas'), {
		          zoom: 16,
		          center: myLatLng
		        });
		
		        var marker = new google.maps.Marker({
		          position: myLatLng,
		          map: map,
		          title: '<?php echo $ku_nama;?>'
		        });
		
		}
		
		google.maps.event.addDomListener(window, 'load', initialize);
		
		    </script>
		    <div id="map-canvas"></div>
		


	</div>
	
	</div>


	<?php
	}














else
	{
	?>
	
	

		
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

    
		
	<script>
	$(document).ready(function() {
	  		
		$.noConflict();
	    
	});
	</script>
	  
	    

        <?php
        echo '<form action="'.$filenya.'" method="post" name="formx">

			<table id="empTable" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
			<thead>
                <tr valign="top" bgcolor="'.$warnaheader.'">
	                <th><strong><font color="'.$warnatext.'">KENA_COVID-19</font></strong></th>
	                <th><strong><font color="'.$warnatext.'">NIK</font></strong></th>
					<th><strong><font color="'.$warnatext.'">NAMA</font></strong></th>
					<th><strong><font color="'.$warnatext.'">IMAGE</font></strong></th>
					<th><strong><font color="'.$warnatext.'">TIPE</font></strong></th>
					<th><strong><font color="'.$warnatext.'">JABATAN</font></strong></th>
					<th><strong><font color="'.$warnatext.'">TGL.LAHIR</font></strong></th>
					<th><strong><font color="'.$warnatext.'">ALAMAT</font></strong></th>
					<th><strong><font color="'.$warnatext.'">TELP</font></strong></th>
					<th><strong><font color="'.$warnatext.'">EMAIL</font></strong></th>
                </tr>
                </thead>';

				//ketahui jumlah yg kena covid-19
				$qyuk = mysqli_query($koneksi, "SELECT * FROM m_orang ".
													"WHERE kenacovid_tgl_awal <> ''");
				$ryuk = mysqli_fetch_assoc($qyuk);
				$tyuk = mysqli_num_rows($qyuk);
				

				echo '<tfoot>
	                <tr valign="top" bgcolor="'.$warnaheader.'">
		                <th><strong><font color="'.$warnatext.'">KENA_COVID-19 <br> '.$tyuk.'</font></strong></th>
		                <th><strong><font color="'.$warnatext.'">NIK</font></strong></th>
						<th><strong><font color="'.$warnatext.'">NAMA</font></strong></th>
						<th><strong><font color="'.$warnatext.'">IMAGE</font></strong></th>
						<th><strong><font color="'.$warnatext.'">TIPE</font></strong></th>
						<th><strong><font color="'.$warnatext.'">JABATAN</font></strong></th>
						<th><strong><font color="'.$warnatext.'">TGL.LAHIR</font></strong></th>
						<th><strong><font color="'.$warnatext.'">ALAMAT</font></strong></th>
						<th><strong><font color="'.$warnatext.'">TELP</font></strong></th>
						<th><strong><font color="'.$warnatext.'">EMAIL</font></strong></th>
	                </tr>
				</tfoot>

            </table>
		</form>';

		?>

        <script>
        $(document).ready(function(){


            var table = $('#empTable').DataTable({
				"scrollY": "100%",
				"scrollX": true, 
		        "order": [[ 1, "DESC" ]],
				"language": {
							"url": "../Indonesian.json",
							"sEmptyTable": "Tidak ada data di database"
						}, 
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'i_kenacovid19_data.php'
                },
                'columns': [
                    { data: 'kenacovid' },
                    { data: 'nip' },
                    { data: 'nama' },
                    { data: 'image' },
                    { data: 'tipe_user' },
                    { data: 'jabatan' },
                    { data: 'tgllahir' },
                    { data: 'alamat' },
                    { data: 'telp' },
                    { data: 'email' }
                ]
            });
            
        
        });
        
        

        
		

        

        </script>


	<?php
	}









require("../template_bawah.php");



//null-kan
xclose($koneksi);
exit();
?>