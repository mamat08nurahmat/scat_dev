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
    <link type="text/css" rel="stylesheet" href="css/style-tabs2.css" />
	<script src="js/jquery-2.1.0.min.js"></script>
	<script src="js/gulpfile.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<?php
	if($_SESSION['user_level']==7)
	{
?>
<?php 
	$store = mssql_query("SELECT COUNT(*) AS total FROM report_tl where id_cabang='$_SESSION[id_cabang]' and ket='1' and persetujuan_pengalihan is null ");
	$sto 	= mssql_fetch_assoc($store);
	$s 		= $sto['total'];	
	
	$follow = mssql_query("SELECT COUNT(*) AS total1 FROM report_tl where id_cabang='$_SESSION[id_cabang]' and persetujuan_pengalihan='1'");
	$fol 	= mssql_fetch_assoc($follow);
	$f		= $fol['total1'];
	
	$closing = mssql_query("SELECT COUNT(*) AS total2 FROM report_tl where id_cabang='$_SESSION[id_cabang]' and ket='2' and persetujuan_pengalihan='1'");
	$clos 	 = mssql_fetch_assoc($closing);
	$cl		 = $clos['total2'];
	
	$tdk_closing = mssql_query("SELECT COUNT(*) AS total3 FROM report_tl where id_cabang='$_SESSION[id_cabang]' and persetujuan_pengalihan='2'");
	$tdk 		 = mssql_fetch_assoc($tdk_closing);
	$t			 = $tdk['total3'];
?>
<div class="container" style=" width:98%;" >
	<div id="horizontalTab">
		<ul>
			<li><a href="#tab-1"><i class="fa fa-building-o" style="font-size:25px" ></i> STORE ( <?php echo $s ?> )</a></li>
			<li><a href="#tab-2"><i class="fa fa-hand-o-right" style="font-size:25px"></i></i>FOLLOW UP ( <?php echo $f ?> )</a></li>
			<li><a href="#tab-3"><i class="fa fa-times-circle-o" style="font-size:25px"></i>CLOSING ( <?php echo $cl ?> )</a></li>
            <li><a href="#tab-4"><i class="fa fa-warning" style="font-size:25px"></i> TIDAK CLOSING ( <?php echo $t ?> )</a></li>
			<li><a href="#tab-5"><i class="fa fa-file" style="font-size:25px"></i>REPORT</a></li>
        </ul>
        <div id="tab-1">
			<?php include ('management_tim_leader.php'); ?>
        </div>
        <div id="tab-2">
			<?php include ('report_tl_followup.php'); ?>
		</div>
		<div id="tab-3">
			<?php include ('report_tl_closing.php'); ?>
		</div>
		<div id="tab-4">
			<?php include ('report_tl_tidak_closing.php'); ?>
		</div>
		<div id="tab-5">
			<?php include ('data_tim_leader_report.php'); ?>
		</div>
    </div>
</div>

<?php
	}
	elseif($_SESSION['user_level'] == 1 || $_SESSION['user_level'] == 2)
	{
?>
<?php 
	$store = mssql_query("SELECT COUNT(*) AS total FROM report_tl where ket='1' and persetujuan_pengalihan is null ");
	$sto 	= mssql_fetch_assoc($store);
	$s 		= $sto['total'];	
	
	$follow = mssql_query("SELECT COUNT(*) AS total1 FROM report_tl where persetujuan_pengalihan='1' and ket='1'");
	$fol 	= mssql_fetch_assoc($follow);
	$f		= $fol['total1'];
	
	$closing = mssql_query("SELECT COUNT(*) AS total2 FROM report_tl where ket='2' and persetujuan_pengalihan='1'");
	$clos 	 = mssql_fetch_assoc($closing);
	$cl		 = $clos['total2'];
	
	$tdk_closing = mssql_query("SELECT COUNT(*) AS total3 FROM report_tl where persetujuan_pengalihan='2'");
	$tdk 		 = mssql_fetch_assoc($tdk_closing);
	$t			 = $tdk['total3'];
?>
<div class="container" style=" width:98%; ">
	<div id="horizontalTab">
        <ul>
			<li><a href="#tab-1"><i class="fa fa-building-o" style="font-size:25px"></i> STORE ( <?php echo $s ?> )</a></li>
			<li><a href="#tab-2"><i class="fa fa-hand-o-right" style="font-size:25px"></i></i>FOLLOW UP ( <?php echo $f ?> )</a></li>
			<li><a href="#tab-3"><i class="fa fa-times-circle-o" style="font-size:25px"></i>CLOSING ( <?php echo $cl ?> )</a></li>
            <li><a href="#tab-4"><i class="fa fa-warning" style="font-size:25px"></i> TIDAK CLOSING ( <?php echo $t ?> )</a></li>
			<li><a href="#tab-5"><i class="fa fa-file" style="font-size:25px"></i>REPORT</a></li>
        </ul>
        <div id="tab-1">
			<?php include ('management_tim_leader.php'); ?>
        </div>
        <div id="tab-2">
			<?php include ('report_tl_followup.php'); ?>
		</div>
		<div id="tab-3">
			<?php include ('report_tl_closing.php'); ?>
		</div>
		<div id="tab-4">
			<?php include ('report_tl_tidak_closing.php'); ?>
		</div>
		<div id="tab-5">
			<?php include ('data_tim_leader_report.php'); ?>
		</div>
    </div>
</div>
<?php
	}
?>	
    <!--<![endif]-->

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
                disabled: [5,6],
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
