<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
        <link href="css/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body>
<h2>Genseqr-5.0</h2>
<br />
<form class="form-horizontal" action="process.php" method="post">
  <div class="control-group">
    <label class="control-label" name="login"for="login">iPlant Username</label>
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
</form>
<?php

session_start();
?>
</body>
</html>
