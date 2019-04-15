<?php
    class Cruln
	{
		function httpPost($url2,$params)
		{
		    $data_json = json_encode($params);
	
			$ch = curl_init();  
		 	
			curl_setopt($ch,CURLOPT_URL,$url2);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
			curl_setopt($ch,CURLOPT_POST, count($data_json));
			curl_setopt($ch,CURLOPT_POSTFIELDS, $data_json);    
		 
			$output=curl_exec($ch);
			$ouput = str_replace('/','',$output);
			curl_close($ch);
			return $output;
		}
	}
?>