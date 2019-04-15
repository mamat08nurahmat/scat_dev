<?php
session_start();
include('include/config.php');
?>
<?php
		$i = 1;
        $jml_per_halaman = 20;
        $jml_data = mssql_num_rows(mssql_query("select * from( SELECT id,ROW_NUMBER() OVER (ORDER BY id) AS ROWNUM,id_cabang,nama_prospek,produk,nominal_pengajuan,tgl_input FROM leads where is_expired=1 and ket=7 ) AS a 
									LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
									LEFT JOIN area d on c.id_area=d.id_area "));
        $jml_halaman = ceil($jml_data / $jml_per_halaman);

	if($_SESSION['user_level']==1 || $_SESSION['user_level']==2 )
	{
		 if(isset($_POST['cari_exp'])) {
            $kunci = $_POST['cari_exp'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mssql_query("	select * from( SELECT id,ROW_NUMBER() OVER (ORDER BY id) AS ROWNUM,id_cabang,nama_prospek,produk,nominal_pengajuan,tgl_input FROM leads where is_expired=1 and ket=7 ) AS a 
									LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
									LEFT JOIN area d on c.id_area=d.id_area
				WHERE a.nama_prospek LIKE '%$kunci%'
                OR c.nama_cabang LIKE '%$kunci%'
                OR a.nominal_pengajuan LIKE '%$kunci%'
				OR a.produk LIKE '%$kunci%'
				OR a.tgl_input LIKE '%$kunci%'
            ");
			
        // query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query("select * from( SELECT id,ROW_NUMBER() OVER (ORDER BY id) AS ROWNUM,id_cabang,nama_prospek,produk,nominal_pengajuan,tgl_input FROM leads where is_expired=1 and ket=7 ) AS a 
									LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
									LEFT JOIN area d on c.id_area=d.id_area 
									WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY a.tgl_input DESC");
        
		// query ketika tidak ada parameter halaman maupun pencarian
        } else {
			 $halaman = 1;
			 $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query("select * from( SELECT id,ROW_NUMBER() OVER (ORDER BY id) AS ROWNUM,id_cabang,nama_prospek,produk,nominal_pengajuan,tgl_input FROM leads where is_expired=1 and ket=7) AS a 
									LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
									LEFT JOIN area d on c.id_area=d.id_area 
									WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY a.tgl_input DESC");
            $halaman = 1; //tambahan
        }									
?>
	<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
	<thead>
		<tr>	
			<th><center>NO</center></th>
			<th><center>CABANG</center></th>
			<th><center>NPP</center></th>
			<th><center>NAMA PROSPEK</center></th>
			<th><center>PRODUK</center></th>
			<th><center>NOMINAL PENGAJUAN</center></th>
			<th><center>AKSI</center></th>	
		</tr>
	</thead>
	<body>
        <?php
            $no = 1;
            while($data = mssql_fetch_array($query)){
				$nominal=number_format($data['nominal_pengajuan'],0,",",".");
        ?>
        <tr bgcolor="<?php echo $color ; ?>">
			<td><?php echo $no ?></td>
            <td><?php echo $data["nama_cabang"];?></td>
			<td><?php echo $data["npp"];?></td>
			<td><?php echo $data["nama_prospek"];?></td>
			<td><?php echo $data["produk"];?></td>
			<td>Rp.<?php echo  $nominal;?></td>
            <td><a href="index.php?page=29j&id=<?php echo $data['id']; ?>" class="btn">view</a></td>
	   </tr>
        <?php $no++; } ?>
    </table>
<?php
	}
	elseif($_SESSION['user_level'] == 6||$_SESSION['user_level']==7 || $_SESSION['user_level'] == 8 || $_SESSION['user_level'] == 9 || $_SESSION['user_level'] == 11 || $_SESSION['user_level'] == 12)
	{
	 if(isset($_POST['cari_exp'])) {
            $kunci = $_POST['cari_exp'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mssql_query("select * from( SELECT id,ROW_NUMBER() OVER (ORDER BY id) AS ROWNUM,id_cabang,nama_prospek,produk,nominal_pengajuan,tgl_input FROM leads where is_expired=1 and ket=7 and id_cabang='$_SESSION[id_cabang]' ) AS a 
									LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
									LEFT JOIN area d on c.id_area=d.id_area 
				WHERE a.nama_prospek LIKE '%$kunci%'
                OR c.nama_cabang LIKE '%$kunci%'
                OR a.nominal_pengajuan LIKE '%$kunci%'
				OR a.produk LIKE '%$kunci%'
				OR a.tgl_input LIKE '%$kunci%'
            ");
			
        // query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query("select * from( SELECT id,ROW_NUMBER() OVER (ORDER BY id) AS ROWNUM,id_cabang,nama_prospek,produk,nominal_pengajuan,tgl_input FROM leads where is_expired=1 and ket=7 and id_cabang='$_SESSION[id_cabang]' ) AS a 
									LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
									LEFT JOIN area d on c.id_area=d.id_area 
									WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY a.tgl_input DESC");
        
		// query ketika tidak ada parameter halaman maupun pencarian
        } else {
			 $halaman = 1;
			 $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query("select * from( SELECT id,ROW_NUMBER() OVER (ORDER BY id) AS ROWNUM,id_cabang,nama_prospek,produk,nominal_pengajuan,tgl_input FROM leads where is_expired=1 and ket=7 and id_cabang='$_SESSION[id_cabang]' ) AS a 
									LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
									LEFT JOIN area d on c.id_area=d.id_area 
									WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY a.tgl_input DESC");
            $halaman = 1; //tambahan
        }
		?>
	
	<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th><center>NO</center></th>
			<th><center>CABANG</center></th>
			<th><center>NPP</center></th>
			<th><center>NAMA NASABAH</center></th>
			<th><center>PRODUK</center></th>
			<th><center>NOMINAL PENGAJUAN</center></th>
			<th><center>AKSI</center></th>
		</tr>
	</thead>
	<body>
        <?php if(mssql_num_rows($query)>0){ ?>
        <?php
            $no = 1;
            while($data = mssql_fetch_array($query)){
				$nominal=number_format($data['nominal_pengajuan'],0,",",".");
        ?>
        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $data["nama_cabang"];?></td>
			 <td><?php echo $data["npp"];?></td>
			<td><?php echo $data["nama_prospek"];?></td>
			<td><?php echo $data["produk"];?></td>
			<td>Rp.<?php echo  $nominal;?></td>
            <td><a href="index.php?page=29j&id=<?php echo $data['id']; ?>" class="btn">view</a></td>
		<td><center><input type="checkbox" onClick="setChecks(this)" name="pilih[]" value="<?php echo $data['id']; ?>" disabled ></center><td>
       
		</tr>
        <?php $no++; } ?>
        <?php } ?>
    </table>
<?php
	}
?>
<?php if(!isset($_POST['cari_exp'])) { ?>
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
