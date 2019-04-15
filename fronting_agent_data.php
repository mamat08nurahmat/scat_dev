<?php 
session_start();
include('include/config.php');
$query = mssql_query ("SELECT id_perusahaan,nama_perusahaan FROM perusahaan ");
$arrpropinsi = array();
while ($row = mssql_fetch_array($query)) {
	$arrpropinsi [ $row['id_perusahaan'] ] = $row['nama_perusahaan'];
}
		
?>
<body>
<form method="post" action="proses_input_perusahaan.php">
 <div class="pull-right">
			<select id="propinsi" class="required" name="nama_perusahaan" required>
				<option value="<?php echo $nama_perusahaan ?>"><?php echo $nama_perusahaan ?></option>
				<?php
				foreach ($arrpropinsi as $kode=>$nama_perusahaan) {
					echo "<option value='$nama_perusahaan'>$nama_perusahaan</option>";
				}
				?>
				</select></th>

		<input type="submit" name="PILIH" value="PILIH"><br><br>
	</div>
<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
<thead>
	<tr bgcolor='#666666' align='center'>
		<th><font color='white'><center>NO</center></font></th>
		<th><font color='white'><center>NPP</center></font></th>
		<th><font color='white'><center>Nama Cabang</center></font></th>
		<th><font color='white'><center>No Aplikasi</center></font></th>
        <th><font color='white'><center>Nama Nasabah</center></font></th>
		<th><font color='white'><center>Tanggal Booking</center></font></th>
		<th><font color='white'><center>Nominal <p>(Dalam bentuk Juta)</p></center></font></th>
		<th style="width:45px;"><font color='white'><center>Aksi</center></font></th>
		
	</tr>
 
	<?php
		$i=1;
        $jml_per_halaman = 20;
        $jml_data = mssql_num_rows(mssql_query("SELECT * FROM data_booking"));
        $jml_halaman = ceil($jml_data / $jml_per_halaman);
		if(isset($_POST['cari'])){
		$kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
			$query_mssql = mssql_query(" 
				SELECT * FROM  (SELECT id,npp,ROW_NUMBER() OVER (ORDER BY id DESC) AS ROWNUM,no_aplikasi,id_cabang,nama_nasabah,tanggal_booking,net_booking,nominal,nama_perusahaan FROM data_booking where nama_perusahaan is NULL )AS a 
								LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang
								LEFT JOIN perusahaan d on a.nama_perusahaan=d.nama_perusahaan
				WHERE npp LIKE '%$kunci%'
				OR nama_nasabah LIKE '%$kunci%'
				OR nama_cabang LIKE '%$kunci%'
                OR tanggal_booking LIKE '%$kunci%'
				OR net_booking LIKE '%$kunci%'
                OR nominal LIKE '%$kunci%'
                OR no_aplikasi LIKE '%$kunci%'");
			} elseif(isset($_POST['halaman'])) {
			$halaman = $_POST['halaman'];
			
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
           $query_mssql = mssql_query("SELECT * FROM  (
										SELECT id,npp,ROW_NUMBER() OVER (ORDER BY id DESC) AS ROWNUM,no_aplikasi,id_cabang,nama_nasabah,tanggal_booking,net_booking,nominal,nama_perusahaan FROM data_booking where nama_perusahaan is NULL )AS a 
										LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang
										LEFT JOIN perusahaan d on a.nama_perusahaan=d.nama_perusahaan 
										WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY a.nama_perusahaan ASC ");
			} else {
			 $halaman = 1;
			 $i = ($halaman - 1) * $jml_per_halaman  + 1;
			 $query_mssql = mssql_query("SELECT * FROM  (
										  SELECT id,npp,ROW_NUMBER() OVER (ORDER BY id DESC) AS ROWNUM,no_aplikasi,id_cabang,nama_nasabah,tanggal_booking,net_booking,nominal,nama_perusahaan FROM data_booking where nama_perusahaan is NULL )AS a 
										  LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang
										  LEFT JOIN perusahaan d on a.nama_perusahaan=d.nama_perusahaan
										  WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY a.nama_perusahaan ASC  ");
			$halaman = 1;
        }
		while($data = mssql_fetch_array($query_mssql)){
			$net_booking=number_format($data['net_booking'],2,",",".");
			$nominal=number_format($data['nominal'],2,",",".");
			if($data['nama_perusahaan']==null) {
			$color = 'white';	
			}else{
			$color = '#7FFFD4';
			}	
	?>
		<tr>
			<td><font color='black'><?php echo $i++ ; ?></font></td>
			<td><font color='black'><?php echo $data['npp']; ?></font></td>
			<td><font color='black'><?php echo $data['nama_cabang']; ?></font></td>
			<td><font color='black'><?php echo $data['no_aplikasi']; ?></font></td>
			<td><font color='black'><?php echo $data['nama_nasabah']; ?></font></td>
			<?php $format=date('d-m-Y',strtotime($data['tanggal_booking'])); ?>
			<td><font color='black'><?php echo $format; ?></font></td>
			<td><font color='black'>Rp. <?php echo $nominal; ?></font>
			<p><font color='black'>Rp. <?php echo $net_booking; ?></font></p>
			</td>
			<td><center><a class="icon-pencil" href="index.php?page=30d&id=<?php echo $data['id']; ?>"></a>
						<input type="checkbox" name="pilih[]" onClick="setChecks(this)" value="<?php echo $data['id']; ?>"></center>
			</td>
		</tr>
		<?php } ?>
	</table>
	
<?php if(!isset($_POST['cari'])) { ?>
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