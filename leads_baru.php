<?php
session_start();
include('include/config.php');
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link type="text/css" rel="stylesheet" href="css/responsive-tabs.css" />
    <link type="text/css" rel="stylesheet" href="css/style-tabs.css" />
	<script src="js/jquery-2.1.0.min.js"></script>
	<script src="js/gulpfile.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
	if($_SESSION['user_level']==8||$_SESSION['user_level']==9||$_SESSION['user_level']==11||$_SESSION['user_level']==12)
	{
?>
<?php 
	$bucket = mssql_query("SELECT COUNT(*) AS total FROM leads where  id_cabang='$_SESSION[id_cabang]' and ket=1 ");
	$buc 	= mssql_fetch_assoc($bucket);
	$b 		= $buc['total'];
	
	$chart 	= mssql_query("SELECT COUNT(*) AS total1 FROM cart where npp='$_SESSION[npp]' and ket=2");
	$cha 	= mssql_fetch_assoc($chart);
	$c		= $cha['total1'];
	
	$follow = mssql_query("SELECT COUNT(*) AS total2 FROM cart where npp='$_SESSION[npp]' and ket=3");
	$fol 	= mssql_fetch_assoc($follow);
	$f		= $fol['total2'];
	
	$closing = mssql_query("SELECT COUNT(*)AS total3  FROM cart where npp='$_SESSION[npp]' and ket=4");
	$clos 	 = mssql_fetch_assoc($closing);
	$cl		 = $clos['total3'];
	
	$expired = mssql_query("SELECT COUNT(*)AS total4  FROM leads where id_cabang='$_SESSION[id_cabang]' and is_expired=1 and ket=7");
	$exp	 = mssql_fetch_assoc($expired);
	$ex		 = $exp['total4'];

?>
<?php
	}
	elseif($_SESSION['user_level'] == 6 ||$_SESSION['user_level']==7)
	{
?>
<?php 
	$bucket = mssql_query("SELECT COUNT(*) AS total FROM leads where id_cabang='$_SESSION[id_cabang]' and ket=1 and sumber_data='upload'");
	$buc 	= mssql_fetch_assoc($bucket);
	$b 		= $buc['total'];
	
	$chart 	= mssql_query("SELECT COUNT(*) AS total1 FROM cart where id_user_atasan='$_SESSION[npp]' and ket=2");
	$cha 	= mssql_fetch_assoc($chart);
	$c		= $cha['total1'];
	
	$follow = mssql_query("SELECT COUNT(*) AS total2 FROM cart where id_user_atasan='$_SESSION[npp]' and ket=3");
	$fol 	= mssql_fetch_assoc($follow);
	$f		= $fol['total2'];
	
	$closing = mssql_query("SELECT COUNT(*)AS total3  FROM cart where id_user_atasan='$_SESSION[npp]' and ket=4");
	$clos 	 = mssql_fetch_assoc($closing);
	$cl		 = $clos['total3'];
	
	$expired = mssql_query("SELECT COUNT(*)AS total4 FROM leads where id_cabang='$_SESSION[id_cabang]' and is_expired=1 and ket=7");
	$exp	 = mssql_fetch_assoc($expired);
	$ex		 = $exp['total4'];
?>
<?php
	}
	elseif($_SESSION['user_level'] == 1 || $_SESSION['user_level'] == 2)
	{
?>
<?php 
	$bucket = mssql_query("SELECT COUNT(*) AS total FROM leads where ket=1");
	$buc 	= mssql_fetch_assoc($bucket);
	$b 		= $buc['total'];
	
	$chart 	= mssql_query("SELECT COUNT(*) AS total1 FROM cart where ket=2");
	$cha 	= mssql_fetch_assoc($chart);
	$c		= $cha['total1'];
	
	$follow = mssql_query("SELECT COUNT(*) AS total2 FROM cart where ket=3");
	$fol 	= mssql_fetch_assoc($follow);
	$f		= $fol['total2'];
	
	$closing = mssql_query("SELECT COUNT(*)AS total3  FROM cart where ket=4");
	$clos 	 = mssql_fetch_assoc($closing);
	$cl		 = $clos['total3'];
	
	$expired = mssql_query("SELECT COUNT(*)AS total4  FROM leads where is_expired=1 and ket=7");
	$exp	 = mssql_fetch_assoc($expired);
	$ex		 = $exp['total4'];

?>
<?php
	}
?>
<div class="container" style=" width:98%;">
	<div id="horizontalTab">
        <ul>
			<li><a href="#tab-1"><i class="fa fa-building-o" style="font-size:18px"></i> STORE ( <?php echo $b ?> )</a></li>
            <li><a href="#tab-2"><i class="fa fa-cart-arrow-down" style="font-size:18px"></i> CART ( <?php echo $c ?> )</a></li>
			<li><a href="#tab-3"><i class="fa fa-hand-o-right" style="font-size:18px"></i></i>FOLLOW UP ( <?php echo $f ?> )</a></li>
			<li><a href="#tab-4"><i class="fa fa-times-circle-o" style="font-size:18px"></i>CLOSING ( <?php echo $cl ?> )</a></li>
            <li><a href="#tab-5"><i class="fa fa-warning" style="font-size:18px"></i> EXPIRED ( <?php echo $ex ?> )</a></li>
			<li><a href="#tab-6"><i class="fa fa-file" style="font-size:18px"></i>REPORT</a></li>
        </ul>
        <div id="tab-1">
			<?php include ('leads_store.php'); ?>
        </div>
        <div id="tab-2">
			<?php include ('leads_cart_baru.php'); ?>
		</div>
		<div id="tab-3">
			<?php include ('leads_follow_up.php'); ?>
		</div>
		<div id="tab-4">
			<?php include ('leads_closing.php'); ?>
		</div>
		<div id="tab-5">
			<?php include ('leads_expired.php'); ?>
		</div>
		<div id="tab-6">
			<?php include ('leads_tabel_report.php'); ?>
		</div>
    </div>
</div>
    <!-- Responsive Tabs JS -->
    <script src="js/jquery.responsiveTabs.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var $tabs = $('#horizontalTab');
            $tabs.responsiveTabs({
                rotate: false,
                startCollapsed: 'accordion',
                collapsible: 'accordion',
                setHash: true,
                disabled: [6,7],
                click: function(e, tab) {
                    $('.info').html('Tab <strong>' + tab.id + '</strong> clicked!');
                },
                activate: function(e, tab) {
                    $('.info').html('Tab <strong>' + tab.id + '</strong> activated!');
                },
                activateState: function(e, state) {
                    //console.log(state);
                    $('.info').html('Switched from <strong>' + state.oldState + '</strong> state to <strong>' + state.newState + '</strong> state!');
                }
            });

            $('#start-rotation').on('click', function() {
                $tabs.responsiveTabs('startRotation', 1000);
            });
            $('#stop-rotation').on('click', function() {
                $tabs.responsiveTabs('stopRotation');
            });
            $('#start-rotation').on('click', function() {
                $tabs.responsiveTabs('active');
            });
            $('#enable-tab').on('click', function() {
                $tabs.responsiveTabs('enable', 3);
            });
            $('#disable-tab').on('click', function() {
                $tabs.responsiveTabs('disable', 3);
            });
            $('.select-tab').on('click', function() {
                $tabs.responsiveTabs('activate', $(this).val());
            });

        });
    </script>
</body>
</html>
