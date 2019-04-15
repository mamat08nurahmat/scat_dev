<?php
session_start();
include('include/config.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="images/add2.png"/>
		<meta name="viewport" content="width=device-width, maximum-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<link href="aset-layout/style/common.css" rel="stylesheet">
		<link href="aset-layout/style/style.css" rel="stylesheet">
		<link href="aset-layout/style/color.css" rel="stylesheet">
		<link href="aset-layout/style/slider.css" rel="stylesheet">
		<link href="aset-layout/style/responsive.css" rel="stylesheet">
		<script src="aset-layout/js/jquery-1.10.2.min.js"></script> 
		<link rel="shortcut icon" href="favicon.png"/>
		<link href="sales-css/bootstrap.min.css" rel="stylesheet" media="screen"> 
	</head>
<body>
<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th><center>No</center></th>
			<th><center>Nama Nasabah</center></th>
			<th><center>Nama Cabang</center></th>
			<!--<th><center>Persetujuan Pengalihan Mutasi Bayar dan Pinjaman</center></th>-->
			<th><center>Nominal Kredit (outstanding bukopin)</center></th>
			<!--<th><center>No Perjanjian Kredit</center></th>-->
			<th><center>No Rekening Pinjaman</center></th>
			<th><center>No Rekening Affiliasi</center></th>
			<th><center>Angsuran ( Pokok + Bunga ) </center></th>
			<th><center>Npp/Fronting Pengakuan<center></th>
			<!--<th><center>Keterangan<center></th>-->
			<!--<th><center>Tanggal</center></th>-->
			<!--<th style="width:35px;"><center>AKSI</center></th>-->
		</tr>
	</thead>
	<tbody>
    <?php 
        $i = 1;
        $jml_per_halaman = 20;
        $jml_data = mssql_num_rows(mssql_query("SELECT * FROM ( SELECT id_report,ROW_NUMBER() OVER (ORDER BY nama_nasabah ASC) AS ROWNUM,nama_nasabah,persetujuan_pengalihan,nominal,no_perjanjian,no_rekening,no_rekening_affiliasi,angsuran,keterangan,id_cabang,ket,tgl_update,npp,perusahaan,outstanding
												FROM report_tl where ket='2' and persetujuan_pengalihan='1' ) AS a  
												LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang =  'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
												"));
        $jml_halaman = ceil($jml_data / $jml_per_halaman);
       

	if($_SESSION['user_level']==1||$_SESSION['user_level']==2) 
	  {
		
        if(isset($_POST['cari'])) {
            $kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mssql_query("SELECT * FROM ( SELECT id_report,ROW_NUMBER() OVER (ORDER BY nama_nasabah ASC) AS ROWNUM,nama_nasabah,persetujuan_pengalihan,nominal,no_perjanjian,no_rekening,no_rekening_affiliasi,angsuran,keterangan,id_cabang,ket,tgl_update,npp,perusahaan,outstanding
											FROM report_tl where ket='2' and persetujuan_pengalihan='1' ) AS a  
											LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang =  'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
                WHERE a.nama_nasabah LIKE '%$kunci%'
                OR a.no_perjanjian LIKE '%$kunci%'
				OR a.no_rekening_affiliasi LIKE '%$kunci%'
				OR a.angsuran LIKE '%$kunci%'
                OR a.no_rekening LIKE '%$kunci%'
				OR c.nama_cabang LIKE '%$kunci%'
				OR a.tgl_update LIKE '%$kunci%'
            ");
			
        // query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query("SELECT * FROM ( SELECT id_report,ROW_NUMBER() OVER (ORDER BY nama_nasabah ASC) AS ROWNUM,nama_nasabah,persetujuan_pengalihan,nominal,no_perjanjian,no_rekening,no_rekening_affiliasi,angsuran,keterangan,id_cabang,ket,tgl_update,npp,perusahaan,outstanding
												FROM report_tl where ket='2' and persetujuan_pengalihan='1' ) AS a  
												LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang =  'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
												WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY nama_nasabah ASC");
        // query ketika tidak ada parameter halaman maupun pencarian
        } else {
			 $halaman = 1;
			 $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query("SELECT * FROM ( SELECT id_report,ROW_NUMBER() OVER (ORDER BY nama_nasabah ASC) AS ROWNUM,nama_nasabah,persetujuan_pengalihan,nominal,no_perjanjian,no_rekening,no_rekening_affiliasi,angsuran,keterangan,id_cabang,ket,tgl_update,npp,perusahaan,outstanding
												FROM report_tl where ket='2' and persetujuan_pengalihan='1' ) AS a  
												LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang =  'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
												WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY nama_nasabah ASC");
            $halaman = 1; //tambahan
        }
		
	}
	elseif($_SESSION['user_level']==7) 
	{
		
		 if(isset($_POST['cari'])) {
            $kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mssql_query("
               SELECT * FROM ( SELECT id_report,ROW_NUMBER() OVER (ORDER BY nama_nasabah ASC) AS ROWNUM,nama_nasabah,persetujuan_pengalihan,nominal,no_perjanjian,no_rekening,no_rekening_affiliasi,angsuran,keterangan,id_cabang,ket,tgl_update,npp,perusahaan,outstanding
												FROM report_tl where ket='2' and persetujuan_pengalihan='1'  and id_cabang='$_SESSION[id_cabang]) AS a  
												LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang =  'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
                WHERE a.nama_nasabah LIKE '%$kunci%'
                OR a.no_perjanjian LIKE '%$kunci%'
                OR a.no_rekening LIKE '%$kunci%'
				OR c.nama_cabang LIKE '%$kunci%'
				OR a.tgl_update LIKE '%$kunci%'
            ");
			
        // query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query("SELECT * FROM ( SELECT id_report,ROW_NUMBER() OVER (ORDER BY nama_nasabah ASC) AS ROWNUM,nama_nasabah,persetujuan_pengalihan,nominal,no_perjanjian,no_rekening,no_rekening_affiliasi,angsuran,keterangan,id_cabang,ket,tgl_update,npp,perusahaan,outstanding
												FROM report_tl where ket='2' and persetujuan_pengalihan='1' and id_cabang='$_SESSION[id_cabang]') AS a  
												LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang =  'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
												WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY nama_nasabah ASC");
        // query ketika tidak ada parameter halaman maupun pencarian
        } else {
			 $halaman = 1;
			 $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query("SELECT * FROM ( SELECT id_report,ROW_NUMBER() OVER (ORDER BY nama_nasabah ASC) AS ROWNUM,nama_nasabah,persetujuan_pengalihan,nominal,no_perjanjian,no_rekening,no_rekening_affiliasi,angsuran,keterangan,id_cabang,ket,tgl_update,npp,perusahaan,outstanding
												FROM report_tl where ket='2' and persetujuan_pengalihan='1'  and id_cabang='$_SESSION[id_cabang]' ) AS a  
												LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang =  'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
												WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY nama_nasabah ASC");
            $halaman = 1; //tambahan
        }
		
	}
		
        // tampilkan data mahasiswa selama masih ada
        while($data = mssql_fetch_array($query)) {
			$nominal=number_format($data['outstanding'],0,",",".");
			$angsuran=number_format($data['angsuran'],0,",",".");
			$tgl = date('d-m-Y',strtotime($data['tgl_update']));
			if($data['persetujuan_pengalihan']==1) {
                $pp = "Ya";	
            }
			elseif($data['persetujuan_pengalihan']==2) {
                $pp = "Tidak";
            }
			
			if($data['perusahaan']==1) {
					$perusahaan = "BSR";	
				}elseif($data['perusahaan']==2) {
				   $perusahaan = "TAS";	
				}elseif($data['perusahaan']==3) {
				   $perusahaan = "MKSA";	
				}elseif($data['perusahaan']==4) {
				   $perusahaan = "ETS";	
				}else
				{
				   $perusahaan = "";	
				}
			
?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $data['nama_nasabah']?></td>
        <td><?php echo $data['nama_cabang']?></td>
		<!--<td><center><?php echo $pp ?></center></td>-->
        <td>Rp.<?php echo  $nominal;?></td>
        <!--<td><?php echo $data['no_perjanjian'] ?></td>-->
		<td><?php echo $data['no_rekening'] ?></td>
		<td><?php echo $data['no_rekening_affiliasi'] ?></td>
		<td>Rp.<?php echo  $angsuran;?></td>
			<?if($data['npp']>0) {
			?>
			<td><?php echo $data['npp'] ?></td>
			<?
			}
			elseif($data['npp']==0) {
              ?>
			<td><?php echo $perusahaan ?></td>
			<?
            }
			?>
		<!--<td><?php echo $data['keterangan'] ?></td>-->
		<!--<td><?php echo $tgl ?></td>-->
        <!--<td><center>
            <a href="#dialog-report" id="<?php echo $data['id_report'] ?>" class="ubah" data-toggle="modal">
                <i class="icon-pencil"></i>
            </a></center>
        </td>
		 <td><center><a href="index.php?page=32a&id=<?php echo $data['id_report']; ?>" class="btn">EDIT</a></center></td>-->
    </tr>
    <?php
        $i++;
        }
    ?>
</tbody>
</table>
 
<?php if(!isset($_POST['cari'])) { ?>
<!-- untuk menampilkan menu halaman -->
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
 
<script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>
</body>
</html>
