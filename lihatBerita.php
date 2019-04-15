<?php
#------- memulai page number -------------------------------------------------------------------------------------#
$dataPerPage = 10; 
$i = 1;
if(isset($_GET['hal']))
{	
	$noPage = $_GET['hal'];
}else{	
	$noPage = 1;
}
$offset   = ($noPage) * $dataPerPage;
include "include/config.php";
//$ambil_data = mssql_query("select * from berita where aksi=1 order by id_berita desc OFFSET $offset ROWS FETCH NEXT $dataPerPage ROWS ONLY");
$ambil_data = mssql_query("SELECT * FROM 
(
select A.*,ROW_NUMBER() OVER (ORDER BY TANGGAL DESC) AS ROWNUM from berita A where aksi=1
) A WHERE A.ROWNUM BETWEEN (($i - 1) * $dataPerPage)+1 AND ($offset) ORDER BY id_berita DESC");
$hitung_record = mssql_query("SELECT COUNT(*) AS jumData FROM berita");
$data          = mssql_fetch_array($hitung_record);
$jumData       = $data['jumData'];
$jumPage  = ceil($jumData/$dataPerPage);
# ceil digunakan untuk membulatkan hasil pembagian
#------- akhir page number -------------------------------------------------------------------------------------#

while($hasil_data = mssql_fetch_array($ambil_data)){
	$tgl= date('d M Y H:i',strtotime($hasil_data['tanggal']));
?>
	<div class="row-fluid">
      <div class="span8" style="width:100%">
          <h2><?=$hasil_data['judul'];?></h2>
          <p style="text-align:justify;"><?=substr($hasil_data['isi'],0,352);?>...</p>
          <p>
          	<a href="index.php?page=1&link=lihatDetailBerita.php&id=<?=$hasil_data['id_berita'];?>" class="btn btn-primary">Selengkapnya</a> 
          	<a href="#" class="btn btn-inverse"><?=$tgl;?></a>
          </p>
      </div>      
    </div>
    <hr>
<?php
}
?>

<!----  menampilkan page number di bawah post ------------>
<div class="pagination pagination-centered">
    <ul>
	<?php
		$link = "index.php?page=1&link=lihatBerita.php&hal=";
		# menampilkan link previous
		if ($noPage > 1) echo  "<li><a href='".$link."".($noPage-1)."'>&larr; Prev</a></li>";
		# memunculkan nomor halaman dan linknya
		for($jml_hal = 1; $jml_hal <= $jumPage; $jml_hal++)
		{
			if($noPage == $jml_hal){
				echo "<li class='disabled'><a href='#' style='cursor'>".$jml_hal."</a></li> ";
			}else{
				echo "<li><a href='".$link."".$jml_hal."'>".$jml_hal."</a></li> ";}
		}
		# menampilkan link next
		if ($noPage < $jumPage) echo "<li><a href='".$link."".($noPage+1)."'>Next &rarr;</a></li>";
		?>
    </ul>
</div>