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
		 <th><center>Nama Perusahaan</center></th>
		<th><center>Aksi</center></th>
    </tr>
</thead>
<tbody>
    <?php 
        $i = 1;
        $jml_per_halaman = 20; 
        $jml_data = mssql_num_rows(mssql_query("SELECT * FROM pipeline_vendor"));
        $jml_halaman = ceil($jml_data / $jml_per_halaman);
	if($_SESSION['user_level']==1||$_SESSION['user_level']==2) 
	{
        if(isset($_POST['cari'])) {
            $kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mssql_query("select * from( SELECT id_pipeline,ROW_NUMBER() OVER (ORDER BY id_pipeline) AS ROWNUM,nama,nominal,produk,tgl_input,id_perusahaan FROM pipeline_vendor where ket=1 ) AS a join perusahaan b on  a.id_perusahaan=b.id_perusahaan  
				WHERE nama LIKE '%$kunci%'
                OR nominal LIKE '%$kunci%'
                OR produk LIKE '%$kunci%'
                OR tgl_input LIKE '%$kunci%'
            ");
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query(" select * from( SELECT id_pipeline,ROW_NUMBER() OVER (ORDER BY id_pipeline) AS ROWNUM,nama,nominal,produk,tgl_input,id_perusahaan FROM pipeline_vendor where ket=1 ) AS a join perusahaan b on  a.id_perusahaan=b.id_perusahaan 
									WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY a.tgl_input DESC");
        } else {
			 $halaman = 1;
			 $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query(" select * from( SELECT id_pipeline,ROW_NUMBER() OVER (ORDER BY id_pipeline) AS ROWNUM,nama,nominal,produk,tgl_input,id_perusahaan FROM pipeline_vendor where ket=1 ) AS a join perusahaan b on  a.id_perusahaan=b.id_perusahaan  
									WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY a.tgl_input DESC");
			
			$halaman = 1;
        }
	}
	elseif($_SESSION['user_level']==7) 
	{	
	 if(isset($_POST['cari'])) {
            $kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mssql_query("select * from( SELECT id_pipeline,ROW_NUMBER() OVER (ORDER BY id_pipeline) AS ROWNUM,nama,nominal,produk,tgl_input,id_perusahaan,id_cabang FROM pipeline_vendor where ket=1 and id_cabang='$_SESSION[id_cabang]' ) AS a join perusahaan b on  a.id_perusahaan=b.id_perusahaan  
				WHERE nama LIKE '%$kunci%'
                OR nominal LIKE '%$kunci%'
                OR produk LIKE '%$kunci%'
                OR tgl_input LIKE '%$kunci%'
            ");
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query(" select * from( SELECT id_pipeline,ROW_NUMBER() OVER (ORDER BY id_pipeline) AS ROWNUM,nama,nominal,produk,tgl_input,id_perusahaan,id_cabang FROM pipeline_vendor where ket=1 and id_cabang='$_SESSION[id_cabang]' ) AS a join perusahaan b on  a.id_perusahaan=b.id_perusahaan 
									WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY a.tgl_input DESC");
        } else {
			 $halaman = 1;
			 $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query(" select * from( SELECT id_pipeline,ROW_NUMBER() OVER (ORDER BY id_pipeline) AS ROWNUM,nama,nominal,produk,tgl_input,id_perusahaan,id_cabang FROM pipeline_vendor where ket=1 and id_cabang='$_SESSION[id_cabang]' ) AS a join perusahaan b on  a.id_perusahaan=b.id_perusahaan  
									WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY a.tgl_input DESC");
			
			$halaman = 1;
        }
		
	}
	elseif($_SESSION['user_level']==15) 
	{
		 if(isset($_POST['cari'])) {
            $kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mssql_query("select * from( SELECT id_pipeline,ROW_NUMBER() OVER (ORDER BY id_pipeline) AS ROWNUM,nama,nominal,produk,tgl_input,id_perusahaan,nama_pemproses FROM pipeline_vendor where ket=1 and nama_pemproses='$_SESSION[namauser]' ) AS a join perusahaan b on  a.id_perusahaan=b.id_perusahaan  
				WHERE nama LIKE '%$kunci%'
                OR nominal LIKE '%$kunci%'
                OR produk LIKE '%$kunci%'
                OR tgl_input LIKE '%$kunci%'
            ");
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query(" select * from( SELECT id_pipeline,ROW_NUMBER() OVER (ORDER BY id_pipeline) AS ROWNUM,nama,nominal,produk,tgl_input,id_perusahaan,nama_pemproses FROM pipeline_vendor where ket=1 and nama_pemproses='$_SESSION[namauser]' ) AS a join perusahaan b on  a.id_perusahaan=b.id_perusahaan 
									WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY a.tgl_input DESC");
        } else {
			 $halaman = 1;
			 $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query(" select * from( SELECT id_pipeline,ROW_NUMBER() OVER (ORDER BY id_pipeline) AS ROWNUM,nama,nominal,produk,tgl_input,id_perusahaan,nama_pemproses FROM pipeline_vendor where ket=1 and nama_pemproses='$_SESSION[namauser]') AS a join perusahaan b on  a.id_perusahaan=b.id_perusahaan  
									WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY a.tgl_input DESC");
			
			$halaman = 1;
        }
	}elseif($_SESSION['user_level']==14) 
	{
		 if(isset($_POST['cari'])) {
            $kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mssql_query("select * from( SELECT id_pipeline,ROW_NUMBER() OVER (ORDER BY id_pipeline) AS ROWNUM,nama,nominal,produk,tgl_input,id_perusahaan,nama_pemproses FROM pipeline_vendor where ket=1 and id_perusahaan='$_SESSION[id_perusahaan]' ) AS a join perusahaan b on  a.id_perusahaan=b.id_perusahaan  
				WHERE nama LIKE '%$kunci%'
                OR nominal LIKE '%$kunci%'
                OR produk LIKE '%$kunci%'
                OR tgl_input LIKE '%$kunci%'
            ");
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query(" select * from( SELECT id_pipeline,ROW_NUMBER() OVER (ORDER BY id_pipeline) AS ROWNUM,nama,nominal,produk,tgl_input,id_perusahaan,nama_pemproses FROM pipeline_vendor where ket=1 and id_perusahaan='$_SESSION[id_perusahaan]' ) AS a join perusahaan b on  a.id_perusahaan=b.id_perusahaan 
									WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY a.tgl_input DESC");
        } else {
			 $halaman = 1;
			 $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query(" select * from( SELECT id_pipeline,ROW_NUMBER() OVER (ORDER BY id_pipeline) AS ROWNUM,nama,nominal,produk,tgl_input,id_perusahaan,nama_pemproses FROM pipeline_vendor where ket=1 and id_perusahaan='$_SESSION[id_perusahaan]' ) AS a join perusahaan b on  a.id_perusahaan=b.id_perusahaan  
									WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY a.tgl_input DESC");
			
			$halaman = 1;
        }
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
		<td><?php echo $data['nama_perusahaan'] ?></td>
		 <?php
			if($_SESSION['user_level']==15)
			{
		?>	<!-- pipeline update data-->
			<td><center><a class='icon-pencil' href="index.php?page=16d&id=<?php echo $data['id_pipeline']; ?>"></a> |
			<!-- pipeline hapus-->
			<a class='icon-trash' onclick="return tanya()" href="pipeline_hapus.php?id=<?php echo $data['id_pipeline']; ?>"></a></center></td>
		<?php
			}
			elseif($_SESSION['user_level']==1 || $_SESSION['user_level']==7)
			{
		?>	<!-- pipeline update tl-->
			<td><center><a class="btn" href="index.php?page=16b&id=<?php echo $data['id_pipeline']; ?>">Edit</a></center></td>
		<?php
			}
			elseif($_SESSION['user_level']==14 ||$_SESSION['user_level']==2)
			{
		?>	<!-- pipeline update tl-->
			<td><center><a class="btn" href="index.php?page=16e&id=<?php echo $data['id_pipeline']; ?>">view</a></center></td>
		
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
