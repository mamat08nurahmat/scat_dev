<?php
SESSION_START();
error_reporting(0);
/* koneksi ke database */

include "include/config.php";

/*end*/ 

 if ($_SESSION['user_level'] == 10)
	{
		$where_vendor = "and a.id_vendor =". $_SESSION['id_vendor'];
	}
	else{
		$where_vendor = " ";
	}

if($_POST['query'] != ''){ 

    if($_POST['qtype'] == 'NPP'){ // bila pencarian berdasarkan Nama
    	

        $where = "and a.npp LIKE '%".htmlentities($_POST['query'])."%'" ;
				//echo "$where";
				if ($_SESSION['user_level'] == 10)
	{
		$where_vendor = "and a.id_vendor =". $_SESSION['id_vendor'];
	}
				elseif($_SESSION['user_level'] == 6 || $_SESSION['user_level'] == 7 )
	{
		$where_penyelia = "and a.id_user_atasan =".$_SESSION['username'];
	}
				elseif($_SESSION['user_level'] == 5)
	{
		$where_cabang = "and a.id_cabang =".$_SESSION['id_cabang'];
	}

	
	
	else{
		$where_vendor = " ";
		$where_penyelia = " ";
		$where_cabang = " ";
	}
		}
		else if($_POST['qtype'] == 'NAMASALES'){ // bila pencarian berdasarkan Nama
    	
        $where = "and a.nama LIKE '%".htmlentities($_POST['query'])."%'" ;
				//echo "$where";
				if ($_SESSION['user_level'] == 10)
	{
		$where_vendor = "and a.id_vendor =". $_SESSION['id_vendor'];
	}
				elseif($_SESSION['user_level'] == 6 || $_SESSION['user_level'] == 7 )
	{
		$where_penyelia = "and a.id_user_atasan =".$_SESSION['username'];
	}
				elseif($_SESSION['user_level'] == 5)
	{
		$where_cabang = "and a.id_cabang =".$_SESSION['id_cabang'];
	}
	
	
	else{
		$where_vendor = " ";
		$where_penyelia = " ";
		$where_cabang = " ";
		
	}
		}
		else if($_POST['qtype'] == 'SALES_TYPE'){ // bila pencarian berdasarkan Nama
    	

        $where = "and b.nama_grup LIKE '%".htmlentities($_POST['query'])."%'" ;
				//echo "$where";
				if ($_SESSION['user_level'] == 10)
	{
		$where_vendor = "and a.id_vendor =". $_SESSION['id_vendor'];
	}
				elseif($_SESSION['user_level'] == 6 || $_SESSION['user_level'] == 7 )
	{
		$where_penyelia = "and a.id_user_atasan =".$_SESSION['username'];
	}
				elseif($_SESSION['user_level'] == 5)
	{
		$where_cabang = "and a.id_cabang =".$_SESSION['id_cabang'];
	}

	
	else{
		$where_vendor = " ";
		$where_penyelia = " ";
		$where_cabang = " ";
	}
		}
		
		else if($_POST['qtype'] == 'SPV'){ // bila pencarian berdasarkan Nama
    	

        $where = "and a.id_user_atasan LIKE '%".htmlentities($_POST['query'])."%'" ;
				//echo "$where";
				if ($_SESSION['user_level'] == 10)
	{
		$where_vendor = "and a.id_vendor =". $_SESSION['id_vendor'];
	}
				elseif($_SESSION['user_level'] == 6 || $_SESSION['user_level'] == 7 )
	{
		$where_penyelia = "and a.id_user_atasan =".$_SESSION['username'];
	}
				elseif($_SESSION['user_level'] == 5)
	{
		$where_cabang = "and a.id_cabang =".$_SESSION['id_cabang'];
	}

	
	
	else{
		$where_vendor = " ";
		$where_penyelia = " ";
		$where_cabang = " ";
		
	}
		}
			else if($_POST['qtype'] == 'BRANCH'){ // bila pencarian berdasarkan Nama
    	

        $where = "and c.nama_cabang LIKE '%".htmlentities($_POST['query'])."%'" ;
				//echo "$where";
				if ($_SESSION['user_level'] == 10)
	{
		$where_vendor = "and a.id_vendor =". $_SESSION['id_vendor'];
	}
				elseif($_SESSION['user_level'] == 6 || $_SESSION['user_level'] == 7 )
	{
		$where_penyelia = "and a.id_user_atasan =".$_SESSION['username'];
	}
				elseif($_SESSION['user_level'] == 5)
	{
		$where_cabang = "and a.id_cabang =".$_SESSION['id_cabang'];
	}
	
	
	else{
		$where_vendor = " ";
		$where_penyelia = " ";
		$where_cabang = " ";
	}
		}
		else if($_POST['qtype'] == 'REGION'){ // bila pencarian berdasarkan Nama
    	

        $where = "and d.nama_area LIKE '%".htmlentities($_POST['query'])."%'" ;
				//echo "$where";
				if ($_SESSION['user_level'] == 10)
	{
		$where_vendor = "and a.id_vendor =". $_SESSION['id_vendor'];
	}
				elseif($_SESSION['user_level'] == 6 || $_SESSION['user_level'] == 7 )
	{
		$where_penyelia = "and a.id_user_atasan =".$_SESSION['username'];
	}
	
				elseif($_SESSION['user_level'] == 5)
	{
		$where_cabang = "and a.id_cabang =".$_SESSION['id_cabang'];
	}
	
	else{
		$where_vendor = " ";
		$where_penyelia = " ";
		$where_cabang = " ";
		
	}
		}
}else{  // bila tidak ada pencarian data

    $where = "";
	if ($_SESSION['user_level'] == 10)
	{
		$where_vendor = "and a.id_vendor =". $_SESSION['id_vendor'];
	}
				elseif($_SESSION['user_level'] == 6 || $_SESSION['user_level'] == 7 )
	{
		$where_penyelia = "and a.id_user_atasan =".$_SESSION['username'];
	}
				elseif($_SESSION['user_level'] == 5)
	{
		$where_cabang = "and a.id_cabang =".$_SESSION['id_cabang'];
	}

	
	else{
		$where_vendor = " ";
		$where_penyelia = " ";
		$where_cabang = " ";
	}

}

 $page = $_POST['page'];  
