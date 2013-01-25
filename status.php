<!DOCTYPE html>
<html>
<head>
	<title>Status of a Job</title>
        <link href="css/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body>
<?php

session_start();

$username=$_SESSION['login'];
$password=$_SESSION['password'];
$id=$_GET['job_id'];

$ch = curl_init();
$job_url = "https://foundation.iplantcollaborative.org/apps-v1/job/$id/status";

$ch_values = "$username:$password";
curl_setopt($ch, CURLOPT_URL,$job_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERPWD, $ch_values);

$response = curl_exec($ch);
$resultStatus = curl_getinfo($ch);

$handled_json = json_decode($response,true);
$status = $handled_json['result']['status'];

if($resultStatus['http_code'] == 200) {
    //$status = $response['result']['status'];
    echo "<h2>Job $id is $status</h2><br />";
//    echo "$response";
} else {
    echo '<h3>Call Failed</h3> '.print_r($resultStatus);
    echo "$response";
}
curl_close ($ch);

?>  
</body>
<html>
