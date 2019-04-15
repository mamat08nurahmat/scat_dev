<?php
include('include/config.php');
include 'approve.php';
$npp = $_POST['npp'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>scat</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="favicon.png"/>
	<link href="sales-css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
<div align="center" style="border:1px solid;background-color:#00BFFF"><strong><p>DATA APPROVE</strong></p></div>
<p></p>
	<!--<div class="row" style="width:98%;margin-left:10px;">
		<h3>
			<div class="pull-right">
				<form action="index.php?page=10k" method="POST">
				<input type="text" value='' name="qcari" placeholder="cari nama lengkap">
				<input type="submit" value="cari">
				</form>
			</div>
		</h3>
	</div>-->
<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
<thead>
	<tr bgcolor='#666666' align='center'>
		<th><font color='white'><center>NO</center></font></th>
        <th><font color='white'><center>TIPE</center></font></th>
        <th><font color='white'><center>NAMA CABANG</center></font></th>
		<th><font color='white'><center>NAMA LENGKAP</center></font></th>
        <th><font color='white'><center>ALAMAT</center></font></th>
        <th><font color='white'><center>NO HANDPHONE</center></font></th>
        <th><font color='white'><center>TANGGAL INPUT</center></font></th>
		<th><font color='white'><center>AKSI</center></font></th>
	</tr>
		<?php 
			 $query_mssql = mssql_query("SELECT * FROM 
										( 
										select id,ROW_NUMBER() OVER (ORDER BY id DESC) AS ROWNUM, id_grup,id_cabang, nama_lengkap , alamat ,hp , tgl ,ket 
										from contoh where ket=2
										)As a LEFT JOIN app_user_grup b on a.id_grup = b.id_grup LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
										ORDER BY tgl,id ASC  ");
			
		$nomor = 1;
		while($data = mssql_fetch_array($query_mssql)){
		$tgl_approve = date('d-m-Y',strtotime($data['tgl']));
		$tgl_sekarang = date('d-m-Y');
		//$tgl_sekarang = "20-02-2018";
		$lama_approve = hitung_approve($tgl_approve, $tgl_sekarang,"-");			
			if($lama_approve==1){
			$color = '#98FB98';	
			}elseif($lama_approve==2){
			$color = '#FFD700';	
			}else{
			$color = '#FF6347';
			}			
		?>
		<tr bgcolor="<?php echo $color ; ?>" >
			<td><font color='black'><?php echo $nomor++; ?></font></td>
			<td><font color='black'><?php echo $data['nama_grup']; ?></font></td>
			<td><font color='black'><?php echo $data['nama_cabang']; ?></font></td>
			<td><font color='black'><?php echo $data['nama_lengkap']; ?></font></td>
			<td><font color='black'><?php echo $data['alamat']; ?></font></td>
			<td><font color='black'><?php echo $data['hp']; ?></font></td>
			<td><font color='black'><center><?php echo $tgl_approve; ?></center></font></td>
			<!-- sales approve sco form -->
			<td><center><a class="btn" href="index.php?page=10l&id=<?php echo $data['id']; ?>">view</a></center></td>
		</tr>
		<?php } ?>
	</table>
<script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>
</body>
</html>