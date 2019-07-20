<?php
session_start();
if(!isset($_SESSION["admin"])){
	header("Location: login.php");}
include "koneksi.php"; //ambil koneksi ke db

$username = $_POST['username'];
$password     = $_POST['password'];
$pass = stripslashes($password);
$pass     = mysqli_real_escape_string($connect, $pass); //mencegah mysql injection
$pass = md5($pass); //enkripsi paswot
$login = mysqli_query($connect, "SELECT * FROM user WHERE username = '$username' AND password='$pass'");
$row=mysqli_fetch_array($login);

	if ($row['username'] == $username AND $row['password'] == $pass){
	 session_start(); 
	  $_SESSION['admin'] = $row['username'];//menyimpan session username
	  header('location:panel-home.php');}

	else{ //kalo levelnya bukan user ato admin maka masuk sini
	  echo "<script>alert('Maaf, Pastikan Username dan Password anda benar!');
	  window.location=('login.php');</script>";}
?>