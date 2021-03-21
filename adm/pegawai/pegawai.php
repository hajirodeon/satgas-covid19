<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");

nocache;

//nilai
$filenya = "pegawai.php";
$judul = "Data USER";
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
//jika import
if ($_POST['btnIM'])
	{
	//re-direct
	$ke = "$filenya?s=import";
	xloc($ke);
	exit();
	}






//jika import
if ($_POST['btnIMM'])
	{
	//re-direct
	$ke = "$filenya?s=importt";
	xloc($ke);
	exit();
	}




















//lama
//import sekarang
if ($_POST['btnIMX'])
	{
	$filex_namex2 = strip(strtolower($_FILES['filex_xls']['name']));

	//nek null
	if (empty($filex_namex2))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		$ke = "$filenya?s=import";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//deteksi .xls
		$ext_filex = substr($filex_namex2, -4);

		if ($ext_filex == ".xls")
			{
			//nilai
			$path1 = "../../filebox";
			$path2 = "../../filebox/excel";
			chmod($path1,0777);
			chmod($path2,0777);

			//nama file import, diubah menjadi baru...
			$filex_namex2 = "user.xls";

			//mengkopi file
			copy($_FILES['filex_xls']['tmp_name'],"../../filebox/excel/$filex_namex2");

			//chmod
            $path3 = "../../filebox/excel/$filex_namex2";
			chmod($path1,0755);
			chmod($path2,0777);
			chmod($path3,0777);

			//file-nya...
			$uploadfile = $path3;


			//require
			require('../../inc/class/PHPExcel.php');
			require('../../inc/class/PHPExcel/IOFactory.php');


			  // load excel
			  $load = PHPExcel_IOFactory::load($uploadfile);
			  $sheets = $load->getActiveSheet()->toArray(null,true,true,true);
			
			  $i = 1;
			  foreach ($sheets as $sheet) 
			  	{
			    // karena data yang di excel di mulai dari baris ke 2
			    // maka jika $i lebih dari 1 data akan di masukan ke database
			    if ($i > 1) 
			    	{
				      // nama ada di kolom A
				      // sedangkan alamat ada di kolom B
				      //$i_xyz = md5("$x$i");
				      $i_no = cegah($sheet['A']);
				      $i_kode = cegah($sheet['B']);
				      $i_nama = cegah($sheet['C']);
				      $i_tipe = cegah($sheet['D']);
				      $i_jabatan = cegah($sheet['E']);
				      $i_tgl_lahir = cegah($sheet['F']);
				      $i_alamat = cegah($sheet['G']);
				      $i_telp = cegah($sheet['H']);
				      $i_email = cegah($sheet['I']);
					  $i_akses = balikin($i_kode);
					  $i_passx = md5($i_akses);
					  
					  $i_xyz = md5($i_kode);
					  
						//insert
						mysqli_query($koneksi, "INSERT INTO m_orang(kd, nip, nama, tipe_user, jabatan, ".
										"tgl_lahir, alamat, telp, email, usernamex, passwordx, postdate) VALUES ".
										"('$i_xyz', '$i_kode', '$i_nama', '$i_tipe', '$i_jabatan', ".
										"'$i_tgl_lahir', '$i_alamat', '$i_telp', '$i_email', '$i_akses', '$i_passx', '$today')");
					  
				    }
			
			    $i++;
			  }





			//hapus file, jika telah import
			$path1 = "../../filebox/excel/$filex_namex2";
			chmod($path1,0777);
			unlink ($path1);


			//re-direct
			xloc($filenya);
			exit();
			}
		else
			{
			//salah
			$pesan = "Bukan File .xls . Harap Diperhatikan...!!";
			$ke = "$filenya?s=import";
			pekem($pesan,$ke);
			exit();
			}
		}
	}








