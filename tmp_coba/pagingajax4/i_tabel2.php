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
   	if ((!isset($_GET['page2'])) || ($_GET['page2'] == "1"))
   		{
   		$start = 0;
   		$_GET['page2'] = 1;
   		}
     else
      	{
       	$start = ($_GET['page2']-1) * $limit;
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
		$xpage = "?limitku2=$limitku&page2";
		}
	else
		{
		$xpage = "&limitku2=$limitku&page2";
		}
			
	?>
	
	
	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){


		$("#idku12").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=1",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable2").html(data);
						}
					});
			});





		$("#idku22").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo ($curpage-1);?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable2").html(data);
						}
					});
			});






		$("#idku32").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo ($curpage+1);?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable2").html(data);
						}
					});
			});








		$("#idku42").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo $pages;?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable2").html(data);
						}
					});
			});






		$("#idku52").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo ($curpage-1);?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable2").html(data);
						}
					});
			});





		$("#idku62").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo ($curpage+1);?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable2").html(data);
						}
					});
			});






		} );
	  </script>

			
	<?php			
    //awal-sebelumnya
   	if (($curpage != 1) && ($curpage))
		{
   		$page_list .= "&nbsp; <a id=\"idku12\" class=\"btn btn-warning\" title=\"<<\"><i class=\"fa fa-fast-backward\"></i></a> ";
   		}
	else
		{
		$page_list .= "&nbsp; <a id=\"idku12x\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-fast-backward\"></i></font></a> ";
		}

   	if (($curpage-1) > 0)
   		{
   		$page_list .= "&nbsp; <a id=\"idku22\" class=\"btn btn-warning\" title=\"<\"><i class=\"fa fa-backward\"></i></a> &nbsp; ";
   		}
	else
		{
		$page_list .= "&nbsp; <a id=\"idku22x\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-backward\"></i></font></a> &nbsp; ";
		}


   	//selanjutnya-akhir
   	if (($curpage+1) <= $pages)
   		{
		$page_list .= " <a id=\"idku32\" class=\"btn btn-warning\" title=\">\"><i class=\"fa fa-forward\"></i></a> ";
   		}
	else
		{
		$page_list .= " <a id=\"idku32x\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-forward\"></i></font></a> ";
		}

   	if (($curpage != $pages) && ($pages != 0))
   		{
   		$page_list .= "&nbsp; <a id=\"idku42\" class=\"btn btn-warning\" title=\">>\"><i class=\"fa fa-fast-forward\"></i></a> &nbsp;";
   		}
	else
		{
		$page_list .= "&nbsp; <a id=\"idku42x\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-fast-forward\"></i></font></a> &nbsp;";
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
   		$next_prev .= "<a id=\"idku52\" class=\"btn btn-warning\"><i class=\"fa fa-fast-backward\"></i></a>";
   		}
     else
   		{
   		$next_prev .= "<a id=\"idku52\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-fast-backward\"></i></font></a>";
   		}

   	$next_prev .= " &nbsp; ";

   	if (($curpage+1) > $pages)
   		{
   		$next_prev .= "<a id=\"idku62\" class=\"btn btn-warning\"><i class=\"fa fa-fast-forward\"></i></a>";
  		}
   	else
   		{
   		$next_prev .= "<a id=\"idku62\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-fast-forward\"></i></font></a>";
   		}

   	return $next_prev;
   	}
}














$filenyax = "i_tabel2.php";
$tabel2 = "orang_login";



