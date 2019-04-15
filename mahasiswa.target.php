<script>
function hapus(npp)
{
	var urls='delete.php?npp='+npp;
	//alert(urls);
	window.location.replace(urls);
}

</script>
<?php
// panggil berkas koneksi.php
//require('include/config.php');
 
// buat koneksi ke database mssql
include('include/config.php');
 
?>
 
<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
<thead>
    <tr>
        <th>No</th>
        <th>NPP</th> 
        <th>Grup</th>
        <th>Region</th>
		<th>Nama</th>
        <th>Vendor</th>
        <th>Grade</th>
		<th>Delete</th>
    </tr>
</thead>
<tbody>
    <?php 
        $i = 1;
        $jml_per_halaman = 20; // jumlah data yg ditampilkan perhalaman
        $jml_data = mssql_num_rows(mssql_query("SELECT * FROM sales_target"));
        $jml_halaman = ceil($jml_data / $jml_per_halaman);
        // query pada saat mode pencarian
        if(isset($_POST['cari'])) {
            $kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mssql_query("
                SELECT * FROM sales a LEFT JOIN app_user_grup b on a.id_grup = b.id_grup 
										LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
										LEFT JOIN area d on c.id_area=d.id_area
                WHERE npp LIKE '%$kunci%'
                OR nama LIKE '%$kunci%'
                OR alamat LIKE '%$kunci%'
                OR status LIKE '%$kunci%'
            ");
        // query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query("SELECT DISTINCT z.npp,a.kd_npp,a.ROWNUM,a.id_grup,a.id_cabang,a.nama,a.id_vendor,a.id_user_atasan,a.grade,a.id_grup,
									b.is_sales,b.id_grup_atasan,c.kode_cabang,c.id_area,c.nama_cabang,c.id_area,d.nama_area,d.kode_area 
									FROM sales_target z
										LEFT JOIN 
											(
												SELECT kd_npp,ROW_NUMBER() OVER (ORDER BY npp) AS ROWNUM,npp,id_grup,id_cabang,nama,id_vendor,id_user_atasan,grade,tanggal_resign
												FROM SALES where id_grup in (8,9,11)
											) AS a ON a.npp = z.npp
										LEFT JOIN app_user_grup b on a.id_grup = b.id_grup 
										LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
										LEFT JOIN area d on c.id_area=d.id_area
									WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY NPP DESC");
        // query ketika tidak ada parameter halaman maupun pencarian
        } else {
            //$query = mssql_query("SELECT * FROM sales");
			 $halaman = 1;
			 $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query("SELECT DISTINCT z.npp,a.kd_npp,a.ROWNUM,a.id_grup,a.id_cabang,a.nama,a.id_vendor,a.id_user_atasan,a.grade,a.id_grup,
									b.is_sales,b.id_grup_atasan,c.kode_cabang,c.id_area,c.nama_cabang,c.id_area,d.nama_area,d.kode_area 
									FROM sales_target z
										LEFT JOIN 
											(
												SELECT kd_npp,ROW_NUMBER() OVER (ORDER BY npp) AS ROWNUM,npp,id_grup,id_cabang,nama,id_vendor,id_user_atasan,grade,tanggal_resign
												FROM SALES where id_grup in (8,9,11)
											) AS a ON a.npp = z.npp
										LEFT JOIN app_user_grup b on a.id_grup = b.id_grup 
										LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
										LEFT JOIN area d on c.id_area=d.id_area
									WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY NPP DESC");
			
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
			if($data['status']==1) {
                $status = "Aktif";
            }
			elseif($data['status']==2) {
                $status = "Resign";
            }
			elseif($data['status']==3) {
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
			if($data['id_grup']==8) {
                $sales_type = "fleksi";
            }
			elseif($data['id_grup']==9) {
                $sales_type = "lending";
            }
			elseif($data['id_grup']==11)	{
				$sales_type = "BKP";
			}
			
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $data['npp'] ?></td>
        <td><?php echo $sales_type ?></td>
        <td><?php echo $data['nama_area'] ?></td>
        <td><?php echo $data['nama'] ?></td>
        <td><?php echo $id_vendor ?></td>
		<td><?php echo $grade ?></td>
		<td><center><button onclick='hapus(<?php echo $data['npp'];?>)'>Delete</button></center></td>
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
 
