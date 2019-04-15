<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<link href="../assets/css/bootstrap.css" rel="stylesheet">
		<link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
		<!------datepicker------------->
		<link type="text/css" rel="stylesheet" href="development-bundle/themes/ui-lightness/ui.all.css" />
		<script src="development-bundle/jquery-1.8.0.min.js"></script>
		<script src="development-bundle/ui/ui.core.js"></script>
		<script src="development-bundle/ui/ui.datepicker.js"></script>
		<script src="development-bundle/ui/i18n/ui.datepicker-id.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#tanggal_aktif").datepicker({
					dateFormat : "yy/mm/dd",
					changeMonth : true,
					changeYear : true
				});
			});
		</script>
		<!----------------------------->
		<!--	<link href="../assets/css/docs.css" rel="stylesheet"> -->

		<script type="text/javascript" src="../assets/js/jquery.js"></script>
		<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>

		<!-- <link href="../assets/img/favicon.png" rel="shortcut icon" /> -->

		<!-- MENAMBAHKAN NIVO SLIDER -->
		<link rel="stylesheet" href="../assets/css/default.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="../assets/css/nivo-slider.css" type="text/css" media="screen" />
		<script src="../assets/js/nivo.slider.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(window).load(function() {
				$('#slider').nivoSlider();
			});
		</script>
		
		<script type="text/javascript" src="../assets/js/jquery.validate.js"></script>
		<script type="text/javascript" src="../assets/js/messages_id.js"></script>
		
		
		<!-- AKHIR NIVO SLIDER -->
	</head>
	
			
	
