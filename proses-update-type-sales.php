<?php
$npp = $_GET['npp'];
$id_grup = $_GET['id_grup'];
include ('include/config.php');
$querya="UPDATE sales SET id_grup = '$id_grup' WHERE npp = '$npp'";
						
						mssql_query($querya);
						
?>
<script> 
		alert('UPDATE <?php echo "$npp" ?> SUKSES');
		window.location.replace("index.php?page=21"); </script>
