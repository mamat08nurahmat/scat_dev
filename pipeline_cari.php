<?php 
include('include/config.php');
$q		= $_POST['q'];
$query	= mssql_query("select * from data_booking where no_aplikasi  =".$q."");
$row	= mssql_num_rows($query);

if ($row > 0)
{
 while ($data= mssql_fetch_array($query))
 {
	echo "<strong>No Aplikasi Booking : <input type='text' value=".$data['no_aplikasi']." readonly><input type='hidden' name='ket' value='2' readonly></strong><br>
		<table align='center'>
			<tr><th><input type='submit' class='btn btn-primary' name='pilih' value='LANJUT'></th>
				<th><a href='index.php?page=16a' class='btn btn-danger' >BACK</a></th>
			</tr>
		</table> ";
 }
}
else 
{
 echo "<strong>Data Tidak Booking</strong><textarea placeholder='ALASAN' name='keterangan' type='text' ></textarea><br>
		<input type='hidden' name='ket' value='3' readonly>
		<table align='center'>
			<tr><th><input type='submit' class='btn btn-primary' name='pilih' value='LANJUT'></th>
				<th><a href='index.php?page=16a' class='btn btn-danger' >BACK</a></th>
			</tr>
		</table> "; 
}
?>