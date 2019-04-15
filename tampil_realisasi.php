<?php

$id=$_GET["id"]; 
$month=$_GET["month"];
$year=$_GET["year"];
$grade=$_GET["grade"];
//Koneksi dan memilih database di server
//mysql_connect($server,$username,$password) or die ("Koneksi database gagal");
//mysql_select_db($database) or die ("Database tidak tersedia");
include('include/config.php');
$tampil2 = "SELECT a.npp, x.grade,b.product_name,a.target,a.realisasi,a.month,a.year
		   FROM sales_target a INNER JOIN product b ON a.productID = b.productID INNER JOIN sales x on a.npp=x.npp
		   
		   where a.npp='$id' and month='$month' and year='$year'";

//perintah menampilkan data dikerjakan
$sql2 = mssql_query($tampil2);
while($data2 = mssql_fetch_array($sql2))
 {
if($data2['grade']==3)
{
echo '
<br>
<h3><center>Data Realisasi</center></h3>
<table border ="1" style="border-collapse:collapse; width:100%;">
<tr style="background:#CCC;">
<th>Product</th>
<th  colspan="2">Pencapaian</th>
<th>Month</th>
<th>Year</th>
</tr>
<tr>';
}
elseif($data2['grade']==4||$data2['grade']==5||$data2['grade']==6)
{
echo'
<br>
<h3>Data Realisasi</h3>
<table border ="1" style="border-collapse:collapse; width:100%;">
<tr style="background:#CCC;">
<th>Product</th>
<th>Target</th>
<th>Pencapaian</th>
<th>Realisasi</th>
<th>Month</th>
<th>Year</th>
</tr>
<tr>';
}
 }
//
$cek="select * from sales where npp='$id'";
$xcek = mssql_query($cek);
$wcek = mssql_fetch_array($xcek);
$scek=$wcek['id_grup'];
//echo $scek;
// mengupdate data 
$update1 = "update performances set realisasi = (select (realisasi/target)*100 from sales_target where npp='$id' and productID=1 and month='$month' and year='$year'),
			performance=((select (realisasi/target)*100 from sales_target 
			where
			npp='$id' and productID=1 and month='$month' and year='$year')*bobot)/100 where npp='$id' and kpiid=10 and month='$month' and year='$year'" ;
			
$update2 = "update performances set realisasi = (select (realisasi/target)*100 from sales_target where npp='$id' and productID=2 and month='$month' and year='$year'),
			performance=((select (realisasi/target)*100 from sales_target 
			where 
			npp='$id' and productID=2 and month='$month' and year='$year')*bobot)/100 where npp='$id' and kpiid=20 and month='$month' and year='$year'";
			

//$update3 =	"update performances set realisasi = (select (realisasi/target)*100 from sales_target where npp='$id' and productID=3 and month='$month' and year='$year'),performance=((select (realisasi/target)*100 from sales_target where npp='$id' and productID=3 and month='$month' and year='$year')*bobot)/100 where npp='$id' and kpiid=30 and month='$month' and year='$year'";

// mengupdate data 
//$update4 = "update performances set realisasi =(select (sum(realisasi) / sum( target )) *100 FROM sales_target WHERE npp = '$id' and productid IN ( 4, 5 )  and month ='$month' AND year='$year') ,
//			performance=((select (sum(realisasi) / sum( target )) *100 FROM sales_target WHERE npp = '$id' and productid IN ( 4, 5 )  and month ='$month' AND year='$year')*bobot)/100
//			where npp='$id' and kpiid=40 and month='$month' and year='$year'";
//$update5 = "update performances set realisasi =(select (sum(realisasi) / sum( target )) *100 FROM sales_target WHERE npp = '$id' and productid IN ( 6,7,8 )  and month ='$month' AND year='$year') ,
//			performance=((select (sum(realisasi) / sum( target )) *100 FROM sales_target WHERE npp = '$id' and productid IN ( 6,7,8 )  and month ='$month' AND year='$year')*bobot)/100
//			where npp='$id' and kpiid=50 and month='$month' and year='$year'";
$update6 =	"update performances set realisasi = (select (realisasi/target)*100 from sales_target where npp='$id' and productID=3 and month='$month' and year='$year'),
			 performance=((select (realisasi/target)*100 from sales_target 
			 where 
			 npp='$id' and productID=3 and month='$month' and year='$year')*bobot)/100 where npp='$id' and kpiid=50 and month='$month' and year='$year'";

$update8 =	"update performances set realisasi = (select (realisasi/target)*100 from sales_target where npp='$id' and productID=2 and month='$month' and year='$year'),
			 performance=((select (realisasi/target)*100 from sales_target 
			 where 
			 npp='$id' and productID=2 and month='$month' and year='$year')*bobot)/100 where npp='$id' and kpiid=60 and month='$month' and year='$year'";	
			 
			 
