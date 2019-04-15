
<?php
include('include/config.php');
if(isset($_POST['submit'])){
	
//echo "<script>alert('POST');</script>";
//print_r($_POST);	
$tahun_libur = $_POST['tahun_libur'];
$tgl_libur = $_POST['tgl_libur'];
$sql = "INSERT INTO tanggal_libur (tahun,tanggal)
VALUES ('$tahun_libur', '$tgl_libur')";

$insert = mssql_query($sql);
if($insert){
echo "<script>alert('SAVE');</script>";
	
}else{
echo "<script>alert('GAGAL');</script>";
	
}

}
?>
  <div class="container">

<form action="index.php?page=libur" method="POST">

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
<script>
$('.date').datepicker({
  multidate: true,
	format: 'dd-mm-yyyy'
});
</script>