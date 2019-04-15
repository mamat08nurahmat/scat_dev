<?php
session_start();
include('include/config.php');
$kd_npp = $_POST['id'];
$ktp = $_GET['ktp'];
$level=$_SESSION['user_level'];

if($level==1)
	{
	$ceklevel='';
	$cektipe='';
}
elseif($level==2)
	{
	$ceklevel='';
}
elseif($level== 2 ||$level== 3)
{
	$cektipe='where id_grup in (8,9,11,12)';
}
elseif($level==10)
{
	$cektipe='where id_grup in (9)';
}
else
{
	$ceklevel="and c.id_cabang =".$cbg."";
}
/*-------combo user group------*/
$pilihan = '';
$result = mssql_query("SELECT * FROM app_user_grup ".$cektipe." order by is_sales desc");
while($row = mssql_fetch_array($result))
{
  $pilihan .= "<option value='".$row['id_grup']."'>".$row['nama_grup']."</option>";
}
//-------------------------------------------NPP MUNCUL------

$sql="select max(npp) npp from sales where len(npp) = 5 and id_grup in (8,9,11)"; /* selain sales harus lebih dari 5 digit */
$datax=mssql_fetch_array(mssql_query($sql));
?> 
<?php
/*-------------------combo wilayah-----------------------------------------*/
$query = mssql_query ("SELECT id_area, nama_area FROM area ORDER BY nama_area");
$arrpropinsi = array();
while ($row = mssql_fetch_array($query)) {
	$arrpropinsi [ $row['id_area'] ] = $row['nama_area'];
}

if(isset($_GET['action']) && $_GET['action'] == "getKab") {
	$kode_prop = $_GET['kode_prop'];
	
/*-------------------combo cabang------------------------------------------*/
	$query = mssql_query ("SELECT kode_cabang kode, nama_cabang nama FROM cabang WHERE id_area='$kode_prop' and tipe_cabang in ('KCU') ORDER BY nama_cabang");

	$arrkab = array();
	while ($row = mssql_fetch_array($query)) {
		array_push($arrkab, $row);
	}
	echo json_encode($arrkab);
	exit;
}

