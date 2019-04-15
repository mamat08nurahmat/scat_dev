<?php
//error_reporting (E_ALL & ~E_NOTICE); 
$a=$_GET['a'];
session_start();
include "include/config.php";
if(empty($_SESSION['npp']) and empty($_SESSION['nama']) and empty($_SESSION['pass']))
{
	header('location:login.php');
}
elseif ($_SESSION['status']==0 && ($_SESSION['status_sales'] == 1||$_SESSION['status_sales'] == 3 || $_SESSION['status_sales'] == 4))
	{
		header('location:ganti-password.php');
	}
elseif($_SESSION['status']==1 && ($_SESSION['status_sales'] == 1||$_SESSION['status_sales'] == 3 || $_SESSION['status_sales'] == 4))
{
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="images/add2.png"/>
	<title>S.C.A.T</title>
	<meta name="viewport" content="width=device-width, maximum-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link href="aset-layout/style/common.css" rel="stylesheet">
	<link href="aset-layout/style/style.css" rel="stylesheet">
	<link href="aset-layout/style/color.css" rel="stylesheet">
	<link href="aset-layout/style/slider.css" rel="stylesheet">
	<link href="aset-layout/style/responsive.css" rel="stylesheet">
	<script src="aset-layout/js/jquery-1.10.2.min.js"></script> 
</head>
<body>
<div class="wrap" style="border:1px solid;">
<!--------------------------------------------------------------- header ----------------------------------------------------------------------------------> 
  <div class="tp-bar"  style="background-color: #FF8C00" >
	<div class="container">
		<img class="span3" align="pull-right" style="width:180px;height:80px;border-radius:10%" src="img/bni.jpg" >
		<h1  align="center"><font style="color:#F0F8FF;font-family:Magneto;">SCAT</font></h1>
		<h3 align="center"><font style="color:#F0F8FF;font-family:Forte;">Sales Company Administration Tools</font></h3>
	</div>
  </div>
<!--------------------------------------------------------------- /header ----------------------------------------------------------------------------------> 
  <!--<div style="background:#00BFFF"><marquee direction ="left"  style="color:#fff;"><b>SELAMAT DATANG <?php echo $_SESSION['namauser'] ?> || Diinformasikan Data Realisasi bulan agustus sudah di upload untuk sebagai terhadap pencapaian sales, mohon untuk dilakukan pengecekan apabila data tidak sesuai , mohon untuk di laporakan dengan segera  </b></marquee></div>-->
  <div style="background:#20B2AA;"><marquee direction ="left"  style="color:#fff; font-family:Comic Sans MS"><b>SELAMAT DATANG <?php echo strtoupper($_SESSION['namauser']) ?> </b></marquee></div>
  <nav class="menu-bar">
    <div class="container">
      <a href="#" class="tablet-menu"></a>
      <ul class="menu">
<!--------------------------------------------------------------- menu administrator----------------------------------------------------------------------------------> 
	<?php
	if($_SESSION['user_level']==1) 
	{
	?>
			<li><a href="?page=1">Home</a></li>
			<li><a href="#">Sales</a>
				<ul>
					<li><a href="?page=10a">Create NPP</a></li> 
					<li><a href="?page=34">Update Grade</a></li>
					<li><a href="?page=10b">Create vendor</a></li>
					<li><a href="?page=10m">Approve Penyelia</a></li>
					<li><a href="?page=10k">Approve SCO</a></li>
					<li><a href="?page=10e">Approve SGV</a></li>
					<li><a href="?page=3a">Resign to SCO</a></li>
				</ul>
			</li> 
			<li><a href="#">Management</a>
				<ul>
					<li><a href="?page=26">Tambah berita</a></li>
					<li><a href="?page=30">Fronting Agent</a></li>
					<li><a href="?page=16">Pipeline</a></li>
					<li><a href="?page=33">Report Tim Leader</a></li>
					<!--<li><a href="?page=28">Pipeline</a></li>-->
				</ul>
			</li> 
			<li><a href="#">Target</a>
				<ul>
					<li><a href="?page=11">Create Target</a></li> 
					<li><a href="?page=20">Generate R & P</a></li> 
				</ul>
			</li>
			<li><a href="#">Upload</a>
				<ul>
					<li><a href="?page=6">Upload Realisasi</a></li>
					<li><a href="?page=29">Upload Leads</a></li>
					<li><a href="?page=7">Upload Data Booking</a></li>
					<li><a href="?page=31a">Upload Data Report TL</a></li> 
				</ul>
			</li>
			<li><a href="#">Monitoring</a>
				<ul>	
					<li><a href="?page=4">Realisasi Sales</a></li>
					<li><a href="?page=5">Performance Sales</a></li> 
					<li><a href="?page=29a">Leads Mart</a></li>
					<li><a href="?page=8">Data Developer</a></li>
					<li><a href="?page=30c">Fronting Agen BFP</a></li>
					<li><a href="?page=16a">Update Pipeline</a></li>					
				</ul>
			</li>  
			<li><a href="#">Report</a>
				<ul>
					<li><a href="?page=2">Print Insentif Sales</a></li>
					<li><a href="?page=9a">Data Sales Approve</a></li>
					<li><a href="?page=9">Report Sales</a></li>
					<li><a href="?page=30e">Report Perusahaan</a></li>
					<li><a href="?page=8e">Report Data Developer</a></li>
					<li><a href="?page=16c">Report Pipeline</a></li>
				</ul>
			</li>
			<li><a href="#" target="_blank">Help</a>
			<ul>
				<li><a href="about/juklak.pdf" target="_blank">Juklak</a></li>
				<li><a href="about/panduan-aplikasi-scat.pdf" target="_blank">Manual SCAT</a></li>
				<li><a href="about/MANUAL_SCAT_HIRING.pdf" target="_blank">SCAT HIRING</a></li>
				<li><a href="about/MANUAL SCAT LEADS.pdf" target="_blank">SCAT LEADS</a></li>
				<li><a href="about/FRONTING AGENT.pdf" target="_blank">SCAT FRONTING AGENT</a></li>
				<li><a href="about/MANUAL PENGGUNAAN DATA DEVELOPER.pdf" target="_blank">SCAT DATA DEVELOPER</a></li>
				<li><a href="about/MANUAL PIPELINE.pdf" target="_blank">SCAT MANUAL PIPELINE</a></li>
				<li><a href="about/MANUAL PENGGUNAAN REPORT TL.pdf" target="_blank">SCAT MANUAL REPORT TIM LEADER</a></li>
			</ul>
			</li>
			<li><a href="?page=19">Logout</a></li> 
<!--------------------------------------------------------------- menu user admin sln ---------------------------------------------------------------------------------> 
	<?php
	}
	elseif($_SESSION['user_level']==2) 
	{
	?>
	<li><a href="?page=1">Home</a></li>
			<li><a href="#">Management</a>
				<ul>
					<li><a href="?page=10a">Create NPP</a></li>
					<!--<li><a href="?page=34">update grade</a></li>-->
					<li><a href="?page=10b">Data Create vendor</a></li>
					<li><a href="?page=10k">Data Approve</a></li>
					<li><a href="?page=30">Fronting Agent</a></li>					
				</ul>
			</li>
			<li><a href="#">Target</a>
				<ul>
					<li><a href="?page=11">Create Target</a></li> 
				</ul>
			</li>
			<li><a href="#">Upload</a>
				<ul>
					<li><a href="?page=29">Leads</a></li>
					<!--<li><a href="?page=31a">Upload Data Report TL</a></li>-->
				</ul>
			</li>
			<li><a href="#">Monitoring</a>
				<ul>
					<li><a href="?page=4">Realisasi Sales</a></li>
					<li><a href="?page=5">Performance Sales</a></li> 
					<li><a href="?page=29a">Leads Mart</a></li>
					<li><a href="?page=30c">Fronting Agen BFP</a></li>
					<li><a href="?page=8">Data Developer</a></li>
					<li><a href="?page=33">Report Tim Leader</a></li>					
					<li><a href="?page=16a">Pipeline</a></li>					
				</ul>
			</li> 
			<li><a href="#">Report</a>
				<ul>
					<li><a href="?page=9a">Data Sales Approve</a></li>
					<li><a href="?page=9">Report Sales</a></li>
					<li><a href="?page=30e">Report Perusahaan</a></li>
					<li><a href="?page=8e">Report Data Developer</a></li>
					<li><a href="?page=16c">Report Pipeline</a></li>
				</ul>
			</li>
			<li><a href="#" target="_blank">Help</a>
				<ul>
					<li><a href="about/juklak.pdf" target="_blank">Juklak</a></li>
					<li><a href="about/panduan-aplikasi-scat.pdf" target="_blank">Manual SCAT</a></li>
					<li><a href="about/MANUAL_SCAT_HIRING.pdf" target="_blank">SCAT HIRING</a></li>
					<li><a href="about/MANUAL SCAT LEADS.pdf" target="_blank">SCAT LEADS</a></li>
					<li><a href="about/FRONTING AGENT.pdf" target="_blank">SCAT FRONTING AGENT</a></li>
					<li><a href="about/MANUAL PENGGUNAAN DATA DEVELOPER.pdf" target="_blank">SCAT DATA DEVELOPER</a></li>
					<li><a href="about/MANUAL PIPELINE.pdf" target="_blank">SCAT MANUAL PIPELINE</a></li>
					<li><a href="about/MANUAL PENGGUNAAN REPORT TL.pdf" target="_blank">SCAT MANUAL REPORT TIM LEADER</a></li>
				</ul>
			</li>
			<li><a href="?page=19">Logout</a></li> 	
<!--------------------------------------------------------------- menu user kantor pusat ---------------------------------------------------------------------------------> 
	<?php
	}
	elseif($_SESSION['user_level']==3)
	{
	?>
			<li><a href="?page=1">Home</a></li>
			<li><a href="#">Management</a>
				<ul>
					<li><a href="?page=10a">Create NPP</a></li>
					<li><a href="?page=11">Create Target</a></li>  				
				</ul>
			</li>
			<li><a href="#">Monitoring</a>
				<ul>
					<li><a href="?page=4">Realisasi Sales</a></li>
					<li><a href="?page=5">Performance Sales</a></li> 
				</ul>
			</li> 
			<li><a href="?page=9">Report</a></li>
			<li><a href="#" target="_blank">Help</a>
				<ul>
					<li><a href="about/juklak.pdf" target="_blank">Juklak</a></li>
					<li><a href="about/panduan-aplikasi-scat.pdf" target="_blank">Manual SCAT</a></li>
				</ul>
			</li>
			<li><a href="?page=19">Logout</a></li>	
<!--------------------------------------------------------------- menu user ASM Ddan RSM---------------------------------------------------------------------------------> 
	<?php
	}
	elseif($_SESSION['user_level']==4||$_SESSION['user_level']==5)
	{
	?>
			<li><a href="?page=1">Home</a></li>
			<li><a href="#">Monitoring</a>
				<ul>
					<li><a href="?page=4">Realisasi Sales</a></li>
					<li><a href="?page=5">Performance Sales</a></li> 
				</ul>
			</li> 
			<li><a href="?page=9">Report</a></li>
			<li><a href="#" target="_blank">Help</a>
				<ul>
					<li><a href="about/juklak.pdf" target="_blank">Juklak</a></li>
					<li><a href="about/panduan-aplikasi-scat.pdf" target="_blank">Manual SCAT</a></li>
				</ul>
			</li>
			<li><a href="?page=19">Logout</a></li> 	
<!--------------------------------------------------------------- menu user Penyelia ---------------------------------------------------------------------------------> 
	<?php
	}
	elseif($_SESSION['user_level']==6) 
	{
	?>
			<li><a href="?page=1">Home</a></li>
			<li><a href="#">Management</a>
				<ul>
					<!--<li><a href="?page=10m">Approve Penyelia</a></li>-->
					<li><a href="?page=29a">Leads Mart</a></li>					
				</ul>
			</li>
			<li><a href="#">Monitoring</a>
				<ul>
					<li><a href="?page=4">Realisasi Sales</a></li>
					<li><a href="?page=5">Performance Sales</a></li> 
				</ul>
			</li> 
			<li><a href="?page=9">Report</a></li>
			<li><a href="#" target="_blank">Help</a>
				<ul>
					<li><a href="about/juklak.pdf" target="_blank">Juklak</a></li>
					<li><a href="about/panduan-aplikasi-scat.pdf" target="_blank">Manual SCAT</a></li>
					<li><a href="about/MANUAL SCAT LEADS.pdf" target="_blank">SCAT LEADS</a></li>
				</ul>
			</li>
			<li><a href="?page=19">Logout</a></li> 
<!--------------------------------------------------------------- menu user Timleader ---------------------------------------------------------------------------------> 
	<?php
	}
	elseif($_SESSION['user_level']==7) 
	{
	?>
			<li><a href="?page=1">Home</a></li>
			<li><a href="#">Management</a>
				<ul>
					<li><a href="?page=30c">Fronting Agen BFP</a></li>
					<li><a href="?page=29a">Leads Mart</a></li>	
					<li><a href="?page=16a">Update Pipeline</a></li>
					<li><a href="?page=33">Report Tim Leader</a></li>					
					<?php
						//$data = array(15,181,34,113,131,121,285,38,6,23,28,227,14,11,169,4);
						//if(in_array($_SESSION['id_cabang'],$data))
						//{
					?>
					<!--<li><a href="?page=33">Report Tim Leader</a></li>-->
					<?php //} ?>
					
				</ul>
			</li>
			<li><a href="#">Monitoring</a>
				<ul>
					<li><a href="?page=4">Realisasi Sales</a></li>
					<li><a href="?page=5">Performance Sales</a></li> 				
				</ul>
			</li> 
			<li><a href="#">Report</a>
				<ul>
					<li><a href="?page=30e">Report Perusahaan</a></li>
					<li><a href="?page=16c">Report Pipeline</a></li>
				</ul>
			</li> 
			<li><a href="#" target="_blank">Help</a>
				<ul>
					<li><a href="about/juklak.pdf" target="_blank">Juklak</a></li>
					<li><a href="about/panduan-aplikasi-scat.pdf" target="_blank">Manual SCAT</a></li>
					<li><a href="about/MANUAL SCAT LEADS.pdf" target="_blank">SCAT LEADS</a></li>
					<li><a href="about/FRONTING AGENT.pdf" target="_blank">SCAT FRONTING AGENT</a></li>
					<li><a href="about/MANUAL PIPELINE.pdf" target="_blank">SCAT MANUAL PIPELINE</a></li>
					<li><a href="about/MANUAL PENGGUNAAN REPORT TL.pdf" target="_blank">SCAT MANUAL REPORT TIM LEADER</a></li>
				</ul>
			</li>
			<li><a href="?page=19">Logout</a></li> 				
<!--------------------------------------------------------------- menu sales----------------------------------------------------------------------------------> 
	  <?php
	  }elseif($_SESSION['user_level']==8||$_SESSION['user_level']==9||$_SESSION['user_level']==11||$_SESSION['user_level']==12) 
	  {
	  ?>
			<li><a href="?page=1">Home</a></li>
			<li><a href="#">Management</a>
				<ul>
					<li><a href="?page=29a">Leads Mart</a></li>
					<li><a href="?page=8a">Data Developer</a></li>		
				</ul>
			</li>
			<li><a href="#">Monitoring</a>
				<ul>
					<li><a href="?page=4">Realisasi Sales</a></li>
					<li><a href="?page=5">Performance Sales</a></li> 				
				</ul>
			</li> 
			<li><a href="#" target="_blank">Help</a>
				<ul>
					<li><a href="about/juklak.pdf" target="_blank">Juklak</a></li>
					<li><a href="about/panduan-aplikasi-scat.pdf" target="_blank">Manual SCAT</a></li>
					<li><a href="about/MANUAL SCAT LEADS.pdf" target="_blank">SCAT LEADS</a></li>
					<li><a href="about/MANUAL PENGGUNAAN DATA DEVELOPER.pdf" target="_blank">SCAT DATA DEVELOPER</a></li>
				</ul>
			</li>
			<li><a href="?page=19">Logout</a></li> 	
	  <!--<div style="background:#00BFFF"><marquee style="color:#fff;"><b>Untuk melihat incentive pencapaian , grade trainee  di dalam menu realisasi , sedangkan grade level di dalam menu perfomance</b></marquee></div>-->			
<!--------------------------------------------------------------- menu vendor----------------------------------------------------------------------------------> 	
	<?php	
	}
	elseif($_SESSION['user_level']==10) 
	{
	  ?>
			<li><a href="?page=1">Home</a></li>
			<li><a href="#">Monitoring</a>
				<ul>
					<li><a href="?page=4">Realisasi Sales</a></li>
					<li><a href="?page=5">Performance Sales</a></li>
				</ul>
			</li> 
			<li><a href="?page=10b">User Management</a></li>
			<li><a href="?page=9">Report</a>
				<ul>
					<li><a href="?page=9">Report Sales</a></li></li>				
					<li><a href="?page=9a">Data Sales Approve</a></li></li>				
				</ul>
			</li>
			<li><a href="#" target="_blank">Help</a>
				<ul>
					<li><a href="about/juklak.pdf" target="_blank">Juklak</a></li>
					<li><a href="about/panduan-aplikasi-scat.pdf" target="_blank">Manual SCAT</a></li>
					<li><a href="about/MANUAL_SCAT_HIRING.pdf" target="_blank">SCAT HIRING</a></li>
				</ul>
			</li>
			<li><a href="?page=19">Logout</a></li> 		
<!--------------------------------------------------------------- menu ADMIN SGV ---------------------------------------------------------------------------------> 
	<?php
	}
	elseif($_SESSION['user_level']==13)
	{
	?>
			<li><a href="?page=1">Home</a></li>
			<li><a href="#">Management</a>
				<ul>
					<li><a href="?page=10b">Data Create vendor</a></li>
					<li><a href="?page=10e">Data Approve</a></li> 				
				</ul>
			</li>
			<li><a href="#">Report</a>
				<ul>
					<li><a href="?page=9">Report Sales</a></li></li>				
					<li><a href="?page=9a">Data Sales Approve</a></li></li>				
				</ul>
			<li><a href="#" target="_blank">Help</a>
				<ul>
					<li><a href="about/MANUAL_SCAT_HIRING.pdf" target="_blank">SCAT HIRING</a></li>
				</ul>
			</li>
			<li><a href="?page=19">Logout</a></li>
<!--------------------------------------------------------------- menu ADMIN VENDOR BFP  ----------------------------------------------------------------------------------> 			
	<?php
	}
	elseif($_SESSION['user_level']==15)
	{
	?>
			<li><a href="?page=1b">Home</a></li>
			<li><a href="#">Management</a>
				<ul>
					<li><a href="?page=16">Pipeline</a></li>
				</ul>
			</li> 
			
			<li><a href="#">Report</a>
				<ul>
					<li><a href="?page=16c">Report Pipeline</a></li>	
				</ul>
			</li>
			<li><a href="#" target="_blank">Help</a>
				<ul>
					<li><a href="about/juklak.pdf" target="_blank">Juklak</a></li>
					<li><a href="about/MANUAL PIPELINE.pdf" target="_blank">SCAT MANUAL PIPELINE</a></li>
				</ul>
			</li>
			<li><a href="?page=19">Logout</a></li> 
	
	<?php
	}
	elseif($_SESSION['user_level']==14)
	{
	?>
			<li><a href="?page=1b">Home</a></li>
			<li><a href="#">Management</a>
				<ul>
					<li><a href="?page=16a">Pipeline</a></li>
				</ul>
			</li> 
			
			<li><a href="#">Report</a>
				<ul>
					<li><a href="?page=16c">Report Pipeline</a></li>	
				</ul>
			</li>
			<li><a href="#" target="_blank">Help</a>
				<ul>
					<li><a href="about/juklak.pdf" target="_blank">Juklak</a></li>
					<li><a href="about/MANUAL PIPELINE.pdf" target="_blank">SCAT MANUAL PIPELINE</a></li>
				</ul>
			</li>
			<li><a href="?page=19">Logout</a></li> 
	<?php	
	}
	else
	?>
	</ul>
    </div>
  </nav>
  <!-- menu-bar ends -->
<br>
<!--------------------------------------------------------------- menu ----------------------------------------------------------------------------------> 
<div class="container">
   <div class="row" style="border:0px solid; ">
		<div class="span6" style="border:0px solid;">					
			<div class="events">
			<div class="heading-login-content" style="background-color: #FF8C00;"></div>
			<div class="counter-top-kanan"></div>
			<br>
				<?php include "include/page.php";?>
			</div>
		</div>
<!--------------------------------------------------------------- menu kanan ----------------------------------------------------------------------------------> 
   <div class="pull-right ;" style="border:0px solid;">
        <div class="events" style="border:0px solid;">
			<div class="twitter right">
<!--------------------------------------------------------------- menu selamat datang ----------------------------------------------------------------------------------> 
<div class="event-countdown" style="background-color: #FF8C00;font-family:Comic Sans MS;"><h4><center><font color="white" >SELAMAT DATANG</font></center></h4></div>
	<div class="counter-top" style="margin-left:0%;width:99%;"></div>
          <div class="tweets-box" style="background:#20B2AA;">
            <ul>	
              <table border=1>
				<?php
					
					if($_SESSION['user_level']==14||$_SESSION['user_level']==15)
					{
					$sql	=" select * FROM  perusahaan where id_perusahaan='$_SESSION[id_perusahaan]' ";
					$datax	= mssql_fetch_array(mssql_query($sql));
				?>
			 <h4><center><font color="white" style="text-transform: uppercase; font-family:Kristen ITC; "><?php echo $_SESSION['namauser'] ?></font></center></h4>
			 <h5><center><font color="white" style="font-family:Kristen ITC; " ><?php echo $datax['nama_perusahaan']; ?></font></center></h5>
				<?php
					}else if($_SESSION['user_level']<14){
					
				?>
			 <h4><center><font color="white"  style="text-transform: uppercase; font-family:Kristen ITC; "><?php echo $_SESSION['namauser'] ?></font></center></h4>
			 <h5><center><font color="white" style="font-family:Kristen ITC; " ><?php echo $_SESSION['nama_cabang'] ?></font></center></h5>
				
				
				<?php			  
				$ambil_data = mssql_query ("select 
											a.npp,
											a.nama_grade,
											a.realisasi,
											total,
											insentif,
											a.month,
											a.year
											from (select a.npp,h.realisasi,e.nama_grade,a.year,a.month,b.grade,ISNULL(sum(performance),0) as total,
											CASE
											WHEN ISNULL(sum(performance),0) >=1000 THEN 1000
											ELSE ISNULL(sum(performance),0)
											END AS Perform
											from performances a 
											left join sales b on a.npp = b.npp
											left join grade e on b.grade = e.grade
											left join (select npp,realisasi,month,year from sales_target) h on a.npp=h.npp and a.month=h.month and a.year=h.year
											group by a.npp,a.year,a.month,b.grade,e.nama_grade,h.realisasi)a
											left join (select npp,month,year,performance,insentif from vw_insentif where bobot=100) b
											on a.npp = b.npp and a.month = b.month and a.year = b.year and a.perform = b.performance
											where  a.month=MONTH(getdate())-1 and a.year=YEAR(getdate()) and a.npp='$_SESSION[npp]' and a.nama_grade <> 'Trainee'
											union
												select 
												a.npp,
												a.nama_grade,
												a.realisasi,
												total,
												(a.realisasi * 0.003) as insentif,
												a.month,
												a.year
												from
												(select a.npp,h.realisasi,e.nama_grade,a.year,a.month,b.grade,ISNULL(sum(performance),0) as total,
												CASE
												WHEN ISNULL(sum(performance),0) >=1000 THEN 1000
												ELSE ISNULL(sum(performance),0)
												END AS Perform
												from performances a 
												left join sales b on a.npp = b.npp
												left join grade e on b.grade = e.grade
												left join (select npp,realisasi,month,year from sales_target) h on a.npp=h.npp and a.month=h.month and a.year=h.year
												group by a.npp,a.year,a.month,b.grade,e.nama_grade,h.realisasi)a
												left join (select npp,month,year,performance,insentif from vw_insentif where bobot=100) b
												on a.npp = b.npp and a.month = b.month and a.year = b.year and a.perform = b.performance
												where  a.month=MONTH(getdate())-1 and a.year=YEAR(getdate()) and a.npp='$_SESSION[npp]' and a.nama_grade = 'Trainee'
												ORDER BY a.nama_grade ASC,total DESC 
										");
				while($hasil_data = mssql_fetch_array($ambil_data))
				{
					$insentif=number_format($hasil_data['insentif'],0,",",".");
					$realisasi=number_format($hasil_data['realisasi'],0,",",".");
				?>
				<tr><center>
				<?php
				 if($hasil_data['nama_grade']=='Trainee')
					{
				?>
					<tr style='background:#000'><center>
						<td style="width:120px;"><b><center>Realisasi</center></b></td>
						<td style="width:100px;"><b><center>INSENTIF</center></b></td>
					</center></tr>
						<td><center><font style="font-size:100%;"><?php echo $realisasi ?></font></center></td>
						<td><center><font style="font-size:100%;">Rp.<?php echo $insentif ?></font></center></td>
				<?php
					}
					elseif($hasil_data['nama_grade']=='Level 1' ||$hasil_data['nama_grade']=='Level 2' || $hasil_data['nama_grade']=='Level 3'   )
					{
				?>
					<tr style='background:#000'><center>
						<td style="width:120px;"><b><center>PERFORMANCE</center></b></td>
						<td style="width:100px;"><b><center>INSENTIF</center></b></td>
					</center></tr>
						<td><center><font style="font-size:100%;"><?php echo $hasil_data['total'] ?></font></center></td>
						<td><center><font style="font-size:100%;">Rp.<?php echo $insentif ?></font></center></td>
				</center></tr>
				<?php
					}
				?>
			<?php
				$i++;
				}
			?>
		<?php
			}
			else			
		?>
			</table>
            </ul>
          </div>

<!--------------------------------------------------------------- kalender ----------------------------------------------------------------------------------> 
<div class="event-countdown" style="background-color: #FF8C00;font-family:Comic Sans MS;"><h4><center><font color="white" >KALENDER</font></center></h4></div>
	<div class="counter-top" style="margin-left:0%;width:99%;"></div>
		<div class="tweets-box" style="background:#20B2AA;">
				<?php
				$month= date ("m");
				$year=date("Y");
				$day=date("d");
				$endDate=date("t",mktime(0,0,0,$month,$day,$year));
					echo '<font face="arial" size="2">';
					echo '<table align="center" border="0" cellpadding=5 cellspacing=5 ><tr><th align=center><font color=black>';
					echo "Today : ".date("F, d Y ",mktime(0,0,0,$month,$day,$year));
					echo '</font></th></tr></table>';
					echo '<table align="center" border="1" cellpadding=5 cellspacing=5>
							<tr bgcolor="#FF8C00">
							<td align=center><font color=red>M</font></td>
							<td align=center>S</td>
							<td align=center>T </td>
							<td align=center>W</td>
							<td align=center>T</td>
							<td align=center>F</td>
							<td align=center>S</td>
							</tr>';
				$s=date ("w", mktime (0,0,0,$month,1,$year));
						for ($ds=1;$ds<=$s;$ds++) {
						echo "<td style=\"font-family:arial;color:#B3D9FF\" align=center valign=middle bgcolor=\"\">
						</td>";}
						for ($d=1;$d<=$endDate;$d++) {
							if (date("w",mktime (0,0,0,$month,$d,$year)) == 0) { echo "<tr>"; }
							$fontColor="#000000";
							if (date("D",mktime (0,0,0,$month,$d,$year)) == "Sun") { $fontColor="red"; }
						echo "<td style=\"font-family:arial;color:#333333\" align=center valign=middle> <span style=\"color:$fontColor\">$d</span></td>";
							if (date("w",mktime (0,0,0,$month,$d,$year)) == 6) { echo "</tr>"; }}
						echo '</table>';
				?>
		</div>
<!--------------------------------------------------------------- /kalender ----------------------------------------------------------------------------------> 
<!--------------------------------------------------------------- last month top 10 ----------------------------------------------------------------------------------> 
<div class="event-countdown" style="background-color: #FF8C00;font-family:Comic Sans MS;"><center><font color="white" >10 POSITION BEST PERFORMANCE </font></center></div>
	<div class="counter-top" style="margin-left:0%;width:99%;"></div>
          <div class="tweets-box" style="background:#20B2AA;">
            <ul>
             <table border=1>
			  <tr style='background:#000'>
				<td><b><center>NO</center></b></td>
				<td><b><center>NPP</center></b></td>
				<td><b><center>NAMA</center></b></td>
				<td><b><center>(%)</center></b></td>
				</tr>
				<?php			  
				$i = 1;
				$ambil_data = mssql_query ("
				SELECT * FROM 
				(
				SELECT a.*,b.nama FROM 
								(
								SELECT ROW_NUMBER() OVER (ORDER BY PERFORMANCE desc) AS ROWNUM,npp,performance
							FROM vw_totalkpi where month=MONTH(getdate())-1 and year=YEAR(getdate())
								) AS a LEFT JOIN sales b on a.npp = b.npp
							
				) a where a.ROWNUM BETWEEN 0 AND 10	order by a.rownum asc
							");
				while($hasil_data = mssql_fetch_array($ambil_data))
				{
				?>
				<tr>
				<td><center><font style="font-size:80%;"><?php echo $i ?></font></center></td>
				<td><center><font style="font-size:70%;"><?php echo $hasil_data['npp']?></font></center></td>
				<td style="width:80%;"><font style="font-size:80%;"><?php echo $hasil_data['nama'] ?></font></td>
				<td><center><font style="font-size:70%;"><?php echo $hasil_data['performance'] ?></font></center></td>
				</tr>
				<?php
				$i++;
				}
				?>
			</table>
			<br>
            </ul>
          </div><!-- tweets-box ends --> 
<!--------------------------------------------------------------- /last month to 10 ----------------------------------------------------------------------------------> 
<!--------------------------------------------------------------- last day top 10 ----------------------------------------------------------------------------------> 
<!--<div class="event-countdown" style="background-color: #FF8C00"><center><font color="white" >10 POSITION LOWEST PERFORMANCE </font></center></div>
	<div class="counter-top" style="margin-left:0%;width:99%;"></div>
        <div class="tweets-box" style="background:#00BFFF">
            <ul>

             <table border=1>
			  <tr style='background:#000'>
				<td><b><center>NO</center></b></td>
				<td><b><center>NPP</center></b></td>
				<td><b><center>NAMA</center></b></td>
				<td><b><center>(%)</center></b></td>
				</tr>
			  
				<?php			  
				$i = 1;
				$ambil_data = mssql_query ("
				SELECT * FROM 
				(
				SELECT a.*,b.nama FROM 
								(
								SELECT ROW_NUMBER() OVER (ORDER BY PERFORMANCE DESC) AS ROWNUM,npp,performance
							FROM vw_totalkpi where month=MONTH(getdate()) and year=YEAR(getdate())
								) AS a LEFT JOIN sales b on a.npp = b.npp
							
				) a where a.ROWNUM BETWEEN 0 AND 10	order by a.performance desc
							");
				//$hasil_data = mssql_fetch_array($ambil_data);
				while($hasil_data = mssql_fetch_array($ambil_data))
				{
				?>
				<tr>
				<td><center><font style="font-size:80%;"><?php echo $i ?></font></center></td>
				<td><center><font style="font-size:70%;"><?php echo $hasil_data['npp']?></font></center></td>
				<td style="width:80%;"><font style="font-size:80%;"><?php echo $hasil_data['nama'] ?></font></td>
				<td><center><font style="font-size:70%;"><?php echo $hasil_data['performance'] ?></font></center></td>
				</tr>
				<?php
				$i++;
				}
				?>
			</table>
			<br>
            </ul>
          </div>-->
<!--------------------------------------------------------------- /last day to 10 ----------------------------------------------------------------------------------> 
				</div><!-- twitter ends --> 
			</div><!-- /event --> 
		</div><!-- /span3 --> 
	</div><!-- /row --> 
 </div><!-- /container --> 
<!--------------------------------------------------------------- bottom ----------------------------------------------------------------------------------> 
  <div class="bottom" style="background-color: #FF8C00">
    <div class="container">
      <div class="bottom-left"  style="color:#fff;font-family:Comic Sans MS;">
        <p>&copy;2015 S.C.A.T (Sales Company Administration Tools)</p>
      </div>
      <div class="social-links"></div>
    </div>
  </div>
<!--------------------------------------------------------------- bottom ----------------------------------------------------------------------------------> 
</div><!-- wrap ends -->
<div class="dialog-overlay"></div>
<link rel="stylesheet" href="sales-css/bootstrap.min.css">
<script src="aset-layout/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="aset-layout/js/jquery.countdown.js"></script>
<script src="aset-layout/js/jquery.bxslider.js"></script>
<script src="aset-layout/js/script.js"></script> 


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
 // js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=203335796018";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>
<?
}else 
	{
	header('location:login.php');
	}	
?>