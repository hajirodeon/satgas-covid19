<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_deteksi.php";
$filenyax = "$sumber/covid_android_satgas/i_deteksi.php";
$judul = "Deteksi Hardware";
$juduli = $judul;



//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];
$passx = $_SESSION['passx'];





//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika deteksi
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'deteksi'))
	{
	//ambil nilai
	$hkode = cegah($_GET["hkode"]);
	


	//jika login
	if (!empty($passx))
		{
		//re-direct
	
		//update ke data lokasi
		mysqli_query($koneksi, "UPDATE orang_lokasi SET hardware_kode = '$hkode' ".
						"WHERE orang_kd = '$sesiku'");
		
		
		
		
		
		//jika pengguna baru ato abis kena reset, kasi id hardware...
		$q = mysqli_query($koneksi, "SELECT * FROM m_orang ".
							"WHERE kd = '$sesiku'");
		$row = mysqli_fetch_assoc($q);
		//$total = mysqli_num_rows($q);
		$kodeku = balikin($row['hardware_kode']);
	
		//cek belum ada...
		if (empty($kodeku))
			{
			//cek lg, wes ono sing nduwe po durung
			$q1 = mysqli_query($koneksi, "SELECT * FROM m_orang ".
								"WHERE hardware_kode = '$hkode'");
			$row1 = mysqli_fetch_assoc($q1);
			$total1 = mysqli_num_rows($q1);
	
	
			//jika ada
			if (!empty($total1))
				{
				?>
				
				<script language='javascript'>
				//membuat document jquery
				$(document).ready(function(){
						window.location.href = "deteksi.html"; 
				
				});
				
				</script>
				
				<?php
				}
			else
				{		
				//kasi kode
				mysqli_query($koneksi, "UPDATE m_orang SET hardware_kode = '$hkode' ".
								"WHERE kd = '$sesiku'");
				}
			}




	
		
	
		//jika deteksi, benar ato tidak..................
		$q = mysqli_query($koneksi, "SELECT * FROM m_orang ".
							"WHERE kd = '$sesiku' ".
							"AND hardware_kode = '$hkode'");
		$row = mysqli_fetch_assoc($q);
		$total = mysqli_num_rows($q);
	
	
		//jika salah
		if (empty($total))
			{
			//re-direct
			?>
			
			<script language='javascript'>
			//membuat document jquery
			$(document).ready(function(){
					window.location.href = "deteksi.html"; 
			
			});
			
			</script>
			
			<?php
			}
	

		}	


	 
	
	exit();
	}








/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>