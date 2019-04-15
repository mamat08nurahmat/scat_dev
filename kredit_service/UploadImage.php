<?php
  //  error_reporting(0);
  //$file_path = "/var/www/html/kredit_service/img/";
    //$file_path = $file_path . basename( $_FILES['uploaded_file']['name']);
    //if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
    //    echo "success";
    //} else{
    //    echo "fail";
    //}
//	include("parameter.php");
//	include("token.php");
//	include("mac.php");  
//	$file = '/var/www/html/kredit_service/img/'. basename( $_FILES['uploaded_file']['name']);      
//    $ch = curl_init();
//	  curl_setopt($ch, CURLOPT_HEADER, 0);
//    curl_setopt($ch, CURLOPT_VERBOSE, 0);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
//    curl_setopt($ch, CURLOPT_POST, true);
//	$post_array = array(
//        "my_file"=>"@".$file,
//        "upload"=>"Upload"
//    );
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_array);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
//	$result=curl_exec ($ch);
//	curl_close ($ch);
//echo $result;
//Allow Headers

error_reporting(0);
 header('Access-Control-Allow-Origin: *');
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
$target_path = "img/";
 
$target_path = $target_path . basename( $_FILES['file']['name']);
 
if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
    echo "Upload and move success";
} else{
echo $target_path;
    echo "There was an error uploading the file, please try again!";
}

?>