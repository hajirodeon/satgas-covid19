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
<h3 class="box-title">REALTIME HISTORY PERILAKU MASYARAKAT</h3>
</div>


	
	
	<!-- /.box-header -->
	<div class="box-body">
	  <div class="table-responsive">
	    <table class="table no-margin">
	      <thead>
	        <tr>
	          <th>POSTDATE</th>
	          <th>FOTO</th>
	          <th>KATEGORI</th>
	          <th>KONTRIBUTOR</th>
	          <th>ALAMAT</th>
	          <th>GPS</th>
	          <th>JML_ORANG</th>
	          <th>MEMAKAI_MASKAER</th>
	          <th>JAGA_JARAK</th>
	          <th>DIINGATKAN</th>
	        </tr>
	      </thead>
	      <tbody>
	      	
	      	
	      	<?php
	      	$qyuk = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
												"ORDER BY postdate DESC LIMIT 0,10");
			$ryuk = mysqli_fetch_assoc($qyuk);
			$tyuk = mysqli_num_rows($qyuk);
			
			
			do
				{
		      	$i_kd = balikin($ryuk['kd']);
		      	$i_nama_lokasi = balikin($ryuk['nama_lokasi']);
				$i_kategori = balikin($ryuk['kategori']);
				$i_ket = balikin($ryuk['keterangan']);
				$i_kota = balikin($ryuk['kota']);
				$i_kec = balikin($ryuk['kecamatan']);
				$i_kelurahan = balikin($ryuk['kelurahan']);
				$i_alamat = balikin($ryuk['alamat']);
				$i_alamat_googlemap = balikin($ryuk['alamat_googlemap']);
				$i_kategori_tempat = balikin($ryuk['kategori_tempat']);
				$i_tipe_laporan = balikin($ryuk['tipe_laporan']);
				$i_jml_orang = balikin($ryuk['jumlah_orang']);
				$i_jml_masker_pake = balikin($ryuk['jml_masker_pake']);
				$i_jml_masker_tidak_pake = balikin($ryuk['jml_masker_tidak_pake']);
				$i_jml_jaga_jarak = balikin($ryuk['jml_jaga_jarak']);
				$i_jml_jaga_jarak_tidak = balikin($ryuk['jml_jaga_jarak_tidak']);
				$i_jml_ingatkan = balikin($ryuk['jml_ingatkan']);
				$i_jml_ingatkan_tidak = balikin($ryuk['jml_ingatkan_tidak']);
				$i_lat_x = balikin($ryuk['lat_x']);
				$i_lat_y = balikin($ryuk['lat_y']);
				$i_k_nik = balikin($ryuk['kontributor_nik']);
				$i_k_nama = balikin($ryuk['kontributor_nama']);
				$i_k_kontak = balikin($ryuk['kontributor_kontak']);
				$i_k_ket = balikin($ryuk['kontributor_ket']);
				$i_postdate = balikin($ryuk['postdate']);
				
				$nil_foto1 = "$sumber/filebox/perilaku/$i_kd/$i_kd-1.jpg";

				
				

				//cek, sudah forward atau belum...
				$qkuy = mysqli_query($koneksi, "SELECT * FROM perilaku_satgas ".
													"WHERE perilaku_kd = '$i_kd' ".
													"AND tugaskan = 'true'");
				$tkuy = mysqli_num_rows($qkuy);				
				
				
		      	?>
		        <tr>
		          <td><?php echo $i_postdate;?></td>
		          <td>
		          	<img src="<?php echo $nil_foto1;?>" width="150">
		          	<br>
		          	
		          	<?php
		          	//jika sudah forward, lihat status
		          	if (!empty($tkuy))
						{
						?>
						<a href="perilaku/status.php?pkd=<?php echo $i_kd;?>" target="_parent" class="btn btn-warning" title="LIHAT STATUS">LIHAT STATUS >></a>
						<?php							
						}
						
					else
						{
			          	?>
			          	<a href="perilaku/panggil_satgas.php?pkd=<?php echo $i_kd;?>" target="_parent" class="btn btn-success" title="Panggil SATGAS">PANGGIL SATGAS >></a>
			          	<?php
						}
					?>
		          	</td>
		          <td><?php echo $i_kategori_tempat;?></td>
		          <td><?php echo $i_k_nik;?>. <?php echo $i_k_nama;?></td>
		          <td><?php echo $i_alamat;?>, Kelurahan <?php echo $i_kelurahan;?>, Kecamatan <?php echo $i_kec;?></td>
		          <td>
		          	<?php echo $i_lat_x;?>, <?php echo $i_lat_y;?>
		          	<br>
		          	<?php echo $i_alamat_googlemap;?>
		          </td>
		          
		          <td><?php echo $i_jml_orang;?></td>
		          <td>
		          	Pakai : <b><?php echo $i_jml_masker_pake;?></b>
		          	<br>
		          	Tidak : <b><?php echo $i_jml_masker_tidak_pake;?></b>
		          	</td>
		          
		          <td>
		          	Jaga Jarak : <b><?php echo $i_jml_jaga_jarak;?></b>
		          	<br>
		          	
		          	Tidak : <b><?php echo $i_jml_jaga_jarak_tidak;?></b>
		          	
		          </td>
		          
		          <td>
		          	Diingatkan : <b><?php echo $i_jml_ingatkan;?></b>
		          	<br>
		          	Tidak : <b><?php echo $i_jml_ingatkan_tidak;?></b>
		          	
		          </td>
		        </tr>
		        <?php
				}
			while ($ryuk = mysqli_fetch_assoc($qyuk));
			?>
	
	
	
	      </tbody>
	    </table>
	  </div>
	  <!-- /.table-responsive -->
	</div>
	<!-- /.box-body -->
	<div class="card-footer clearfix">
	  <b><?php echo $tyuk;?></b> Data.
	  <a href="perilaku/history_perilaku_masyarakat.php" target="_parent" class="btn btn-sm btn-danger float-right">SELENGKAPNYA >></a>
	</div>
	<!-- /.box-footer -->





</div>
  
  
