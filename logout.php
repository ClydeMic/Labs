<?php
include_once ('user.php');

if(!isset($_POST['username'])){

$instance = User::create();
$instance->logout();
}
?>