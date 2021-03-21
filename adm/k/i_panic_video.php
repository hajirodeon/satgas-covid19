<?php
session_start();


//ambil nilai
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");



nocache;

//nilai
$panickd = nosql($_GET['panickd']);
$panickdx = $panickd;







//jika player...
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'playernya'))
	{
	//nilai
	$panickd = balikin($_GET['panickd']);
	$pkd = balikin($_SESSION['pkd']);

	
	
	//ketahui batas akhir
	$qmboh21 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_video ".
							"WHERE panic_kd = '$panickd' ".
							"ORDER BY postdate DESC");
	$rmboh21 = mysqli_fetch_assoc($qmboh21);
	$i_postdate21 = balikin($rmboh21['postdate']);

	
	
	

	//jika null
	if (empty($pkd))
		{
		//tampilkan satu per satu...
		$qmboh2 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_video ".
								"WHERE panic_kd = '$panickd' ".
								"ORDER BY postdate ASC");
		$rmboh2 = mysqli_fetch_assoc($qmboh2);
		$tmboh2 = mysqli_num_rows($qmboh2);
		}
		
	else
		{
		//tampilkan satu per satu...
		$qmboh2 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_video ".
								"WHERE panic_kd = '$panickd' ".
								"AND postdate > '$pkd' ".
								"ORDER BY postdate ASC");
		$rmboh2 = mysqli_fetch_assoc($qmboh2);
		$tmboh2 = mysqli_num_rows($qmboh2);			
		}
	

	//jika ada
	if (!empty($tmboh2))
		{
		//nilai
		$i_no = 1;
		$i_umum_kd = nosql($rmboh2['umum_kd']);
		$i_kd = nosql($rmboh2['kd']);
		$i_filex = balikin($rmboh2['filex']);
		$i_postdate = balikin($rmboh2['postdate']);
	
	
		//jika sama, jangan bunyi, selesai...
		if ($pkd == $i_postdate)
			{
			//echo "<font color='green'>$i_postdate -> $pkd</font>";
	
			exit();
			}
			
		else
			{
			//bikin sesi baru...
			$_SESSION['pkd'] = $i_postdate;	


			echo "$sumber/filebox/panic/$i_umum_kd/$panickd/$i_filex";
			
			
			

			//jika sama dengan batas akhir, ulang dari awal
			if ($i_postdate21 == $i_postdate)
				{
				//netralkan
				$_SESSION['pkd'] = "";
				}

			}

		
		
		}
	}



exit();
?>