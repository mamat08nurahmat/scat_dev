<?php
include 'approve.php';
$tgl_approve = "01-05-2018";
$tgl_sekarang = "02-05-2018";
$lama_approve = hitung_approve($tgl_approve, $tgl_sekarang,"-");
echo "Tanggal Approve  ".$tgl_approve." dan Tanggal Sekarang ".$tgl_sekarang."<br/>";
echo "Lama Approve = ".  $lama_approve ;
if($lama_approve==1){
	$color = 'green';	
}elseif($lama_approve==2){
	$color = 'yellow';	
}else{
	$color = 'red';
}
?>

<body>
<table>

<tr>
<td>NO</td>
<td>Nama</td>
<td>Tanggal</td>
</tr>



<tr>
<td>1</td>
<td>AAAA</td>
<td>24-01-2018</td>
</tr>


<tr style="background-color:<?=$color?>">
<td>2</td>
<td>BBB</td>
<td >24-01-2018</td>
</tr>


<tr>
<td>3</td>
<td>CCCC</td>
<td>24-01-2018</td>
</tr>


</table>
</body>