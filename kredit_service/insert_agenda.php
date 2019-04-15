<?php
include("token.php");
include("parameter.php");
include("mac.php");
error_reporting(0);
	if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
	 
	$mcrypt = new MCrypt();

// This is the data to POST to the form. The KEY of the array is the name of the field. The value is the value posted.

  // if($api_keyservice == $mcrypt->decrypt($api_key ))
	if($api_keyservice ==   "3gyu66nm2903sapm7863gh")
	{
	// if( $tanggalserver != $mcrypt->decrypt($tanggal))
	$form_url = "$urlservice/PostAgenda";
		
	$npp = $_POST['npp'];
    $waktu = $_POST['waktu']; 
    $tanggal =$_POST['tanggal'];
    $activitas =$_POST['activitas'];
  
  // $npp = "820765";
  // $CIF = "123"; 
  // $waktu = "17:47"; 
  // $StatusNasabah ="1"; 
  // $tanggal ="2016-12-19 13:35:07.567";
  // $activitas ="baru";
  
  // echo $npp."".$CIF."".$waktu."".$StatusNasabah."".$tanggal."".$activitas;
		
	$data_to_post = array();
		
	 // $data_to_post['CIF'] = $CIF;
     // $data_to_post['waktu'] = $waktu;
	 // $data_to_post['npp'] = $npp;
	 // $data_to_post['activitas'] = $activitas;
	 // $data_to_post['StatusNasabah'] = $StatusNasabah;
     // $data_to_post['tanggal'] = $tanggal;
	

	
	 //$data_to_post['CIF'] =  $mcrypt->decrypt($CIF);
     //$data_to_post['waktu'] = $mcrypt->decrypt($waktu); 
	 //$data_to_post['npp'] =$mcrypt->decrypt($npp); 
	 //$data_to_post['activitas'] =$mcrypt->decrypt($activitas); 
	 
	 //$data_to_post['StatusNasabah'] =$mcrypt->decrypt($StatusNasabah); 
     //$data_to_post['tanggal'] =$mcrypt->decrypt($tanggal); 

	 $data_to_post['CIF'] =  $CIF;
     $data_to_post['waktu'] = $waktu; 
	 $data_to_post['npp'] =$npp; 
	 $data_to_post['activitas'] =$activitas; 
	 
	 $data_to_post['StatusNasabah'] =$StatusNasabah; 
     $data_to_post['tanggal'] =$tanggal; 
	
	$data_json = json_encode($data_to_post);
		

	// Initialize cURL
	$curl = curl_init();

	// Set the options
	curl_setopt($curl,CURLOPT_URL, $form_url);
		

	curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($curl, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
	curl_setopt($curl,CURLOPT_POST, count($data_json));
	// This sets the number of fields to post
	curl_setopt($curl,CURLOPT_POST, sizeof($data_json));

	// This is the fields to post in the form of an array.
	curl_setopt($curl,CURLOPT_POSTFIELDS, $data_json);
       
	
	//execute the post
	$result = curl_exec($curl);

	echo $result;

	//close the connection
	curl_close($curl);
}
else
{
	header('HTTP/1.0 403 Forbiden');
	echo 'You are forbidden!';
}

?>