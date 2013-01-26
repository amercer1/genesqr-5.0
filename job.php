<!DOCTYPE html>
<html>
<head>
        <title>Job Page</title>
        <link href="css/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body>

<?php
// Start the php session to be able to pull login and password tokens
session_start();

$username=$_SESSION['login'];
$password=$_SESSION['password'];
$token=$_SESSION['token'];

$job_name=$_POST['job_name'];
$output_name=$_POST['output_location'];

//Create a php curl object  
$ch = curl_init();

//Base url for foundation api for php curl
$job_url = 'https://foundation.iplantcollaborative.org/apps-v1/job';

$ch_values = "$username:$password";

//Set php curl options. 
curl_setopt($ch, CURLOPT_URL,$job_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERPWD, $ch_values);
curl_setopt($ch, CURLOPT_POST, true);

//Setting the base postField. Here we are starting software name of the application.
$postField ="softwareName=GeneSeqer-5.0";

//HARD CODE CALLBACK URL HERE. MAKE SURE TO CHANGE THIS TO THE IP ADDRESS OF THAT HIS SCRIPT IS INSTALLED
$postField="$postField&callbackUrl=http://128.196.142.30/genesqr-5.0/done.php";

//Going through all the input form from process.php that user entered. Then adds it to the baseField.

foreach($_POST as $name => $value) {
 if($value != ""){
  $postField = "$postField&$name=$value"; 
  
  }
}


//Sets the postField as an option for our php curl request
curl_setopt($ch, CURLOPT_POSTFIELDS, $postField);

//Execute the php curl and grab the response
$response = curl_exec($ch);
$resultStatus = curl_getinfo($ch);

//Turn the response into json which php can manipulate 
$handled_json = json_decode($response,true);

//If the php curl was successful, display the results, if not, print failed results
if($resultStatus['http_code'] == 200) {
    $job_id=$handled_json['result']['id'];
    $status=$handled_json['result']['status'];
    echo "$response <br />";
    echo "<br />";
    echo "<h2>Your Job ID is $job_id</h2><br />";
    echo "<h2>Your Job Status is $status</h2><br />";
} 

else { //Here it failed
    echo '<h3>Call Failed</h3> '.print_r($resultStatus);
    echo "$response";
}

//destroy php curl object 
curl_close ($ch);
?>
</body>
</html>

