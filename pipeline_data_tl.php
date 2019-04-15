<?php
session_start();
include('include/config.php');
?>
<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
<thead>
    <tr>
		<th><center>No</center></th>
		<th><center>Nama</center></th>
        <th><center>Nominal</center></th> 
        <th><center>Produk</center></th>
        <th><center>Tanggal Input</center></th>
		<th><center>Aksi</center></th>
    </tr>
</thead>
<tbody>
    <?php 
        $i = 1;
        $jml_per_halaman = 20; // jumlah data yg ditampilkan perhalaman
        $jml_data = mssql_num_rows(mssql_query("SELECT * FROM pipeline_vendor"));
        $jml_halaman = ceil($jml_data / $jml_per_halaman);
        if(isset($_POST['cari'])) {
            $kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mssql_query("
                SELECT * FROM pipeline_vendor 
                WHERE nama LIKE '%$kunci%'
                OR nominal LIKE '%$kunci%'
                OR produk LIKE '%$kunci%'
                OR tgl_input LIKE '%$kunci%'
            ");
        // query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query(" select * from( SELECT id_pipeline,ROW_NUMBER() OVER (ORDER BY id_pipeline) AS ROWNUM,nama,nominal,produk,tgl_input FROM pipeline_vendor ) AS a 
									WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY tgl_input DESC");
        // query ketika tidak ada parameter halaman maupun pencarian
        } else {
            //$query = mssql_query("SELECT * FROM sales");
			 $halaman = 1;
			 $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query(" select * from( SELECT id_pipeline,ROW_NUMBER() OVER (ORDER BY id_pipeline) AS ROWNUM,nama,nominal,produk,tgl_input FROM pipeline_vendor ) AS a 
									WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY tgl_input DESC");
			
			$halaman = 1; //tambahan
        }
        // tampilkan data mahasiswa selama masih ada
        while($data = mssql_fetch_array($query)) {	
			$nominal=number_format($data['nominal'],2,",",".");	
			$tgl = date('d-m-Y',strtotime($data['tgl_input']));			
    ?>
    <tr>
        <td><center><?php echo $i++; ?><center></td>
        <td><?php echo $data['nama'] ?></td>
        <td><?php echo $nominal ?></td>
		<td><?php echo $data['produk'] ?></td>	
        <td><center><?php echo $tgl ?></center></td> 
		 <?php
			if($_SESSION['user_level']==10)
			{
		?>
			<td><center><a class="btn" onclick="return tanya()" href="pipeline_hapus.php?id=<?php echo $data['id_pipeline']; ?>">Delete</a></center></td>
		<?php
			}
			elseif($_SESSION['user_level']==1 || $_SESSION['user_level']==17)
			{
		?>
			<td><center><a class="btn" href="index.php?page=16b&id=<?php echo $data['id_pipeline']; ?>">Edit</a></center></td>
		<?php	
			}
		?>
	</tr>
    
	<?php
        }
    ?>
</tbody>
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
<script language="javascript">
 function tanya() {
 if (confirm ("Apakah Anda yakin akan menghapus data ini ?")) {
 return true;
  } else {
   return false;
  }
  }
</script>