//import sekarang
if ($_POST['btnIMXX'])
	{
	$filex_namex2 = strip(strtolower($_FILES['filex_xls']['name']));

	//nek null
	if (empty($filex_namex2))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		$ke = "$filenya?s=importt";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//deteksi .xls
		$ext_filex = substr($filex_namex2, -4);

		if ($ext_filex == ".xls")
			{
			//nilai
			$path1 = "../../filebox";
			$path2 = "../../filebox/excel";
			chmod($path1,0777);
			chmod($path2,0777);

			//nama file import, diubah menjadi baru...
			$filex_namex2 = "user_lokasi.xls";

			//mengkopi file
			copy($_FILES['filex_xls']['tmp_name'],"../../filebox/excel/$filex_namex2");

			//chmod
            $path3 = "../../filebox/excel/$filex_namex2";
			chmod($path1,0755);
			chmod($path2,0777);
			chmod($path3,0777);

			//file-nya...
			$uploadfile = $path3;


			//require
			require('../../inc/class/PHPExcel.php');
			require('../../inc/class/PHPExcel/IOFactory.php');


			  // load excel
			  $load = PHPExcel_IOFactory::load($uploadfile);
			  $sheets = $load->getActiveSheet()->toArray(null,true,true,true);
			
			  $i = 1;
			  foreach ($sheets as $sheet) 
			  	{
			    // karena data yang di excel di mulai dari baris ke 2
			    // maka jika $i lebih dari 1 data akan di masukan ke database
			    if ($i > 1) 
			    	{
				      // nama ada di kolom A
				      // sedangkan alamat ada di kolom B
				      //$i_xyz = md5("$x$i");
				      $i_no = cegah($sheet['A']);
				      $i_kode = cegah($sheet['B']);
				      $i_nama = cegah($sheet['C']);
				      $i_tipe = cegah($sheet['D']);
				      $i_latx = cegah($sheet['E']);
				      $i_laty = cegah($sheet['F']);
				      $i_desk = cegah($sheet['G']);
				      $i_ket = cegah($sheet['H']);
					  $i_akses = balikin($i_kode);
					  $i_passx = md5($i_akses);
					  
					  $i_kodex = "tps$i_kode";
					  $i_xyz = md5($i_kodex);

					  
						//insert
						mysqli_query($koneksi, "INSERT INTO m_orang(kd, nip, nama, tipe_user, ".
										"lat_x, lat_y, alamat, ket, postdate) VALUES ".
										"('$i_xyz', '$i_kodex', '$i_nama', '$i_tipe', ".
										"'$i_laty', '$i_latx', '$i_desk', '$i_ket', '$today')");
										
										
						//insert koordinatnya
						mysqli_query($koneksi, "INSERT INTO orang_lokasi(kd, orang_kd, orang_kode, orang_nama, ".
										"lat_x, lat_y, status, alamat, ket, postdate) VALUES ".
										"('$i_xyz', '$i_xyz', '$i_kodex', '$i_nama', ".
										"'$i_laty', '$i_latx', 'MASUK', '$i_desk', '$i_ket', '$today')");
						
					  
				    }
			
			    $i++;
			  }





			//hapus file, jika telah import
			$path1 = "../../filebox/excel/$filex_namex2";
			chmod($path1,0777);
			unlink ($path1);


			//re-direct
			xloc($filenya);
			exit();
			}
		else
			{
			//salah
			$pesan = "Bukan File .xls . Harap Diperhatikan...!!";
			$ke = "$filenya?s=importt";
			pekem($pesan,$ke);
			exit();
			}
		}
	}







