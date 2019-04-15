<link rel="stylesheet" type="text/css/css" href="style.css">
<?php
	$id=$_GET['id'];
	
	include('include/config.php');
	$sql = 
"select a.npp,a.nama,e.sales_type,a.id_cabang,a.grade,b.area,c.productID,c.target,d.product_name 
from sales a join mapping_target b 
on a.id_cabang=b.branch_code
JOIN SALES_TYPE e
on a.id_grup = e.id
join template_target c
on e.sales_type = c.sales_type and a.grade = c.grade and b.area = c.area 
join product d 
on c.productID = d.productID
where  npp = '$id'";
	$sqlx=mssql_query($sql);
	while($data=mssql_fetch_array($sqlx))
	{

		echo ("<div class='form_settings'><div class='span12'><span>".$data['product_name']."</span>");
		?>
				
				
				<input type='text' name='target' style='width:170px; height:20px;' value='<?php echo "Rp. ".number_format($data['target'])?>' readonly>
				</div>
				</div>
				
		<?php
	
	}
		
?>
<div class="span12">
<input type="submit" value="Simpan" name="simpan" />
</div>