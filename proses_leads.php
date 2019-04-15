<?php
    include './koneksi.php';
    $kode_leads = $_POST['id_leads'];
    $namma    = $_POST['nama_prospek'];
    $alamat   = $_POST['alamat'];
	$hasil_status = $_POST['status'];
	$tanggal = date('d M Y H:i');
	$nominalku = $_POST['nominal'];
	$ketku = $_POST['ket'];
	$aksiku = $_POST['aksi'];

    $barang=  mssql_query("update leads set nama_prospek='$namma', alamat='$alamat',status = '$hasil_status', kolek_data = '$tanggal',
							nominal = '$nominalku', ket = '$ketku', aksi = '$aksiku'
							where id_leads='$kode_leads'");
    header('location:index.php?page=30#tab-2');
?>