//jika export
//export
if ($_POST['btnEX'])
	{
	//require
	require('../../inc/class/excel/OLEwriter.php');
	require('../../inc/class/excel/BIFFwriter.php');
	require('../../inc/class/excel/worksheet.php');
	require('../../inc/class/excel/workbook.php');


	//nama file e...
	$i_filename = "user.xls";
	$i_judul = "user";
	



	//header file
	function HeaderingExcel($i_filename)
		{
		header("Content-type:application/vnd.ms-excel");
		header("Content-Disposition:attachment;filename=$i_filename");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
		header("Pragma: public");
		}

	
	
	
	//bikin...
	HeaderingExcel($i_filename);
	$workbook = new Workbook("-");
	$worksheet1 =& $workbook->add_worksheet($i_judul);
	$worksheet1->write_string(0,0,"NO.");
	$worksheet1->write_string(0,1,"NOINDUK");
	$worksheet1->write_string(0,2,"NAMA");
	$worksheet1->write_string(0,3,"TIPE_USER");
	$worksheet1->write_string(0,4,"JABATAN");
	$worksheet1->write_string(0,5,"TGL_LAHIR");
	$worksheet1->write_string(0,6,"ALAMAT");
	$worksheet1->write_string(0,7,"TELP");
	$worksheet1->write_string(0,8,"EMAIL");



	//data
	$qdt = mysqli_query($koneksi, "SELECT * FROM m_orang ".
							"ORDER BY nama ASC");
	$rdt = mysqli_fetch_assoc($qdt);

	do
		{
		//nilai
		$dt_nox = $dt_nox + 1;
		$dt_nip = balikin($rdt['nip']);
		$dt_nama = balikin($rdt['nama']);
		$dt_tipe = balikin($rdt['tipe_user']);
		$dt_jabatan = balikin($rdt['jabatan']);
		$dt_tgl_lahir = balikin($rdt['tgl_lahir']);
		$dt_alamat = balikin($rdt['alamat']);
		$dt_telp = balikin($rdt['telp']);
		$dt_email = balikin($rdt['email']);



		//ciptakan
		$worksheet1->write_string($dt_nox,0,$dt_nox);
		$worksheet1->write_string($dt_nox,1,$dt_nip);
		$worksheet1->write_string($dt_nox,2,$dt_nama);
		$worksheet1->write_string($dt_nox,3,$dt_tipe);
		$worksheet1->write_string($dt_nox,4,$dt_jabatan);
		$worksheet1->write_string($dt_nox,5,$dt_tgl_lahir);
		$worksheet1->write_string($dt_nox,6,$dt_alamat);
		$worksheet1->write_string($dt_nox,7,$dt_telp);
		$worksheet1->write_string($dt_nox,8,$dt_email);
		}
	while ($rdt = mysqli_fetch_assoc($qdt));


	//close
	$workbook->close();

	
	
	//re-direct
	xloc($filenya);
	exit();
	}












//jika export
//export
if ($_POST['btnEXX'])
	{
	//require
	require('../../inc/class/excel/OLEwriter.php');
	require('../../inc/class/excel/BIFFwriter.php');
	require('../../inc/class/excel/worksheet.php');
	require('../../inc/class/excel/workbook.php');


	//nama file e...
	$i_filename = "user_lokasi.xls";
	$i_judul = "lokasi";
	



	//header file
	function HeaderingExcel($i_filename)
		{
		header("Content-type:application/vnd.ms-excel");
		header("Content-Disposition:attachment;filename=$i_filename");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
		header("Pragma: public");
		}

	
	
	
	//bikin...
	HeaderingExcel($i_filename);
	$workbook = new Workbook("-");
	$worksheet1 =& $workbook->add_worksheet($i_judul);
	$worksheet1->write_string(0,0,"NO.");
	$worksheet1->write_string(0,1,"KODE");
	$worksheet1->write_string(0,2,"NAMA");
	$worksheet1->write_string(0,3,"TIPE_USER");
	$worksheet1->write_string(0,4,"LONGITUDE");
	$worksheet1->write_string(0,5,"LATITUDE");
	$worksheet1->write_string(0,6,"DESKRIPSI");
	$worksheet1->write_string(0,7,"KET");



	//data
	$qdt = mysqli_query($koneksi, "SELECT * FROM m_orang ".
							"ORDER BY nama ASC");
	$rdt = mysqli_fetch_assoc($qdt);

	do
		{
		//nilai
		$dt_nox = $dt_nox + 1;
		$dt_kd = balikin($rdt['kd']);
		$dt_nip = balikin($rdt['nip']);
		$dt_nama = balikin($rdt['nama']);
		$dt_tipe = balikin($rdt['tipe_user']);
		$yuk_latx = balikin($rdt['lat_x']);
		$yuk_laty = balikin($rdt['lat_y']);
		$yuk_alamat = balikin($rdt['alamat']);
		$yuk_ket = balikin($rdt['ket']);
		
	
		
		
		//ciptakan
		$worksheet1->write_string($dt_nox,0,$dt_nox);
		$worksheet1->write_string($dt_nox,1,$dt_nip);
		$worksheet1->write_string($dt_nox,2,$dt_nama);
		$worksheet1->write_string($dt_nox,3,$dt_tipe);
		$worksheet1->write_string($dt_nox,4,$yuk_latx);
		$worksheet1->write_string($dt_nox,5,$yuk_laty);
		$worksheet1->write_string($dt_nox,6,$yuk_alamat);
		$worksheet1->write_string($dt_nox,7,$yuk_ket);
		}
	while ($rdt = mysqli_fetch_assoc($qdt));


	//close
	$workbook->close();

	
	
	//re-direct
	xloc($filenya);
	exit();
	}















