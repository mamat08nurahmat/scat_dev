<?php
session_start();
    include './koneksi.php';
    $kode_leads = $_POST['id_leads'];
    $barang=mssql_query("update leads set status='2',aksi='1', npp='$_SESSION[username]' where id_leads='$kode_leads'");
    header('location:index.php?page=30');
?>

