<html>
<head>
		<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
    	<script type="text/javascript">
    		function printValue(sliderID, textbox) {
            var x = document.getElementById(textbox);
            var y = document.getElementById(sliderID);
            x.value = y.value;
        }
    	</script>
		</head>
<body>
<div class="wrapper">
                    <?php
						if(empty($_GET['link']))
                    		include "lihatBerita.php";
						else
							include($_GET['link']);						
					?>
		</div>	    
	    <script src="./js/berita/latest.js"></script>
	    <script src="./js/berita/bootstrap.min.js"></script>
</body>
</html>
