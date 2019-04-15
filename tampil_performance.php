<link rel="stylesheet" type="text/css/css" href="style.css">
<?php
$id=$_GET["id"]; 
$month=$_GET["month"];
$year=$_GET["year"];
$grade=$_GET["grade"];
//Koneksi dan memilih database di server
include('include/config.php');
echo '
<br>

<h3>Data Performance</h3>
<table border ="1" style="border-collapse:collapse; width:100%;">
<tr style="background:#CCC; font color:"white"">
<th>Product</th>
<th>Bobot</th>
<th>Realisasi</th>
<th>Performance</th>
</tr>';
 
//perintah untuk menampilkan data,
//$tampil = "SELECT * FROM performances where npp='$id' and month='$month' and year='$year'";

$tampil = "SELECT A.npp,B.nama_kpi,A.bobot,A.realisasi,A.performance,A.month,A.year
FROM performances A INNER JOIN tmp_kpi B ON A.kpiid=B.kpiid INNER JOIN sales X on A.npp=X.npp
		   where A.npp='$id' and month='$month' and year='$year'";

$tampil2 = "select sum(performance) total from performances where npp='$id' and month='$month' and year='$year'";	
//$tampil3 = "select 	insentif
//			from
//			(select a.npp,b.nama,d.nama_grup,c.nama_cabang,c.atasan_cabang,e.nama_grade,f.nama_area,g.nama_vendor,a.year,a.month,b.grade,ISNULL(sum(performance),0) as total,
//			CASE
//			WHEN ISNULL(sum(performance),0) >=700 THEN 700
//			ELSE ISNULL(sum(performance),0)
//			END AS Perform
//			 from performances a 
//					left join sales b on a.npp = b.npp
//					left join cabang c on b.id_cabang = c.kode_cabang
//					left join app_user_grup d on b.id_grup = d.id_grup
//					left join grade e on b.grade = e.grade
//					left join area f on c.id_area = f.id_area
//					left join vendor g on b.id_vendor = g.id_vendor

//				 group by a.npp,b.nama,d.nama_grup,a.year,a.month,b.grade,c.nama_cabang,c.atasan_cabang,f.nama_area,g.nama_vendor,e.nama_grade
//			)a
//			left join insentif_rupiah b
//			on a.grade = b.grade and a.perform = b.performance
//			where month = '$month' and year = '$year' and a.atasan_cabang = 0 and npp = '$id'";
			
//$tampil3 = "select * from vw_insentif where month='$month' and year='$year' and npp='$id'";


$tampil3 = "
SELECT     ori.npp, ori.grade, ori.nama, ori.nama_grup, ori.nama_grade, ori.nama_cabang, ori.nama_area, ori.nama_vendor, ori.id_vendor, ori.nama_kpi, ori.bobot, ori.realisasi, 
                      ori.performance, ori.performance_asli, ori.month, ori.year, b.insentif
FROM         (SELECT     npp, grade, nama, nama_grup, nama_grade, nama_cabang, nama_area, nama_vendor, id_vendor, nama_kpi, bobot, realisasi, 
                                              CASE WHEN ISNULL(a.performance, 0) >= 1000 THEN 1000 ELSE ISNULL(a.performance, 0) END AS performance, performance AS performance_asli, 
                                              month, year
                       FROM          
					   
					   
					 (  SELECT     TOP (100) PERCENT a.npp, a.grade, c.nama, d.nama_grup, h.nama_grade, e.nama_cabang, f.nama_area, g.nama_vendor, g.id_vendor, 'TOTAL KPI' AS nama_kpi, 
                      SUM(a.bobot) AS bobot, NULL AS realisasi, SUM(a.performance) AS performance, a.month, a.year, c.status_sales
FROM         dbo.performances AS a LEFT OUTER JOIN
                      dbo.kpi AS b ON a.kpiid = b.kpiid LEFT OUTER JOIN
                      dbo.sales AS c ON a.npp = c.npp LEFT OUTER JOIN
                      dbo.app_user_grup AS d ON c.id_grup = d.id_grup LEFT OUTER JOIN
                      dbo.cabang AS e ON e.kode_cabang = c.id_cabang LEFT OUTER JOIN
                      dbo.area AS f ON e.id_area = f.id_area LEFT OUTER JOIN
                      dbo.vendor AS g ON c.id_vendor = g.id_vendor LEFT OUTER JOIN
                      dbo.grade AS h ON c.grade = h.grade
WHERE     (c.status_sales = 1) AND (e.tipe_cabang = 'KCU')
GROUP BY a.npp, a.grade, c.nama, d.nama_grup, h.nama_grade, e.nama_cabang, f.nama_area, g.nama_vendor, g.id_vendor, a.month, a.year, c.status_sales
ORDER BY a.npp, bobot)

					   AS A) AS ori LEFT OUTER JOIN
                      dbo.insentif_rupiah AS b ON ori.grade = b.grade AND ori.performance = b.performance
					
 where month='$month' and year='$year' and npp='$id'";
