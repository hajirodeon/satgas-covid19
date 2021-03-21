<?php
session_start();

//ambil nilai
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");
$tpl = LoadTpl("../../template/admin.html");


nocache;

//nilai
$filenya = "kontak.php";
$judul = "[SETTING]. Kontak";
$judulku = "$judul";




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//simpan
if ($_POST['btnSMP'])
	{
	//ambil nilai
	$e_telp = cegah($_POST["e_telp"]);
	$e_email = cegah($_POST["e_email"]);


	//cek
	//nek null
	if ((empty($e_telp)) OR (empty($e_email)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}

	else
		{
		//perintah SQL
		mysqli_query($koneksi, "UPDATE a_profil SET telp = '$e_telp', ".
									"email = '$e_email'");


		//auto-kembali
		xloc($filenya);
		exit();
		}
	}
	
	
	
	
	
	
	
	
	




	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






//isi *START
ob_start();




//detail
$qku = mysqli_query($koneksi, "SELECT * FROM a_profil");
$rku = mysqli_fetch_assoc($qku);
$ku_telp = balikin($rku['telp']);
$ku_email = balikin($rku['email']);




     	
echo '<form action="'.$filenya.'" method="post" name="formx">
<div class="row">

	<div class="col-md-6">
	
	
		<p>
		Telepon : 
		<br>
		<input name="e_telp" type="text" size="20" value="'.$ku_telp.'" class="btn btn-warning">
		</p>
		
		
	
		<p>
		E-Mail : 
		<br>
		<input name="e_email" type="text" size="20" value="'.$ku_email.'" class="btn btn-warning">
		</p>
		
		
		
		<p>
		<input name="btnSMP" type="submit" value="SIMPAN" class="btn btn-danger">
		</p>
	
	</div>

</div>

</form>

<hr>';



//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");

//diskonek
xfree($qbw);
xclose($koneksi);
exit();
?>