<?php
session_start();

//ambil nilai
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");




nocache;

//nilai
$filenya = "radius.php";
$judul = "[SETTING]. Radius Jangkauan";
$judulku = "$judul";




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//simpan
if ($_POST['btnSMP'])
	{
	//ambil nilai
	$e_radius = cegah($_POST["e_radius"]);


	//cek
	//nek null
	if (empty($e_radius))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}

	else
		{
		//perintah SQL
		mysqli_query($koneksi, "UPDATE a_profil SET radius = '$e_radius'");


		//auto-kembali
		xloc($filenya);
		exit();
		}
	}
	
	
	
	
	
	
	
	
	




	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





require("../template_atas.php");



//detail
$qku = mysqli_query($koneksi, "SELECT * FROM a_profil");
$rku = mysqli_fetch_assoc($qku);
$ku_radius = balikin($rku['radius']);




     	
echo '<form action="'.$filenya.'" method="post" name="formx">
<div class="row">

	<div class="col-md-6">
	
	
		<p>
		Radius Jangkauan : 
		<br>
		<input name="e_radius" type="text" size="5" value="'.$ku_radius.'" class="btn-warning"> Meter
		</p>
		
		
		
		
		<p>
		<input name="btnSMP" type="submit" value="SIMPAN" class="btn btn-danger">
		</p>
	
	</div>

</div>

</form>

<hr>';




require("../template_bawah.php");




//diskonek
xfree($qbw);
xclose($koneksi);
exit();
?>