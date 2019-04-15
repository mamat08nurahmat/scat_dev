<?php
require_once 'C:\xampp\htdocs\html\include/config.php';

$npp = $_GET['npp'];

$query = "DELETE FROM sales WHERE npp='$npp'";
$result = mssql_query($query) or die(mysql_error());

mssql_close();

header('Location:../../index.php?page=10');


?>