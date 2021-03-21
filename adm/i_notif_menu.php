<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");




//akun cakmustofa
$keyku = "AIzaSyBZ73oHLqNFmGX6bs3qyyRAoCim-_WxdqQ";



function geo2address($lat,$long,$keyku) 
	{
    $url = "https://maps.googleapis.com/maps/api/geocode/json?key=$keyku&latlng=$lat,$long&sensor=false";
    $curlData=file_get_contents(    $url);
    $address = json_decode($curlData);
    $a=$address->results[0];
    return explode(",",$a->formatted_address);
	}






/*

//ambil satu terakhir
$qku = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
									"WHERE lat_x <> '' ".
									"AND notif = 'false' ".
									"ORDER BY postdate DESC");
$rku = mysqli_fetch_assoc($qku);
$tku = mysqli_num_rows($qku);
$i_kd = cegah($rku['kd']);
$i_asal_kd = cegah($rku['umum_kd']);
$i_umum_nama = cegah($rku['umum_nama']);
$i_postdate = balikin($rku['postdate']);
$lat = balikin($rku['lat_x']);
$long = balikin($rku['lat_y']);



$nilku = geo2address($lat,$long,$keyku);
$nil1 = $nilku[0];
$nil2 = $nilku[1];
$nil3 = $nilku[2];
$nil4 = $nilku[3];
$nil5 = $nilku[4];
$nil6 = $nilku[5];
$nil7 = $nilku[6];


$i_alamat = cegah("$nil1, $nil2, $nil3, $nil4, $nil5, $nil6, $nil7, ");
*/




