<?php
include('include/config.php');
$ambil_data = mssql_query("select * from berita where id_berita='$_GET[id]'");
$hasil_data = mssql_fetch_array($ambil_data);
?>
<div class="wrapper">
<div class="paragraphs">
      <div class="content-heading"><h3><?=$hasil_data['judul'];?></h3></div>
      <p style="text-align:justify;"><?=$hasil_data['isi'];?></p>
	  <p><a href="#" class="btn btn-inverse" value="Go Back" onclick="history.back(-1)">Kembali</a></p>
      <div style="clear:both;"></div>

</div>
</div>