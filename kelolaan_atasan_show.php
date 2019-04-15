<?php
SESSION_START();
error_reporting(0);
/* koneksi ke database */
include "include/config.php";
 if ($_SESSION['user_level'] == 10)
		{
		$where_vendor = "and a.id_vendor =". $_SESSION['id_vendor'];
		} else{
		$where_vendor = " ";
		}
if($_POST['query'] != ''){ 
    if($_POST['qtype'] == 'NPP'){ // bila pencarian berdasarkan Nama
        $where = "and a.npp LIKE '%".htmlentities($_POST['query'])."%'" ;
				if ($_SESSION['user_level'] == 10)
				{
				$where_vendor = "and a.id_vendor =". $_SESSION['id_vendor'];
				} elseif($_SESSION['user_level'] == 6)
				{
				$where_penyelia = "and a.id_user_atasan =".$_SESSION['username'];
				} elseif($_SESSION['user_level'] == 5)
				{
				$where_cabang = "and a.id_cabang =".$_SESSION['id_cabang'];
				}
	
	} else if($_POST['qtype'] == 'NAMASALES'){ // bila pencarian berdasarkan Nama
    	$where = "and a.nama LIKE '%".htmlentities($_POST['query'])."%'" ;
				if ($_SESSION['user_level'] == 10)
				{
				$where_vendor = "and a.id_vendor =". $_SESSION['id_vendor'];
				}
				elseif($_SESSION['user_level'] == 6)
				{
				$where_penyelia = "and a.id_user_atasan =".$_SESSION['username'];
				}
				elseif($_SESSION['user_level'] == 5)
				{
				$where_cabang = "and a.id_cabang =".$_SESSION['id_cabang'];
				}
	}
		
	}else{  // bila tidak ada pencarian data
		$where = "";
			if ($_SESSION['user_level'] == 10)
			{
			$where_vendor = "and a.id_vendor =". $_SESSION['id_vendor'];
			} elseif($_SESSION['user_level'] == 6)
			{ 
			$where_penyelia = "and a.id_user_atasan =".$_SESSION['username'];
			} elseif($_SESSION['user_level'] == 5)
			{
			$where_cabang = "and a.id_cabang =".$_SESSION['id_cabang'];
			} else{
				$where_vendor = " ";
				$where_penyelia = " ";
				$where_cabang = " ";
				}
	}
	$page	= $_POST['page'];  
	$rp		= $_POST['rp'];  
    $start 	= (($page-1) * $rp)+1; 
    $stop 	= $page * $rp;

$q=mssql_query("select * from
		(select n.*, ROWNUM jumlahrow FROM (select  
	   a.npp NPP,
       a.nama NAMASALES,
	   ISNULL(b.total,0) TOTALL,
	   row_number() OVER(order by a.npp asc) as ROWNUM from sales a 
	  left join (SELECT npp,COUNT(*) AS total FROM cart where ket=2 group by npp) b on a.npp = b.npp
		where a.id_grup in(8,9,11,12) and a.status_sales=1 $where_vendor $where_penyelia $where_cabang $where) n
		where ROWNUM <= $stop )x
		where x.jumlahrow >= $start ");
		
$w=mssql_query("select  a.npp NPP,
       a.nama NAMASALES,
	   b.total TOTALL
       from sales a 
	   left join (SELECT npp,COUNT(*) AS total FROM cart where ket=2 group by npp) b on a.npp = b.npp
		where a.id_grup in(8,9,11,12) and a.status_sales=1 $where_vendor $where_penyelia $where_cabang $where
		order by a.npp ");
$key=0;
while ($tampil = mssql_fetch_array($q))
{
    $rows    = array('NPP'  => $tampil['NPP'],
					'NAMASALES'  	=>$tampil['NAMASALES'], 
    				'CART' 			=>$tampil['TOTALL'], 
    								);
    $record  = array('id'  => $key, 'cell' => $rows);    // array data yang sudah siap ditampilkan
    $hasil[] = $record;
    $key=$key+1;
}
$keys=0;
while ($tampil2 = mssql_fetch_array($w))
{
    $rowss    = array('NPP'  => $tampil2['NPP'],
    								'NAMASALES'  	=>$tampil2['NAMASALES'], 
    								'CART		' 	=>$tampil2['TOTALL'],								
    								); // data yang akan kita tampilkan pada Grid
    $records  = array('id'  => $keys, 'cell' => $rowss);    // array data yang sudah siap ditampilkan
    $hasils[] = $records;
    $keys=$keys+1;
}


$data = array(
     "page"     => $page
    ,"total"    => count($hasils) // total dari record data
    ,"rows"     => $hasil // data yang akan di tampilkan pada grid

);
echo json_encode($data);

?>
