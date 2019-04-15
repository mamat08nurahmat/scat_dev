<?php
	session_destroy();	
	unset($_SESSION[username]);
	unset($_SESSION[password]);
	unset($_SESSION[namauser]);
	unset($_SESSION[userlevel]);
?>
<script> window.location.replace("login.php");</script>