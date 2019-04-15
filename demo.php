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
</head>
<body>
	  <div class="container" style=" width:98%;">
    <div id="horizontalTab">
        <ul>
            <li><a href="#tab-1">BUCKET</a></li>
            <li><a href="#tab-2">SALES</a></li>
            <li><a href="#tab-3">REPORT</a></li>
        </ul>

        <div id="tab-1">
            <?php
			include ('leads_1.php');
			?>
        </div>
        <div id="tab-2">
          <?php
			include ('leads_2.php');
			?>
		  </div>
		  <div id="tab-3">
          <?php
			include ('leads_tabel_report.php');
			?>
		  </div>

    </div>
	</div>
		
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
                disabled: [3,4],
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