//nek batal
if ($_POST['btnBTL'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}






//nek entri baru
if ($_POST['btnBARU'])
	{
	//re-direct
	//$ke = "$filenya?s=baru&kd=$x";
	$ke = "$filenya?s=baru&kd=$x";
	xloc($ke);
	exit();
	}










//nek pegawai : reset
if ($s == "reset")
	{ 
	//nilai
	$nilku = rand(1,5);
	
	//pass baru
	$passbarux = md5($nilku);
	
	
	//update
	mysqli_query($koneksi, "UPDATE m_orang SET passwordx = '$passbarux' ".
					"WHERE kd = '$kd'"); 
	
	//re-direct
	$pesan = "Password Baru : $nilku";
	pekem($pesan,$filenya);
	exit();
	}










//nek pegawai : hardware kode
if ($s == "haid")
	{ 
	//update
	mysqli_query($koneksi, "UPDATE m_orang SET hardware_kode = '' ".
					"WHERE kd = '$kd'"); 
	
	//re-direct
	$pesan = "HardWare Kode untuk HP Berhasil Dilakukan Reset";
	pekem($pesan,$filenya);
	exit();
	}




















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










	//set akses 
	$aksesnya = $e_nip;
	$passx = md5($aksesnya);
	
	
	
	//jika update
	if ($s == "edit")
		{
		mysqli_query($koneksi, "UPDATE m_orang SET nip = '$e_nip', ".
						"nama = '$e_nama', ".
						"tipe_user = '$e_tipe', ".
						"jabatan = '$e_jabatan', ".
						"tgl_lahir = '$e_tgl_lahir', ".
						"alamat = '$e_alamat', ".
						"telp = '$e_telp', ".
						"email = '$e_email', ".
						"usernamex = '$aksesnya', ".
						"passwordx = '$passx' ".
						"WHERE kd = '$kd'");

		//update
		mysqli_query($koneksi, "UPDATE m_orang SET filex1 = '$namabaru', ".
						"postdate = '$today' ".
						"WHERE kd = '$kd'");

		//re-direct
		xloc($filenya);
		exit();
		}



	//jika baru
	if ($s == "baru")
		{
		//cek
		$qcc = mysqli_query($koneksi, "SELECT * FROM m_orang ".
								"WHERE nip = '$e_nip'");
		$rcc = mysqli_fetch_assoc($qcc);
		$tcc = mysqli_num_rows($qcc);

		//nek ada
		if ($tcc != 0)
			{
			//re-direct
			$pesan = "Sudah Ada. Silahkan Ganti Yang Lain...!!";
			$ke = "$filenya?s=baru&kd=$kd";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			mysqli_query($koneksi, "INSERT INTO m_orang(kd, nip, nama, tipe_user, jabatan, ".
							"tgl_lahir, alamat, telp, email, usernamex, passwordx, postdate) VALUES ".
							"('$kd', '$e_nip', '$e_nama', '$e_tipe', '$e_jabatan', ".
							"'$e_tgl_lahir', '$e_alamat', '$e_telp', '$e_email', '$aksesnya', '$passx', '$today')");

							
			//update
			mysqli_query($koneksi, "UPDATE m_orang SET filex1 = '$namabaru', ".
							"postdate = '$today' ".
							"WHERE kd = '$kd'");
										

			//re-direct
			xloc($filenya);
			exit();
			}
		}
	}