$rp = $_POST['rp'];  

 //if (!$page) $page = 1;  
    //if (!$rp) $rp = 10;  
      
    $start = (($page-1) * $rp)+1; 
    $stop = $page * $rp;
	
$q=mssql_query("select * from
		(
			select n.*, ROWNUM jumlahrow FROM 
 				(select  
	   a.npp NPP,
       a.nama NAMASALES,
       b.nama_grup SALES_TYPE,
       a.id_user_atasan SPV,
       c.nama_cabang BRANCH,
       d.nama_area REGION,
	   e.nama_vendor VENDOR,
	   a.grade GRADE,
	   a.tanggal_aktif AKTIF,
	   a.keterangan KETERANGAN,
	   row_number() OVER(order by npp asc) as ROWNUM
from sales a left join app_user_grup b on a.id_grup=b.id_grup
			 left join (select kode_cabang,id_area,nama_cabang from cabang where atasan_cabang=0) c on a.id_cabang = c.kode_cabang 
left join area d on c.id_area=d.id_area
left join vendor e on a.id_vendor = e.id_vendor
where a.id_grup in(8,9,11,12) and a.status_sales=1 $where_vendor $where_penyelia $where_cabang $where
       										 ) n
										
   where ROWNUM <= $stop
   )x
   where x.jumlahrow >= $start
										 ");
$w=mssql_query("select  a.npp NPP,
       a.nama NAMASALES,
       b.nama_grup SALES_TYPE,
       a.id_user_atasan SPV,
       c.nama_cabang BRANCH,
       d.nama_area REGION,
	   a.grade GRADE,
	   e.nama_vendor VENDOR,
	   a.tanggal_aktif AKTIF,
	   a.keterangan KETERANGAN
from sales a left join app_user_grup b on a.id_grup=b.id_grup
left join (select kode_cabang,id_area,nama_cabang from cabang where atasan_cabang=0) c on a.id_cabang=c.kode_cabang 
left join area d on c.id_area=d.id_area
left join vendor e on a.id_vendor = e.id_vendor
where a.id_grup in(8,9,11,12) and a.status_sales=1 $where_vendor $where_penyelia $where_cabang $where
order by a.npp
							");
	
							


//foreach($result as $key => $row){ // ulang sebanyak data query
$key=0;
while ($tampil = mssql_fetch_array($q))
{

    $rows    = array('NPP'  => $tampil['NPP'],
    								'NAMASALES'  	=>$tampil['NAMASALES'], 
    								'SALES_TYPE' 	=>$tampil['SALES_TYPE'], 
    								'SPV' 			=>$tampil['SPV'], 
    								'BRANCH'  		=>$tampil['BRANCH'], 
    								'REGION'  		=>$tampil['REGION'], 
    								'GRADE'  		=>$tampil['GRADE'], 
    								'VENDOR'  		=>$tampil['VENDOR'], 
    								'AKTIF'  		=>$tampil['AKTIF'], 
    								'KETERANGAN' 	=>$tampil['KETERANGAN'], 
    								//'PROFIT' =>number_format(oci_result($q,'PROFIT')),
    								//'PROFIT'  =>number_format(oci_result($q,'PROFIT')), 
    								//'STATUS'  =>oci_result($q,'STATUS')
    								); // data yang akan kita tampilkan pada Grid

    $record  = array('id'  => $key, 'cell' => $rows);    // array data yang sudah siap ditampilkan

    $hasil[] = $record;
    $key=$key+1;

}

$keys=0;
while ($tampil2 = mssql_fetch_array($w))
{

    $rowss    = array('NPP'  => $tampil2['NPP'],
    								'NAMASALES'  	=>$tampil2['NAMASALES'], 
    								'SALES_TYPE' 	=>$tampil2['SALES_TYPE'], 
    								'SPV' 			=>$tampil2['SPV'], 
    								'BRANCH'  		=>$tampil2['BRANCH'], 
    								'REGION'  		=>$tampil2['REGION'],
    								'GRADE'  		=>$tampil2['GRADE'],
    								'VENDOR'  		=>$tampil2['VENDOR'],
    								'AKTIF'  		=>$tampil2['AKTIF'],
    								'KETERANGAN' 	=>$tampil['KETERANGAN'], 
									//'PROFIT' =>number_format(oci_result($q,'PROFIT')),
    								//'PROFIT'  =>number_format(oci_result($q,'PROFIT')), 
    								//'STATUS'  =>oci_result($q,'STATUS')
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
