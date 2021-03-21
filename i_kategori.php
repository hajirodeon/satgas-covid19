<?php
//kategori
$qyuk2 = mysqli_query($koneksi, "SELECT * FROM cp_m_kategori ".
						"ORDER BY nama ASC");
$ryuk2 = mysqli_fetch_assoc($qyuk2);




do
	{
	//nilai
	$yuk2_kd = nosql($ryuk2['kd']);
	$yuk2_nama = urldecode(balikin($ryuk2['nama']));
	$yuk2_postdate = balikin($ryuk2['postdate']);
	
	$yuk2_nama2 = seo_friendly_url($yuk2_nama);
	
	
	//ketahui jumlah artikel
	$qmboh = mysqli_query($koneksi, "SELECT * FROM cp_artikel ".
							"WHERE kategori = '$yuk2_nama'");
	$tmboh = mysqli_num_rows($qmboh);
	
	
	echo '<li>
	<a href="kategori.php?katkd='.$yuk2_nama.'&'.$yuk2_nama2.'" class="d-flex">
	<p>'.$yuk2_nama.'</p>
	<p>('.$tmboh.')</p></a>
	</li>';
	}
while ($ryuk2 = mysqli_fetch_assoc($qyuk2));
?>