$update7 =	"update performances set realisasi = (select (realisasi/target)*100 from sales_target where npp='$id' and productID=4 and month='$month' and year='$year'),
			 performance=((select (realisasi/target)*100 from sales_target 
			 where 
			 npp='$id' and productID=4 and month='$month' and year='$year')*bobot)/100 where npp='$id' and kpiid=40 and month='$month' and year='$year'";	
			 
$update_pencapaian ="	merge sales_target a using(
						select 
						npp,
						id_produk,
						sum(nominal) nominal,
						bulan,
						tahun
						 from lending where npp = $id and bulan = $month and tahun = $year
						 group by npp,id_produk,bulan,tahun)b
						 on(a.npp = b.npp and a.productID = b.id_produk and a.month = b.bulan and a.year = b.tahun)
						 when matched then update set
						 a.realisasi = b.nominal;";
						 
$update_performance="merge performances a using(
						select
						a.npp,
						case
						
						when b.id_grup = 9 and a.productID = 2 then 70 
						when b.id_grup = 8 and a.productID = 1 then 80
						when b.id_grup = 11 and a.productID =2 then 60
						when b.id_grup = 11 and a.productID =3 then 50
						end as kpiid,
						a.year,
						a.month,
						case
						
						when b.id_grup = 9 and a.productID = 2 then 100
						when b.id_grup = 8 and a.productID = 1 then 100
						when b.id_grup = 11 and a.productID =2 then 20
						when b.id_grup = 11 and a.productID =3 then 80
						end as bobot,
						case
						
						when b.id_grup = 9 and a.productID = 2 then ISNULL((round((realisasi/target)*100,0)),0)
						when b.id_grup = 8 and a.productID = 1 then ISNULL((round((realisasi/target)*100,0)),0)
						when b.id_grup = 11 and a.productID = 2 then ISNULL((round((realisasi/target)*100,0)),0)
						when b.id_grup = 11 and a.productID = 3 then ISNULL((round((realisasi/target)*100,0)),0)
						end as realisasi,
						case
						
						when b.id_grup = 9 and productID = 2 then ISNULL(round((round((realisasi/target)*100,0)),0),0)
						when b.id_grup = 8 and productID = 1 then ISNULL(round((round((realisasi/target)*100,0)),0),0)
						when b.id_grup = 11 and productID = 2 then ISNULL(round((round((realisasi/target)*100,0)*(0.2)),0),0)
						when b.id_grup = 11 and productID = 3 then ISNULL(round((round((realisasi/target)*100,0)*(0.8)),0),0)
						end as performance
						from
						sales_target a join sales b
						on a.npp = b.npp
						where a.month=$month and a.year=$year
						)b
						on (a.npp = b.npp and a.kpiid = b.kpiid and a.month = b.month and a.year = b.year)
						when matched then update set
						a.realisasi = b.realisasi,
						a.performance = b.performance;";
mssql_query($update_pencapaian);
mssql_query($update_performance);
//if($scek=='9'){
//mssql_query($update1); 
//mssql_query($update2); 
//mssql_query($update3);
//}
//elseif($scek=='8')
//{
//mssql_query($update4);
//mssql_query($update5);
//mssql_query($update6);
//mssql_query($update7);
//}
//perintah untuk menampilkan data, id_brg terbesar ke kecil
//$tampil = "SELECT * FROM sales_target where npp='$id' and month=$month and year=$year";

$tampil = "SELECT a.npp, x.grade,b.product_name,a.target,a.realisasi,a.month,a.year
		   FROM sales_target a INNER JOIN product b ON a.productID = b.productID INNER JOIN sales x on a.npp=x.npp
		   
		   where a.npp='$id' and month='$month' and year='$year'";

//perintah menampilkan data dikerjakan
$sql = mssql_query($tampil);
$persen = 100;
$persenR = 0.003;

//tampilkan seluruh data yang ada pada tabel user
while($data = mssql_fetch_array($sql))
 {
	 if($data['grade']==4||$data['grade']==5||$data['grade']==6)
	 {
echo "
<tr>
 <td><center>".$data['product_name']."</center></td>
 <td><center>Rp. ".number_format($data['target'])."</center></td>
 <td><center>Rp. ".number_format($data['realisasi'])."</center></td>
 <td><center>".round(($data['realisasi']/$data['target'])*$persen,2)."%</center></td>
 <td><center>".$data['month']."</center></td>
 <td><center>".$data['year']."</center></td>
 
 ";
 }
 elseif($data['grade']==3)
 {
	 echo "
<tr>
 <td><center>".$data['product_name']."</center></td>
 <td colspan=2><center>Rp. ".number_format($data['realisasi'])."</center></td>
 <td><center>".$data['month']."</center></td>
 <td><center>".$data['year']."</center></td>
 </tr>
  <td colspan=4><center><b>TOTAL PENCAPAIAN</b></center></td>
 <td colspan=2><center><b>Rp. ".number_format($data['realisasi']*$persenR)."</b></center></td>
 </tr>
 
 ";
 }
 }
echo "</table></br>";