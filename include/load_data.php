<?php
		include ("config.php");
		
		$sql="select a.npp, a.nama, b.nama_grup, a.status, a.grade from sales a join app_user_grup b on  a.id_grup = b.id_grup where npp='$_POST[parent_id]'";
		$response = array(); // siapkan respon yang nanti akan di convert menjadi JSON
		$query = mssql_query($sql);		
		if($query){
			if(mssql_num_rows($query) > 0){
				while($row = mssql_fetch_object($query)){
					// masukan setiap baris data ke variable respon
					$response[] = $row; 
				}
			}else{
				$response['error'] = 'Data kosong'; // memberi respon ketika data kosong
			}
		}else{
			$response['error'] = mysql_error(); // memberi respon ketika query salah
		}
		die(json_encode($response)); // convert variable respon menjadi JSON, lalu tampilkan 
	
?>
