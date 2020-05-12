<?php
include_once ('DBConnector.php'); 
include_once ('user.php');
$con = new DBConnector;//Database Connection made

//data insert code starts here.
if (isset($_POST['btn-save'])) {
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
  $city = $_POST['city_name'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  
  //echo $first_name;
  //echo $last_name;

//Creating a User object
/* Note the way we create our object
 using constructor that will be used to initialize your variables*/
  $user = new User ();

  //FirstName
  $user -> setFirstName($first_name);
  $first_name = $user -> getFirstName();

   //LastName
   $user -> setLastName($last_name);
   $last_name = $user -> getLastName();

    //CitytName
  $user -> setCityName($city);
  $city = $user -> getCityName();

  //username
  $user -> setUsername($username);
  $city = $user -> getUsername();

  //Password
  $user -> setPassword($password);
  $city = $user -> getPassword();


if(!$user->validateForm()){
  $user->createFormErrorSessions();
  header("Refresh:0");
  die();
}

$res = $user -> save();

	if($res){
		echo "Save update was successful";
	}else{
		echo "An error occured!";
	}

	}
//mysql_close();
?>

<!DOCTYPE html>
<html>
<head>
	<title> Simple Form</title>
	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="validate.css">

  <script type = "text/javascript" src="validate.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
    <form method="POST" name="user_details" id="user_details" onsubmit="return validateForm()" action="<?=$_SERVER[ 'PHP_SELF' ]?>"  style='width:300px; '>
    <div class="form-group">
      <div id="form-errors">
         <?php
         session_start();
         if(!empty($_SESSION['form_errors'])){
           echo " " . $_SESSION['form_errors'];
           unset($_SESSION['form_errors']);
         }
         ?>
      </div>
  </div>
   <div class="form-group">
    <label for="first_name">First Name:</label>
    <input type="text" class="form-control" name="first_name">
  </div>

<div class="form-group">
    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" class="form-control">
  </div>

  <div class="form-group">
    <label for="city_name">City Name:</label>
    <input type="text" name="city_name" class="form-control">
  </div>
  
  <div class="form-group">
    <label for="username">Username:</label>
    <input type="text" name="username" class="form-control">
  </div>

  <div class="form-group">
    <label for="password">Password:</label>
    <input type="password" name="password" class="form-control">
  </div>


  <button type="submit" name="btn-save" class="btn btn-default"><strong>SAVE</strong></button>

   <div class="form-group">
   <div><a href="login.php">Login</a></div>
  </div> 
  
</body>
</html>
