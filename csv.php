<html>
<html>
<head>
<title>Upload CSV FILE</title>
</head>
<body>
<?php
include ('include/config.php');
if (isset($_POST['submit'])) {
//Script Upload File..
    if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
        echo "<h1>" . "File ". $_FILES['filename']['name'] ." Berhasil di Upload" . "</h1>";
        echo "<h2>Menampilkan Hasil Upload:</h2>";
        readfile($_FILES['filename']['tmp_name']);
    }
    //Import uploaded file to Database, Letakan dibawah sini..
    $handle = fopen($_FILES['filename']['tmp_name'], "r");
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $import="insert into lending (no_aplikasi,nama_nasabah,nama_produk,nominal,npp,id_produk,bulan,tahun)
			values
			('$data[0]','$data[1]','$data[3]',CONVERT (bignint,'$data[4]'),'$data[5]','$data[6]','$data[7]','$data[8]')
			"; //data array sesuaikan dengan jumlah kolom pada CSV anda mulai dari “0” bukan “1”
        mssql_query($import) or die(mssql_get_last_message()); //Melakukan Import
    }
    fclose($handle); //Menutup CSV file
    echo "
<strong>Import data selesai.</strong>";
}else { //Jika belum menekan tombol submit, form dibawah akan muncul.. ?>
<!-- Form Untuk Upload File CSV-->
   Silahkan masukan file csv yang ingin diupload
  
   <form enctype='multipart/form-data' action='' method='post'>
    Cari CSV File anda:
 
 <input type='file' name='filename' size='100'>
   <input type='submit' name='submit' value='Upload'></form>
<?php } mssql_close(); //Menutup koneksi SQL?>
</body>
</html>