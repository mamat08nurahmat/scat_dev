<?php
//Fungsi autonumber
function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
	$query="select max (npp) as npp from sales";
	$hasil=mssql_query($query);
	$jumlahrecord = mssql_num_rows($hasil);
	if($jumlahrecord == 0)
		$nomor=1;
	else
	{
		$row=mssql_fetch_array($hasil);
		$nomor=intval(substr($row[0],strlen($awalan)))+1;
	}
	if($lebar>0)
		$angka = $awalan.str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
	else
		$angka = $awalan.$nomor;
	return $angka;
}
?>