//jika hapus
if ($s == "hapus")
	{
	$kd = nosql($_REQUEST['kd']);

	//del
	mysqli_query($koneksi, "DELETE FROM m_orang ".
					"WHERE kd = '$kd'");

	//auto-kembali
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
//jika import
if ($s == "import")
	{
	?>
	<div class="row">

	<div class="col-md-12">
		
	<?php
	echo '<form action="'.$filenya.'" method="post" enctype="multipart/form-data" name="formxx2">
	<p>
		<input name="filex_xls" type="file" size="30" class="btn btn-warning">
	</p>

	<p>
		<input name="btnBTL" type="submit" value="BATAL" class="btn btn-info">
		<input name="btnIMX" type="submit" value="IMPORT >>" class="btn btn-danger">
	</p>
	
	
	</form>';	
	?>
		


	</div>
	
	</div>


	<?php
	}






//jika importt
if ($s == "importt")
	{
	?>
	<div class="row">

	<div class="col-md-12">
		
	<?php
	echo '<form action="'.$filenya.'" method="post" enctype="multipart/form-data" name="formxx2">
	<p>
		<input name="filex_xls" type="file" size="30" class="btn btn-warning">
	</p>

	<p>
		<input name="btnBTL" type="submit" value="BATAL" class="btn btn-info">
		<input name="btnIMXX" type="submit" value="IMPORT >>" class="btn btn-danger">
	</p>
	
	
	</form>';	
	?>
		


	</div>
	
	</div>


	<?php
	}











//jika edit / baru
else if (($s == "baru") OR ($s == "edit"))
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
	<input name="e_nip" type="text" value="'.$e_nip.'" size="10" class="btn-warning" required>
	</p>
	
	
	
	<p>
	Nama : 
	<br>
	<input name="e_nama" type="text" value="'.$e_nama.'" size="30" class="btn-warning" required>
	</p>
	
	
	<p>
	Tipe User : 
	<br>
	<select name="e_tipe" id="e_tipe" class="btn btn-warning" required>
	<option value="'.$e_tipe2.'" selected>'.$e_tipe.'</option>';
	
	//list
	$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
									"ORDER BY nama ASC");
	$rku = mysqli_fetch_assoc($qku);
	
	do
		{
		//nilai
		$ku_nama = balikin($rku['nama']);
		$ku_nama2 = cegah($rku['nama']);
		
		
		echo '<option value="'.$ku_nama2.'">'.$ku_nama.'</option>';
		}
	while ($rku = mysqli_fetch_assoc($qku));
	
	echo '</select>
	</p>

	
	
	
	<p>
	Jabatan : 
	<br>
	<input name="e_jabatan" type="text" value="'.$e_jabatan.'" size="10" class="btn-warning">
	</p>
	
	
	
	
	<p>
	Tgl. Lahir : 
	<br>
	<input name="e_tgl_lahir" id="e_tgl_lahir" type="text" value="'.$e_tgl_lahir.'" size="10" class="btn-warning">
	</p>
	
	
	<p>
	Alamat : 
	<br>
	<input name="e_alamat" type="text" value="'.$e_alamat.'" size="20" class="btn-warning">
	</p>
	
	
	<p>
	Telepon : 
	<br>
	<input name="e_telp" type="text" value="'.$e_telp.'" size="10" class="btn-warning">
	</p>
	
	
	<p>
	E-Mail : 
	<br>
	<input name="e_email" type="text" value="'.$e_email.'" size="20" class="btn-warning">
	</p>
	
	
	
	
	
	
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
	
	
   <form method="post" id="upload_image" enctype="multipart/form-data">
	<input type="file" name="image_upload" id="image_upload" class="btn btn-warning" />

   </form>
   
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
        echo '<form action="'.$filenya.'" method="post" name="formxx">
			<p>
			<input name="btnBARU" type="submit" value="ENTRI BARU" class="btn btn-danger">
			<input name="btnIM" type="submit" value="IMPORT" class="btn btn-primary">
			<input name="btnEX" type="submit" value="EXPORT" class="btn btn-success">
			</p>
			<hr>
			
			
			</form>

			
			
			<form action="'.$filenya.'" method="post" name="formx">

			<table id="empTable" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
			<thead>
                <tr valign="top" bgcolor="'.$warnaheader.'">
					<th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
	                <th><strong><font color="'.$warnatext.'">NIK</font></strong></th>
					<th><strong><font color="'.$warnatext.'">NAMA</font></strong></th>
					<th><strong><font color="'.$warnatext.'">IMAGE</font></strong></th>
					<th><strong><font color="'.$warnatext.'">TIPE</font></strong></th>
					<th><strong><font color="'.$warnatext.'">JABATAN</font></strong></th>
					<th><strong><font color="'.$warnatext.'">TGL.LAHIR</font></strong></th>
					<th><strong><font color="'.$warnatext.'">ALAMAT</font></strong></th>
					<th><strong><font color="'.$warnatext.'">TELP</font></strong></th>
					<th><strong><font color="'.$warnatext.'">EMAIL</font></strong></th>
					<th><strong><font color="'.$warnatext.'">LOKASI</font></strong></th>
					<th><strong><font color="'.$warnatext.'">KET</font></strong></th>
                </tr>
                </thead>



				<tfoot>
	                <tr valign="top" bgcolor="'.$warnaheader.'">
						<th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
		                <th><strong><font color="'.$warnatext.'">NIK</font></strong></th>
						<th><strong><font color="'.$warnatext.'">NAMA</font></strong></th>
						<th><strong><font color="'.$warnatext.'">IMAGE</font></strong></th>
						<th><strong><font color="'.$warnatext.'">TIPE</font></strong></th>
						<th><strong><font color="'.$warnatext.'">JABATAN</font></strong></th>
						<th><strong><font color="'.$warnatext.'">TGL.LAHIR</font></strong></th>
						<th><strong><font color="'.$warnatext.'">ALAMAT</font></strong></th>
						<th><strong><font color="'.$warnatext.'">TELP</font></strong></th>
						<th><strong><font color="'.$warnatext.'">EMAIL</font></strong></th>
						<th><strong><font color="'.$warnatext.'">LOKASI</font></strong></th>
						<th><strong><font color="'.$warnatext.'">KET</font></strong></th>
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
				"columnDefs": [ 
					{ "width": "350px", "targets": 0 }, 
					{ "width": "100px", "targets": 0 }, 
					{ "width": "100px", "targets": 0 }, 
					{ "width": "100px", "targets": 0 }, 
					{ "width": "100px", "targets": 0 }, 
					{ "width": "100px", "targets": 0 }, 
					{ "width": "100px", "targets": 0 }, 
					{ "width": "100px", "targets": 0 }, 
					{ "width": "100px", "targets": 0 }, 
					{ "width": "100px", "targets": 0 }, 
					{ "width": "100px", "targets": 0 }, 
					{ "width": "100px", "targets": 0 }
				  ], 
				"language": {
							"url": "../Indonesian.json",
							"sEmptyTable": "Tidak ada data di database"
						}, 
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'i_pegawai_data.php'
                },
                'columns': [
                    { data: 'postdate' }, 
                    { data: 'nip' },
                    { data: 'nama' },
                    { data: 'image' },
                    { data: 'tipe_user' },
                    { data: 'jabatan' },
                    { data: 'tgllahir' },
                    { data: 'alamat' },
                    { data: 'telp' },
                    { data: 'email' },
                    { data: 'lokasi' },
                    { data: 'ket' }
                ]
            });
            
        
        });
        
        

        
		

        

        </script>


	<?php
	}







