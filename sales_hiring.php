<?php
session_start();
include('include/config.php');
$kd_npp = $_POST['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>scat</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="favicon.png"/>
	<link href="sales-css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/style-popup.css" rel="stylesheet">
</head>

<body>
<div align="center" style="border:1px solid;background-color:#00BFFF"><strong><p>FORM VENDOR</strong></p></div><br>

	<div class="row" style="width:98%;margin-left:10px;">	
		<h3>
			<!-- textbox untuk pencarian -->
			<div class="input-prepend pull-right">
				<span class="add-on"><i class="icon-search"></i></span>
				<input class="span2" id="prependedInput" type="text" name="cari_data" placeholder="Pencarian All...">
				
			</div>
			<?php
				if($_SESSION['user_level']==10 || $_SESSION['user_level']==1)
				{
			?>
					<div id="closed"></div>
					<a href="#popup"class="btn tambah"><i class="icon-plus"></i> Tambah data</a>
					<div class="popup" id="popup">
					<div style="width:300px"class="popup-container">
						<form action="index.php?page=10g" method="post">
							<tr><td><input type="text" value='' style="height:30px" name="cari" maxlength="16" placeholder="check no_ktp" onkeypress="return hanyaAngka(event)" ></td>
								<td><input type="submit" onclick="return validasi_input(form)"  value="CHECK"></td></tr>
							<a class="popup-close" href="#closed">x</a>
						</form>
					</div>
					</div>
			<?php } ?>
		</h3>
	</div>
		<div class="pull-right">
			<td><a href="uploads/komitmen.pdf" class="btn " download>Download Komitmen Do's & Don'ts</a></td><br>	
		</div>
		
		<div id="data-hiring"></div>

	
<script type="text/javascript">
function validasi_input(form){
  var mincar = 16;
  if (form.cari.value.length < mincar){
    alert("Input Number Minimal 16 Karater!");
    form.cari.focus();
    return (false);
  }
   return (true);
}

function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script>

 
<script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>
<script src="aplikasi.hiring.js"></script>
</body>
</html>
