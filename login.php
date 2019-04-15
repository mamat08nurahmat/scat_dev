<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="images/add2.png"/>
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
</head>

<body>
<div class="wrap" style="border:1px solid;" >
<!--------------------------------------------------------------- header ----------------------------------------------------------------------------------> 
  <div class="tp-bar"  style="background-color: #FF8C00" align="center" >
	<div class="container">
		<h1 align="center"><font style="color:#00008B;font-family:Magneto;">SCAT</font></h1>
		<h3 align="center"><font style="color:#00008B;font-family:Forte;">Sales Company Administration Tools</font></h3>
	</div>
  </div>
<!--------------------------------------------------------------- /header ----------------------------------------------------------------------------------> 
<div style="background:#20B2AA;"><marquee style="color:#00008B;font-family:Kristen ITC;"><b>Sales Company Administration Tools</b></marquee></div><br>
<!--------------------------------------------------------------- slider ---------------------------------------------------------------------------------->        
<div class="slider">
		<div  class="span8" align="center" >
              <?php include"slider.php" ?>
		</div>
</div> 
<p></p>
<!--<table border="7">
	<tr height="40" >
		<th><font color="red">SEHUBUNGAN DENGAN ADANYA PENDATAAN ULANG USER S.C.A.T MAKA PASSWORD  MENGGUNAKAN "bankbni" SELANJUTNYA DAPAT DI GANTI SETELAH MELAKUKAN LOGIN</font></th>
	</tr>
</table><br>-->
<!--------------------------------------------------------------- container ---------------------------------------------------------------------------------->
 <div class="container_login">
   <div class="row">
		<div class="input-prepend pull-right ; span4" style=" -webkit-box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 1px;
									 -moz-box-shadow: rgba(0, 0, 0, 0.2) 2px 2px 2px;
									  box-shadow: rgba(0, 0, 0, 0.2) 2px 2px 2px;" >
			  <div class="heading-login" style="background:#20B2AA;">
				<p style="text-align: center; line-height:20px;"><font style="color:#00008B;font-family:Kristen ITC;"><b>WELCOME<b></font></p>
			  </div>
			  <div class="dialog-block">
				  <form method="POST" action="ceklogin.php" class="user-login-form">
					  <input type="text" class="input-block-level" placeholder=" Username" name ="npp">
					  <input type="password" class="input-block-level"  placeholder="Password" name="pass">
					 <div class="controls">
						 <label class="help-inline"></label>
						  <input type="submit" class="btn pull-right" value="Sign In" style="background:#20B2AA;">
					  </div>
					  <br>
					
				  </form>
				   <div class="heading-login">
						<p style="text-align: left; line-height:10px;"><font style="color:#00008B; font-family:Comic Sans MS;"><b>Jika lupa password silakan hubungi contact person 021-50836857 (Andhika)<b></font></p>
					</div>
			 </div>	 
			<!-- dialog-block ends -->        
		</div>	
 </div>
</div><br>
<!--------------------------------------------------------------- /container ----------------------------------------------------------------------------------> 
<!--------------------------------------------------------------- FOOTER ----------------------------------------------------------------------------------> 
  <div class="tp-bar" style="background-color: #FF8C00">
    <div class="container">
      <div class="bottom-left">
        
      </div>
      <div class="social-links">
       <!-- <ul>
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
<script src="aset-layout/js/jquery-1.10.2.min.js"></script> 
<script src="aset-layout/js/jquery-ui-1.10.3.custom.min.js"></script> 
<script src="aset-layout/js/jquery.countdown.js"></script>
<script src="aset-layout/js/jquery.bxslider.js"></script>
<script src="aset-layout/js/script.js"></script> 
</body>
</html>