//bikin kasi border //////////////////////////////////////////////////////////////////////////////////
$img_src = $pathkecil;

$img = imagecreatefromjpeg($img_src);



//ketahui kode warna
$qx = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
					"WHERE nama = '$e_tipe'");
$rowx = mysqli_fetch_assoc($qx);
$e_warna = balikin($rowx['warna']);




//pecah kode
$ewarna1 = substr($e_warna, 1,2);
$ewarna2 = substr($e_warna, 3,2);
$ewarna3 = substr($e_warna, 5,2);




$nil1 = hexdec($ewarna1);
$nil2 = hexdec($ewarna2);
$nil3 = hexdec($ewarna3);



//$color = imagecolorallocate($img, 132, 15, 153);
$color = imagecolorallocate($img, $nil1, $nil2, $nil3);
$borderThickness = 5;




drawBorder($img, $color, $borderThickness);


    function drawBorder(&$img, &$color, $thickness)
    {
        $x1 = 0;
        $y1 = 0;
        $x2 = imagesx($img) - 1;
        $y2 = imagesy($img) - 1;

        for($i = 0; $i < $thickness; $i++)
        {

            imagerectangle($img, $x1++, $y1++, $x2--, $y2--, $color);
        }

    }

header('Content-type: image/jpeg');
imagejpeg($img, $pathkecil2);






require("../template_bawah.php");



//null-kan
xclose($koneksi);
exit();
?>