<!DOCTYPE html>
<html>
<head>
	<title>Kill Job</title>
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

$id=$_POST['job_id'];

//Create a php curl object
$ch = curl_init();

//Base url for foundation api for php curl
$job_url = "https://foundation.iplantcollaborative.org/apps-v1/job/$id";

$ch_values = "$username:$password";

//Set php curl options. 
curl_setopt($ch, CURLOPT_URL,$job_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERPWD, $ch_values);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

//Execute the php curl and grab the response
$response = curl_exec($ch);
$resultStatus = curl_getinfo($ch);


//If the php curl was successful, display the results, if nott, print failed results
if($resultStatus['http_code'] == 200) {
    echo "<h2>Job $id was deleted</h2>";
} else {
    echo 'Call Failed '.print_r($resultStatus);
    echo "$response";
}

//destroy php curl object
curl_close ($ch);

?>  
</body>
<html>
