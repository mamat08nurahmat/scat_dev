<?php
// panggil berkas koneksi.php
require 'koneksi.php';
 
// buat koneksi ke database mysql
//koneksi_buka();
include('koneksi.php');
 
?>
 
<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
<thead>
    <tr>
        <th style="width:20px">NPP</th>
        <th style="width:120px">ID_GROUP</th>
        <th style="width:120px">ID_VENDOR</th>
        <th style="width:120px">ID_CABANG</th>
        <th style="width:120px">NAMA</th>
        <th style="width:120px">TANGGAL LAHIR</th>
        <th style="width:120px">STATUS</th>
        <th style="width:120px">ID_USER_ATASAN</th>
        <th style="width:120px">ID_USER_LEADER</th>
        <th style="width:120px">GRADE</th>
        <th style="width:120px">ALAMAT</th>
        <th style="width:120px">TELEPON</th>
        <th style="width:120px">KETERANGAN</th>
        <th style="width:120px">TANGGAL AKTIF</th>
        <th style="width:120px">TANGGAL RESIGN</th>
        <th style="width:120px">TANGGAL BUAT</th>
        <th style="width:120px">AKSI</th>
    </tr>
</thead>
<tbody>
    <?php 
        $i = 1;
        $jml_per_halaman = 5; // jumlah data yg ditampilkan perhalaman
        $jml_data = mssql_num_rows(mssql_query("SELECT * FROM sales"));
        $jml_halaman = ceil($jml_data / $jml_per_halaman);
        // query pada saat mode pencarian
        if(isset($_POST['cari'])) {
            $kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mssql_query("
                SELECT * FROM sales
                WHERE npp LIKE '%$kunci%'
                OR nama LIKE '%$kunci%'
                OR alamat LIKE '%$kunci%'
                OR status LIKE '%$kunci%'
            ");
        // query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
            $query = mssql_query("SELECT * FROM sales LIMIT 0 ".(($halaman - 1) * $jml_per_halaman).", $jml_per_halaman");
			//$query="SELECT * FROM SomeTable LIMIT 10 OFFSET 10 ORDER BY SomeColumn ";
        // query ketika tidak ada parameter halaman maupun pencarian
        } else {
            $query = mssql_query("SELECT * FROM sales");
            $halaman = 1; //tambahan
        }
         
        // tampilkan data mahasiswa selama masih ada
        while($data = mssql_fetch_array($query)) {
    ?>
    <tr>
        <td><?php echo $data['npp']; ?></td>
        <td><?php echo $data['id_grup']; ?></td>
        <td><?php echo $data['id_vendor']; ?></td>
        <td><?php echo $data['id_cabang']; ?></td>
        <td><?php echo $data['nama']; ?></td>
        <td><?php echo $data['tanggal_lahir']; ?></td>
        <td><?php echo $data['status']; ?></td>
        <td><?php echo $data['id_user_atasan']; ?></td>
        <td><?php echo $data['id_user_leader']; ?></td>
        <td><?php echo $data['grade']; ?></td>
        <td><?php echo $data['alamat']; ?></td>
        <td><?php echo $data['telepon']; ?></td>
        <td><?php echo $data['keterangan'];?></td>
        <td><?php echo $data['tanggal_aktif']; ?></td>
        <td><?php echo $data['tanggal_resign']; ?></td>
        <td><?php echo $data['tanggal_buat']; ?></td>

        <td>
            <a href="#dialog-mahasiswa" id="<?php echo $data['npp'] ?>" class="ubah" data-toggle="modal">
                <i class="icon-pencil"></i>
            </a>
            <a href="#" id="<?php echo $data['npp'] ?>" class="hapus">
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
 
<?php if(!isset($_POST['cari'])) { ?>
<!-- untuk menampilkan menu halaman -->
<div class="pagination pagination-right">
  <ul>
    <?php

    // tambahan
    // panjang pagig yang akan ditampilkan
    $no_hal_tampil = 5; // lebih besar dari 3

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
 