<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
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








<!-- jQuery 3 -->
<script src="<?php echo $sumber;?>/template/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $sumber;?>/template/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo $sumber;?>/template/adminlte/dist/js/adminlte.min.js"></script>



  


<!-- Bootstrap core JavaScript -->
<script src="<?php echo $sumber;?>/template/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo $sumber;?>/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>




<div class="box box-danger box-solid">
<div class="box-header with-border">
<h3 class="box-title">REALTIME HISTORY PANIC BUTTON : KORBAN</h3>
</div>


	<!-- /.box-header -->
	<div class="box-body">
	  <div class="table-responsive">
	    <table class="table no-margin">
	      <thead>
	        <tr>
	          <th>POSTDATE</th>
	          <th>USER</th>
	          <th>FOTO</th>
	          <th>GPS</th>
	          <th>AUDIO</th>
	          <th>VIDEO</th>
	        </tr>
	      </thead>
	      <tbody>
	      	
	      	
	      	
			<?php
			//total
			$qku2 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
											"ORDER BY postdate DESC");
			$rku2 = mysqli_fetch_assoc($qku2);
			$tku2 = mysqli_num_rows($qku2);
			
			
			
			//query
			$qku = mysqli_query($koneksi, "SELECT DISTINCT(umum_kd) AS orgkd ".
											"FROM umum_sesi_panic ".
											"ORDER BY postdate DESC LIMIT 0,5");
			$rku = mysqli_fetch_assoc($qku);
			
			
			do 
				{
				$nomer = $nomer + 1;			
				$i_umum_kd = balikin($rku['orgkd']);
				
				
				//detailkan
				$qkux = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
												"WHERE umum_kd = '$i_umum_kd' ".
												"ORDER BY postdate DESC LIMIT 0,5");
				$rkux = mysqli_fetch_assoc($qkux);
				$i_postdate = balikin($rkux['postdate']);
				$i_umum_kode = balikin($rkux['umum_kode']);
				$i_umum_nama = balikin($rkux['umum_nama']);
				$i_lat_x = balikin($rkux['lat_x']);
				$i_lat_y = balikin($rkux['lat_y']);
				$i_alamat = balikin($rkux['alamat']);
						
				//m_orang
				$qyuk3 = mysqli_query($koneksi, "SELECT * FROM m_orang ".
										"WHERE kd = '$i_umum_kd'");
				$ryuk3 = mysqli_fetch_assoc($qyuk3);
				$i_orang_tipe = balikin($ryuk3['tipe_user']);
				$i_umum_kode = balikin($ryuk3['nip']);
				$i_umum_nama = balikin($ryuk3['nama']);
			
				?>
	      	
	        <tr>
	          <td><?php echo $i_postdate;?></td>
	          <td>
	          	<?php echo $i_umum_kode;?>. <?php echo $i_umum_nama;?> [<?php echo $i_orang_tipe;?>. ]  
	          	<br>
	          	<a href="#" class="btn btn-success">BERI BANTUAN >></a>
	          </td>
	          <td>{i_foto}</td>
	          <td>{i_gps}</td>
	          <td>{i_audio}</td>
	          <td>{i_video}</td>
	        </tr>
	
	
				<?php
				}
			while ($rku = mysqli_fetch_assoc($qku));
			?>
	
	
	
	      </tbody>
	    </table>
	  </div>
	  <!-- /.table-responsive -->
	</div>
	<!-- /.box-body -->
	<div class="card-footer clearfix">
	  <b><?php echo $tku2;?></b> Data.
	  <a href="k/history_panic_button_korban.php" target="_parent" class="btn btn-sm btn-danger float-right">SELENGKAPNYA >></a>
	</div>
	<!-- /.box-footer -->
	

<!-- /.box-footer -->
</div>