<?php
    include './koneksi.php';
    $leads = $_POST['id_leads'];
    $barang=mssql_query("delete from leads where id_leads='$leads'");
    header('location:index.php');
?>

