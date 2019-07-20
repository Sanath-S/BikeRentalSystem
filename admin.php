<?php include('aserver.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Admin login</h2>
  </div>
	 
  <form method="post" action="admin.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="aname" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="apassword">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_admin">Login</button>
  	</div>
  	
  </form>
</body>
</html>