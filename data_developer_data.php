<?php
session_start();
include('include/config.php');
?>
<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
<thead>
  <tr bgcolor='#666666' align='center'>
		<th><font color='white'><center>NO</center></font></th>
		<th><font color='white'><center>Nama Developer</center></font></th>
		<th><font color='white'><center>Wilayah</center></font></th>
		<th><font color='white'><center>Project Developer</center></font></th>
		<th><font color='white'><center>Tanggal Mulai</center></font></th>
		<th><font color='white'><center>Tanggal Berakhir</center></font></th>
		<th><font color='white'><center>Status</center></font></th>
		<th style="width:45px;"><font color='white'><center>Aksi</center></font></th>
	</tr>
</thead>
<tbody>
    <?php 
        $i = 1;
        $jml_per_halaman = 20; 
        $jml_data = mssql_num_rows(mssql_query("SELECT * FROM data_developer"));
        $jml_halaman = ceil($jml_data / $jml_per_halaman);
		// query pada saat mode pencarian
		
		if($_SESSION['user_level']==1||$_SESSION['user_level']==2)
		{	
        if(isset($_POST['cari_dev'])) {
            $kunci = $_POST['cari_dev'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mssql_query("SELECT * FROM data_developer a 
								LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang
								LEFT JOIN area d on c.id_area=d.id_area 
								WHERE a.nama_sales LIKE '%$kunci%'
								OR a.npp LIKE '%$kunci%'
								OR a.nama_developer LIKE '%$kunci%'
								OR c.nama_cabang LIKE '%$kunci%'
               
								");
        
		// query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query("SELECT * FROM ( select id_developer,ROW_NUMBER() OVER (ORDER BY id_developer DESC) AS ROWNUM, npp,nama_sales,nama_developer,project_developer,alamat_developer,id_cabang,jml_unit,sisa_unit,tanggal_mulai,tanggal_berakhir,status_developer,keterangan,tgl_input
									from data_developer)As a 
									LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
									LEFT JOIN area d on c.id_area=d.id_area
									WHERE  a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY status_developer,tanggal_mulai ASC ");
        
		// query ketika tidak ada parameter halaman maupun pencarian
        } else {
			 $halaman = 1;
			 $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query("SELECT * FROM ( select id_developer,ROW_NUMBER() OVER (ORDER BY id_developer DESC) AS ROWNUM, npp,nama_sales,nama_developer,project_developer,alamat_developer,id_cabang,jml_unit,sisa_unit,tanggal_mulai,tanggal_berakhir,status_developer,keterangan,tgl_input
									from data_developer)As a 
									LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
									LEFT JOIN area d on c.id_area=d.id_area
									WHERE  a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY status_developer,tanggal_mulai ASC 
								");
            $halaman = 1; //tambahan
        }
		
		}
		elseif($_SESSION['user_level']==8||$_SESSION['user_level']==9||$_SESSION['user_level']==11)
		{
			if(isset($_POST['cari_dev'])) {
            $kunci = $_POST['cari_dev'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mssql_query("SELECT * FROM data_developer a 
								LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang
								LEFT JOIN area d on c.id_area=d.id_area 
								WHERE a.nama_sales LIKE '%$kunci%'
								OR a.npp LIKE '%$kunci%'
								OR a.nama_developer LIKE '%$kunci%'
								OR c.nama_cabang LIKE '%$kunci%'
               
								");
        
		// query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query("SELECT * FROM ( select id_developer,ROW_NUMBER() OVER (ORDER BY id_developer DESC) AS ROWNUM, npp,nama_sales,nama_developer,project_developer,alamat_developer,id_cabang,jml_unit,sisa_unit,tanggal_mulai,tanggal_berakhir,status_developer,keterangan,tgl_input
									from data_developer where npp='$_SESSION[npp]')As a 
									LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
									LEFT JOIN area d on c.id_area=d.id_area
									WHERE  a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY status_developer,tanggal_mulai ASC ");
        
		// query ketika tidak ada parameter halaman maupun pencarian
        } else {
			 $halaman = 1;
			 $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query("SELECT * FROM ( select id_developer,ROW_NUMBER() OVER (ORDER BY id_developer DESC) AS ROWNUM, npp,nama_sales,nama_developer,project_developer,alamat_developer,id_cabang,jml_unit,sisa_unit,tanggal_mulai,tanggal_berakhir,status_developer,keterangan,tgl_input
									from data_developer where npp='$_SESSION[npp]')As a 
									LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
									LEFT JOIN area d on c.id_area=d.id_area
									WHERE  a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY status_developer,tanggal_mulai ASC 
								");
            $halaman = 1; //tambahan
        }
			
			
			
		}
		
        // tampilkan data mahasiswa selama masih ada
        while($data = mssql_fetch_array($query)) {
			
		if($_SESSION['user_level']==8||$_SESSION['user_level']==9||$_SESSION['user_level']==11)
		{
			if($data['status_developer']==2) {
                $status = "NON AKTIF";
				$tombol =""; 
				$tombol .="<center><a class='icon-search' href='index.php?page=8c&id=".$data['id_developer']."'></a></center>"; 
				$color = "";	
				$color .= '#FF6347';	
            }
			elseif($data['status_developer']==1) {
                $status = "AKTIF";
				$tombol ="";
				$tombol .="<a class='icon-pencil' href='index.php?page=8b&id=".$data['id_developer']."'></a>|";	
				$tombol .="<a class='icon-search' href='index.php?page=8c&id=".$data['id_developer']."'></a>";
				$color 	 = 'white';
            }
			
	}
	else
	{
	if($data['status_developer']==2) {
                $status = "NON AKTIF";
				$tombol =""; 
				$tombol .="<center><a class='icon-search' href='index.php?page=8c&id=".$data['id_developer']."'></a></center>"; 
				$color = "";	
				$color .= '#FF6347';	
            }
			elseif($data['status_developer']==1) {
                $status = "AKTIF";
				$tombol ="";
				$tombol .="<center><a class='icon-search' href='index.php?page=8c&id=".$data['id_developer']."'></a></center>";
				$color 	 = 'white';
            }
	}
	
    ?>
   <tr >
			<td><font color='black'><?php echo $i++; ?></font></td>
			<td><font color='black'><?php echo $data['nama_developer']; ?></font></td>
			<td><font color='black'><?php echo $data['nama_cabang']; ?></font></td>
			<td><font color='black'><?php echo $data['project_developer']; ?></font></td>
			<?php $format=date('d-m-Y',strtotime($data['tanggal_mulai'])); ?>
			<td><center><font color='black'><?php echo $format; ?></font></center></td>
			<?php $format1=date('d-m-Y',strtotime($data['tanggal_berakhir'])); ?>
			<td><center><font color='black'><?php echo $format1; ?></font></center></td>
			<td><center><font color='black'><?php echo $status; ?></font></center></td>
			<td><?=$tombol;?></td>
		</tr>
    <?php
        
        }
    ?>
</tbody>
</table>
 
<?php if(!isset($_POST['cari_dev'])) { ?>
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
