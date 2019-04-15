<?php
include('include/config.php');
$id = $_POST['npp'];
$year = $_POST['year'];
$month = $_POST['month'];

$hapus_realisasi = "delete from sales_target where npp = '$id' and month >= '$month' and year = '$year'";
mssql_query($hapus_realisasi);

$hapus_performances = "delete from performances where npp = '$id' and month >= '$month' and year = '$year'";
mssql_query($hapus_performances);


$query2="INSERT INTO temp_performance (npp) values('$id')";
mssql_query($query2);
$x=1;
while($x<=(13-$month))
{
			$query="insert into sales_target(npp,year,month,productid,target)
			select 
			'$id' NPP,
			'$year' YEAR,
			($month+$x-1) MONTH,
			c.productid PRODUCTID, 
			c.target TARGET
			from sales a join mapping_target b 
			on a.id_cabang=b.branch_code
			join sales_type e
			on a.id_grup = e.id
			join template_target c
			on e.sales_type = c.sales_type and a.grade = c.grade and b.area = c.area 
			where  npp = '$id'
			";
			mssql_query($query);
			$query3="	insert into performances(npp,kpiid,year,month,bobot,realisasi,performance,grade)
						SELECT A.NPP, b.kpiid, '$year' year ,($month+$x-1) MONTH , b.bobot, 0 realisasi, 0 performance, A.grade
						FROM SALES A
						join sales_type c on a.id_grup = c.id
						JOIN TMP_KPI B ON c.SALES_TYPE = B.SALES_TYPE
						WHERE A.NPP
						IN (SELECT DISTINCT NPP FROM TeMP_PERFORMANCE where npp<>'')
					";
			$query4 ="truncate table temp_performance";
			mssql_query($query3);
			$x++;
}
mssql_query($query4);

?>
<?php
header("Location:index.php?page=11");

?>