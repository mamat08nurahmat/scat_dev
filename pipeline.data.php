<?php
session_start();
$masuk=$_SESSION['username'];
$level=$_SESSION['user_level'];
if($level==8 || $level==9 || $level==11)
{
	$cek_npp = " npp ='$masuk'";
}
else
{
	
}
include('include/config.php');

?>
 
<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
<thead>
    <tr style='background:#7CFC00'>
         <th><center>No</center></th>
         <th><center>Npp</center></th>
        <th><center>Nama Prospek</center></th> 
        <th><center>Periode</center></th>
        <th><center>Telp</center></th>
		<th><center>Produk</center></th>
        <th><center>Nominal</center></th>
        <th><center>Developer/Institusi</center></th>
        <th><center>Keterangan</center></th>
    </tr>
</thead>
<tbody>
    <?php 
        $i = 1;
        $jml_per_halaman = 20; // jumlah data yg ditampilkan perhalaman
        $jml_data = mssql_num_rows(mssql_query("SELECT * FROM pipeline where $cek_npp"));
        $jml_halaman = ceil($jml_data / $jml_per_halaman);
        
		if(isset($_POST['halaman'])) 
		{
					$halaman = $_POST['halaman'];
					$i = ($halaman - 1) * $jml_per_halaman  + 1;
					$query = mssql_query("SELECT * FROM 
										(
										SELECT id_pipeline,npp,ROW_NUMBER() OVER (ORDER BY tgl_input DESC) AS ROWNUM,upper(nama_prospek) as nama_prospek,periode,no_telp,produk,nominal,upper(developer) as developer,keterangan,tgl_input,YEAR(tgl_input) as year, MONTH(tgl_input) as month
										FROM pipeline where $cek_npp
										) a
										WHERE a.month=MONTH(getdate()) and a.year=YEAR(getdate())");
        } 
		else 
		{		
					 $halaman = 1;
					 $i = ($halaman - 1) * $jml_per_halaman  + 1;
					$query = mssql_query("SELECT * FROM 
										(
										SELECT id_pipline,npp,ROW_NUMBER() OVER (ORDER BY tgl_input DESC) AS ROWNUM,upper(nama_prospek) as nama_prospek,periode,no_telp,produk,nominal,upper(developer) as developer,keterangan,tgl_input,YEAR(tgl_input) as year, MONTH(tgl_input) as month
										FROM pipeline where $cek_npp
										) a
										 WHERE a.month=MONTH(getdate()) and a.year=YEAR(getdate())");
					$halaman = 1; //tambahan
        }
        // tampilkan data mahasiswa selama masih ada
        while($data = mssql_fetch_array($query)) {
			//type sales
			if($data['produk']==1) {
                $produk = "Fleksi";
            }
			elseif($data['produk']==2) {
                $produk = "Griya";
            }
			elseif($data['produk']==3) {
                $produk = "BKP";
            }
    ?>
    <tr>
        <td><font style="font-size:80%;"><?php echo $i ?></font></td>
		<td><font style="font-size:80%;"><?php echo $data['npp'] ?></font></td>
        <td><font style="font-size:80%;"><?php echo $data['nama_prospek'] ?></font></td>
        <td><font style="font-size:80%;"><?php echo $data['periode'] ?></font></td>
        <td><font style="font-size:80%;"><?php echo $data['no_telp'] ?></font></td>
        <td><font style="font-size:80%;"><?php echo $produk ?></font></td>
       <!-- <td><?php echo $data['nominal'] ?></td>-->
		<td><font style="font-size:80%;">Rp. <?php echo number_format($data['nominal']) ?></font></td>
        <td><font style="font-size:80%;"><?php echo $data['developer'] ?></font></td>
        <td><font style="font-size:80%;"><?php echo $data['keterangan'] ?></font></td>
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
   
    <?php } ?>
  </ul>
</div>
<?php } ?>
 
