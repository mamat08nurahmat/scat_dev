<?php
include('include/config.php');
?>
 
<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
<thead>
    <tr>
        <th style="width:30px;"><center>No</center></th>
        <th style="width:200px;"><center>JUDUL</center></th> 
        <th><center>ISI</center></th>
        <th style="width:80px;"><center>TANGGAL</center></th>
		<th style="width:80px;"><center>STATUS</center></th>
        <th style="width:35px;"><center>AKSI</center></th>
    </tr>
</thead>
<tbody>
    <?php 
        $i = 1;
        $jml_per_halaman = 5;
        $jml_data = mssql_num_rows(mssql_query("SELECT * FROM berita"));
        $jml_halaman = ceil($jml_data / $jml_per_halaman);
		 if(isset($_POST['cari'])) {
            $kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mssql_query("
                SELECT * FROM berita
                WHERE judul LIKE '%$kunci%'
                OR isi LIKE '%$kunci%'
                OR tanggal LIKE '%$kunci%'
                OR aksi LIKE '%$kunci%'
            ");
        // query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query("SELECT * FROM 
								(
								SELECT id_berita,ROW_NUMBER() OVER (ORDER BY tanggal DESC) AS ROWNUM,judul,substring (isi,1,50) as isi,tanggal,aksi
								FROM berita
								) AS a
								WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman)");
        } else {
			 $halaman = 1;
			 $i = ($halaman - 1) * $jml_per_halaman  + 1;
			$query = mssql_query("SELECT * FROM 
								(
								SELECT id_berita,ROW_NUMBER() OVER (ORDER BY tanggal DESC) AS ROWNUM,judul,substring (isi,1,50) as isi,tanggal,aksi
								FROM berita
								) AS a
								WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman)");
            $halaman = 1;
        }
        while($data = mssql_fetch_array($query)) {
			$tgl= date('d M Y H:i',strtotime($data['tanggal']));
			if($data['aksi']==1) {
                $aksi = "aktif";
            }
			elseif($data['aksi']==2) {
                $aksi = "non-aktif";
            }
			
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $data['judul'] ?></td>
        <td><?php echo $data['isi'] ?>...</td>
        <td><center><?php echo $tgl ?></td>
        <td><center><?php echo $aksi ?></center></td>
        <td>
            <a href="#dialog-berita" id="<?php echo $data['id_berita'] ?>" class="ubah" data-toggle="modal">
                <i class="icon-pencil"></i>
            </a>
			 <a href="#" id="<?php echo $data['id_berita'] ?>" class="hapus">
                <i class="icon-trash"></i>
            </a>
			
			
        </td>
    </tr>
    <?php
        $i++;
        }
    ?>
</tbody>
</table>
 
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

<script language="javascript">
 function tanya() {
 if (confirm ("Apakah Anda yakin akan menghapus data ini ?")) {
 return true;
  } else {
   return false;
  }
  }
</script>