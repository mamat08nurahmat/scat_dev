<?php
session_start();
include('include/config.php');
?>
	<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="images/add2.png"/>
<title>S.C.A.T</title>
<meta name="viewport" content="width=device-width, maximum-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!--<link href="aset-tabel/assets/css/bootstrap.min.css" rel="stylesheet">-->
<link href="aset-layout/style/common.css" rel="stylesheet">
<link href="aset-layout/style/style.css" rel="stylesheet">
<link href="aset-layout/style/color.css" rel="stylesheet">
<link href="aset-layout/style/slider.css" rel="stylesheet">
<link href="aset-layout/style/responsive.css" rel="stylesheet">
<script src="aset-layout/js/jquery-1.10.2.min.js"></script> 
<link rel="shortcut icon" href="favicon.png"/>
<link href="sales-css/bootstrap.min.css" rel="stylesheet" media="screen"> 
<!--<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>-->

</head>

<body>

<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
<thead>
    <tr>
        <th><center>No</center></th>
        <th><center>NPP</center></th> 
        <th><center>TIPE</center></th>
        <th><center>CABANG</center></th>
		<th><center>NAMA</center></th>
        <th><center>VENDOR</center></th>
        <th><center>PENYELIA</center></th>
        <th><center>GRADE</center></th>
        <th><center>STATUS</center></th>
        <th style="width:35px;"><center>AKSI</center></th>
    </tr>
</thead>
<tbody>
    <?php 
        $i = 1;
        $jml_per_halaman = 20; // jumlah data yg ditampilkan perhalaman
        $jml_data = mssql_num_rows(mssql_query("SELECT * FROM (
								SELECT kd_npp,ROW_NUMBER() OVER (ORDER BY npp DESC) AS ROWNUM,npp,id_grup,id_cabang,nama,id_vendor,id_user_atasan,grade,tanggal_resign,status_sales
								FROM sales_penyelia where id_grup in (8,9,11) and id_user_atasan='$_SESSION[npp]' and status_sales='1'
								) AS a  LEFT JOIN app_user_grup b on a.id_grup = b.id_grup LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang =  'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
							"));
        $jml_halaman = ceil($jml_data / $jml_per_halaman);
        // query pada saat mode pencarian
        if(isset($_POST['cari'])) {
            $kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mssql_query("
               SELECT * FROM 
								(
								SELECT kd_npp,ROW_NUMBER() OVER (ORDER BY npp DESC) AS ROWNUM,npp,id_grup,id_cabang,nama,id_vendor,id_user_atasan,grade,tanggal_resign,status_sales
								FROM sales_penyelia where id_grup in (8,9,11) and id_user_atasan='$_SESSION[npp]' and status_sales='1'
								) AS a  LEFT JOIN app_user_grup b on a.id_grup = b.id_grup LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang =  'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
				WHERE npp LIKE '%$kunci%'
                OR nama LIKE '%$kunci%'
                OR alamat LIKE '%$kunci%'
                OR status LIKE '%$kunci%'
            ");
        // query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query("SELECT * FROM 
								(
								SELECT kd_npp,ROW_NUMBER() OVER (ORDER BY npp DESC) AS ROWNUM,npp,id_grup,id_cabang,nama,id_vendor,id_user_atasan,grade,tanggal_resign,status_sales
								FROM sales_penyelia where id_grup in (8,9,11) and status_sales='5'
								) AS a  LEFT JOIN app_user_grup b on a.id_grup = b.id_grup LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang =  'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
							WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY npp DESC");
        // query ketika tidak ada parameter halaman maupun pencarian
        } else {
            //$query = mssql_query("SELECT * FROM sales");
			 $halaman = 1;
			 $i = ($halaman - 1) * $jml_per_halaman  + 1;
			//$query = mssql_query("SELECT * FROM sales a LEFT JOIN app_user_grup b on a.id_grup = b.id_grup LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE ATASAN_CABANG = 0) c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area order by npp asc OFFSET ".(($halaman - 1) * $jml_per_halaman)." ROWS FETCH NEXT $jml_per_halaman ROWS ONLY");
			$query = mssql_query("SELECT * FROM 
								(
								SELECT kd_npp,ROW_NUMBER() OVER (ORDER BY npp DESC) AS ROWNUM,npp,id_grup,id_cabang,nama,id_vendor,id_user_atasan,grade,tanggal_resign,status_sales
								FROM sales_penyelia where id_grup in (8,9,11) and status_sales='5'
								) AS a  LEFT JOIN app_user_grup b on a.id_grup = b.id_grup LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
								WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY npp DESC");
            $halaman = 1; //tambahan
        }
        // tampilkan data mahasiswa selama masih ada
        while($data = mssql_fetch_array($query)) {
            if($data['id_vendor']==1) {
                $id_vendor = "PPU";
            } 
			elseif($data['id_vendor']==2) {
                $id_vendor = "AOS";
            }
			elseif($data['id_vendor']==3) {
                $id_vendor = "PERMATA";
            }
			elseif($data['id_vendor']==4) {
				$id_vendor = "PERDANA PERKASA ELASTINDO";
			}
			// status sales
			if($data['status_sales']==1) {
                $status = "Aktif";
            }
			elseif($data['status_sales']==5) {
                $status = "Resign";
            }
			elseif($data['status_sales']==3) {
                $status = "Cancel";
            }
			elseif($data['status_sales']==4) {
                $status = "Cuti";
            }
			//grade sales
			if($data['grade']==3) {
                $grade = "Trainee";
            }
			elseif($data['grade']==4) {
                $grade = "Level 1";
            }
			elseif($data['grade']==5) {
                $grade = "Level 2";
            }
			elseif($data['grade']==6) {
                $grade = "Level 3";
            }
			
			//type sales
			if($data['sales_type']==1) {
                $sales_type = "fleksi";
            }
			elseif($data['sales_type']==2) {
                $sales_type = "lending";
            }
			
    ?>
    <tr>
        <td><?php echo $i ?></td>
		<?php
		if($data['id_grup']==8||$data['id_grup']==9)
		{
		?>
        <td><?php echo "SC",$data['npp'] ?></td>
		<?php
		}
		elseif($data['id_grup']==12)
		{
		?>
		<td><?php echo "SD",$data['npp'] ?></td>
		<?php
		}
		?>
        <td><?php echo $data['nama_grup']?></td>
        <td><?php echo $data['nama_cabang'] ?></td>
        <td><?php echo $data['nama'] ?></td>
        <td><?php echo $id_vendor ?></td>
		<td><?php echo $data['id_user_atasan'] ?></td>
		  <td><?php echo $grade ?></td>
		  <td><?php echo $status ?></td>
		   <!--<td><?php echo $data['tanggal_aktif'] ?></td>-->
        <td><center>
            <a href="#dialog-penyelia" id="<?php echo $data['kd_npp'] ?>" class="ubah" data-toggle="modal">
                <i class="icon-pencil"></i>
            </a></center>
        </td>
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

    // tambahan
    // panjang pagig yang akan ditampilkan
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
 
 <script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>


</body>
</html>
