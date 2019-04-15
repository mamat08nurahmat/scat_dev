<?php 
include('include/config.php');
$q=$_POST['q'];

// query untuk melakukan pencarian
//$query=mssql_query("select * from X3 where ID_NUMBER like '%".$q."%'");
$query=mssql_query("select * from X3_SCAT where ID_NUMBER  =".$q."");
// mendapatkan jumlah baris
$row=mssql_num_rows($query);

if ($row > 0) // jika baris lebih dari 0 / data ditemukan
{

 while ($data=mssql_fetch_array($query)) // perulangna untuk menampilkan data
 {
 echo "<strong>No rekening : ".$data['ID_NUMBER']."</strong><br>
 
 <input type='submit' class='btn btn-primary' name='pilih' value='LANJUT'>
 
 ";
 }
  
   
/*
*/	
}
else // jika data tidak ditemukan
{
 echo "<strong>Data tidak ditemukan</strong>"; 
}
?>