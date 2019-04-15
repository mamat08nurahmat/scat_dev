<?php 
include('include/config.php');
?>
	<?php 
	
	if(isset($_POST['cari'])){
	$no_ktp=$_POST['cari'];
	$cek_username = mssql_num_rows(mssql_query("select * from (select no_ktp no_ktp from sales union select no_ktp from contoh) a WHERE a.no_ktp='$no_ktp'"));
		if ($cek_username > 0){
		echo "
		<script> 
		alert('Username Sudah Terdaftar');
		</script>";		
		}else{		
			echo "<script> alert('Username Belum Terdaftar. Lanjutkan');
				window.location.replace('index.php?page=10c&ktp=$no_ktp');</script>";
		}	 
		echo "<b>Hasil pencarian : ".$no_ktp."</b>";
	}


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

		<tr>
			<td><a href="index.php?page=10b" class="btn btn-danger" >kembali</a></td>
		</tr>
		<p></p>
<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
	<tr>
		<th><center>NPP</center></th>
		<th><center>NAMA</center></th>
        <th><center>Tanggal Aktif</center></th>
        <th><center>Tanggal Resign</center></th>
		<th><center>KETERANGAN</center></th>
 
	</tr>
 
		<?php 
		//$no_ktp	=$_POST['cari'];
		$query_mssql = mssql_query("SELECT * FROM sales WHERE no_ktp='$no_ktp'");
		while($data = mssql_fetch_array($query_mssql)){
			
		?>
		<tr>
			<td><center><?php echo $data['npp']; ?></center></td>
			<td><?php echo $data['nama']; ?></td>
			<?php $format=date('d-m-Y',strtotime($data['tanggal_aktif'])); ?>
			<td><center><?php echo $format; ?><//center></td>
			<?php $formate=date('d-m-Y',strtotime($data['tanggal_resign'])); ?>
			<td><center><?php echo $formate; ?></center></td>
			<td><?php echo $data['keterangan']; ?></td>
		</tr>
		<?php } ?>
</table>

<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
<thead>
	<tr>
		<th><center>NO</center></th>
		<th><center>TIPE</center></th>
        <th><center>NAMA CABANG</center></th>
		<th><center>NAMA LENGKAP</center></th>
        <th><center>ALAMAT</center></th>
        <th><center>NO HANDPHONE</center></th>
        <th style="width:55px;"><center>AKSI</center></th>
		<th><center>KETERANGAN</center></th>
 
	</tr>
 
		<?php 
		$cari=$_POST['cari'];
		$query_mssql = mssql_query("SELECT  distinct a.id,b.nama_grup,c.nama_cabang,a.nama_lengkap,a.alamat,a.hp,a.ket FROM contoh a 
									join app_user_grup b on a.id_grup = b.id_grup 
									LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang =  'KCU') c on a.id_cabang=c.kode_cabang 
									join area d on c.id_area=d.id_area 
									where no_ktp like '%".$cari."%' $cektipe ");
									
								
		$nomor = 1;
		while($data = mssql_fetch_array($query_mssql)){
			
			if($data['ket']==2) {
				//view
                $ket = "waiting approve";
				$tombol =""; 
				$tombol .="<center><a class='icon-search' href='index.php?page=10j&id=".$data['id']."'></a></center>"; 	
            }
			elseif($data['ket']==3) {
                $ket = "approve sco";
				//view
				$tombol =""; 
				$tombol .="<center><a class='icon-search' href='index.php?page=10j&id=".$data['id']."'></a></center>"; 
            }
			elseif($data['ket']==4) {
				//edit + hapus
                $ket = "cancel";
				$tombol ="";
				$tombol .="<a class='icon-pencil' href='index.php?page=10d&id=".$data['id']."'></a>|";
				$tombol .="<a class='icon-trash'  onclick='return tanya()' href='sgv_hapus.php?id=".$data['id']."'></a>|";		
				$tombol .="<a class='icon-search' href='index.php?page=10n&id=".$data['id']."'></a>"; 
            }
			if($data['ket']==5) {
				//edit + hapus
                $ket = "approve";
				$tombol ="";	
				$tombol .="<center><a class='icon-search' href='index.php?page=10m&id=".$data['id']."'></a></center>"; 
            }
		?>
		<tr>
			<td><?php echo $nomor++; ?></td>
			<td><?php echo $data['nama_grup']; ?></td>
			<td><?php echo $data['nama_cabang']; ?></td>
			<td><?php echo $data['nama_lengkap']; ?></td>
			<td><?php echo $data['alamat']; ?></td>
			<td><?php echo $data['hp']; ?></td>
			<td>
				   
<?=$tombol;?>
				
			</td>
			<td><center><?php echo $ket; ?></center></td>
		</tr>
		<?php } ?>
	</table>
</body>
</html>