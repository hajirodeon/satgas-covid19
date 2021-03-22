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
   	if ((!isset($_GET['page5'])) || ($_GET['page5'] == "1"))
   		{
   		$start = 0;
   		$_GET['page5'] = 1;
   		}
     else
      	{
       	$start = ($_GET['page5']-1) * $limit;
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
		$xpage = "?limitku5=$limitku&page5";
		}
	else
		{
		$xpage = "&limitku5=$limitku&page5";
		}
			
	?>
	
	
	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){


		$("#idku15").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=1",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable5").html(data);
						}
					});
			});





		$("#idku25").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo ($curpage-1);?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable5").html(data);
						}
					});
			});






		$("#idku35").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo ($curpage+1);?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable5").html(data);
						}
					});
			});








		$("#idku45").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo $pages;?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable5").html(data);
						}
					});
			});






		$("#idku55").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo ($curpage-1);?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable5").html(data);
						}
					});
			});





		$("#idku65").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo ($curpage+1);?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable5").html(data);
						}
					});
			});






		} );
	  </script>

			
	<?php			
    //awal-sebelumnya
   	if (($curpage != 1) && ($curpage))
		{
   		$page_list .= "&nbsp; <a id=\"idku15\" class=\"btn btn-warning\" title=\"<<\"><i class=\"fa fa-fast-backward\"></i></a> ";
   		}
	else
		{
		$page_list .= "&nbsp; <a id=\"idku15x\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-fast-backward\"></i></font></a> ";
		}

   	if (($curpage-1) > 0)
   		{
   		$page_list .= "&nbsp; <a id=\"idku25\" class=\"btn btn-warning\" title=\"<\"><i class=\"fa fa-backward\"></i></a> &nbsp; ";
   		}
	else
		{
		$page_list .= "&nbsp; <a id=\"idku25x\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-backward\"></i></font></a> &nbsp; ";
		}


   	//selanjutnya-akhir
   	if (($curpage+1) <= $pages)
   		{
		$page_list .= " <a id=\"idku35\" class=\"btn btn-warning\" title=\">\"><i class=\"fa fa-forward\"></i></a> ";
   		}
	else
		{
		$page_list .= " <a id=\"idku35x\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-forward\"></i></font></a> ";
		}

   	if (($curpage != $pages) && ($pages != 0))
   		{
   		$page_list .= "&nbsp; <a id=\"idku45\" class=\"btn btn-warning\" title=\">>\"><i class=\"fa fa-fast-forward\"></i></a> &nbsp;";
   		}
	else
		{
		$page_list .= "&nbsp; <a id=\"idku45x\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-fast-forward\"></i></font></a> &nbsp;";
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
   		$next_prev .= "<a id=\"idku55\" class=\"btn btn-warning\"><i class=\"fa fa-fast-backward\"></i></a>";
   		}
     else
   		{
   		$next_prev .= "<a id=\"idku55\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-fast-backward\"></i></font></a>";
   		}

   	$next_prev .= " &nbsp; ";

   	if (($curpage+1) > $pages)
   		{
   		$next_prev .= "<a id=\"idku65\" class=\"btn btn-warning\"><i class=\"fa fa-fast-forward\"></i></a>";
  		}
   	else
   		{
   		$next_prev .= "<a id=\"idku65\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-fast-forward\"></i></font></a>";
   		}

   	return $next_prev;
   	}
}












$filenyax = "i_tabel5.php";
$tabel2 = "orang_login";



