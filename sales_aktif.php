<?php 
session_start();
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
        $i = 1;
        $jml_per_halaman = 20; 
        $jml_data = mssql_num_rows(mssql_query("SELECT * FROM ( 
																select id,ROW_NUMBER() OVER (ORDER BY id DESC) AS ROWNUM, id_grup,id_cabang,id_vendor, nama_lengkap , alamat ,hp , tgl ,ket 
																from contoh where ket='5'
															  ) As a LEFT JOIN app_user_grup b on a.id_grup = b.id_grup LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
												"));
        $jml_halaman = ceil($jml_data / $jml_per_halaman);
		
       if($_SESSION['user_level']==1|| $_SESSION['user_level']==2|| $_SESSION['user_level']==13)
	  {
		// query pada saat mode pencarian
        if(isset($_POST['cari_data'])) {
            $kunci = $_POST['cari_data'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mssql_query("SELECT * FROM ( 
												select id,ROW_NUMBER() OVER (ORDER BY id DESC) AS ROWNUM, id_grup,id_cabang,id_vendor, nama_lengkap , alamat ,hp , tgl ,ket 
												from contoh where ket='5'
												)As a LEFT JOIN app_user_grup b on a.id_grup = b.id_grup LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
									WHERE a.nama_lengkap LIKE '%$kunci%'
									OR a.alamat LIKE '%$kunci%'
									OR c.nama_cabang LIKE '%$kunci%'
               
								");
        
		// query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query("SELECT * FROM ( 
												select id,ROW_NUMBER() OVER (ORDER BY id DESC) AS ROWNUM, id_grup,id_cabang,id_vendor, nama_lengkap , alamat ,hp , tgl ,ket 
												from contoh where ket='5' 
												)As a LEFT JOIN app_user_grup b on a.id_grup = b.id_grup LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
												WHERE  a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY tgl ASC ");
        
		// query ketika tidak ada parameter halaman maupun pencarian
        } else {
			 $halaman = 1;
			 $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query("SELECT * FROM ( 
												select id,ROW_NUMBER() OVER (ORDER BY id DESC) AS ROWNUM, id_grup,id_cabang,id_vendor, nama_lengkap , alamat ,hp , tgl ,ket 
												from contoh where ket='5'
												)As a LEFT JOIN app_user_grup b on a.id_grup = b.id_grup LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
												WHERE  a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY tgl ASC
								");
            $halaman = 1; //tambahan
        }
		
	}
	elseif($_SESSION['user_level']==10)
	{
		 if(isset($_POST['cari_data'])) {
            $kunci = $_POST['cari_data'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mssql_query("SELECT * FROM ( 
												select id,ROW_NUMBER() OVER (ORDER BY id DESC) AS ROWNUM, id_grup,id_cabang,id_vendor, nama_lengkap , alamat ,hp , tgl ,ket 
												from contoh where ket='5' and id_cabang='13'
												)As a LEFT JOIN app_user_grup b on a.id_grup = b.id_grup LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
									WHERE a.nama_lengkap LIKE '%$kunci%'
									OR a.alamat LIKE '%$kunci%'
									OR c.nama_cabang LIKE '%$kunci%'
               
								");
        
		// query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query("SELECT * FROM ( 
												select id,ROW_NUMBER() OVER (ORDER BY id DESC) AS ROWNUM, id_grup,id_cabang,id_vendor, nama_lengkap , alamat ,hp , tgl ,ket 
												from contoh where ket='5' and id_vendor='$_SESSION[id_vendor]'
												)As a LEFT JOIN app_user_grup b on a.id_grup = b.id_grup LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
												WHERE  a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY tgl ASC ");
        
		// query ketika tidak ada parameter halaman maupun pencarian
        } else {
			 $halaman = 1;
			 $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query("SELECT * FROM ( 
												select id,ROW_NUMBER() OVER (ORDER BY id DESC) AS ROWNUM, id_grup,id_cabang,id_vendor, nama_lengkap , alamat ,hp , tgl ,ket 
												from contoh where ket='5' nd id_vendor='$_SESSION[id_vendor]'
												)As a LEFT JOIN app_user_grup b on a.id_grup = b.id_grup LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
												WHERE  a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY tgl ASC
								");
            $halaman = 1; //tambahan
        }
	}
        // tampilkan data mahasiswa selama masih ada
        while($data = mssql_fetch_array($query)) {
			$tgl_approve 	= date('d-m-Y',strtotime($data['tgl']));
			$tgl_sekarang 	= date('d-m-Y');
			$lama_approve 	= hitung_approve($tgl_approve, $tgl_sekarang,"-");	

			if($data['ket']==1) {
                $ket = "waiting approve Penyelia";
				$tombol =""; 
				$tombol .="<center><a class='icon-search' href='index.php?page=10i&id=".$data['id']."'></a></center>"; 
					if($lama_approve==1){
						$color = '#98FB98';	
						}elseif($lama_approve==2){
						$color = '#FFD700';	
						}else{
						$color = '#FF6347';
						}	
            } elseif($data['ket']==2) {
                $ket = "waiting approve sco";
				$tombol =""; 
				$tombol .="<center><a class='icon-search' href='index.php?page=10i&id=".$data['id']."'></a></center>"; 
					if($lama_approve==1){
						$color = '#98FB98';	
						}elseif($lama_approve==2){
						$color = '#FFD700';	
						}else{
						$color = '#FF6347';
						}	
            }
			elseif($data['ket']==3) {
                $ket = "waiting approve sgv";
				$tombol =""; 
				$tombol .="<center><a class='icon-search' href='index.php?page=10i&id=".$data['id']."'></a></center>";
				if($lama_approve==1){
					$color = '#98FB98';	
					}elseif($lama_approve==2){
					$color = '#98FB98';	
					}elseif($lama_approve==3){
					$color = '#FFD700';	
					}else{
					$color = '#FF6347';
					}
            }
			elseif($data['ket']==4) {
                $ket = "cancel";
				$tombol ="";
				$tombol .="<a class='icon-pencil' href='index.php?page=10d&id=".$data['id']."'></a>|";
				$tombol .="<a class='icon-trash'  onclick='return tanya()' href='sgv_hapus.php?id=".$data['id']."'></a>|";		
				$tombol .="<a class='icon-search' href='index.php?page=10i&id=".$data['id']."'></a>";
				$color 	 = 'white';
				
            }elseif($data['ket']==5) {
                $ket = "approve";
				$tombol ="";	
				$tombol .="<center><a class='icon-search' href='index.php?page=10j&id=".$data['id']."'></a></center>"; 
            }	
		
    ?> 
		<tr bgcolor="<?php echo $color ; ?>" >
			
			<td><font color='black'><?php echo $i++;?></font></td>
			<td><font color='black'><?php echo $data['nama_grup']; ?></font></td>
			<td><font color='black'><?php echo $data['nama_cabang']; ?></font></td>
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
	
<?php if(!isset($_POST['cari_data'])) { ?>
<div class="pagination pagination-right">
  <ul>
    <?php
    $no_hal_tampil = 10;

    if ($jml_halaman <= $no_hal_tampil) {
        $no_hal_awal = 1;
        $no_hal_akhir = $jml_halaman;
    } else {
        $val = $no_hal_tampil - 2;
        $mod = $halaman % $val;
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
        $aktif = $i == $halaman ? ' active' : '';
    ?>
    <li class="halaman<?php echo $aktif ?>" id="<?php echo $i ?>"><a href="#"><?php echo $i ?></a></li>
    <?php } ?>
  </ul>
</div>
<?php } ?>	
</body>
</html>