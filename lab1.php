<?php
include_once ('DBConnector.php');
include_once ('user.php');
$con = new DBConnector;

if (isset($_POST['btn_save'])) {
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$city = $_POST['city_name'];

	$user = new User ( $first_name, $last_name, $city);
	$res = $user->save();

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
    <form method="POST" action="<?=$_SERVER[ 'PHP_SELF' ]?>"  style='width:300px; '>
   <div class="form-group">
    <label for="first_name">First Name:</label>
    <input type="text" class="form-control" name="first_name" required>
  </div>

<div class="form-group">
    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" class="form-control" required>
  </div>

  <div class="form-group">
    <label for="city_name">City Name:</label>
    <input type="text" name="city_name" class="form-control"  required>
  </div>


  <button type="submit" name="btn-save" class="btn btn-default"><strong>SAVE</strong></button>
    
  
</body>
</html>
