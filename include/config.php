<?php
error_reporting(0);
$host="(local)"; //deklarasi variabel
$user="sa"; 
$password="BNI@2014"; 
$database="APPSC_NEW_DEV"; 




//$database="APPSC_NEW"; 
//$host="DESKTOP-DL4Q2FD"; //deklarasi variabel
//$user="sa"; 
//$password="bi5millah"; 
//$database="APPSC_NEW_DEV"; 

//sambungkan ke database
$con = mssql_connect($host, $user, $password );
//$koneksi=mysql_connect($host,$user,$password); 

//memilih database yang akan dipakai
$select_db = mssql_select_db($database,$con);
//$select_db = mysql_select_db($database, $con);

if($con !== false && $select_db !== false) {  //cek koneksi 
//echo "berhasil koneksi"; 
}else{ 
    echo "koneksi ke database mysql gagal karena : ";
    exit();
} 
?>
