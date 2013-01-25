<!DOCTYPE html>
<html>
<head>
	<title>Processing</title>
        <link href="css/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body>
<?php

//session_start();
$username=$_POST['login'];
$password=$_POST['password'];

$_SESSION['login']=$username;
$_SESSION['password']=$password;

// Authentication of a user

$ch = curl_init();

$auth_url = 'http://foundation.iplantc.org/auth-v1/';

curl_setopt($ch, CURLOPT_URL,$auth_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_POST, true);
$ch_values = "$username:$password";
curl_setopt($ch, CURLOPT_USERPWD, $ch_values);
// Getting results

$response = curl_exec($ch);                                          
$resultStatus = curl_getinfo($ch);                                   

if($resultStatus['http_code'] == 200) {
     echo '<h2>Create a job</h2><br />';
           
     echo '<form class="form-horizontal" action="job.php" method="post">
  
  <div class="control-group">
    <label class="control-label" name="jobName"for="login">Job Name</label>
    <div class="controls">
      <input type="text" name="jobName" id="login" placeholder="Job Name" required>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" name="outPutFile" for="output">Output Location</label>
    <div class="controls">
      <input type="text" name="outPutFile" id="outPutFile" placeholder="Output Location" required>
    </div>
  </div>
  
  <div class="control-group">
     <label class="control-label" name="Species" for="Species">Species</label>
     <div class="controls">
         <select name="Species" required>  
                <option>Arabidopsis</option>  
                <option>maize</option>  
                <option>rice</option>  
                <option>Medicago</option>  
                <option>Aspergillus</option>
		<option>yeast</option>
		<option>human</option>
		<option>mouse</option>
		<option>rat</option>
		<option>chicken</option>
		<option>Drosophila</option>
		<option>nematode</option>  
         </select>
     </div>
  </div>

  <div class="control-group">
      <label class="control-label" name="libfname" for="libfname">libfname</label>
      <div class="controls">
           <input type="text" name="libfname" id="libfname" placeholder="libfname">
       </div>
  </div>
      
  <div class="control-group">
      <label class="control-label" name="EstFormat" for="EstFormat">EstFormat</label>  
      <div class="controls">
      	   <input type="text" name="EstFormat" id="EstFormat" placeholder="EstFormat">
       </div>
  </div>
  
   <div class="control-group">
	<label class="control-label" name="estSeq" for="estSeq">estSeq</label>
        <div class="controls">
	    <input type="text" name="estSeq" id="estSeq" placeholder="estSeq" required>
        </div>
   </div> 

   <div class="control-group">
        <label class="control-label" name="maxnest" for="maxnest">maxnest</label>
        <div class="controls">
            <input type="text" name="maxnest" id="maxnest" placeholder="maxnest">
        </div>
   </div>


   <div class="control-group">
   	<label class="control-label" name="requestedTime" for="">Requested Time</label>
        <div class="controls">
           <input type="text" name="requestedTime" id="requestedTime" placeholder="1:00:00" required>
        </div>
   </div>
     
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Launch</button>
    </div>
  </div>

  
</form>';
   echo "<br />";
   echo "<h2>Check the Status of a Job</h2><br />";
   echo 
   '<form class="form-horizontal" action="status.php" method="get">
    <div class="control-group">
         <label class="control-label" name="job_id"for="login">Job ID</label>
         <div class="controls">
            <input type="text" name="job_id" id="login" placeholder="Job ID" required>
         </div>
    </div>
    <div class="controls">
        <button type="submit" class="btn">Check Status</button>
    </div>
  </div>
  </form>';



  echo '<h2>Kill a job</h2><br />';      
  echo '<form class="form-horizontal" action="kill.php" method="post">
  <div class="control-group">
    <label class="control-label" name="job_id"for="login">Job ID</label>
    <div class="controls">
      <input type="text" name="job_id" id="login" placeholder="Job ID" required>
    </div>
  </div>
    <div class="controls">
      <button type="submit" class="btn">Delete Job</button>
    </div>
  </div>
</form>';
           $handled_json = json_decode($response,true);
           $TOKEN=$handled_json['result']['token'];
           $_SESSION['token']=$TOKEN;
} else if($resultStatus['http_code'] == 401){
    echo 'Login Failed ';
/*    echo '<form action="process.php" method="post">
          Login <input name="login" type="text" />
          Password <input name="password" type="password" />

          <input type="submit" />
          </form> ';                         
*/

    echo'<form class="form-horizontal" action="process.php" method="post">
  <div class="control-group">
    <label class="control-label" name="login"for="login">Email</label>
    <div class="controls">
      <input type="text" name="login" id="login" placeholder="Username">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" name="password" for="password">Password</label>
    <div class="controls">
      <input type="password" name="password" id="inputPassword" placeholder="Password">
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Sign in</button>
    </div>
  </div>
</form>';
} else{

    echo 'Login Failed '.print_r($resultStatus);
}
curl_close ($ch);

?>

</body>
<html>
