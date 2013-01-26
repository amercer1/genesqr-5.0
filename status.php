<!DOCTYPE html>
<html>
<head>
	<title>Status of a Job</title>
        <link href="css/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body>
<?php

// Start the php session to be able to pull login and password tokens
session_start();

//Grab the relevent session cookie data and place them into variables
$username=$_SESSION['login'];
$password=$_SESSION['password'];
$token=$_SESSION['token'];

$id=$_GET['job_id'];

//Create a php curl object
$ch = curl_init();

//Base url for foundation api for php curl
$job_url = "https://foundation.iplantcollaborative.org/apps-v1/job/$id/status";


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

//grab the "status" of the job from the json
$status = $handled_json['result']['status'];

//If the php curl was successful, display the results, if not, print failed results
if($resultStatus['http_code'] == 200) {
    echo "<h2>Job $id is $status</h2><br />";
} else {
    echo '<h3>Call Failed</h3> '.print_r($resultStatus);
    echo "$response";
}

//destroy php curl object 
curl_close ($ch);

?>  
</body>
<html>
