<!DOCTYPE html>
<html>
<head>
	<title>Kill Job</title>
        <link href="css/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body>
<?php

session_start();

$username=$_SESSION['login'];
$password=$_SESSION['password'];
$id=$_POST['job_id'];

$ch = curl_init();
$job_url = "https://foundation.iplantcollaborative.org/apps-v1/job/$id";

$ch_values = "$username:$password";
curl_setopt($ch, CURLOPT_URL,$job_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERPWD, $ch_values);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

$response = curl_exec($ch);
$resultStatus = curl_getinfo($ch);


if($resultStatus['http_code'] == 200) {
    echo "<h2>Job $id was deleted</h2>";
} else {
    echo 'Call Failed '.print_r($resultStatus);
    echo "$response";
}
curl_close ($ch);

?>  
</body>
<html>
