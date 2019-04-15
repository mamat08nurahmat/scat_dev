<?php
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
error_reporting(0);
include("token.php");
include("mac.php");
include("parameter.php");

// Define URL where the form resides
$form_url = "$urlservice/Registrasi.php";
$api_key =$_POST['api_key'];
// This is the data to POST to the form. The KEY of the array is the name of the field. The value is the value posted.

 $npp = $_POST['npp'];
 $name_sales = $_POST['name_sales'];
 $email = $_POST['email'];
 $notelp = $_POST['notelp'];
 $imei = $_POST['imei'];   
 $role = $_POST['role'];
 $unit = $_POST['unit'];
 $status_login = $_POST['status_login'];
 $token = $_POST['token']; 
 $rekgaji = $_POST['rekgaji']; 
 
 
// $npp ="91757";
 // $name_sales = "evy";
 // $email = "muhammad.syamsul@bni.co.id";
 // $notelp = "0808483";
 // $imei = "2";   
 // $role = "234";
 // $unit = "1";
  // $auth = "78:e7:d1:d2:16:bf";
  // $status_login ="1";
 
  // $rekgaji = "123";
 

$mcrypt = new MCrypt();
  		
  if($api_keyservice == $mcrypt->decrypt($api_key ))
  // if($api_keyservice == "3gyu66nm2903sapm7863gh")
{
$data_to_post = array();

// $data_to_post['npp'] = $npp;
// $data_to_post['name_sales'] =$name_sales;
// $data_to_post['email'] = $email;
// $data_to_post['notelp'] = $notelp;
// $data_to_post['imei'] =$imei;
// $data_to_post['unit'] =$unit;
// $data_to_post['status_login'] =$status_login;
// $data_to_post['role'] =$role;
// $data_to_post['rekgaji'] =$rekgaji;

$data_to_post['npp'] = $mcrypt->decrypt($npp);
$data_to_post['name_sales'] =$mcrypt->decrypt($name_sales);
$data_to_post['email'] = $mcrypt->decrypt($email);
$data_to_post['notelp'] = $mcrypt->decrypt($notelp);
$data_to_post['imei'] = $mcrypt->decrypt($imei);
$data_to_post['unit'] =$mcrypt->decrypt($unit);
$data_to_post['status_login'] =$mcrypt->decrypt($status_login);
$data_to_post['role'] =$mcrypt->decrypt($role);
$data_to_post['token'] =$mcrypt->decrypt($token);
$data_to_post['rekgaji'] =$mcrypt->decrypt($rekgaji);

$data_to_post['auth']= $auth;

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

// penambahan di registrasi.php
// post['role']
?>

