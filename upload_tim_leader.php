<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>scat</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
</head>
<body>
</head>
<div class="span12">
<h2>Import Data Tim Leader </h2>
</div>
	<form action="upload_tim_leader_proses.php" method="post" enctype="multipart/form-data">
		<div class="form_settings">
			<div class="span12">
				<p><span>Pilih File  *xls</span><span>&nbsp;</span><input  type="file" name="fileexcel"  /></p>
			</div><br>
			<div class="span12">
				<p><span>&nbsp;</span><span>&nbsp;</span><input class="submit" type="submit" name="upload" value="Import" /></p>
			</div>
		</div>
	</form>
		<div class="pull-right">
			<td><a href="about/data_tim_leader.xls" class="btn " download>Download Template Upload Excel</a></td><p></p>
		</div>
</body>
<!--
<?php
session_start();
include('include/config.php');
$id = $_POST['id'];
$query = mssql_query("SELECT * FROM ( SELECT id_report,ROW_NUMBER() OVER (ORDER BY nama_nasabah DESC) AS ROWNUM,nama_nasabah,persetujuan_pengalihan,nominal,no_perjanjian,no_rekening,keterangan,id_cabang,ket,tgl_input
												FROM report_tl ) AS a  
												LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang =  'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
												where a.ket=1 ORDER BY id_report DESC");
?>
<form action="" method="post"> 
<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
<thead>
		<tr>
			<th><center>No</center></th>
			<th><center>Nama Nasabah</center></th>
			<th><center>Persetujuan Pengalihan Mutasi Bayar dan Pinjaman</center></th>
			<th><center>Nominal Kredit</center></th>
			<th><center>No Perjanjian Kredit</center></th>
			<th><center>No Rekening Pinjaman</center></th>
			<th><center>Keterangan<center></th>
			<th><center>Tanggal</center></th>
			<th style="width:35px;"><center>AKSI</center></th>
		</tr>
</thead>
<body>
        <?php if(mssql_num_rows($query)>0){ ?>
        <?php
            $no = 1;
            while($data = mssql_fetch_array($query)){
				$tgl = date('d-m-Y',strtotime($data['tgl_input']));
			if($data['persetujuan_pengalihan']==1) {
                $pp = "Ya";	
            }
			elseif($data['persetujuan_pengalihan']==2) {
                $pp = "Tidak";
            }
			if($data['ket']==1) {
				$tombol =""; 
				$tombol .="<center><a class='icon-pencil' href='index.php?page=32c&id_report=".$data['id_report']."'></a>|";
				$tombol .="<a class='icon-trash' onclick='return tanya()' href='data_tim_leader_hapus.php?id_report=".$data['id_report']."'></a></center>";	
            }
        ?>
        <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $data['nama_nasabah']?></td>
		<td><center><?php echo $pp ?></center></td>
        <td><?php echo $data['nominal'] ?></td>
        <td><?php echo $data['no_perjanjian'] ?></td>
		<td><?php echo $data['no_rekening'] ?></td>
		<td><?php echo $data['keterangan'] ?></td>
		<td><?php echo $tgl ?></td>
		<td><?=$tombol;?></td></tr>
        <?php $no++; } ?>
        <?php } ?>
</table>
</form>

<script language="javascript">
 function tanya() {
 if (confirm ("Apakah Anda yakin akan menghapus data ini ?")) {
 return true;
  } else {
   return false;
  }
  }
</script>

-->
</html>