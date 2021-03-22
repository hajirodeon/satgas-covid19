<?php
session_start();

//fungsi - fungsi
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");


nocache;








class Pager
{	
var $target;
var $curpage;


//batas
function findStart($limit)
   	{
   	if ((!isset($_GET['page9'])) || ($_GET['page9'] == "1"))
   		{
   		$start = 0;
   		$_GET['page9'] = 1;
   		}
     else
      	{
       	$start = ($_GET['page9']-1) * $limit;
      	}

     return $start;
    }
		
//total halaman
function findPages($count, $limit)
    {
     $pages = (($count % $limit) == 0) ? $count / $limit : floor($count / $limit) + 1;

     return $pages;
   	}
		
//penanda daftar halaman
function pageList($limitku, $curpage, $pages, $target)
	{
    $page_list  = "";
		
	//jika $target kosong
	if ($target == "")
		{
		$xpage = "?limitku9=$limitku&page9";
		}
	else
		{
		$xpage = "&limitku9=$limitku&page9";
		}
			
	?>
	
	
	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){


		$("#idku19").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=1",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable9").html(data);
						}
					});
			});





		$("#idku29").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo ($curpage-1);?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable9").html(data);
						}
					});
			});






		$("#idku39").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo ($curpage+1);?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable9").html(data);
						}
					});
			});








		$("#idku49").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo $pages;?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable9").html(data);
						}
					});
			});






		$("#idku59").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo ($curpage-1);?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable9").html(data);
						}
					});
			});





		$("#idku69").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo ($curpage+1);?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable9").html(data);
						}
					});
			});






		} );
	  </script>

			
	<?php			
    //awal-sebelumnya
   	if (($curpage != 1) && ($curpage))
		{
   		$page_list .= "&nbsp; <a id=\"idku19\" class=\"btn btn-warning\" title=\"<<\"><i class=\"fa fa-fast-backward\"></i></a> ";
   		}
	else
		{
		$page_list .= "&nbsp; <a id=\"idku19x\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-fast-backward\"></i></font></a> ";
		}

   	if (($curpage-1) > 0)
   		{
   		$page_list .= "&nbsp; <a id=\"idku29\" class=\"btn btn-warning\" title=\"<\"><i class=\"fa fa-backward\"></i></a> &nbsp; ";
   		}
	else
		{
		$page_list .= "&nbsp; <a id=\"idku29x\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-backward\"></i></font></a> &nbsp; ";
		}


   	//selanjutnya-akhir
   	if (($curpage+1) <= $pages)
   		{
		$page_list .= " <a id=\"idku39\" class=\"btn btn-warning\" title=\">\"><i class=\"fa fa-forward\"></i></a> ";
   		}
	else
		{
		$page_list .= " <a id=\"idku39x\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-forward\"></i></font></a> ";
		}

   	if (($curpage != $pages) && ($pages != 0))
   		{
   		$page_list .= "&nbsp; <a id=\"idku49\" class=\"btn btn-warning\" title=\">>\"><i class=\"fa fa-fast-forward\"></i></a> &nbsp;";
   		}
	else
		{
		$page_list .= "&nbsp; <a id=\"idku49x\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-fast-forward\"></i></font></a> &nbsp;";
		}
     	
	$page_list .= "\n";

   	return $page_list;
   	}
		
//sebelumnya-selanjutnya
function nextPrev($curpage, $pages)
   	{
     $next_prev  = "";

     if (($curpage-1) <= 0)
   		{
   		$next_prev .= "<a id=\"idku59\" class=\"btn btn-warning\"><i class=\"fa fa-fast-backward\"></i></a>";
   		}
     else
   		{
   		$next_prev .= "<a id=\"idku59\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-fast-backward\"></i></font></a>";
   		}

   	$next_prev .= " &nbsp; ";

   	if (($curpage+1) > $pages)
   		{
   		$next_prev .= "<a id=\"idku69\" class=\"btn btn-warning\"><i class=\"fa fa-fast-forward\"></i></a>";
  		}
   	else
   		{
   		$next_prev .= "<a id=\"idku69\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-fast-forward\"></i></font></a>";
   		}

   	return $next_prev;
   	}
}












