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
	$form_url = "$urlservice/HistoryAll";
	
	$Npp = $_POST['Npp'];
	$StartDate = $_POST['StartDate'];
	$EndDate = $_POST['EndDate'];
   
	// $Npp = '820765';
  

  
  // echo $npp."".$CIF."".$waktu."".$StatusNasabah."".$tanggal."".$activitas;
		
	$data_to_post = array();
		
	 // $data_to_post['CIF'] = $CIF;
     // $data_to_post['waktu'] = $waktu;
	 // $data_to_post['npp'] = $Npp;


	
	 //$data_to_post['Npp'] =$mcrypt->decrypt($Npp); 
	 //$data_to_post['StartDate'] =$mcrypt->decrypt($StartDate); 
	 //$data_to_post['EndDate'] =$mcrypt->decrypt($EndDate);  

	 $data_to_post['Npp'] = $Npp; 
	 $data_to_post['StartDate'] = $StartDate; 
	 $data_to_post['EndDate'] = $EndDate;

	
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