//jika detail data
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'form'))
	{
	//ambil nilai
	$kunci = cegah($_GET['cariku5']);
	$sort = cegah($_GET['sort5']);
	$pageke = cegah($_GET['pageke5']);
	$sortx = cegah($_SESSION['sortx5']);
	$page = nosql($_GET['page5']);
	$limitku = cegah($_GET['limitku5']);
	$limitku2 = cegah($_SESSION['limitku5']);
	
	
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
		$_SESSION['sortx5'] = "ASC";
		}
		
	else if ($sortx == "ASC")
		{
		$_SESSION['sortx5'] = "DESC";
		}
		
	else if ($sortx == "DESC")
		{
		$_SESSION['sortx5'] = "ASC";
		}
	
	?>
	




	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
	
		$("#pageke5").on('change', function(){
		    	var pageke = $("#pageke5").val();
		    	
		    	
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=form&limitku2=<?php echo $limitku;?>&cariku5=<?php echo $kunci;?>&page5="+pageke,
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable5").html(data);
						}
					});				
			});
	





		$("#ia5").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=form&limitku5=<?php echo $limitku;?>&sort5=ia5&cariku5=<?php echo $kunci;?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable5").html(data);
						}
					});
			});


		$("#ib5").on('click', function(){
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=form&limitku5=<?php echo $limitku;?>&sort5=ib5&cariku5=<?php echo $kunci;?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable5").html(data);
						}
					});
			});


		$("#ic5").on('click', function(){
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=form&limitku5=<?php echo $limitku;?>&sort5=ic5&cariku5=<?php echo $kunci;?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable5").html(data);
						}
					});
			});
		

	    $('#table-responsive5').dataTable( {
	        "scrollX": true
	    } );
	} );
	  </script>
	  
	<?php
	$sortx = cegah($_SESSION['sortx5']);
	
	//jika ada sort
	if ($sort == "ia5")
		{
		$q5 = "ORDER BY orang_kode $sortx";
		
		//jika null ato ASC
		if ($sortx == "ASC") 
			{
			$nilsort1a5 = "asc";
			$nilsort1b5 = "desc";
			$nilsort1c5 = "desc";
			}
		else 
			{
			$nilsort1a5 = "desc";
			$nilsort1b5 = "asc";
			$nilsort1c5 = "asc";
			}
		
		}
		
	//jika ada sort
	else if ($sort == "ib5")
		{
		$q5 = "ORDER BY orang_nama $sortx";
		
		//jika null ato ASC
		if ($sortx == "ASC") 
			{
			$nilsort1a5 = "desc";
			$nilsort1b5 = "asc";
			$nilsort1c5 = "desc";
			}
		else 
			{
			$nilsort1a5 = "asc";
			$nilsort1b5 = "desc";
			$nilsort1c5 = "asc";
			}
		}
		

	//jika ada sort
	else if ($sort == "ic5")
		{
		$q5 = "ORDER BY postdate $sortx";
		
		//jika null ato ASC
		if ($sortx == "ASC") 
			{
			$nilsort1a5 = "desc";
			$nilsort1b5 = "desc";
			$nilsort1c5 = "asc";
			}
		else 
			{
			$nilsort1a5 = "asc";
			$nilsort1b5 = "asc";
			$nilsort1c5 = "desc";
			}
		}
		
		
	else
		{
		$q5 = "ORDER BY postdate DESC";
		
		//jika null ato ASC
		if ($sortx == "ASC") 
			{
			$nilsort1a5 = "asc";
			$nilsort1b5 = "asc";
			$nilsort1c5 = "desc";
			}
		else 
			{
			$nilsort1a5 = "asc";
			$nilsort1b5 = "asc";
			$nilsort1c5 = "desc";
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

	$sqlku = "$qyuk $q5";
	
	$sqlcount = $sqlku;
	$sqlresult = $sqlcount;
	
	$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenyax?aksi=form&cariku5=$kunci";
	$pagelist = $p->pageList($limitku, $page, $pages, $target);
	$data = mysqli_fetch_array($result);
	
			
	
		
	
	echo '<form name="formx5" id="formx5">
	<div class="table-responsive5">          
		  <table class="table" border="1">
		    <tbody>';
			
			echo '<tr bgcolor="'.$warnaheader.'">
	    	<th id="ia5" width="150">
	    		<span><font color="white">KODE</font></span> <i class="fa fa-sort-amount-'.$nilsort1a5.'"></i>
              </th>
	        <th id="ib5">
	        	<span><font color="white">NAMA</font></span> <i class="fa fa-sort-amount-'.$nilsort1b5.'"></i>
	        	</th>
	        <th id="ic5" width="150">
	        	<span><font color="white">POSTDATE</font></span> <i class="fa fa-sort-amount-'.$nilsort1c5.'"></i>
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
	    	<th id="ia5">
	    		<span><font color="white">KODE</font></span>
              </th>
	        <th id="ib5">
	        	<span><font color="white">NAMA</font></span>
	        	</th>
	        <th id="ic5">
	        	<span><font color="white">POSTDATE</font></span>
	        	</th>
	        </tr>';
		

		
		echo '</tbody>
		  </table>
		  </div>



		<div class="row">
			
			<div class="col-md-12">

			    <strong><font color="#FF0000">'.$count.'</font></strong> Data.

				<select name="pageke5" id="pageke5" class="btn btn-warning">
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