//jika detail data
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'form'))
	{
	//ambil nilai
	$kunci = cegah($_GET['cariku2']);
	$sort = cegah($_GET['sort2']);
	$pageke = cegah($_GET['pageke2']);
	$sortx = cegah($_SESSION['sortx2']);
	$page = nosql($_GET['page2']);
	$limitku = cegah($_GET['limitku2']);
	$limitku2 = cegah($_SESSION['limitku2']);
	
	
	//jika null, kasi default 10
	if (empty($limitku))
		{
		$limit = 10;
		}
	else
		{
		$limit = $limitku;				
		}
		
		
		
		
	
	//jika null ato ASC
	if (empty($sortx)) 
		{
		$_SESSION['sortx2'] = "ASC";
		}
		
	else if ($sortx == "ASC")
		{
		$_SESSION['sortx2'] = "DESC";
		}
		
	else if ($sortx == "DESC")
		{
		$_SESSION['sortx2'] = "ASC";
		}
	
	?>
	




	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
	
		$("#pageke2").on('change', function(){
		    	var pageke = $("#pageke2").val();
		    	
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=form&limitku2=<?php echo $limitku;?>&cariku2=<?php echo $kunci;?>&page2="+pageke,
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable2").html(data);
						}
					});				
			});
	





		$("#ia2").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=form&limitku2=<?php echo $limitku;?>&sort2=ia2&cariku2=<?php echo $kunci;?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable2").html(data);
						}
					});
			});


		$("#ib2").on('click', function(){
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=form&limitku2=<?php echo $limitku;?>&sort2=ib2&cariku2=<?php echo $kunci;?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable2").html(data);
						}
					});
			});


		$("#ic2").on('click', function(){
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=form&limitku2=<?php echo $limitku;?>&sort2=ic2&cariku2=<?php echo $kunci;?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable2").html(data);
						}
					});
			});
		

	    $('#table-responsive2').dataTable( {
	        "scrollX": true
	    } );
	} );
	  </script>
	  
	<?php
	$sortx = cegah($_SESSION['sortx2']);
	
	//jika ada sort
	if ($sort == "ia2")
		{
		$q4 = "ORDER BY orang_kode $sortx";
		
		//jika null ato ASC
		if ($sortx == "ASC") 
			{
			$nilsort1a2 = "asc";
			$nilsort1b2 = "desc";
			$nilsort1c2 = "desc";
			}
		else 
			{
			$nilsort1a2 = "desc";
			$nilsort1b2 = "asc";
			$nilsort1c2 = "asc";
			}
		
		}
		
	//jika ada sort
	else if ($sort == "ib2")
		{
		$q4 = "ORDER BY orang_nama $sortx";
		
		//jika null ato ASC
		if ($sortx == "ASC") 
			{
			$nilsort1a2 = "desc";
			$nilsort1b2 = "asc";
			$nilsort1c2 = "desc";
			}
		else 
			{
			$nilsort1a2 = "asc";
			$nilsort1b2 = "desc";
			$nilsort1c2 = "asc";
			}
		}
		

	//jika ada sort
	else if ($sort == "ic2")
		{
		$q4 = "ORDER BY postdate $sortx";
		
		//jika null ato ASC
		if ($sortx == "ASC") 
			{
			$nilsort1a2 = "desc";
			$nilsort1b2 = "desc";
			$nilsort1c2 = "asc";
			}
		else 
			{
			$nilsort1a2 = "asc";
			$nilsort1b2 = "asc";
			$nilsort1c2 = "desc";
			}
		}
		
		
	else
		{
		$q4 = "ORDER BY postdate DESC";
		
		//jika null ato ASC
		if ($sortx == "ASC") 
			{
			$nilsort1a2 = "asc";
			$nilsort1b2 = "asc";
			$nilsort1c2 = "desc";
			}
		else 
			{
			$nilsort1a2 = "asc";
			$nilsort1b2 = "asc";
			$nilsort1c2 = "desc";
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

	$sqlku = "$qyuk $q4";
	
	$sqlcount = $sqlku;
	$sqlresult = $sqlcount;
	
	$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenyax?aksi=form&cariku2=$kunci";
	$pagelist = $p->pageList($limitku, $page, $pages, $target);
	$data = mysqli_fetch_array($result);
	
			
	
		
	
	echo '<form name="formx5" id="formx5">
	<div class="table-responsive2">          
		  <table class="table" border="1">
		    <tbody>';
			
			echo '<tr bgcolor="'.$warnaheader.'">
	    	<th id="ia2" width="150">
	    		<span><font color="white">KODE</font></span> <i class="fa fa-sort-amount-'.$nilsort1a2.'"></i>
              </th>
	        <th id="ib2">
	        	<span><font color="white">NAMA</font></span> <i class="fa fa-sort-amount-'.$nilsort1b2.'"></i>
	        	</th>
	        <th id="ic2" width="150">
	        	<span><font color="white">POSTDATE</font></span> <i class="fa fa-sort-amount-'.$nilsort1c2.'"></i>
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
	    	<th id="ia2">
	    		<span><font color="white">KODE</font></span>
              </th>
	        <th id="ib2">
	        	<span><font color="white">NAMA</font></span>
	        	</th>
	        <th id="ic2">
	        	<span><font color="white">POSTDATE</font></span>
	        	</th>
	        </tr>';
		

		
		echo '</tbody>
		  </table>
		  </div>



		<div class="row">
			
			<div class="col-md-12">

			    <strong><font color="#FF0000">'.$count.'</font></strong> Data.

				<select name="pageke2" id="pageke2" class="btn btn-warning">
				<option value="'.$page.'" selected>'.$page.'</option>';
		
				
				//loop jumlah page
				for ($k=1;$k<=$pages;$k++)
					{
					echo '<option value="'.$k.'">Halaman '.$k.'</option>';
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