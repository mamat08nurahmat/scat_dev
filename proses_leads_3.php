<?php
    include './koneksi.php';
    $kode_leads = $_POST['id_leads'];
    $namma    = $_POST['nama_prospek'];
    $alamat   = $_POST['alamat'];
	$hasil_status = $_POST['status'];
	$tanggal = date('d M Y H:i');
	$ketku = $_POST['ket'];
    $barang=  mssql_query("update leads set nama_prospek='$namma', alamat='$alamat',status = '$hasil_status', input_elo = '$tanggal',ket = '$ketku' where id_leads='$kode_leads'");
    header('location:index.php?page=30#tab-2');
?>

