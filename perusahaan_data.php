<?php
SESSION_START();
error_reporting(0);
/* koneksi ke database */
include "include/config.php";

	$page	= $_POST['page'];  
	$rp		= $_POST['rp'];  
    $start 	= (($page-1) * $rp)+1; 
    $stop 	= $page * $rp;

$q=mssql_query("select * from
		(select n.*, ROWNUM jumlahrow FROM (select  
	   a.nama_perusahaan NAMAPERUSAHAAN,
       a.alamat ALAMAT,
	   a.id_area KOTA,
	   a.kodepos KODEPOS,
	   a.no_telp NO_TELP,
		row_number() OVER(order by a.nama_perusahaan asc) as ROWNUM from perusahaan a 
		LEFT JOIN area b on a.id_area=b.id_area) n
		where ROWNUM <= $stop )x
		where x.jumlahrow >= $start ");
		
$w=mssql_query("select   a.nama_perusahaan NAMAPERUSAHAAN,
       a.alamat ALAMAT,
	   a.id_area KOTA,
	   a.kodepos KODEPOS,
	   a.no_telp NO_TELP
       from perusahaan a 
	   LEFT JOIN area b on a.id_area=b.id_area ");
$key=0;
while ($tampil = mssql_fetch_array($q))
{
    $rows    = array('NAMAPERUSAHAAN' 	=> $tampil['nama_perusahaan'],
					 'ALAMAT'  			=>$tampil['ALAMAT'], 
    				 'KOTA' 			=>$tampil['KOTA'],
					 'KODEPOS' 			=>$tampil['KODEPOS'], 
					 'NO_TELP' 			=>$tampil['NO_TELP'], 
    								);
    $record  = array('id'  => $key, 'cell' => $rows);    // array data yang sudah siap ditampilkan
    $hasil[] = $record;
    $key=$key+1;
}
$keys=0;
while ($tampil2 = mssql_fetch_array($w))
{
    $rowss    = array('NAMAPERUSAHAAN' 	=> $tampil['nama_perusahaan'],
					 'ALAMAT'  			=>$tampil['ALAMAT'], 
    				 'KOTA' 			=>$tampil['KOTA'],
					 'KODEPOS' 			=>$tampil['KODEPOS'], 
					 'NO_TELP' 			=>$tampil['NO_TELP'], 							
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
