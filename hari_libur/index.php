<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Bootstrap Multi Select Date Picker</title>
  
  
  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>

      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>

<?php

if(isset($_POST['submit'])){
	
	//echo "<script>alert('POST');</script>";
	//print_r($_POST);
/*
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
*/	
//include '../include/config.php';


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

/*

$tahun_libur = $_POST['tahun_libur'];
$tgl_libur = $_POST['tgl_libur'];

$sql = "INSERT INTO tanggal_libur (tahun,tanggal)
VALUES ('$tahun_libur', '$tgl_libur')";

if (mysqli_query($conn, $sql)) {
	
//    echo "New record created successfully";
echo "<script>alert('Data save');</script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);	

mysql_query($sql);	

header('location:index.php');
*/
	
}

?>


  <div class="container">

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

    <div class="form-group">
     <label for="comment">Tahun Libur:</label>
	 <input type="text" name="tahun_libur" class="form-control" placeholder="Tahun Libur">
    </div>

	  
    <div class="form-group">
     <label for="comment">Tanggal Libur:</label>
	 <input type="text" name="tgl_libur" class="form-control date" placeholder="Tanggal Libur">
    </div>
	
	 <button type="submit" value="Submit" name="submit" class="btn btn-default">Submit</button>
	 
  </form>
	
	
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js'></script>

  

    <script  src="js/index.js"></script>




</body>

</html>
