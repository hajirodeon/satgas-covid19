<?php
session_start();

//fungsi - fungsi
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
//require("class_paging.php");


nocache;




class Pager
{	
var $target;
var $curpage;


//batas
function findStart($limit)
   	{
   	if ((!isset($_GET['page'])) || ($_GET['page'] == "1"))
   		{
   		$start = 0;
   		$_GET['page'] = 1;
   		}
     else
      	{
       	$start = ($_GET['page']-1) * $limit;
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
		$xpage = "?limitku=$limitku&page";
		}
	else
		{
		$xpage = "&limitku=$limitku&page";
		}
			
	?>
	
	
	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){


		$("#idku1").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=1",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable").html(data);
						}
					});
			});





		$("#idku2").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo ($curpage-1);?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable").html(data);
						}
					});
			});






		$("#idku3").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo ($curpage+1);?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable").html(data);
						}
					});
			});








		$("#idku4").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo $pages;?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable").html(data);
						}
					});
			});






		$("#idku5").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo ($curpage-1);?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable").html(data);
						}
					});
			});





		$("#idku6").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo ($curpage+1);?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable").html(data);
						}
					});
			});






		} );
	  </script>

			
	<?php			
    //awal-sebelumnya
   	if (($curpage != 1) && ($curpage))
		{
   		$page_list .= "&nbsp; <a id=\"idku1\" class=\"btn btn-warning\" title=\"<<\"><i class=\"fa fa-fast-backward\"></i></a> ";
   		}
	else
		{
		$page_list .= "&nbsp; <a id=\"idku1x\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-fast-backward\"></i></font></a> ";
		}

   	if (($curpage-1) > 0)
   		{
   		$page_list .= "&nbsp; <a id=\"idku2\" class=\"btn btn-warning\" title=\"<\"><i class=\"fa fa-backward\"></i></a> &nbsp; ";
   		}
	else
		{
		$page_list .= "&nbsp; <a id=\"idku2x\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-backward\"></i></font></a> &nbsp; ";
		}


   	//selanjutnya-akhir
   	if (($curpage+1) <= $pages)
   		{
		$page_list .= " <a id=\"idku3\" class=\"btn btn-warning\" title=\">\"><i class=\"fa fa-forward\"></i></a> ";
   		}
	else
		{
		$page_list .= " <a id=\"idku3x\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-forward\"></i></font></a> ";
		}

   	if (($curpage != $pages) && ($pages != 0))
   		{
   		$page_list .= "&nbsp; <a id=\"idku4\" class=\"btn btn-warning\" title=\">>\"><i class=\"fa fa-fast-forward\"></i></a> &nbsp;";
   		}
	else
		{
		$page_list .= "&nbsp; <a id=\"idku4x\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-fast-forward\"></i></font></a> &nbsp;";
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
   		$next_prev .= "<a id=\"idku5\" class=\"btn btn-warning\"><i class=\"fa fa-fast-backward\"></i></a>";
   		}
     else
   		{
   		$next_prev .= "<a id=\"idku5\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-fast-backward\"></i></font></a>";
   		}

   	$next_prev .= " &nbsp; ";

   	if (($curpage+1) > $pages)
   		{
   		$next_prev .= "<a id=\"idku6\" class=\"btn btn-warning\"><i class=\"fa fa-fast-forward\"></i></a>";
  		}
   	else
   		{
   		$next_prev .= "<a id=\"idku6\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-fast-forward\"></i></font></a>";
   		}

   	return $next_prev;
   	}
}






















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
					url: "<?php echo $filenyax;?>?aksi=form&limitku=<?php echo $limitku;?>&cariku=<?php echo $kunci;?>&page="+pageke,
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable").html(data);
						}
					});				
			});
	





		$("#ia").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=form&limitku=<?php echo $limitku;?>&sort=ia&cariku=<?php echo $kunci;?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable").html(data);
						}
					});
			});


		$("#ib").on('click', function(){
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=form&limitku=<?php echo $limitku;?>&sort=ib&cariku=<?php echo $kunci;?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable").html(data);
						}
					});
			});


		$("#ic").on('click', function(){
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=form&limitku=<?php echo $limitku;?>&sort=ic&cariku=<?php echo $kunci;?>",
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
	$target = "$filenyax?aksi=form&cariku=$kunci";
	$pagelist = $p->pageList($limitku, $page, $pages, $target);
	$data = mysqli_fetch_array($result);
	
			
	
		
	
	echo '<form name="formx5" id="formx5">
	<div class="table-responsive">          
		  <table class="table" border="1">
		    <tbody>';
			
			echo '<tr bgcolor="'.$warnaheader.'">
	    	<th id="ia" width="150">
	    		<a href="#">
	    		<span><font color="white">KODE</font></span> <i class="fa fa-sort-amount-'.$nilsort1a.'"></i>
	    		</a>
              </th>
	        <th id="ib">
	    		<a href="#">
	        	<span><font color="white">NAMA</font></span> <i class="fa fa-sort-amount-'.$nilsort1b.'"></i>
	        	</a>
	        	</th>
	        <th id="ic" width="150">
	    		<a href="#">
	        	<span><font color="white">POSTDATE</font></span> <i class="fa fa-sort-amount-'.$nilsort1c.'"></i>
	        	</a>
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
	    	<th id="ia">
	    		<span><font color="white">KODE</font></span>
              </th>
	        <th id="ib">
	        	<span><font color="white">NAMA</font></span>
	        	</th>
	        <th id="ic">
	        	<span><font color="white">POSTDATE</font></span>
	        	</th>
	        </tr>';
		

		
		echo '</tbody>
		  </table>
		  </div>



		<div class="row">
			
			<div class="col-md-12">

			    <strong><font color="#FF0000">'.$count.'</font></strong> Data.

				<select name="pageke" id="pageke" class="btn btn-warning">
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