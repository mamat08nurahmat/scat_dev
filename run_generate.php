<?php
$npp = $_GET['npp'];
$month = $_GET['month'];
$year = $_GET['year'];
include ('include/config.php');
$querya="merge sales_target a using(
												select 
												npp,id_produk,isnull(sum(nominal),0) nominal,bulan,tahun from
												(
												select 
												npp,
												id_produk,
												sum(nominal) nominal,
												bulan,
												tahun
												 from lending where bulan = $month and tahun = $year
												 group by npp,id_produk,bulan,tahun
												 union
												 select 
												npp,
												1 id_produk,
												0 nominal,
												bulan,
												tahun
												 from lending where bulan = $month and tahun = $year
												 group by npp,id_produk,bulan,tahun
												 union
												 select 
												npp,
												2 id_produk,
												0 nominal,
												bulan,
												tahun
												 from lending where bulan = $month and tahun = $year
												 group by npp,id_produk,bulan,tahun
												  union
												 select 
												npp,
												3 id_produk,
												0 nominal,
												bulan,
												tahun
												 from lending where bulan = $month and tahun = $year
												 group by npp,id_produk,bulan,tahun)a
												 group by npp,id_produk,bulan,tahun
					)b
						 on(a.npp = b.npp and a.productID = b.id_produk and a.month = b.bulan and a.year = b.tahun)
						 when matched then update set
						 a.realisasi = b.nominal;";


$queryb="merge performances a using(
						select
						a.npp,
						b.grade
						case
						
						when b.id_grup = 9 and a.productID = 2 then 90 
						when b.id_grup = 8 and a.productID = 1 then 80
						end as kpiid,
						a.year,
						a.month,
						case
						
						when b.id_grup = 9 and a.productID = 2 then 100
						when b.id_grup = 8 and a.productID = 1 then 100
						end as bobot,
						case
						
						when b.id_grup = 9 and a.productID = 2 then ISNULL((round((realisasi/target)*100,0)),0)
						when b.id_grup = 8 and a.productID = 1 then ISNULL((round((realisasi/target)*100,0)),0)
						end as realisasi,
						case
						
						when b.id_grup = 9 and productID = 2 then ISNULL(round((round((realisasi/target)*100,0)),0),0)
						when b.id_grup = 8 and productID = 1 then ISNULL(round((round((realisasi/target)*100,0)),0),0)
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
						
						mssql_query($querya);
						mssql_query($queryb);
						
?>
<script> 
		alert('GENERATE SUKSES');
		window.location.replace("index.php?page=20"); </script>
