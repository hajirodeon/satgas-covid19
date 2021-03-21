<?php
session_start();



//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

//nilai session
$kd = cegah($_SESSION['kd']);
$sesikode = cegah($_SESSION['sesikode']);



//jika baca artikel, munculkan judulnya...
if ($sesikode == "artikelbaca")
	{
	//judul
	$query = mysqli_query($koneksi, "SELECT * FROM cp_artikel ".
							"WHERE kd = '$kd'");
	$row = mysqli_fetch_assoc($query);
	$sesijudul = balikin($row['judul']);
	}






//menu header ///////////////////////////////////////////////////////////////////////////////////////////
echo '<table border="0" width="100%">
<tr bgcolor="green">

<td width="50" align="center">
<a href="main.html">
	<i class="fa fa-arrow-left" style="color:orange"></i>
</a>


</td>

<td align="left">
	<font color="yellow">ARTIKEL</font>

</td>
</tr>
</table>';
?>