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
<h3 class="box-title">REALTIME HISTORY PANIC BUTTON : PENOLONG</h3>
</div>

	
	<!-- /.box-header -->
	<div class="box-body">
	  <div class="table-responsive">
	    <table class="table no-margin">
	      <thead>
	        <tr>
	          <th>POSTDATE</th>
	          <th>PENOLONG</th>
	          <th>KATEGORI MASALAH</th>
	          <th>SOLUSI</th>
	          <th>KORBAN</th>
	          <th>FOTO</th>
	          <th>GPS</th>
	          <th>AUDIO</th>
	          <th>VIDEO</th>
	        </tr>
	      </thead>
	      <tbody>
	      	
	      	      	
			<?php
			//total
			$qku2 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_penolong ".
											"WHERE sukses = 'true' ".
											"ORDER BY sukses_postdate DESC");
			$rku2 = mysqli_fetch_assoc($qku2);
			$tku2 = mysqli_num_rows($qku2);
			
			
			
			//query
			$qku = mysqli_query($koneksi, "SELECT DISTINCT(penolong_kd) AS orgkd ".
											"FROM umum_sesi_penolong ".
											"WHERE sukses = 'true' ".
											"ORDER BY sukses_postdate DESC LIMIT 0,5");
			$rku = mysqli_fetch_assoc($qku);
			
			
			do 
				{
				$nomer = $nomer + 1;			
				$i_penolong_kd = balikin($rku['orgkd']);
				
				//detail e
				$qku21 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_penolong ".
												"WHERE sukses = 'true' ".
												"AND penolong_kd = '$i_penolong_kd' ".
												"ORDER BY sukses_postdate DESC");
				$rku21 = mysqli_fetch_assoc($qku21);
				$tku21 = mysqli_num_rows($qku21);
				$i_postdate = balikin($rku21['postdate']);
				$i_umum_kode = balikin($rku21['penolong_kode']);
				$i_umum_nama = balikin($rku21['penolong_nama']);
				$i_korban_kd = balikin($rku21['korban_kd']);
				$i_korban_kode = balikin($rku21['korban_kode']);
				$i_korban_nama = balikin($rku21['korban_nama']);
				$i_lat_x = balikin($rku21['lat_x']);
				$i_lat_y = balikin($rku21['lat_y']);
				$i_alamat = balikin($rku21['alamat']);
				$i_kategori = balikin($rku21['kategori']);
				$i_solusi = balikin($rku21['ket']);
						
				//penolong
				$qyuk3 = mysqli_query($koneksi, "SELECT * FROM m_orang ".
										"WHERE kd = '$i_penolong_kd'");
				$ryuk3 = mysqli_fetch_assoc($qyuk3);
				$i_orang_tipe = balikin($ryuk3['tipe_user']);
				$i_umum_kode = balikin($ryuk3['nip']);
				$i_umum_nama = balikin($ryuk3['nama']);
				
				
				
				//korban
				$qyuk31 = mysqli_query($koneksi, "SELECT * FROM m_orang ".
										"WHERE kd = '$i_korban_kd'");
				$ryuk31 = mysqli_fetch_assoc($qyuk31);
				$i_korban_tipe = balikin($ryuk31['tipe_user']);
				$i_korban_kode = balikin($ryuk31['nip']);
				$i_korban_nama = balikin($ryuk31['nama']);
			
				?>
	
		        <tr>
		          <td><?php echo $i_postdate;?></td>
		          <td><?php echo $i_umum_kode;?>. <?php echo $i_umum_kode;?> [<?php echo $i_orang_tipe;?>]</td>
		          <td><?php echo $i_kategori;?></td>
		          <td><?php echo $i_solusi;?></td>
		          <td><?php echo $i_korban_kode;?>. <?php echo $i_korban_nama;?> [<?php echo $i_korban_tipe;?>]</td>
		          <td>
		          	{i_foto}
		          	
		          	</td>
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
	  <a href="k/history_panic_button_penolong.php" target="_parent" class="btn btn-sm btn-danger float-right">SELENGKAPNYA >></a>
	</div>
	<!-- /.box-footer -->
	

</div>
