<?php
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
include("token.php");
include("parameter.php");
include("mac.php");

// Define URL where the form resides
$form_url = "$urlservice/CustList";

$api_key =$_POST['api_key'];

$mcrypt = new MCrypt();

// This is the data to POST to the form. The KEY of the array is the name of the field. The value is the value posted.

 // $custno = $_POST['custno'];
 // $imei = $_POST['imei']; 
	// $npp = 18205;
	// $imei = '353019070534618';
		

  // if($api_keyservice == $mcrypt->decrypt($api_key ))
	  if($api_keyservice ==   "3gyu66nm2903sapm7863gh")
{

	// $decryptedtgl = $mcrypt->decrypt($tgl);

	  

	$data_to_post = array();
	
    // $data_to_post['npp'] = $npp;
	// $data_to_post['imei'] = $imei;
	
	
	// $data_to_post['custno'] = $mcrypt->decrypt($custno);
	// $data_to_post['imei'] = $mcrypt->decrypt($imei);

	$data_to_post['auth'] = $auth;

	// Initialize cURL
	$curl = curl_init();

	// Set the options
	curl_setopt($curl,CURLOPT_URL, $form_url);

	// This sets the number of fields to post
	curl_setopt($curl,CURLOPT_POST, sizeof($data_to_post));

	// This is the fields to post in the form of an array.
	curl_setopt($curl,CURLOPT_POSTFIELDS, $data_to_post);

	//execute the post
	$result = curl_exec($curl);

	//close the connection
	curl_close($curl);
}
else
{
	header('HTTP/1.0 403 Forbiden');
	echo 'You are forbidden!';
}

?>