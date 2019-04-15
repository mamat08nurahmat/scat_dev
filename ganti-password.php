<?php SESSION_START(); ?>
<html lang="en">
<head>
<meta charset="utf-8">
<title>S.C.A.T</title>
<meta name="viewport" content="width=device-width, maximum-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
<link href="aset-layout/style/common.css" rel="stylesheet">
<link href="aset-layout/style/style.css" rel="stylesheet">
<link href="aset-layout/style/color.css" rel="stylesheet">
<link href="aset-layout/style/slider.css" rel="stylesheet">
<link href="aset-layout/style/responsive.css" rel="stylesheet">
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]--> 
</head>

<body>
<div class="wrap">
<!--------------------------------------------------------------- header ----------------------------------------------------------------------------------> 
  <div class="tp-bar"  style="background-color: #FF8C00" align="center" >
	<img class="span3" align="pull-right" style="width:200px;height:100px;border-radius:10%" src="img/bni.jpg" >
		<div class="container"align="center">
		<h1 align="center"><font style="color:#F0F8FF;font-family:Magneto;">SCAT</font></h1>
		<h3 align="center"><font style="color:#F0F8FF;font-family:Forte;">Sales Company Administration Tools</font></h3>
	</div>
  </div>
<!--------------------------------------------------------------- /header ----------------------------------------------------------------------------------> 

<div class="fullwidthbanner-container" style="background-color:#000; height:20px;">
</div><!-- slider ends -->
  
<!--------------------------------------------------------------- container ----------------------------------------------------------------------------------> 
<div class="container" style="height:430px;">
    <div class="row">
		  <div class="span3" style=" -webkit-box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 2px;
									 -moz-box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 2px;
									  box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 2px;
									  width:500px; margin-top:90px; margin-bottom:20px;margin-left:350px;">
			  <div class="heading-login" style="background-color:#000; height:30px;">
			  <p style="text-align: center; line-height:30px;"><font style="color:#fff;"><b>Ganti Password Anda<b></font></p>
			  </div>
			  <div class="dialog-block">
				  <form method="POST" action="update-password.php" class="user-login-form">
					
				   <input type="hidden" class="input-block-level" placeholder="User Login" name ="npp" value="<?php echo $_SESSION['username']; ?>">
				    <input type="password" class="input-block-level" placeholder="Password lama" name="pass_lama">
				  <input type="password" class="input-block-level" placeholder="Password Baru" name="pass">
				  <input type="password" class="input-block-level" placeholder="Ulangi Password Baru" name="pass_lagi">
				  <div class="controls">
					  <label class="help-inline"></label>
					  <input type="submit" class="btn pull-right" value="Update">
				  </div>
				  </form>
			 </div>
			 <!-- dialog-block ends -->      
		  </div>
    </div>
</div>
<!--------------------------------------------------------------- /container ----------------------------------------------------------------------------------> 

<!--------------------------------------------------------------- FOOTER ----------------------------------------------------------------------------------> 
  <div class="bottom" style="background-color: #FF8C00">
    <div class="container">
      <div class="bottom-left">
        
      </div>
      <div class="social-links">
      <!--  <ul>
          <li><a href="#" class="icon-yahoo tooltip" title="yahoo"></a></li>
          <li><a href="#" class="icon-facebook tooltip" title="facebook"></a></li>
          <li><a href="#" class="icon-rss tooltip" title="rss"></a></li>
          <li><a href="#" class="icon-flickr tooltip" title="flickr"></a></li>
          <li><a href="#" class="icon-msn tooltip" title="msn"></a></li>
          <li><a href="#" class="icon-stumbleupon tooltip" title="stumbleupon"></a></li>
        </ul>-->
      </div>
    </div>
	
  </div>
<!--------------------------------------------------------------- /FOOTER ----------------------------------------------------------------------------------> 
</div>
<!-- wrap ends -->

<div class="dialog-overlay"></div>
<script src="aset-layout/js/jquery-1.10.2.min.js"></script> 
<script src="aset-layout/js/jquery-ui-1.10.3.custom.min.js"></script> 
<script src="aset-layout/js/jquery.countdown.js"></script>
<script src="aset-layout/js/jquery.bxslider.js"></script>
<script src="aset-layout/js/script.js"></script> 
<div id="fb-root"></div>

</body>
</html>
