<?php
session_start();
if(!isset($_SESSION["admin"])){
	header("Location: login.php");
}

unset($_SESSION['id_user']); //matiin session id user
unset($_SESSION['admin']);
header('location:login.php'); //direct ke login.php
?>