// query untuk menampilkan mahasiswa berdasarkan kd_npp
$data = mssql_fetch_array(mssql_query("SELECT * FROM contoh a 
join app_user_grup b on a.id_grup = b.id_grup 
join cabang c on a.id_cabang=c.kode_cabang and c.tipe_cabang='KCU'
join area d on c.id_area=d.id_area 
left join (select id,ket,keterangan from history_sales) e on a.id=e.id
WHERE a.id=".$kd_npp));
// jika kd_npp > 0 / form ubah data
if($npp> 0) {
	$id_grup 			= $data['id_grup'];
	$id_cabang 			= $data['kode_cabang'];
} else {
	$id_grup 			= "";
	$id_cabang 			= "";
	
}	
?>
 <form id="form-data1" action="sales_hiring_proses.php" method="post" enctype="multipart/form-data" autocomplate="onload"> 
<div align="center" style="border:1px solid;background-color:#00BFFF"><strong><p>REGISTRASI FORM LENDING - SGV</strong></p></div><br>
		<tr><td>Posisi</td>
			<td><select name="id_grup" id="id_grup"  class="required" required >
				<option value="<?php echo $id_grup ?>"><?php echo $nama_grup ?></option>
				<?php echo $pilihan;?>
				</select></td>
		</tr>
	
		<tr><td>Wilayah</td>
			<td><select id="propinsi" name="propinsi" class="required" required >
				<option value="<?php echo $id_area ?>"><?php echo $nama_area ?></option>
				<?php
				foreach ($arrpropinsi as $kode=>$nama) {
					echo "<option value='$kode'>$nama</option>";
				}
				?>
				</select></td>
		</tr>
		
		<tr><td>Cabang</td>
			<td><select id="id_cabang" name="id_cabang" class="required" required  >
				<option value="<?php echo $id_cabang ?>"><?php echo $nama_cabang ?></option>
				</select></td>
		</tr>
<!--<table align = "center">
		<tr>
		<td>
			<?php
				if($kd_npp>0)
				{
			?>
			<input type="hidden" class="input-medium" name="npp" value="<?php echo $kd_npp ?>" readonly="readonly"/>
			<?php
				}
				else
				{
			?>
			<input type="hidden" id="npp" class="input-medium" name="npp" value="<?php echo $npp ?>"/>
			<?php
				}
			?>
		</td>
	</tr>
</table>-->
<div align="center" style="border:1px solid;background-color:#00BFFF"><strong>PERSONAL DATA</strong></div><br>
		<div class="control-group" align = "center" >
			<img src="images/orang-1.PNG" id="uploadPreview" style="width: 150px; height:160px;border:1px solid;" /></br>
			<input id="uploadImage" type="file" name="photo"  onchange="PreviewImage();" align="center"  class="required" required/>
		</div>

<table align ="left">
		<tr><td>Nama Lengkap </td>
			<td><input name="nama_lengkap" type="text" onkeypress="return huruf(event)" class="required" required/></td>
		</tr>

		<tr><td>Nama Panggil </td>
			<td><input name="nama_panggil"type="text" onkeypress="return huruf(event)" class="required" required/></td>
		</tr>
		<tr><td>No KTP </td>
			<td><input name="no_ktp" value="<?php echo $ktp ?>" onkeypress="return hanyaAngka(event)" maxlength="16" type="text"  readonly="readonly" /></td>
		</tr>
		
		<tr><td>Tempat Lahir </td>
			<td><input name="tempat_lahir" type="text" onkeypress="return huruf(event)" class="required" required/></td>
		</tr>
		
		<tr><td>Tanggal Lahir </td>
			<td><input name="tanggal_lahir" id="tanggal_lahir" type="date" class="required" required/></td>
		</tr>
		
		<tr><td>Alamat Rumah Tinggal Saat Ini </td>
			<td><textarea name="alamat" type="text" class="required" required/></textarea></td>
		</tr>
	
		<tr><td>Kota</td>
			<td><input name="kota" type="text" onkeypress="return huruf(event)" class="required" required/></td>
		</tr>
		
		<tr><td>Kode Pos </td>
			<td><input name="kodepos"  onkeypress="return hanyaAngka(event)" maxlength="5" type="text" class="required" required /></td>
		</tr>
	
		<tr><td>Lama Tinggal </td>
			<td><input style="width:50px;" name="lama" onkeypress="return hanyaAngka(event)" maxlength="3" type="text" class="required" required /> Tahun</td>
		</tr>
		
		<tr><td>Status Tempat Tinggal </td>
		<td><input name="status_tinggal" type="radio" value="orang tua" <? if($status_tinggal=='orang tua'){echo 'checked';}?>  class="required" required/> orang tua 
			<input name="status_tinggal" type="radio" value="sendiri" <? if($status_tinggal=='sendiri'){echo 'checked';}?>/> sendiri
			<input name="status_tinggal" type="radio" value="sewa" <? if($status_tinggal=='sewa'){echo 'checked';}?>/> sewa 
		</td></tr>	
</table>
	<table align="center">
		<tr><td>Jenis Kelamin</td>
			<td><input name="jenis_kelamin" type="radio" value="l" <? if($jenis_kelamin=='l'){echo 'checked';}?>  class="required" required/> Laki-laki
				<input name="jenis_kelamin" type="radio" value="p" <? if($jenis_kelamin=='p'){echo 'checked';}?>  /> Perempuan</td>
		</tr>
			
		<tr><td>Status</td>
			<td><select name="status" class="required" required>
			<option value>Pilih status</option>
			<option value="lajang">lajang</option>
			<option value="menikah">menikah </option>
			<option value="bercerai">bercerai </option>
		</select></td></tr>
		
		<tr><td>Agama</td>
			<td><select name="agama" class="required" required>
			<option value>Pilih agama</option>
			<option value="islam">islam</option>
			<option value="kristen">kristen</option>
			<option value="budha">budha </option>
			<option value="hindu">hindu </option>
			<option value="khongucu">khongucu </option>
		</select></td></tr>
		
		<tr><td>Telp Rumah </td>
			<td><input name="telp" type="text" maxlength="13" onkeypress="return hanyaAngka(event)" /></td>
		</tr>
		
		<tr><td>No HP </td>
			<td><input name="hp"  type="text" maxlength="13" onkeypress="return hanyaAngka(event)" class="required" required/></td>
		</tr>
		
		<tr><td>Nama Ibu Kandung </td>
			<td><input name="ibu" type="text" onkeypress="return huruf(event)" class="required" required/></td>
		</tr>
		
		<tr><td>Alamat Rumah Tinggal KTP </td>
			<td><textarea name="alamat_ktp" type="text" class="required" required/></textarea></td>
		</tr>
		
		<tr><td>Kota </td>
			<td><input name="kota_ktp" size="40" type="text" onkeypress="return huruf(event)" class="required" required/></td>
		</tr>
		
		<tr><td>Kode Pos </td>
			<td><input name="kodepos_ktp" onkeypress="return hanyaAngka(event)" maxlength="5" type="text" class="required" required/></td>
		</tr>
		
		<tr><td>Lama Tinggal </td>
			<td><input name="tinggal_ktp"  style="width:50px;" maxlength="3" type="text" onkeypress="return hanyaAngka(event)" class="required" required/> Tahun</td>
		</tr>
		
		<tr><td>E-mail </td>
			<td><input name="email"  type="text" class="required" required /></td>
		</tr>
		
		<tr><td>Kendaraan </td>
			<td><input name="kendaraan" type="radio" <? if($kendaraan=='mobil'){echo 'checked';}?> value='mobil' class="required" required/> mobil 
				<input name="kendaraan" type="radio" <? if($kendaraan=='motor'){echo 'checked';}?>  value='motor'/> motor
				<input name="kendaraan" type="radio" <? if($kendaraan=='kendaraan umum'){echo 'checked';}?> value='kendaraan umun'/> kendaraan umum
			</td>
		</tr>	
  </table>
 
<div align="center" style="border:1px solid;background-color:#00BFFF"><strong>EMERGENCY CONTACT</strong></div><br>
<h3> *KELUARGA TIDAK SERUMAH</h3>
<table align= "left">		
		<tr><td>Nama</td>
			<td><input name="nama2" type="text" onkeypress="return huruf(event)" class="required" required/></td>
		</tr>
		<tr><td>Alamat</td>
			<td><textarea name="alamat_emergency" type="text"  class="required" required/></textarea></td>
		</tr>
		<tr>
</table>
	<table>
		<td>Hubungan</td>
			<td><input name="hubungan"  type="text"  onkeypress="return huruf(event)" class="required" required/></td>
		</tr>
		<tr>
			<td>Telp Rumah</td>
			<td><input name="telp2" type="text" maxlength="13" onkeypress="return hanyaAngka(event)" /></td>
		</tr>
		<tr>
			<td>No HP</td>
			<td><input name="hp2" type="text" maxlength="13" onkeypress="return hanyaAngka(event)" class="required" required /></td>
		</tr>
	</table>	
	
<div align="center" style="border:1px solid;background-color:#00BFFF"><strong>PENDIDIKAN FORMAL</strong></div><br>
<h5> *Pendidikan Terakhir</h5>
<table border="1">
    <tr align ="center">
        <td>JENJANG PENDIDIKAN</td>
        <td>NAMA SEKOLAH</td>
        <td>KOTA</td>
		<td>PROGRAM STUDY</td>
		<td>NEM/IPK</td>
		<td>TAHUN IJAZAH</td>
    </tr>
    <tr><td><input name="jenjang_pendidikan" style="width:120px;" type="text" class="required" required /></td>
        <td><input name="nama_sekolah" style="width:150px;" type="text" class="required" required /></td>
		<td><input name="kota_sekolah" style="width:100px;" type="text" onkeypress="return huruf(event)" class="required" required /></td>
        <td><input name="program_study" style="width:100px;" type="text" onkeypress="return huruf(event)" class="required" required /></td>
		<td><input name="ipk" style="width:80px;" type="text" onkeypress="return hanyaAngka(event)" class="required" required /></td>
		<td><input name="tahun_ijazah" style="width:80px;" onkeypress="return hanyaAngka(event)" type="text" class="required" required /></td>
   </tr>
	<tr><td><input name="jenjang_pendidikan1" style="width:120px;" type="text" /></td>
        <td><input name="nama_sekolah1" style="width:150px;" type="text"/></td>
		<td><input name="kota_sekolah1" style="width:100px;" type="text" onkeypress="return huruf(event)" /></td>
        <td><input name="program_study1" style="width:100px;" type="text" onkeypress="return huruf(event)"/></td>
		<td><input name="ipk1" style="width:80px;" type="text" onkeypress="return hanyaAngka(event)"/></td>
		<td><input name="tahun_ijazah1" style="width:80px" type="text" onkeypress="return hanyaAngka(event)"  /></td>
    </tr>
	<tr><td><input name="jenjang_pendidikan2" style="width:120px;" type="text" /></td>
        <td><input name="nama_sekolah2" style="width:150px;" type="text"/></td>
		<td><input name="kota_sekolah2" style="width:100px;" type="text" onkeypress="return huruf(event)" /></td>
        <td><input name="program_study2" style="width:100px;" type="text" onkeypress="return huruf(event)"/></td>
		<td><input name="ipk2" style="width:80px;" type="text" onkeypress="return hanyaAngka(event)"/></td>
		<td><input name="tahun_ijazah2" style="width:80px" type="text" onkeypress="return hanyaAngka(event)"  /></td>
    </tr>
</table><br>

<div align="center" style="border:1px solid;background-color:#00BFFF"><strong>PENGALAMAN BEKERJA</strong></div><br>
<table border="1">
	<tr align ="center">
        <td>PERUSAHAAN</td>
		<td>POSISI/JABATAN</td>
		<td>TANGGAL MASUK</td>
		<td>TANGGAL RESIGN</td>
		<td>KETERANGAN</td>
    </tr>
	<tr><td><input name="perusahaan" style="width:150px;" type="text"></td>
		<td><input name="jabatan" style="width:100px;" type="text"></td>
		<td><input name="tgl_masuk" style="width:120px;" type="date"></td>
		<td><input name="tgl_resign" style="width:120px;" type="date"></td>
        <td><input name="alasan" style="width:100px;" type="text"></td>
	</tr>
	<tr><td><input name="perusahaan1" style="width:150px;" type="text"></td>
		<td><input name="jabatan1" style="width:100px;" type="text"></td>
		<td><input name="tgl_masuk1" style="width:120px;" type="date"></td>
		<td><input name="tgl_resign1" style="width:120px;" type="date"></td>
        <td><input name="alasan1" style="width:100px;" type="text"></td>
	</tr>
	<tr><td><input name="perusahaan2" style="width:150px;" type="text"></td>
		<td><input name="jabatan2" style="width:100px;" type="text"></td>
		<td><input name="tgl_masuk2" style="width:120px;" type="date"></td>
		<td><input name="tgl_resign2" style="width:120px;" type="date"></td>
        <td><input name="alasan2" style="width:100px;" type="text"></td>
	</tr>
</table><br>
<table>
	<tr>
	<td>apakah saat ini sedang bekerja di tempat/perusahaan lain??</td>
	<td><input name="sedang_bekerja" type="radio" <? if($sedang_bekerja=='1'){echo 'checked';}?> value='1'  class="required" required />ya 
		<input name="sedang_bekerja" type="radio" <? if($sedang_bekerja=='2'){echo 'checked';}?>  value='2'/>Tidak</td>
	</tr>
</table><br>
<div align="center" style="border:1px solid;background-color:#00BFFF"><strong>DOKUMEN PENDUKUNG<strong></div><br>
<table>
	<tr>
        <th align="left"><font size="3">SCAN KTP</font></th>
		<th align="left"><font size="3">SCAN KOMITMEN Do's & Don'ts</font></th>
    </tr>
	<tr><td><img src="images/orang-1.PNG" id="uploadPreview1" style="width: 200px; height:150px;border:1px solid;" /></br>
			<input id="uploadImage1" type="file" name="upload"  onchange="PreviewImage1();" align="center"  /></td>
		<td><img src="images/orang-1.PNG" id="uploadPreview2" style="width: 200px; height:150px;border:1px solid;" /></br>
			<input id="uploadImage2" type="file" name="komitmen"  onchange="PreviewImage2();" align="center"  /></td>
	</tr>
<table><br>
	<table align="center">
		<?php
		$date=date('Y/m/d H:i:s');
		?>
		<tr>
		<td><input type="hidden" name="tgl" value="<?php echo $date ?>">
		</td></tr>
		
		
		<tr><td>
			<input type="hidden" name="ket" value="1">
			<input type="hidden" name="nama_pemproses" value="<?php echo $_SESSION['namauser'];?>">
		</td></tr>
		<tr><td>
			<input type="submit" class="btn btn-primary" name="kirim" onclick="return validasi_input(form)"   value="SIMPAN">
			<input type="reset" class="btn btn-inverse" value="Reset">
		</td></tr>
</table>
</form>	
	
<script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>
    <script type="text/javascript">
				function PreviewImage() {
				var oFReader = new FileReader();
				oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

				oFReader.onload = function (oFREvent) {
				document.getElementById("uploadPreview").src = oFREvent.target.result;
				};
				};
				function PreviewImage1() {
				var oFReader = new FileReader();
				oFReader.readAsDataURL(document.getElementById("uploadImage1").files[0]);

				oFReader.onload = function (oFREvent) {
				document.getElementById("uploadPreview1").src = oFREvent.target.result;
				};
				};
				function PreviewImage2() {
				var oFReader = new FileReader();
				oFReader.readAsDataURL(document.getElementById("uploadImage2").files[0]);

				oFReader.onload = function (oFREvent) {
				document.getElementById("uploadPreview2").src = oFREvent.target.result;
				};
				};
				</script>
	  
<link rel="stylesheet" type="text/css" href="../combobox/libs/bootstrap.css" media="screen" />
<script type="text/javascript" src="../combobox/libs/jquery.min.js"></script>
	<script type="text/javascript">
		var j = jQuery.noConflict();
			$(document).ready(function(){
				$('#propinsi').change(function(){
					$.getJSON('sales_hiring_form.php',{action:'getKab', kode_prop:$(this).val()}, function(json){
						$('#id_cabang').html('');
						$.each(json, function(index, row) {
							$('#id_cabang').append('<option value='+row.kode+'>'+row.nama+'</option>');
						});
					});
				});
			});
	</script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('#id_grup').change(function(){
				 if(this.value == 9 || this.value == 8 || this.value == 7 || this.value == 11)
				 {
					<?php if($npp > 0)
					{?>
					  $('#npp').val('<?php echo $npp ?>');
					<?php } else { ?>
						<?php
							$npp_new = $datax['npp'] + 1;	
						?>					
					 $('#npp').val('<?php echo $npp_new ?>');
					<?php } ?>
					 $('#npp').attr('readonly', true);
				 }else
				 {
						$('#npp').attr('readonly', false);
					  $('#npp').val('');
				 }
			});
		});	
	</script>

		
<script  type="text/javascript">
	function hanyaAngka(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}

function validasi_input(form){
  var mincar = 5;
  if (form.kodepos.value.length < mincar){
    alert("kodepos Minimal 5 Karater!");
    form.kodepos.focus();
    return (false);
  }
   return (true);
}

function huruf(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if ((charCode < 65 || charCode > 90)&&(charCode < 97 || charCode > 122)&&charCode>32)
            return false;
        return true;
}
</script>

	<link rel="stylesheet" href="themes/base/jquery.ui.all.css">
	<script src="js/jquery-1.7.2.js"></script>
	<script src="ui/jquery.ui.core.js"></script>
	<script src="ui/jquery.ui.widget.js"></script>
	<script src="ui/jquery.ui.datepicker.js"></script>


</html>