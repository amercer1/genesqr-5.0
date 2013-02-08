<?php

session_start();
$username=$_SESSION['login'];
$password=$_SESSION['password'];
$token=$_SESSION['token'];
$job_url = "https://foundation.iplantcollaborative.org/io-v1/io/list/$username";

//Create a php curl object  
$ch = curl_init();

//Base url for foundation api for php curl

$ch_values = "$username:$password";

//Set php curl options. 
curl_setopt($ch, CURLOPT_URL,$job_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERPWD, $ch_values);


//Execute the php curl and grab the response
$response = curl_exec($ch);
$resultStatus = curl_getinfo($ch);

//Turn the response into json which php can manipulate 
$handled_json = json_decode($response,true);

//If the php curl was successful, display the results, if not, print failed results
if($resultStatus['http_code'] == 200) {
  print json_encode($handled_json['result']);
}
else{
  print $resultStatus['http_code'];

}

?>

