<?php
session_start();

require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
	




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika bukutamu
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'bukutamu'))
	{
	//ambil nilai
	$nil1 = cegah($_GET['e_nil1']);
	$nil2 = cegah($_GET['e_nil2']);
	$ongkoku = cegah($_GET['e_ongko']);
	$artkd = cegah($_GET['artkd']);
	$namaku = urlencode(cegah($_GET['e_nama']));
	$emailku = cegah($_GET['e_email']);
	$alamatku = cegah($_GET['e_alamat']);
	$telpku = cegah($_GET['e_telp']);
	$situsku = cegah($_GET['e_situs']);
	$isiku = urlencode(cegah($_GET['e_isi']));
	$xyz = "$artkd$namaku$emailku$isiku";

	
	
	//jika admin, gak boleh
	if (($namaku == "admin") OR ($namaku == "administrator"))
		{
		echo '<p>
		<font color="red">
		<strong>Silahkan Dicek Lagi...!!</strong>
		</font>
		</p>';			
		}
		
	else
		{
		$ongkokux = $nil1 + $nil2;
		
		//jika betul
		if ($ongkoku == $ongkokux)
			{
			//insert
			mysqli_query($koneksi, "INSERT INTO cp_bukutamu(kd, nama, alamat, telp, email, situs, isi, postdate) VALUES ".
							"('$xyz', '$namaku', '$alamatku', '$telpku', '$emailku', '$situsku', '$isiku', '$today')");
		
		
			?>
	
		
			<script language='javascript'>
			//membuat document jquery
			$(document).ready(function(){
	
				$("#iformnya").hide();
						
			});
			
			</script>
				
		
		
			<?php
			echo '<p>
			<font color="green">
			<strong>Terima Kasih Telah Mengisi Buku Tamu....</strong>
			</font>
			</p>';
			}
			
		else
			{
			echo '<p>
			<font color="red">
			<strong>Silahkan Jawab Perhitungan Matematika dengan Benar...!!</strong>
			</font>
			</p>';
			}
		}
		
		
	exit();
	}









exit();
?>