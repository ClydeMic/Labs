<?php
include_once ('DBConnector.php'); 
include_once ('user.php');

$con = new DBConnector;//Database Connection made


//data insert code starts here.
if (isset($_POST['btn-login'])) {

	  $username = $_POST['username'];
    $password = $_POST['password'];

    $instance = User::create();

    $instance->setPassword($password);
    $instance->setUsername($username);

  if($instance->isPasswordCorrect()){
      $instance->login();

      //close database connection
     // $con->closeDatabase();
     
      //next create a user session
      $instance->createUserSession();

      echo "You have successfully logged in";
      
  }else{
      $con->closeDatabase();
      header("Loacation:login.php");
  }
}
  ?>

<!DOCTYPE html>
<html>
<head>
	<title> Login</title>
	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="validate.css">

  <script type = "text/javascript" src="validate.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
    <form method="POST" name="login" id="login" action="<?=$_SERVER[ 'PHP_SELF' ]?>"  style='width:300px; '>

   <div class="form-group">
    <label for="username">Username:</label>
    <input type="text" name="username" class="form-control" required>
  </div>

<div class="form-group">
    <label for="password">Password:</label>
    <input type="password" name="password" class="form-control" required>
  </div>

  <button type="submit" name="btn-login" class="btn btn-default"><strong>LOGIN</strong></button>
      </form>
</body>
</html>