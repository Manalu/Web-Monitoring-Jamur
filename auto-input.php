<?php
session_start();
if(!isset($_SESSION["admin"])){
	header("Location: login.php");
}

include ("koneksi.php");
$kelembaban1 = $_POST['nilai_kelembaban1'];
$kelembaban2 = $_POST['nilai_kelembaban2'];
$suhu1 = $_POST['nilai_suhu1'];
$suhu2 = $_POST['nilai_suhu2'];

$node = $_POST['node'];
$mode = $_POST['mode'];
$status_relay = $_POST['status_relay'];

date_default_timezone_set('Asia/Jakarta');
$waktu = date("Y-m-d H:i:sa");


if (!empty($_POST['nilai_kelembaban1'])){
	$x = "insert into reports_kelembaban_node1 (nilai_kelembaban, waktu_kelembaban) values ('$kelembaban1','$waktu')";
	mysqli_query($connect,$x);
}
if (!empty($_POST['nilai_kelembaban2'])){
	$x = "insert into reports_kelembaban_node2 (nilai_kelembaban, waktu_kelembaban) values ('$kelembaban2','$waktu')";
	mysqli_query($connect,$x);
}
if (!empty($_POST['nilai_suhu1'])) {
	$x = "insert into reports_suhu_node1 (nilai_suhu, waktu_suhu) values ('$suhu1','$waktu')";
	mysqli_query($connect,$x);
}
if (!empty($_POST['nilai_suhu2'])) {
	$x = "insert into reports_suhu_node2 (nilai_suhu, waktu_suhu) values ('$suhu2','$waktu')";
	mysqli_query($connect,$x);
}
if (!empty($_POST['status_relay'])) {
	$x = "insert into reports_relay (status, waktu, node, mode) values ('$status_relay','$waktu','$node','$mode')";
	mysqli_query($connect,$x);
}

?>