/*
//panic button ////////////////////////////////////////////////////////////////////////////////////////
//ambil satu terakhir
$qku = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
									"WHERE lat_x <> '' ".
									"AND notif = 'false' ".
									"ORDER BY postdate DESC LIMIT 0,1");
$rku = mysqli_fetch_assoc($qku);
$tku = mysqli_num_rows($qku);

//jika ada
if (!empty($tku))
	{
	$i_kd = cegah($rku['kd']);
	$i_asal_kd = cegah($rku['umum_kd']);
	$i_umum_nama = cegah($rku['umum_nama']);
	$i_postdate = balikin($rku['postdate']);
	$i_lat_x = balikin($rku['lat_x']);
	$i_lat_y = balikin($rku['lat_y']);
	
	
	$nilku = geo2address($i_lat_x,$i_lat_y,$keyku);
	$nil1 = $nilku[0];
	$nil2 = $nilku[1];
	$nil3 = $nilku[2];
	$nil4 = $nilku[3];
	$nil5 = $nilku[4];
	$nil6 = $nilku[5];
	$nil7 = $nilku[6];
	
	
	$i_alamat = cegah("$nil1, $nil2, $nil3, $nil4, $nil5, $nil6, $nil7, ");
	$i_ket = "[$i_postdate]. [$i_umum_nama]. $i_alamat";
	
	
	
	//entri
	mysqli_query($koneksi, "INSERT INTO notif_panic (kd, asal_kd, ket, ".
								"postdate, dibaca, dibaca_postdate) VALUES ".
								"('$i_kd', '$i_asal_kd', '$i_ket', ".
								"'$i_postdate', 'false', NULL);");
	
		
	
	//update
	mysqli_query($koneksi, "UPDATE umum_sesi_panic SET alamat = '$i_alamat', ".
								"notif = 'true', ".
								"notif_postdate = '$today' ".
								"WHERE umum_kd = '$i_asal_kd' ".
								"AND kd = '$i_kd'");
	}














//gps lokasi //////////////////////////////////////////////////////////////////////////////////////////
//ambil satu terakhir
$qku = mysqli_query($koneksi, "SELECT * FROM orang_lokasi ".
									"WHERE lat_x <> '' ".
									"AND notif = 'false' ".
									"ORDER BY postdate DESC LIMIT 0,1");
$rku = mysqli_fetch_assoc($qku);
$tku = mysqli_num_rows($qku);

//jika ada
if (!empty($tku))
	{
	$i_kd = cegah($rku['kd']);
	$i_asal_kd = cegah($rku['orang_kd']);
	$i_umum_nama = cegah($rku['orang_nama']);
	$i_postdate = balikin($rku['postdate']);
	$i_lat_x = balikin($rku['lat_x']);
	$i_lat_y = balikin($rku['lat_y']);
	
	
	$nilku = geo2address($i_lat_x,$i_lat_y,$keyku);
	$nil1 = $nilku[0];
	$nil2 = $nilku[1];
	$nil3 = $nilku[2];
	$nil4 = $nilku[3];
	$nil5 = $nilku[4];
	$nil6 = $nilku[5];
	$nil7 = $nilku[6];
	
	
	$i_alamat = cegah("$nil1, $nil2, $nil3, $nil4, $nil5, $nil6, $nil7, ");	
	$i_ket = "[$i_postdate]. [$i_umum_nama]. $i_alamat";
	



	//entri
	mysqli_query($koneksi, "INSERT INTO notif_tracking (kd, asal_kd, ket, postdate) VALUES ".
								"('$i_kd', '$i_asal_kd', '$i_ket', '$i_postdate')");
	
		
	
	//update
	mysqli_query($koneksi, "UPDATE orang_lokasi SET alamat = '$i_alamat', ".
								"notif = 'true', ".
								"notif_postdate = '$today' ".
								"WHERE orang_kd = '$i_asal_kd' ".
								"AND kd = '$i_kd'");
	}




















//perilaku //////////////////////////////////////////////////////////////////////////////////////////
//ambil satu terakhir
$qku = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
									"WHERE lat_x <> '' ".
									"AND notif = 'false' ".
									"ORDER BY postdate DESC LIMIT 0,1");
$rku = mysqli_fetch_assoc($qku);
$tku = mysqli_num_rows($qku);

//jika ada
if (!empty($tku))
	{
	$i_kd = cegah($rku['kd']);
	$i_asal_kd = cegah($rku['kontributor_kd']);
	$i_umum_nik = cegah($rku['kontributor_nik']);
	$i_umum_nama = cegah($rku['kontributor_nama']);
	$i_postdate = balikin($rku['postdate']);
	$i_lat_x = balikin($rku['lat_x']);
	$i_lat_y = balikin($rku['lat_y']);
	
	
	
	
	//jika kd kosong
	if (empty($i_asal_kd))
		{
		//detail
		$qku2 = mysqli_query($koneksi, "SELECT * FROM m_orang ".
										"WHERE nip = '$i_umum_nik'");
		$rku2 = mysqli_fetch_assoc($qku2);
		$ku2_kd = balikin($rku2['kd']);
		$i_asal_kd = $ku2_kd;
		}
	
	
	
	
	
	
	
	$nilku = geo2address($i_lat_x,$i_lat_y,$keyku);
	$nil1 = $nilku[0];
	$nil2 = $nilku[1];
	$nil3 = $nilku[2];
	$nil4 = $nilku[3];
	$nil5 = $nilku[4];
	$nil6 = $nilku[5];
	$nil7 = $nilku[6];
	
	
	$i_alamat = cegah("$nil1, $nil2, $nil3, $nil4, $nil5, $nil6, $nil7, ");	
	$i_ket = "[$i_postdate]. [$i_umum_nama]. $i_alamat";


	//entri
	mysqli_query($koneksi, "INSERT INTO notif_perilaku(kd, asal_kd, ket, postdate) VALUES ".
								"('$i_kd', '$i_asal_kd', '$i_ket', '$i_postdate')");
	



		
	
	//update
	mysqli_query($koneksi, "UPDATE e_perilaku_masyarakat SET kontributor_kd = '$i_asal_kd', ".
								"alamat_googlemap = '$i_alamat', ".
								"notif = 'true', ".
								"notif_postdate = '$today' ".
								"WHERE kd = '$i_kd'");
	}
*/


















//tampilkan nilainya //////////////////////////////////////////////////////////////////////////////////
//tracking
$qku2 = mysqli_query($koneksi, "SELECT * FROM orang_lokasi ".
									"WHERE dibaca = 'false' ".
									"ORDER BY postdate DESC LIMIT 0,1000");
$rku2 = mysqli_fetch_assoc($qku2);
$i_notif_tracking = mysqli_num_rows($qku2);
 

 
 
 
  
//user baru
$qku2 = mysqli_query($koneksi, "SELECT * FROM m_orang ".
									"WHERE dibaca = 'false' ".
									"ORDER BY postdate DESC LIMIT 0,1000");
