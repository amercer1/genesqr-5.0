<!DOCTYPE html>
<html>
<head>
        <title>Job Page</title>
        <link href="css/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body>

<?php
session_start();

$username=$_SESSION['login'];
$password=$_SESSION['password'];
$token=$_SESSION['token'];

$job_name=$_POST['job_name'];
$output_name=$_POST['output_location'];

$ch = curl_init();
$job_url = 'https://foundation.iplantcollaborative.org/apps-v1/job';

$ch_values = "$username:$password";
//echo $ch_values;
curl_setopt($ch, CURLOPT_URL,$job_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERPWD, $ch_values);
curl_setopt($ch, CURLOPT_POST, true);
//$postField ="softwareName=GeneSeqer-5.0&jobName=$job_name&requestedTime=04:00:00&outPutFile=$output_name&Species=Arabidopsis";
$postField ="softwareName=GeneSeqer-5.0";
foreach($_POST as $name => $value) {
 if($value != ""){
  $postField = "$postField&$name=$value"; 
  
  }
}
echo $postField;
curl_setopt($ch, CURLOPT_POSTFIELDS, $postField);

$response = curl_exec($ch);
$resultStatus = curl_getinfo($ch);

$handled_json = json_decode($response,true);
//$TOKEN=$handled_json['status'][''];

if($resultStatus['http_code'] == 200) {
    $job_id=$handled_json['result']['id'];
    $status=$handled_json['result']['status'];
    echo "$response <br />";
    echo "<br />";
    echo "<h2>Your Job ID is $job_id</h2><br />";
    echo "<h2>Your Job Status is $status</h2><br />";
} else {
    echo '<h3>Call Failed</h3> '.print_r($resultStatus);
    echo "$response";
}
curl_close ($ch);
?>
</body>
</html>

