<?php
//error_reporting(0);
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


$mcrypt = new MCrypt();

// Define URL where the form resides
 $api_key =$_POST['api_key'];
 $tanggalserver =date('Ymd');

 $tanggal = $_POST['date'];
// This is the data to POST to the form. The KEY of the array is the name of the field. The value is the value posted.

  
   // $npp = "18205";
  // $password = "bni46"; 

  // if($api_keyservice == $mcrypt->decrypt($api_key ))
if($api_keyservice ==   "3gyu66nm2903sapm7863gh")
{
	// if( $tanggalserver != $mcrypt->decrypt($tanggal))

		$form_url = "$urlservice/login";
		

		$username = $_POST['username'];
		$password = $_POST['password'];
		
	    // $username = 'c51ab1a83518d2b672e9b67c7b07beae';
	    // $password = 'ff1acc7a08442583353ce4ac35149528';
		 // $imei ='359667064304762';
		
		
		// echo $mcrypt->decrypt($username);
		
		// echo $mcrypt->decrypt($password);
		


		$data_to_post = array();
		
		// $data_to_post['imei'] = $imei;
		  $data_to_post['username'] =$username;
		  $data_to_post['password'] =$password;

		//$data_to_post['username'] = $mcrypt->decrypt($username);
		//$data_to_post['password'] =$mcrypt->decrypt($password);
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