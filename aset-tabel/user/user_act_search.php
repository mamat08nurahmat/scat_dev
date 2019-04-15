<?php
require_once '../inc/config.php';

$npp = $_POST['npp'];

$query = "SELECT * FROM sales WHERE npp LIKE '%$npp%'";
$result = mssql_query($query) or die(mysql_error());

mysql_close();

if ($result > 0) {
	header('Location:user_form_view.php');
}
?>