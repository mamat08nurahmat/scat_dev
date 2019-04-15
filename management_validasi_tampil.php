<script>
function aprove(npp)
{
	var urls='create.php?npp='+npp;
	//alert(urls);
	window.location.replace(urls);
}
</script>
<?php
session_start();
// buat koneksi ke database mssql
include('include/config.php');
 
?>
 
<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
<thead>
    <tr>
        <th><center>NO</center></th>
        <th><center>NPP</center></th> 
        <th><center>TIPE</center></th>
        <th><center>WILAYAH</center></th>
		<th><center>NAMA</center></th>
        <th><center>VENDOR</center></th>
        <th><center>PENYELIA</center></th>
        <th><center>GRADE</center></th>
        <th><center>STATUS</center></th>
        <th style="width:35px;"><center>AKSI</center></th>
		<th><center>KET.</center></th>
		
    </tr>
</thead>
<tbody>
    <?php 
        $i = 1;
        $jml_per_halaman = 20; // jumlah data yg ditampilkan perhalaman
		
        // query pada saat mode pencarian
        if(isset($_POST['cari'])) {
			if($_SESSION[user_level]==10)
		{
			$where_vendor = "and id_vendor = ".$_SESSION[id_vendor];
		}
            $kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mssql_query("
                SELECT * FROM temp_sales a LEFT JOIN app_user_grup b on a.id_grup = b.id_grup LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang ='KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
                WHERE npp LIKE '%$kunci%'
                OR nama LIKE '%$kunci%'
                OR alamat_1 LIKE '%$kunci%'
                OR status LIKE '%$kunci%'
				$where_vendor
            ");
        // query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
			if($_SESSION[user_level]==10)
		{
			$where_vendor = "and id_vendor = ".$_SESSION[id_vendor];
		}
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query("SELECT * FROM 
								(
								SELECT kd_npp,ROW_NUMBER() OVER (ORDER BY npp) AS ROWNUM,npp,id_grup,id_cabang,nama,id_vendor,id_user_atasan,grade,tanggal_resign,ket_tolak
							FROM temp_sales where id_grup in (8,9,11) and ket in (1) $where_vendor
								) AS a  LEFT JOIN app_user_grup b on a.id_grup = b.id_grup LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang='KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
							WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman)");
        // query ketika tidak ada parameter halaman maupun pencarian
        } else {
			if($_SESSION[user_level]==10)
		{
			$where_vendor = "and id_vendor = ".$_SESSION[id_vendor];
		}
            //$query = mssql_query("SELECT * FROM sales");
			 $halaman = 1;
			 $i = ($halaman - 1) * $jml_per_halaman  + 1;
			//$query = mssql_query("SELECT * FROM sales a LEFT JOIN app_user_grup b on a.id_grup = b.id_grup LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE ATASAN_CABANG = 0) c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area order by npp asc OFFSET ".(($halaman - 1) * $jml_per_halaman)." ROWS FETCH NEXT $jml_per_halaman ROWS ONLY");
			$query = mssql_query("SELECT * FROM 
								(
								SELECT kd_npp,ROW_NUMBER() OVER (ORDER BY npp) AS ROWNUM,npp,id_grup,id_cabang,nama,id_vendor,id_user_atasan,grade,tanggal_resign,status_sales,ket,ket_tolak
								FROM temp_sales where id_grup in (8,9,11) and ket in (1) $where_vendor 
								) AS a  LEFT JOIN app_user_grup b on a.id_grup = b.id_grup LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang ='KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
								WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) order by a.npp desc");
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
			// status sales
			if($data['status_sales']==1) {
                $status = "Aktif";
            }
			elseif($data['status_sales']==2) {
                $status = "Resign";
            }
			elseif($data['status_sales']==3) {
                $status = "Cancel";
            }
			//grade sales
			if($data['grade']==4) {
                $grade = "Trainee";
            }
			elseif($data['grade']==5) {
                $grade = "Junior";
            }
			elseif($data['grade']==6) {
                $grade = "Senior";
            }
			
			//type sales
			if($data['sales_type']==1) {
                $sales_type = "fleksi";
            }
			elseif($data['sales_type']==2) {
                $sales_type = "lending";
            }
			
			//type ket
			if($data['ket']==1) {
                $ket = "waiting validasi";
            }
			elseif($data['ket']==2) {
                $ket = "waiting approve";
            }
			elseif($data['ket']==4) {
                $ket = "<a href='#dialog-validasi' id=".$i." class='get_ket' data-toggle='modal'><font color='red'>cancel</font></a>";
            }	
			
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $data['npp'] ?></td>
        <td><?php echo $data['nama_grup'] ?></td>
        <td><?php echo $data['nama_area'] ?></td>
        <td><?php echo $data['nama'] ?></td>
        <td><?php echo $id_vendor ?></td>
		<td><?php echo $data['id_user_atasan'] ?></td>
		 <td><?php echo $grade ?></td>
		  <td><?php echo $status ?></td>
		   <!--<td><?php echo $data['tanggal_aktif'] ?></td>-->
        <td>
            <a href="#dialog-mahasiswa" id="<?php echo $data['kd_npp'] ?>" class="ubah" data-toggle="modal">
                <i class="icon-pencil"></i>
            </a>
			
            <a href="#" id="<?php echo $data['kd_npp'] ?>" class="hapus">
                <i class="icon-trash"></i>
            </a>
			
        </td>
		<input type='hidden' name='kettol<?php echo $i?>' id='kettol<?php echo $i?>' value='<?php echo $data['ket_tolak'] ?>'>
		<td><center><?php echo $ket ?></td>
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
 
