<?php
session_start();


//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_baca.php";
$kd = nosql($_SESSION['kd']);
$kdx = $kd;




//detail
$qku = mysqli_query($koneksi, "SELECT * FROM cp_artikel ".
					"WHERE kd = '$kd'");
$rku = mysqli_fetch_assoc($qku);
$ku_kd = nosql($rku['kd']);
$ku_img_url = balikin($rku['filex']);
$ku_judul2 = balikin($rku['judul']);
$ku_isi = balikin2($rku['isi']);
$ku_postdate = $rku['postdate'];





//judul
$judul = "$ku_judul2";
$judulku = $judul;
$sek_url = "$sumber/artikel.php?artkd=$kd";
$sek_img_url = $ku_img_url; 








//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<table width="100%" border="0" cellpadding="3" cellspacing="3">
<tr valign="top" align="left">
			    	
<td width="10">
&nbsp;
</td>

<td>

	<p>
	<h3>
	'.$ku_judul2.'
	</h3>
	<i>
	<font size="1">Dikirim : <b>'.$ku_postdate.'</b></font>
	</i>
	<br>
	
	
	<p>
	<img src="'.$sumber.'/filebox/artikel/'.$ku_kd.'/'.$ku_img_url.'" width="100%">
	<br>
	
	
	'.$ku_isi.'
	</p>
	
	
	
	
</td>

<td width="10">
&nbsp;
</td>

</tr>
</table>    	

<hr>




<table width="100%" border="0" cellpadding="3" cellspacing="3">
<tr valign="top" align="left">
			    	
<td width="10">
&nbsp;
</td>

<td>

<b>Baca juga :</b> 	
	
</td>

<td width="10">
&nbsp;
</td>

</tr>
</table>';



$rowperpage = 50;


$query = mysqli_query($koneksi, "SELECT * FROM cp_artikel ".
						"ORDER BY postdate DESC ".
						"LIMIT 0,$rowperpage");
$row = mysqli_fetch_assoc($query);


do
	{
    $id = $row['kd'];
    $title = balikin($row['judul']);
    $img_url = balikin($row['filex']);
    $postdate = $row['postdate'];



    echo '<table width="100%" border="0" cellpadding="3" cellspacing="3">
    	<tr valign="top" align="left">
					    	
    		<td width="10">
    		&nbsp;
    		</td>
    		
    		<td>
        		<b><a href="#" onclick="$(\'#iredirect\').load(\''.$sumber.'/covid_android_satgas/i_redirect.php?sesikode=artikelbaca&kd='.$id.'\');">'.$title.'</a></b>
        		<br>
			</td>
			
			<td width="50" align="right"> 
				<a href="#" onclick="$(\'#iredirect\').load(\''.$sumber.'/covid_android_satgas/i_redirect.php?sesikode=artikelbaca&kd='.$id.'\');"><img src="'.$sumber.'/filebox/artikel/'.$id.'/'.$img_url.'" width="50" height="50" vspace="5" hspace="5" align="left"></a>
			</td>

					    	
    		<td width="10">
    		&nbsp;
    		</td>
    	</tr>
    </table>
    <hr>';
	}
while ($row = mysqli_fetch_assoc($query));



//diskonek
exit();
?>