$rku2 = mysqli_fetch_assoc($qku2);
$i_notif_user = mysqli_num_rows($qku2);
  
 
 
 


//panic
$qku2 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
									"WHERE dibaca = 'false' ".
									"ORDER BY postdate DESC LIMIT 0,1000");
$rku2 = mysqli_fetch_assoc($qku2);
$i_notif_panic = mysqli_num_rows($qku2);








//perilaku
$qku2 = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
									"WHERE dibaca = 'false' ".
									"ORDER BY postdate DESC LIMIT 0,1000");
$rku2 = mysqli_fetch_assoc($qku2);
$i_notif_perilaku = mysqli_num_rows($qku2);






//totalnya
$i_notif_total = $i_notif_user + $i_notif_panic + $i_notif_tracking + $i_notif_perilaku;

?>
      <nav class="nav-menu d-none d-lg-block">
        <ul>
        	
          <li><a href="<?php echo $sumber;?>/adm/index.php" title="BERANDA"><i class="fa fa-home" style="font-size:24px;"></i></a></li>

          <li class="drop-down"><a href="#" title="PEMBERITAHUAN"><span><i class="fa fa-bell" style="font-size:24px;color:red"></i><span class="badge"><?php echo $i_notif_total;?></span></a>
            <ul>
              	<li>
              	<a href="<?php echo $sumber;?>/adm/notif/gps.php">TRACKING GPS USER <span class="badge"><?php echo $i_notif_tracking;?></span></a></a>
              	</li>
              	
              	<li>
              	<a href="<?php echo $sumber;?>/adm/pegawai/pegawai.php">USER<span class="badge"><?php echo $i_notif_user;?></span></a></a>
              	</li>
              	
              	<li>
              	<a href="<?php echo $sumber;?>/adm/k/history_panic_button_korban.php">PANIC BUTTON <span class="badge"><?php echo $i_notif_panic;?></span></a></a>
              	</li>
              	
              	
              	<li>
              	<a href="<?php echo $sumber;?>/adm/perilaku/history_perilaku_masyarakat.php">PERILAKU MASYARAKAT <span class="badge"><?php echo $i_notif_perilaku;?></span></a></a>
              	</li>
			    

            </ul>
            
            
          </li>

        	


          <li class="drop-down"><a href="#" title="SETTING"><i class="fa fa-cogs" style="font-size:24px;"></i></a>
            <ul>
              	<li>
              	<a href="<?php echo $sumber;?>/adm/s/pass.php"><i class="fa fa-circle-o"></i> Ganti Password</a>
              	</li>
			    
				<li>
					<a href="<?php echo $sumber;?>/adm/s/map.php" title="MAP"><i class="fa fa-circle-o"></i> MAP</a>
			    </li>
			    
				<li>
					<a href="<?php echo $sumber;?>/adm/s/kontak.php" title="Kontak"><i class="fa fa-circle-o"></i> Kontak</a>
			    </li>

		
				<li>
					<a href="<?php echo $sumber;?>/adm/cp/kategori.php" title="Kategori"><i class="fa fa-circle-o"></i> Kategori</a>
			    </li>
			    
		
				<li>
					<a href="<?php echo $sumber;?>/adm/cp/foto.php" title="Foto"><i class="fa fa-circle-o"></i> Foto</a>
			    </li>
		
				<li>
					<a href="<?php echo $sumber;?>/adm/cp/video.php" title="Video Youtube"><i class="fa fa-circle-o"></i> Video Youtube</a>
			    </li>
	
				<li>
					<a href="<?php echo $sumber;?>/adm/cp/slideshow.php" title="SlideShow"><i class="fa fa-circle-o"></i> SlideShow</a>
			    </li>
		
				<li>
					<a href="<?php echo $sumber;?>/adm/cp/artikel.php" title="Artikel"><i class="fa fa-circle-o"></i> Artikel</a>
			    </li>
			    
		
				<li>
					<a href="<?php echo $sumber;?>/adm/cp/bukutamu.php" title="Buku Tamu"><i class="fa fa-circle-o"></i> Buku Tamu</a>
			    </li>
            </ul>
          </li>
          


          <li class="drop-down"><a href="#">USER</a>
            <ul>

				<li>
					<a href="<?php echo $sumber;?>/adm/pegawai/pegawai.php" class="nav-link" title="Data User"><i class="fa fa-circle-o"></i> Data User</a>
			    </li>

				<li>
					<a href="<?php echo $sumber;?>/adm/pegawai/kenacovid19.php" class="nav-link" title="Kena Covid-19"><i class="fa fa-circle-o"></i> Kena Covid-19</a>
			    </li>
			    
			    <li class="drop-down"><a href="#">HISTORY</a>
	            	<ul>
			    
						<li>
							<a href="<?php echo $sumber;?>/adm/pegawai/history_login.php" class="nav-link" title="History Login"><i class="fa fa-circle-o"></i> Login</a>
					    </li>
					    
						<li>
							<a href="<?php echo $sumber;?>/adm/pegawai/history_gps_user.php" class="nav-link" title="History GPS Tracking"><i class="fa fa-circle-o"></i> GPS Tracking</a>
					    </li>
					</ul>
				</li>

            </ul>
            
            
          </li>








          <li class="drop-down"><a href="#" title="PANIC BUTTON">PANIC BUTTON</a>
            <ul>
			    <li class="drop-down"><a href="#">HISTORY</a>
	            	<ul>

						<li>
							<a href="<?php echo $sumber;?>/adm/k/history_panic_button_korban.php" title="History Korban"><i class="fa fa-circle-o"></i> Korban</a>
					    </li>
		
						<li>
							<a href="<?php echo $sumber;?>/adm/k/history_panic_button_penolong.php" title="History Penolong"><i class="fa fa-circle-o"></i> Penolong</a>
					    </li>
					</ul>>
				</li>
				
				
			    <li class="drop-down"><a href="#">LAPORAN</a>
	            	<ul>
		
						<li>
							<a href="<?php echo $sumber;?>/adm/k/grafik_panic_button_tgl.php" title="Per Tanggal Kejadian"><i class="fa fa-circle-o"></i> Per Tanggal Kejadian</a>
					    </li>
		
						<li>
							<a href="<?php echo $sumber;?>/adm/k/grafik_panic_button_bln.php" title="Per Bulan Kejadian"><i class="fa fa-circle-o"></i> Per Bulan Kejadian</a>
					    </li>
		
						<li>
							<a href="<?php echo $sumber;?>/adm/k/grafik_panic_button_korban_penolong.php" title="Per Korban & Penolong"><i class="fa fa-circle-o"></i> Per Korban & Penolong</a>
					    </li>
					    
		
						<li>
							<a href="<?php echo $sumber;?>/adm/k/grafik_panic_button_tipe_korban.php" title="Per Tipe User Korban"><i class="fa fa-circle-o"></i> Per Tipe User Korban</a>
					    </li>
					    
					    
		
						<li>
							<a href="<?php echo $sumber;?>/adm/k/grafik_panic_button_tipe_penolong.php" title="Per Tipe User Penolong"><i class="fa fa-circle-o"></i> Per Tipe User Penolong</a>
					    </li>
					    
		
						<li>
							<a href="<?php echo $sumber;?>/adm/k/grafik_panic_button_kategori.php" title="Per Kategori Masalah"><i class="fa fa-circle-o"></i> Per Kategori Masalah</a>
					    </li>
					    
					    
		
						<li>
							<a href="<?php echo $sumber;?>/adm/k/grafik_panic_button_instansi.php" title="Forward Instansi"><i class="fa fa-circle-o"></i> Forward Instansi</a>
					    </li>
					    
					    
		
						<li>
							<a href="<?php echo $sumber;?>/adm/k/grafik_panic_button_kecamatan.php" title="Per Kecamatan"><i class="fa fa-circle-o"></i> Per Kecamatan</a>
					    </li>
					</ul>
				</li>>
							   
			    
			    
            </ul>
            
            
          </li>




          <li class="drop-down"><a href="#" title="PERILAKU MASYARAKAT">PERILAKU</a>
            <ul>
			    <li class="drop-down"><a href="#">MASTER DATA</a>
	            	<ul>

					<li>
						<a href="<?php echo $sumber;?>/adm/perilaku/kategori_tempat.php" title="Kategori Tempat"><i class="fa fa-circle-o"></i> Kategori Tempat</a>
				    </li>
	
					<li>
						<a href="<?php echo $sumber;?>/adm/perilaku/tipe_laporan.php" title="Tipe Laporan"><i class="fa fa-circle-o"></i> Tipe Laporan</a>
				    </li>
				    
				    </ul>
				</li>
				

			    <li class="drop-down"><a href="#">HISTORY</a>
	            	<ul>

						<li>
							<a href="<?php echo $sumber;?>/adm/perilaku/history_perilaku_masyarakat.php" title="History Entri"><i class="fa fa-circle-o"></i> History Entri</a>
					    </li>
					    

						<li>
							<a href="<?php echo $sumber;?>/adm/perilaku/history_user.php" title="History User Entri"><i class="fa fa-circle-o"></i> History User Entri</a>
					    </li>


				    </ul>
				</li>
			    
			    <li class="drop-down"><a href="#">LAPORAN</a>
	            	<ul>
	            		
					    
						<li>
							<a href="<?php echo $sumber;?>/adm/perilaku/grafik_perilaku_instansi.php" title="Forward Instansi"><i class="fa fa-circle-o"></i> Forward Instansi</a>
					    </li>
					    
						<li>
							<a href="<?php echo $sumber;?>/adm/perilaku/grafik_perilaku_tgl.php" title="Per Tanggal"><i class="fa fa-circle-o"></i> Per Tanggal</a>
					    </li>
					    
						<li>
							<a href="<?php echo $sumber;?>/adm/perilaku/grafik_perilaku_bln.php" title="Per Bulan"><i class="fa fa-circle-o"></i> Per Bulan</a>
					    </li>
					    
						<li>
							<a href="<?php echo $sumber;?>/adm/perilaku/grafik_perilaku_tipe_kontributor.php" title="Per Tipe Kontributor"><i class="fa fa-circle-o"></i> Per Tipe Kontributor</a>
					    </li>
					    
						<li>
							<a href="<?php echo $sumber;?>/adm/perilaku/grafik_perilaku_tempat.php" title="Per Kategori Tempat"><i class="fa fa-circle-o"></i> Per Kategori Tempat</a>
					    </li>
					    
					    
						<li>
							<a href="<?php echo $sumber;?>/adm/perilaku/grafik_perilaku_kategori.php" title="Per Tipe Laporan"><i class="fa fa-circle-o"></i> Per Tipe Laporan</a>
					    </li>
					    
					    
						<li>
							<a href="<?php echo $sumber;?>/adm/perilaku/grafik_perilaku_jml_perilaku.php" title="Per Jumlah Perilaku"><i class="fa fa-circle-o"></i> Per Jumlah Perilaku</a>
					    </li>
					    
						<li>
							<a href="<?php echo $sumber;?>/adm/perilaku/grafik_perilaku_jml_masker.php" title="Jumlah Pengguna Masker"><i class="fa fa-circle-o"></i> Jumlah Pengguna Masker</a>
					    </li>
				    	
						<li>
							<a href="<?php echo $sumber;?>/adm/perilaku/grafik_perilaku_jml_jagajarak.php" title="Jumlah Jaga Jarak"><i class="fa fa-circle-o"></i> Jumlah Jaga Jarak</a>
					    </li>
					    
						<li>
							<a href="<?php echo $sumber;?>/adm/perilaku/grafik_perilaku_jml_ingatkan.php" title="Jumlah Diingatkan"><i class="fa fa-circle-o"></i> Jumlah Diingatkan</a>
					    </li>
					    
						<li>
							<a href="<?php echo $sumber;?>/adm/perilaku/grafik_perilaku_kecamatan.php" title="Per Kecamatan"><i class="fa fa-circle-o"></i> Per Kecamatan</a>
					    </li>
					    
					    
					</ul>
				</li>

            </ul>
            
            
          </li>






          
        
          <li><a href="<?php echo $sumber;?>/logout.php">KELUAR</a></li>
          
          
        </ul>
      </nav><!-- .nav-menu -->





<?php
/*

<link rel="stylesheet" href="../template/css/bootstrap-side-modals.css">




<script>
$(document).ready(function(){


$("#myModal2").modal('show');
	

})
</script>



<div class="modal fade" id="myModal2">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Pemberitahuan.  <?php echo $today;?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <p>Ada Pemberitahuan Baru</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">OK >></button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
        
*/
?>
