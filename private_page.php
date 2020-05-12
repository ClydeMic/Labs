<?php
session_start();
//if(!isset($_SESSION['username'])){
 //header("Location:login.php");
//}
?>

<!DOCTYPE html>
<html>
<head>
	<title> Accessed</title>
	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="validate.css">

  <script type = "text/javascript" src="validate.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
    <p> This is a restricted page.</p>
    <p> Remember Apart but Not Alone!!! </p>
    <p><a href="logout.php">Logout</a></p>

</body>
</html>