/*
 

$tampil3 = "
SELECT     ori.npp, ori.grade, ori.nama, ori.nama_grup, ori.nama_grade, ori.nama_cabang, ori.nama_area, ori.nama_vendor, ori.id_vendor, ori.nama_kpi, ori.bobot, ori.realisasi, 
			ori.performance, ori.performance_asli, ori.month, ori.year, b.insentif
FROM         (SELECT     npp, grade, nama, nama_grup, nama_grade, nama_cabang, nama_area, nama_vendor, id_vendor, nama_kpi, bobot, realisasi, 
		CASE WHEN ISNULL(a.performance, 0)
		>= 1000 THEN 1000 ELSE ISNULL(a.performance, 0) END AS performance, 
		performance AS performance_asli,month, year
        FROM dbo.vw_totalkpi AS A) AS ori LEFT OUTER JOIN
        dbo.insentif_rupiah AS b ON ori.grade = b.grade AND ori.performance = b.perfor
WHERE month='$month' and year='$year' and npp='$id'";

*/

//perintah menampilkan data dikerjakan
$sql = mssql_query($tampil);
$sql2 = mssql_query($tampil2);
$sql3 = mssql_query($tampil3);
$data1=mssql_fetch_array($sql2);
$data2=mssql_fetch_array($sql3);

 
//tampilkan seluruh data yang ada pada tabel user
while($data = mssql_fetch_array($sql))
 {

echo "
<tr>
 <td><center>".$data['nama_kpi']."</center></td>
 <td><center>".$data['bobot']."%</center></td>
 <td><center>".number_format($data['realisasi'])."%</center></td>
 <td><center>".number_format($data['performance'])."%</center></td>
 </tr>";
 }
 echo"
 <tr>
 <td colspan=3><center><b>TOTAL PERFORMANCE</b></center></td>
 <td><center><b>".$data1['total']."%</b></center></td>
 </tr>";
/*
echo" 
 <tr>
  <td colspan=3><center><b>TOTAL INSENTIF</b></center></td>
 <td><center><b>Rp. ".number_format($data2['insentif'])."</b></center></td>
 </tr>";
*/ 
//---------------

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
/*
echo "
<tr>
 <td><center>".$data['product_name']."</center></td>
 <td><center>Rp. ".number_format($data['target'])."</center></td>
 <td><center>Rp. ".number_format($data['realisasi'])."</center></td>
 <td><center>".round(($data['realisasi']/$data['target'])*$persen,2)."%</center></td>
 <td><center>".$data['month']."</center></td>
 <td><center>".$data['year']."</center></td>
 
 ";
 echo" 
 <tr>
  <td colspan=3><center><b>TOTAL INSENTIF</b></center></td>
 <td><center><b>Rp. ".number_format($data['realisasi']/$data['target'])*$persen,2)."%</b></center></td>
 </tr>";
*/		 
 echo" 
 <tr>
  <td colspan=3><center><b>TOTAL INSENTIF</b></center></td>
<td><center><b>Rp. ".number_format($data2['insentif'])."</b></center></td>
 </tr>";
 }
 elseif($data['grade']==3)
 {
/*
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
*/	 
 
 //---
 echo" 
 <tr>
  <td colspan=3><center><b>TOTAL INSENTIF</b></center></td>
 <td><center><b>Rp. ".number_format($data['realisasi']*$persenR)."</b></center></td>
 </tr>";
 //--
 
 }
 }

//------------


 
 
echo "</table><br>";
?>

</font>

 