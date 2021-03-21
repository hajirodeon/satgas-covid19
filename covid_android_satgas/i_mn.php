<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/covid_covid_android_satgas/i_mn.php";
$filenyax = "$sumber/covid_covid_android_satgas/i_mn.php";
$judul = "Data";
$juduli = $judul;



//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];





//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika form
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'form'))
	{
	?>
	
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/dist/css/skins/skins-biasawae.css">




<script language='javascript'>
//membuat document jquery
$(document).ready(function(){

	$("#ipanic").on('click', function(){
	
		$("#imperilaku").hide();
		$("#impanic").show();
	
	});	


	$("#iperilaku").on('click', function(){
	
		$("#impanic").hide();
		$("#imperilaku").show();
	
	});	




$("#imperilaku").hide();
$("#impanic").show();

});

</script>









<div class="col-12" align="left">
	<div class="box box-danger">
	<div class="box-body">

		<div class="row">

			<div class="col-lg-6 col-xs-12" align="left">

	          
	          <a id="ipanic" class="btn btn-block btn-social btn-warning">
                <i class="fa fa-bullhorn"></i> Panic Button
              </a>
              
				<br>
	          
	          <a id="iperilaku" class="btn btn-block btn-social btn-info">
                <i class="fa fa-users"></i> Perilaku Masyarakat
              </a>

	        </div>
	          
        </div>

	</div>
	</div>
</div>          



<div class="col-12" align="left">
	<div class="box box-danger">
	<div class="box-body">



		<div class="row" id="impanic">
			
			
			
	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-orange">
	            <div class="inner">
	              <h3><?php
	              //total 
	              $sel = mysqli_query($koneksi,"select count(*) as allcount from umum_sesi_panic");
	              $records = mysqli_fetch_assoc($sel);
	              $totalRecords = $records['allcount'];
	              
	              
	              echo $totalRecords;
	              ?></h3>

						<p>PANIC BUTTON</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-arrow-circle-right"></i>
	            </div>
	            <a href="mn_panic_mhistory_korban.html" class="small-box-footer">History Korban <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        
	        
	        	        
	        
	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-orange">
	            <div class="inner">
	              <h3><?php
	              //total 
	              $sel = mysqli_query($koneksi,"select DISTINCT(penolong_kd) as allcount from umum_sesi_penolong");
	              $records = mysqli_fetch_assoc($sel);
	              $totalRecords = mysqli_num_rows($sel);
	              
	              
	              echo $totalRecords;
	              ?></h3>

						<p>PANIC BUTTON</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-arrow-circle-right"></i>
	            </div>
	            <a href="mn_panic_mhistory_tolong.html" class="small-box-footer">History Penolong <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        


	        
	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-orange">
	            <div class="inner">
	              <h3><?php
	              //total 
	              $sel = mysqli_query($koneksi,"select count(*) as allcount from panic_tipe_korban");
	              $records = mysqli_fetch_assoc($sel);
	              $totalRecords = $records['allcount'];
	              
	              
	              echo $totalRecords;
	              ?></h3>

						<p>PANIC BUTTON</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-arrow-circle-right"></i>
	            </div>
	            <a href="mn_panic_mtipe_korban.html" class="small-box-footer">Per Tipe User Korban <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        
	        
	        
	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-orange">
	            <div class="inner">
	              <h3><?php
	              //total 
	              $sel = mysqli_query($koneksi,"SELECT count(*) as allcount FROM umum_sesi_penolong ".
													"WHERE sukses = 'true'");
				  $records = mysqli_fetch_assoc($sel);
				  $totalRecords = $records['allcount'];
	              
	              
	              echo $totalRecords;
	              ?></h3>

						<p>PANIC BUTTON</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-arrow-circle-right"></i>
	            </div>
	            <a href="mn_panic_mtipe_penolong.html" class="small-box-footer">Per Tipe User Penolong <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        




	        
	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-orange">
	            <div class="inner">
	              <h3><?php
	              //total 
	              $sel = mysqli_query($koneksi,"select DISTINCT DATE(postdate) as allcount from umum_sesi_panic");
	              $records = mysqli_fetch_assoc($sel);
	              $totalRecords = mysqli_num_rows($sel);
	              
	              
	              echo $totalRecords;
	              ?></h3>

						<p>PANIC BUTTON</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-arrow-circle-right"></i>
	            </div>
	            <a href="mn_panic_mtgl.html" class="small-box-footer">Per Tanggal <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        
	        



	        
	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-orange">
	            <div class="inner">
	              <h3><?php
	              //total 
	              $sel = mysqli_query($koneksi,"select DISTINCT DATE(postdate) as allcount from umum_sesi_panic");
	              $records = mysqli_fetch_assoc($sel);
	              $totalRecords = mysqli_num_rows($sel);
	              
	              
	              echo $totalRecords;
	              ?></h3>

						<p>PANIC BUTTON</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-arrow-circle-right"></i>
	            </div>
	            <a href="mn_panic_mbln.html" class="small-box-footer">Per Bulan <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        
	        
	        
	        

	        
	        <div class="col-lg-6 col-xs-12">
	          <!-- small box -->
	          <div class="small-box bg-orange">
	            <div class="inner">
	              <h3><?php
	              //total 
	              $sel = mysqli_query($koneksi,"select DISTINCT(kategori) as allcount from umum_sesi_penolong");
	              $records = mysqli_fetch_assoc($sel);
	              $totalRecords = mysqli_num_rows($sel);
	              
	              
	              echo $totalRecords;
	              ?></h3>

						<p>PANIC BUTTON</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-arrow-circle-right"></i>
	            </div>
	            <a href="mn_panic_mkategori.html" class="small-box-footer">Per Kategori Masalah <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        
	        



	        
	        <div class="col-lg-6 col-xs-12">
	          <!-- small box -->
	          <div class="small-box bg-orange">
	            <div class="inner">
	              <h3><?php
	              //total 
	              $sel = mysqli_query($koneksi,"select DISTINCT DATE(postdate) as allcount from umum_sesi_panic");
	              $records = mysqli_fetch_assoc($sel);
	              $totalRecords = mysqli_num_rows($sel);
	              
	              
	              echo $totalRecords;
	              ?></h3>

						<p>PANIC BUTTON</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-arrow-circle-right"></i>
	            </div>
	            <a href="mn_panic_mkecamatan.html" class="small-box-footer">Per Kecamatan <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        

		</div>
		
		<div class="row" id="imperilaku">
		

			<div class="col-md-3 col-sm-6 col-xs-12">
			          <div class="info-box">
			            <span class="info-box-icon bg-aqua"><i class="fa fa-files-o"></i></span>
			
			            <div class="info-box-content">
			              <span class="info-box-text">PERILAKU MASYARAKAT</span>
			              <span class="info-box-number"><a href="mn_perilaku_entri.html" class="small-box-footer">ENTRI LAPORAN <i class="fa fa-arrow-circle-right"></i></a></span>
			            </div>
			            <!-- /.info-box-content -->
			          </div>
			          <!-- /.info-box -->
			        </div>
			        
			        
			        
	        
	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-aqua">
	            <div class="inner">
	              <h3><?php
	              //total 
	              $sel = mysqli_query($koneksi,"select count(*) as allcount from e_perilaku_masyarakat");
	              $records = mysqli_fetch_assoc($sel);
	              $totalRecords = $records['allcount'];
	              
	              
	              echo $totalRecords;
	              ?></h3>

						<p>PERILAKU MASYARAKAT</p>
					
	            </div>
	            <div class="icon">
	              <i class="fa fa-arrow-circle-right"></i>
	            </div>
	            <a href="mn_perilaku_mhistory_laporan.html" class="small-box-footer">History Laporan <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        






	        
	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-aqua">
	            <div class="inner">
	              <h3><?php
	              //total 
	              $sel = mysqli_query($koneksi,"select count(*) as allcount from e_perilaku_masyarakat");
	              $records = mysqli_fetch_assoc($sel);
	              $totalRecords = $records['allcount'];
	              
	              
	              echo $totalRecords;
	              ?></h3>

						<p>PERILAKU MASYARAKAT</p>
					
	            </div>
	            <div class="icon">
	              <i class="fa fa-arrow-circle-right"></i>
	            </div>
	            <a href="mn_perilaku_mtgl.html" class="small-box-footer">Per Tanggal <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        



	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-aqua">
	            <div class="inner">
	              <h3><?php
	              //total 
	              $sel = mysqli_query($koneksi,"select count(*) as allcount from e_perilaku_masyarakat");
	              $records = mysqli_fetch_assoc($sel);
	              $totalRecords = $records['allcount'];
	              
	              
	              echo $totalRecords;
	              ?></h3>

						<p>PERILAKU MASYARAKAT</p>
					
	            </div>
	            <div class="icon">
	              <i class="fa fa-arrow-circle-right"></i>
	            </div>
	            <a href="mn_perilaku_mbln.html" class="small-box-footer">Per Bulan <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        



	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-aqua">
	            <div class="inner">
	              <h3><?php
	              //total 
	              $sel = mysqli_query($koneksi,"select DISTINCT(kontributor_kd) as allcount from e_perilaku_masyarakat");
	              $records = mysqli_fetch_assoc($sel);
	              $totalRecords = mysqli_num_rows($sel);
	              
	              
	              echo $totalRecords;
	              ?></h3>

						<p>PERILAKU MASYARAKAT</p>
					
	            </div>
	            <div class="icon">
	              <i class="fa fa-arrow-circle-right"></i>
	            </div>
	            <a href="mn_perilaku_mkontributor.html" class="small-box-footer">Per Kontributor <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        
	        

	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-aqua">
	            <div class="inner">
	              <h3><?php
	              //total 
	              $sel = mysqli_query($koneksi,"select DISTINCT(kategori) as allcount from e_perilaku_masyarakat");
	              $records = mysqli_fetch_assoc($sel);
	              $totalRecords = mysqli_num_rows($sel);
	              
	              
	              echo $totalRecords;
	              ?></h3>

						<p>PERILAKU MASYARAKAT</p>
					
	            </div>
	            <div class="icon">
	              <i class="fa fa-arrow-circle-right"></i>
	            </div>
	            <a href="mn_perilaku_mkategori.html" class="small-box-footer">Per Kategori Tempat <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        
	        

	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-aqua">
	            <div class="inner">
	              <h3><?php
	              //total 
	              $sel = mysqli_query($koneksi,"select DISTINCT(tipe_laporan) as allcount from e_perilaku_masyarakat");
	              $records = mysqli_fetch_assoc($sel);
	              $totalRecords = mysqli_num_rows($sel);
	              
	              
	              echo $totalRecords;
	              ?></h3>

						<p>PERILAKU MASYARAKAT</p>
					
	            </div>
	            <div class="icon">
	              <i class="fa fa-arrow-circle-right"></i>
	            </div>
	            <a href="mn_perilaku_mtipe_laporan.html" class="small-box-footer">Per Tipe Laporan <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        
	        


	        <div class="col-lg-6 col-xs-12">
	          <!-- small box -->
	          <div class="small-box bg-aqua">
	            <div class="inner">
	              <h3><?php
	              //total 
	              $sel = mysqli_query($koneksi,"select DISTINCT(kecamatan) as allcount from e_perilaku_masyarakat");
	              $records = mysqli_fetch_assoc($sel);
	              $totalRecords = mysqli_num_rows($sel);
	              
	              
	              echo $totalRecords;
	              ?></h3>

						<p>PERILAKU MASYARAKAT</p>
					
	            </div>
	            <div class="icon">
	              <i class="fa fa-arrow-circle-right"></i>
	            </div>
	            <a href="mn_perilaku_mkecamatan.html" class="small-box-footer">Per Kecamatan <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        
	        


	        <div class="col-lg-6 col-xs-12">
	          <!-- small box -->
	          <div class="small-box bg-aqua">
	            <div class="inner">
	              <h3><?php
	              //total 
	              $sel = mysqli_query($koneksi,"select * from e_perilaku_masyarakat ".
	              									"WHERE jml_masker_pake <> ''");
	              $records = mysqli_fetch_assoc($sel);
	              $totalRecords = mysqli_num_rows($sel);
	              
	              
	              echo $totalRecords;
	              ?></h3>

						<p>PERILAKU MASYARAKAT</p>
					
	            </div>
	            <div class="icon">
	              <i class="fa fa-arrow-circle-right"></i>
	            </div>
	            <a href="mn_perilaku_mmasker.html" class="small-box-footer">Per Penggunaan Masker <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        
	        


	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-aqua">
	            <div class="inner">
	              <h3><?php
	              //total 
	              $sel = mysqli_query($koneksi,"select * from e_perilaku_masyarakat ".
	              									"WHERE jml_jaga_jarak <> ''");
	              $records = mysqli_fetch_assoc($sel);
	              $totalRecords = mysqli_num_rows($sel);
	              
	              
	              echo $totalRecords;
	              ?></h3>

						<p>PERILAKU MASYARAKAT</p>
					
	            </div>
	            <div class="icon">
	              <i class="fa fa-arrow-circle-right"></i>
	            </div>
	            <a href="mn_perilaku_mjagajarak.html" class="small-box-footer">Per Jaga Jarak <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        
	        



	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-aqua">
	            <div class="inner">
	              <h3><?php
	              //total 
	              $sel = mysqli_query($koneksi,"select * from e_perilaku_masyarakat ".
	              									"WHERE jml_ingatkan <> ''");
	              $records = mysqli_fetch_assoc($sel);
	              $totalRecords = mysqli_num_rows($sel);
	              
	              
	              echo $totalRecords;
	              ?></h3>

						<p>PERILAKU MASYARAKAT</p>
					
	            </div>
	            <div class="icon">
	              <i class="fa fa-arrow-circle-right"></i>
	            </div>
	            <a href="mn_perilaku_mingatkan.html" class="small-box-footer">Per Diingatkan <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        
	        

	        
	        
		        
			</div>
		</div>
		
		</div>
	</div>
	
        

	<?php
	exit();
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>