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




			
<div class="box box-primary box-solid">
<div class="box-header with-border">
<h3 class="box-title">REALTIME MEMBER TERBARU</h3>
</div>
	
	<!-- /.box-header -->
	<div class="box-body no-padding">
	  <ul class="users-list clearfix">
	
		<?php
		//query
	  	$qyuk2 = mysqli_query($koneksi, "SELECT * FROM m_orang ".
											"ORDER BY postdate DESC");
		$ryuk2 = mysqli_fetch_assoc($qyuk2);
		$tyuk2 = mysqli_num_rows($qyuk2);
		
		
		
		//query
	  	$qyuk = mysqli_query($koneksi, "SELECT * FROM m_orang ".
											"ORDER BY postdate DESC LIMIT 0,12");
		$ryuk = mysqli_fetch_assoc($qyuk);
		$tyuk = mysqli_num_rows($qyuk);
	
			
		do
			{
	      	$i_kd = balikin($ryuk['kd']);
	      	$i_nip = balikin($ryuk['nip']);
			$i_nama = balikin($ryuk['nama']);
			$i_postdate = balikin($ryuk['postdate']);
	
	
		
			//jika edit / baru
			$fotoku = "../filebox/pegawai/$i_kd/$i_nip-1.jpg";
			
			//nek ada foto
			if (file_exists($fotoku))
				{
				$nil_foto1 = "../filebox/pegawai/$i_kd/$i_nip-1.jpg";
				$nil_foto12 = "../filebox/pegawai/$i_kd/thumb-$i_nip-1.jpg";
				$nil_foto13 = "../filebox/pegawai/$i_kd/marker$i_nip-1.jpg";
				}
			else
				{
				$nil_foto1 = "../img/foto_blank.png";
				}
	
			?>
		    <li>
		      <img src="<?php echo $nil_foto12;?>" alt="<?php echo $i_nama;?>">
		      <a class="users-list-name" href="#"><?php echo $i_nama;?></a>
		      <span class="users-list-date"><?php echo $i_postdate;?></span>
		    </li>
		    <?php
			}
		while ($ryuk = mysqli_fetch_assoc($qyuk));
		?>	    
		   
	    
	    
	    
	
	  </ul>
	  <!-- /.users-list -->
	</div>
	<!-- /.box-body -->
	<div class="card-footer clearfix">
	  <b><?php echo $tyuk2;?></b> Data.
	  <a href="pegawai/pegawai.php" target="_parent" class="btn btn-sm btn-danger float-right">SELENGKAPNYA >></a>
	</div>
	


</div>
