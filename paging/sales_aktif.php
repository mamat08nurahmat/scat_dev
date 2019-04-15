<?php 
// memanggil berkas koneksi.php
//require 'koneksi.php'; 
include('include/config.php');
include 'approve.php';
$kd_npp = $_POST['id'];
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
	<link href="css/style-popup.css" rel="stylesheet">
</head>
<body>
 <div align="center" style="border:1px solid;background-color:#00BFFF"><strong><p>FORM VENDOR</strong></p></div>
<p></p>
	<div class="row" style="width:98%;margin-left:10px;">
		
		<h3>
			<div class="input-prepend pull-right">
				<form action="index.php?page=10b" method="POST">
				<input type="text" value='' name="qcari" placeholder="Pencarian All">
				<input type="submit" value="cari">
				</form>
			</div>
		</h3>
	</div>

<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
<thead>
	<tr bgcolor='#666666' align='center'>
		<th><font color='white'><center>NO</center></font></th>
		<th><font color='white'><center>TIPE</center></font></th>
        <th><font color='white'><center>NAMA CABANG</center></font></th>
		<th><font color='white'><center>NAMA LENGKAP</center></font></th>
        <th><font color='white'><center>ALAMAT</center></font></th>
        <th><font color='white'><center>NO HANDPHONE</center></font></th>
        <th style="width:55px;"><font color='white'><center>AKSI</center></font></th>
		<th><font color='white'><center>Tanggal Approve</center></font></th>
		<th><font color='white'><center>KETERANGAN</center></font></th>
 
	</tr>
 
		<?php 
		$i=1;
        $jml_per_halaman = 2;
        $jml_data = mssql_num_rows(mssql_query("SELECT * FROM contoh"));
        $jml_halaman = ceil($jml_data / $jml_per_halaman);
		if(isset($_POST['qcari'])){
		$qcari=$_POST['qcari'];
			echo "<b>Hasil pencarian : ".$qcari."</b>";
			$query_mssql = mssql_query(" SELECT * FROM contoh a LEFT JOIN app_user_grup b on a.id_grup = b.id_grup LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
                WHERE npp LIKE '%$qcari%'
                OR nama_lengkap LIKE '%$qcari%'
                OR alamat LIKE '%$qcari%'
                OR hp LIKE '%$qcari%'");
			} elseif(isset($_POST['halaman'])) {
			$halaman = $_POST['halaman'];
			
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
           $query_mssql = mssql_query("SELECT * FROM  (
									 SELECT  id,ROW_NUMBER() OVER (ORDER BY id DESC) AS ROWNUM,id_grup,id_cabang,nama_lengkap,alamat,hp,ket,tgl FROM contoh  where ket='5')AS a 
									 LEFT JOIN app_user_grup b on a.id_grup = b.id_grup LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang =  'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
									WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY a.tgl DESC  ");
			} else {
			 $halaman = 1;
			 $i = ($halaman - 1) * $jml_per_halaman  + 1;
			 $query_mssql = mssql_query("	SELECT * FROM  (
									 SELECT  id,ROW_NUMBER() OVER (ORDER BY id DESC) AS ROWNUM,id_grup,id_cabang,nama_lengkap,alamat,hp,ket,tgl FROM contoh where ket='5')AS a 
									 LEFT JOIN app_user_grup b on a.id_grup = b.id_grup LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang =  'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
									WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY a.tgl DESC    ");
			 $halaman = 1;
        }
		while($data = mssql_fetch_array($query_mssql)){
				
			if($data['ket']==2) {
                $ket = "waiting approve";
				$tombol =""; 
				$tombol .="<center><a class='icon-search' href='index.php?page=10i&id=".$data['id']."'></a></center>"; 		
            }
			elseif($data['ket']==3) {
                $ket = "approve sco";
				$tombol =""; 
				$tombol .="<center><a class='icon-search' href='index.php?page=10i&id=".$data['id']."'></a></center>";
            }
			elseif($data['ket']==4) {
                $ket = "cancel";
				$tombol ="";
				$tombol .="<a class='icon-pencil' href='index.php?page=10d&id=".$data['id']."'></a>|";
				$tombol .="<a class='icon-trash'  onclick='return tanya()' href='sgv_hapus.php?id=".$data['id']."'></a>|";		
				$tombol .="<a class='icon-search' href='index.php?page=10i&id=".$data['id']."'></a>";
				
            }if($data['ket']==5) {
                $ket = "approve";
				$tombol ="";	
				$tombol .="<center><a class='icon-search' href='index.php?page=10j&id=".$data['id']."'></a></center>"; 
            }
		?>
		
		<tr bgcolor="<?php echo $color ; ?>" >
			
			<td><font color='black'><?php echo $i++;?></font></td>
			<td><font color='black'><?php echo $data['nama_grup'] ,  $halaman ; ?></font></td>
			<td><font color='black'><?php echo $data['nama_cabang'], $jml_per_halaman; ?></font></td>
			<td><font color='black'><?php echo $data['nama_lengkap']; ?></font></td>
			<td><font color='black'><?php echo $data['alamat']; ?></font></td>
			<td><font color='black'><?php echo $data['hp']; ?></font></td>
			<td><?=$tombol;?>		
<!--
			<a class="icon-search" href="index.php?page=10j&id=<?php echo $data['id']; ?>"></a> |
			<a class="icon-pencil" href="index.php?page=10d&id=<?php echo $data['id']; ?>"></a> |
			<a class="icon-trash"  onclick="return tanya()" href="sgv_hapus.php?id=<?php echo $data['id']; ?>"></a> 
-->		   			
			</td>
			<?php $format=date('d-m-Y',strtotime($data['tgl'])); ?>
			<td><font color='black'><center><?php echo $format; ?></center></font></td>
			<td><font color='black'><center><?php echo $ket; ?></center></font></td>
		</tr>
		  <?php
        }
    ?>
	</table>
	
<?php if(!isset($_POST['cari'])) { ?>
<div class="pagination pagination-right">
  <ul>
    <?php
    $no_hal_tampil = 10; // lebih besar dari 3

    if ($jml_halaman <= $no_hal_tampil) {
        $no_hal_awal = 1;
        $no_hal_akhir = $jml_halaman;
    } else {
        $val = $no_hal_tampil - 2; //3
        $mod = $halaman % $val; //
        $kelipatan = ceil($halaman/$val);
        $kelipatan2 = floor($halaman/$val);

        if($halaman < $no_hal_tampil) {
            $no_hal_awal = 1;
            $no_hal_akhir = $no_hal_tampil;
        } elseif ($mod == 2) {
            $no_hal_awal = $halaman - 1;
            $no_hal_akhir = $kelipatan * $val + 2;
        } else {
            $no_hal_awal = ($kelipatan2 - 1) * $val + 1;
            $no_hal_akhir = $kelipatan2 * $val + 2;
        }

        if($jml_halaman <= $no_hal_akhir) {
            $no_hal_akhir = $jml_halaman;
        }
    }

    for($i = $no_hal_awal; $i <= $no_hal_akhir; $i++) {
        // tambahan
        // menambahkan class active pada tag li
        $aktif = $i == $halaman ? ' active' : '';
    ?>
    <li class="halaman<?php echo $aktif ?>" id="<?php echo $i ?>"><a href="#"><?php echo $i ?></a></li>
    <?php } ?>
  </ul>
</div>
<?php } ?>
 	

 <script language="javascript">
 function tanya() {
 if (confirm ("Apakah Anda yakin akan menghapus data ini ?")) {
 return true;
  } else {
   return false;
  }
  }
</script>


</body>
</html>