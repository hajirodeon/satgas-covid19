<?php
session_start();



//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");


//nilai session
$sesiku = $_SESSION['sesiku'];
$brgkd = $_SESSION['brgkd'];
$sesinama = $_SESSION['sesinama'];
$kd6_session = nosql($_SESSION['sesiku']);
$notaku = nosql($_SESSION['notaku']);
$notakux = md5($notaku);





//menu bottom /////////////////////////////////////////////////////////////////////////////////////////
//jika belum login
if (empty($sesiku))
	{
	echo '<br>
	<table border="0" width="100%">
	<tr valign="top">
	<td align="center" width="50%">
		<a href="login.html">
			<i class="fa fa-user" style="font-size:20px;color:green"></i>
			<font size="1"><p class="text-primary">LOGIN</p></font>
		</a>
	</td>

	<td align="center" width="100%">
		<a href="reg.html">
			<i class="fa fa-user" style="font-size:20px;color:green"></i>
			<font size="1"><p class="text-primary">DAFTAR</p></font>
		</a>
	</td>
	</tr>
	</table>';
	}
	
else
	{
	echo '<br>
	<table border="0" width="100%">
	<tr valign="top">
	<td align="center" width="25%">
		<a href="main.html">
			<i class="fa fa-home" style="font-size:20px;color:green"></i>
			<font size="1"><p class="text-primary">BERANDA</p></font>
		</a>
	</td>
	
	<td align="center" width="25%">
		<a href="akun_profil.html">
			<i class="fa fa-user" style="font-size:20px;color:green"></i>
			<font size="1"><p class="text-primary">PROFIL</p></font>
		</a>
	</td>
	
	<td align="center" width="25%">
		<a href="mn.html">
			<i class="fa fa-key" style="font-size:20px;color:green"></i>
			<font size="1"><p class="text-primary">DATA</p></font>
		</a>
	</td>
	
	<td align="center" width="25%">
		<a href="akun_tracking.html">
			<i class="fa fa-map-marker" style="font-size:20px;color:green"></i>
			<font size="1"><p class="text-primary">TRACKING</p></font>
		</a>
	</td>

	</tr>
	</table>';
		
	}

?>