$filenyax = "i_tabel9.php";
$tabel2 = "orang_lokasi";



//jika detail data
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'form'))
	{
	//ambil nilai
	$kunci = cegah($_GET['cariku9']);
	$sort = cegah($_GET['sort9']);
	$pageke = cegah($_GET['pageke9']);
	$sortx = cegah($_SESSION['sortx9']);
	$sortnya = cegah($_SESSION['sortnya']);
	$page = nosql($_GET['page9']);
	$limitku = cegah($_GET['limitku9']);
	$limitku2 = cegah($_SESSION['limitku9']);
	
	
	//jika null, kasi default 10
	if (empty($limitku))
		{
		$limit = 10;
		}
	else
		{
		$limit = $limitku;				
		}
		
		
		
		
	
	//jika null 
	if (empty($sort)) 
		{
		$sortkolom = $_SESSION['sortkolom'];
		}
	else
		{
		$_SESSION['sortkolom'] = $sort;
		$sortkolom = $_SESSION['sortkolom'];
		}
	
	
	
	

	
	
	//jika ada klik
	if (!empty($sort))
		{
		//jika null ato ASC
		if (empty($sortx)) 
			{
			$_SESSION['sortx9'] = "ASC";
			$_SESSION['sortnya'] = "ASC";
			}
			
	
		else if ($sortx == "ASC")
			{
			$_SESSION['sortx9'] = "DESC";
			$_SESSION['sortnya'] = "ASC";
			}
			
		else if ($sortx == "DESC")
			{
			$_SESSION['sortx9'] = "ASC";
			$_SESSION['sortnya'] = "DESC";
			}
		}
		
	else
		{			
		$sortnya = cegah($_SESSION['sortnya']);
		}
	?>
	




	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
	
		$("#pageke9").on('change', function(){
		    	var pageke = $("#pageke9").val();
		    	
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=form&limitku9=<?php echo $limitku;?>&sort9=<?php echo $sort;?>&cariku9=<?php echo $kunci;?>&page9="+pageke,
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable9").html(data);
						}
					});				
			});
	





		$("#ia9").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=form&limitku9=<?php echo $limitku;?>&sort9=ia9&cariku9=<?php echo $kunci;?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable9").html(data);
						}
					});
			});


		$("#ib9").on('click', function(){
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=form&limitku9=<?php echo $limitku;?>&sort9=ib9&cariku9=<?php echo $kunci;?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable9").html(data);
						}
					});
			});


		$("#ic9").on('click', function(){
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=form&limitku9=<?php echo $limitku;?>&sort9=ic9&cariku9=<?php echo $kunci;?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable9").html(data);
						}
					});
			});
		

	    $('#table-responsive9').dataTable( {
	        "scrollX": true
	    } );
	} );
	  </script>
	  
	<?php
	$sortx = cegah($_SESSION['sortx9']);
	$sortnya = cegah($_SESSION['sortnya']);
	$sort = cegah($_SESSION['sortkolom']);
	
	
	//jika ada sort
	if ($sort == "ia9")
		{
		$q9 = "ORDER BY orang_kode $sortx";
		
		//jika null ato ASC
		if ($sortx == "ASC") 
			{
			$nilsort1a9 = "asc";
			$nilsort1b9 = "desc";
			$nilsort1c9 = "desc";
			}
		else 
			{
			$nilsort1a9 = "desc";
			$nilsort1b9 = "asc";
			$nilsort1c9 = "asc";
			}
		
		}
		
	//jika ada sort
	else if ($sort == "ib9")
		{
		$q9 = "ORDER BY orang_nama $sortx";
		
		//jika null ato ASC
		if ($sortx == "ASC") 
			{
			$nilsort1a9 = "desc";
			$nilsort1b9 = "asc";
			$nilsort1c9 = "desc";
			}
		else 
			{
			$nilsort1a9 = "asc";
			$nilsort1b9 = "desc";
			$nilsort1c9 = "asc";
			}
		}
		

	//jika ada sort
	else if ($sort == "ic9")
		{
		$q9 = "ORDER BY postdate $sortx";
		
		//jika null ato ASC
		if ($sortx == "ASC") 
			{
			$nilsort1a9 = "desc";
			$nilsort1b9 = "desc";
			$nilsort1c9 = "asc";
			}
		else 
			{
			$nilsort1a9 = "asc";
			$nilsort1b9 = "asc";
			$nilsort1c9 = "desc";
			}
		}
		
		
	else
		{
		$q9 = "ORDER BY postdate DESC";
		
		//jika null ato ASC
		if ($sortx == "ASC") 
			{
			$nilsort1a9 = "asc";
			$nilsort1b9 = "asc";
			$nilsort1c9 = "desc";
			}
		else 
			{
			$nilsort1a9 = "asc";
			$nilsort1b9 = "asc";
			$nilsort1c9 = "desc";
			}
		}
		
		
		
	//jika cari
	if (!empty($kunci))
		{
		//daftar 
		$qyuk = "SELECT * FROM $tabel2 ".
						"WHERE orang_kode LIKE '%$kunci%' ".
						"OR orang_nama LIKE '%$kunci%' ".
						"OR postdate LIKE '%$kunci%'";
		}
	else
		{
		//daftar 
		$qyuk = "SELECT * FROM $tabel2";
		}

		
		

	//query
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlku = "$qyuk $q9";
	
	$sqlcount = $sqlku;
	$sqlresult = $sqlcount;
	
	$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenyax?aksi=form&cariku9=$kunci";
	$pagelist = $p->pageList($limitku, $page, $pages, $target);
	$data = mysqli_fetch_array($result);
	
			
	
		
	
	echo '<form name="formx9" id="formx9">
	<div class="table-responsive9">          
		  <table class="table" border="1">
		    <tbody>';
			
			echo '<tr bgcolor="'.$warnaheader.'">
	    	<th id="ia9" width="150">
	    		<span><font color="white">KODE</font></span> <i class="fa fa-sort-amount-'.$nilsort1a9.'"></i>
              </th>
	        <th id="ib9">
	        	<span><font color="white">NAMA</font></span> <i class="fa fa-sort-amount-'.$nilsort1b9.'"></i>
	        	</th>
	        <th id="ic9" width="150">
	        	<span><font color="white">POSTDATE</font></span> <i class="fa fa-sort-amount-'.$nilsort1c9.'"></i>
	        	</th>
	        </tr>';
		
			
			
	
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


			echo '<tr bgcolor="'.$warnaheader.'">
	    	<th id="ia9">
	    		<span><font color="white">KODE</font></span>
              </th>
	        <th id="ib9">
	        	<span><font color="white">NAMA</font></span>
	        	</th>
	        <th id="ic9">
	        	<span><font color="white">POSTDATE</font></span>
	        	</th>
	        </tr>';
		

		
		echo '</tbody>
		  </table>
		  </div>



		<div class="row">
			
			<div class="col-md-8">

			    [<strong><font color="#FF0000">'.$count.'</font></strong> Data]. ';
				
				
				//urutan data
				if (empty($page))
					{
					$urut1 = "1";
					$urut2 = $limit;
					}
					
				else if ($page == "1")
					{
					$urut1 = "1";
					$urut2 = $limit;
					}
					
				else
					{
					$urut1 = (($page - 1) * $limit) + 1;
					$urut2 = ($urut1 + $limit) - 1;
					}

				
				echo '[#'.$urut1.' sampai #'.$urut2.']. 
			</div>
			
			
			
			<div class="col-md-4" align="right">

				<select name="pageke9" id="pageke9" class="btn btn-warning">
				<option value="'.$page.'" selected>'.$page.'</option>';
		
				
				//loop jumlah page
				for ($k=1;$k<=$pages;$k++)
					{
					echo '<option value="'.$k.'">Ke-'.$k.'</option>';
					}
				
				
				echo '</select>';
		
		
				
				echo ' '.$pagelist.'		
			</div>
		</div>';
	
	echo '</form>';
	

	exit();
	}

	












//jika jml data
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'jmldatanya'))
	{
	//totalnya
	$qyuk = mysqli_query($koneksi, "SELECT kd FROM $tabel2");
	$tyuk = mysqli_num_rows($qyuk);

	echo "<p>
	Total : <font color='red'><b>$tyuk</b></font> Data
	</p>";

	exit();
	}

	







	
	

exit();
?>