<?php
session_start();

//fungsi - fungsi
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("class_paging.php");


nocache;



$filenyax = "i_tabel.php";
$tabel2 = "orang_login";



//jika detail data
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'form'))
	{
	//ambil nilai
	$kunci = cegah($_GET['cariku']);
	$sort = cegah($_GET['sort']);
	$pageke = cegah($_GET['pageke']);
	$sortx = cegah($_SESSION['sortx']);
	$page = nosql($_GET['page']);
	$limitku = cegah($_GET['limitku']);
	$limitku2 = cegah($_SESSION['limitku']);
	
	
	//jika null, kasi default 10
	if (empty($limitku))
		{
		$limit = 10;
		/*
		//bikin sesi
		$_SESSION['limitku'] = $limit;
		
		$limit = cegah($_SESSION['limitku']);
		 * 
		 */
		}
	else
		{
		$limit = $limitku;				
		}
		
		
		
		
	
	//jika null ato ASC
	if (empty($sortx)) 
		{
		$_SESSION['sortx'] = "ASC";
		}
		
	else if ($sortx == "ASC")
		{
		$_SESSION['sortx'] = "DESC";
		}
		
	else if ($sortx == "DESC")
		{
		$_SESSION['sortx'] = "ASC";
		}
	
	?>
	




	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
	
		$("#pageke").on('change', function(){
		    	var pageke = $("#pageke").val();

				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=form&limitku=<?php echo $limitku;?>&page="+pageke,
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable").html(data);
						}
					});				
			});
	





		$("#ia").on('click', function(){
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=form&limitku=<?php echo $limitku;?>&sort=ia",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable").html(data);
						}
					});
			});


		$("#ib").on('click', function(){
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=form&limitku=<?php echo $limitku;?>&sort=ib",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable").html(data);
						}
					});
			});


		$("#ic").on('click', function(){
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=form&limitku=<?php echo $limitku;?>&sort=ic",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable").html(data);
						}
					});
			});
		

	    $('#table-responsive').dataTable( {
	        "scrollX": true
	    } );
	} );
	  </script>
	  
	<?php
	$sortx = cegah($_SESSION['sortx']);
	
	//jika ada sort
	if ($sort == "ia")
		{
		$q4 = "ORDER BY orang_kode $sortx";
		
		//jika null ato ASC
		if ($sortx == "ASC") 
			{
			$nilsort1a = "asc";
			$nilsort1b = "desc";
			$nilsort1c = "desc";
			}
		else 
			{
			$nilsort1a = "desc";
			$nilsort1b = "asc";
			$nilsort1c = "asc";
			}
		
		}
		
	//jika ada sort
	else if ($sort == "ib")
		{
		$q4 = "ORDER BY orang_nama $sortx";
		
		//jika null ato ASC
		if ($sortx == "ASC") 
			{
			$nilsort1a = "desc";
			$nilsort1b = "asc";
			$nilsort1c = "desc";
			}
		else 
			{
			$nilsort1a = "asc";
			$nilsort1b = "desc";
			$nilsort1c = "asc";
			}
		}
		

	//jika ada sort
	else if ($sort == "ic")
		{
		$q4 = "ORDER BY postdate $sortx";
		
		//jika null ato ASC
		if ($sortx == "ASC") 
			{
			$nilsort1a = "desc";
			$nilsort1b = "desc";
			$nilsort1c = "asc";
			}
		else 
			{
			$nilsort1a = "asc";
			$nilsort1b = "asc";
			$nilsort1c = "desc";
			}
		}
		
		
	else
		{
		$q4 = "ORDER BY postdate DESC";
		
		//jika null ato ASC
		if ($sortx == "ASC") 
			{
			$nilsort1a = "asc";
			$nilsort1b = "asc";
			$nilsort1c = "desc";
			}
		else 
			{
			$nilsort1a = "asc";
			$nilsort1b = "asc";
			$nilsort1c = "desc";
			}
		}
		
		
		
	//jika cari
	if (!empty($kunci))
		{
		//daftar 
		$qyuk = "SELECT * FROM orang_login ".
						"WHERE orang_kode LIKE '%$kunci%' ".
						"OR orang_nama LIKE '%$kunci%' ".
						"OR postdate LIKE '%$kunci%'";
		}
	else
		{
		//daftar 
		$qyuk = "SELECT * FROM orang_login";
		}

		
		

	//query
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlku = "$qyuk $q4";
	
	$sqlcount = $sqlku;
	$sqlresult = $sqlcount;
	
	$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenyax?aksi=form&kunci=$kunci";
	//$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$pagelist = $p->pageList($limitku, $page, $pages, $target);
	$data = mysqli_fetch_array($result);
	
			
	
		
	
	echo '<form name="formx5" id="formx5">
	<div class="table-responsive">          
		  <table class="table" border="1">
		    <tbody>';
			
			echo '<tr bgcolor="'.$warnaheader.'">
	    	<th id="ia">
	    		<a href="#">
	    		<span><font color="white">KODE</font></span> <i class="fa fa-sort-amount-'.$nilsort1a.'"></i>
	    		</a>
              </th>
	        <th id="ib">
	    		<a href="#">
	        	<span><font color="white">NAMA</font></span> <i class="fa fa-sort-amount-'.$nilsort1b.'"></i>
	        	</a>
	        	</th>
	        <th id="ic">
	    		<a href="#">
	        	<span><font color="white">POSTDATE</font></span> <i class="fa fa-sort-amount-'.$nilsort1c.'"></i>
	        	</a>
	        	</th>';
		
			
			
	
		do
			{
			if ($warna_set ==0)
				{
				$warna = $warna01;
				$warna_set = 1;
				}
			else
				{
				$warna = $warna02;
				$warna_set = 0;
				}

	
			//nilai
			$nomer = $nomer + 1;
			$kd = nosql($data['kd']);
			$i_kode = balikin($data['orang_kode']);
			$i_nama = balikin($data['orang_nama']);
			$i_postdate = balikin($data['postdate']);


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>'.$i_kode.'</td>
			<td>'.$i_nama.'</td>
			<td>'.$i_postdate.'</td>
	    	</tr>';
			}
		while ($data = mysqli_fetch_assoc($result));

		
		echo '</tbody>
		  </table>
		  </div>




		<table width="100%" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td><strong><font color="#FF0000">'.$count.'</font></strong> Data.

		<select name="pageke" id="pageke" class="btn btn-info">
		<option value="'.$page.'" selected>'.$page.'</option>';

		
		//loop jumlah page
		for ($k=1;$k<=$pages;$k++)
			{
			echo '<option value="'.$k.'">'.$k.'</option>';
			}
		
		
		echo '</select>';


		
		echo ' '.$pagelist.'
		</td>
		</tr>
		</table>';
	
	echo '</form>';
	

	
	




	exit();
	}

	








	
	

exit();
?>