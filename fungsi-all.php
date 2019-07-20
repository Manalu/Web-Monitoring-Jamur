<?php

/*----------------- KELEMBABAN 1 ----------------------*/
//Menghitung total record kelembaban node 1
function total_kelembaban_1(){
	include "koneksi.php";
	$sql = "SELECT COUNT(id_kelembaban) FROM reports_kelembaban_node1";
	$rs_result = mysqli_query($connect, $sql);  
	$row = mysqli_fetch_row($rs_result); 
	$total_records = $row[0];  
	return $total_records;
}
//Menghitung nilai MAX pada tabel kelembaban node 1
function max_kelembaban_1(){
	include "koneksi.php";
	$sql = "SELECT MAX(nilai_kelembaban) FROM reports_kelembaban_node1";
	$rs_result = mysqli_query($connect, $sql);  
	$row = mysqli_fetch_row($rs_result); 
	$max_records = $row[0];  
	return $max_records;
}
//Menghitung nilai MIN pada tabel kelembaban node 1
function min_kelembaban_1(){
	include "koneksi.php";
	$sql = "SELECT MIN(nilai_kelembaban) FROM reports_kelembaban_node1";
	$rs_result = mysqli_query($connect, $sql);  
	$row = mysqli_fetch_row($rs_result); 
	$min_records = $row[0];  
	return $min_records;
}
//Menghitung rata rata pada tabel kelembaban node 1
function average_kelembaban_1(){
	include "koneksi.php";
	$total_records = "SELECT COUNT(id_kelembaban) FROM reports_kelembaban_node1";
	$sum_kelembaban = "SELECT SUM(nilai_kelembaban) FROM reports_kelembaban_node1";
	$rs_result1 = mysqli_query($connect, $total_records);  
	$rs_result2 = mysqli_query($connect, $sum_kelembaban);  
	$row1 = mysqli_fetch_row($rs_result1);
	$row2 = mysqli_fetch_row($rs_result2);  
	$total_records = $row1[0];  
	$sum_kelembaban = $row2[0];  
	$average=$sum_kelembaban/$total_records;
	//convert 2 desimal
	return number_format((float)$average, 2, '.', '');
}


/*--------------------- KELEMBABAN 2 ----------------------*/
//Menghitung total record kelembaban node 2
function total_kelembaban_2(){
	include "koneksi.php";
	$sql = "SELECT COUNT(id_kelembaban) FROM reports_kelembaban_node2";
	$rs_result = mysqli_query($connect, $sql);  
	$row = mysqli_fetch_row($rs_result); 
	$total_records = $row[0];  
	return $total_records;
}
//Menghitung nilai MAX pada tabel kelembaban node 2
function max_kelembaban_2(){
	include "koneksi.php";
	$sql = "SELECT MAX(nilai_kelembaban) FROM reports_kelembaban_node2";
	$rs_result = mysqli_query($connect, $sql);  
	$row = mysqli_fetch_row($rs_result); 
	$max_records = $row[0];  
	return $max_records;
}
//Menghitung nilai MIN pada tabel kelembaban node 2
function min_kelembaban_2(){
	include "koneksi.php";
	$sql = "SELECT MIN(nilai_kelembaban) FROM reports_kelembaban_node2";
	$rs_result = mysqli_query($connect, $sql);  
	$row = mysqli_fetch_row($rs_result); 
	$min_records = $row[0];  
	return $min_records;
}
//Menghitung rata rata pada tabel kelembaban node 2
function average_kelembaban_2(){
	include "koneksi.php";
	$total_records = "SELECT COUNT(id_kelembaban) FROM reports_kelembaban_node2";
	$sum_kelembaban = "SELECT SUM(nilai_kelembaban) FROM reports_kelembaban_node2";
	$rs_result1 = mysqli_query($connect, $total_records);  
	$rs_result2 = mysqli_query($connect, $sum_kelembaban);  
	$row1 = mysqli_fetch_row($rs_result1);
	$row2 = mysqli_fetch_row($rs_result2);  
	$total_records = $row1[0];  
	$sum_kelembaban = $row2[0];  
	$average=$sum_kelembaban/$total_records;
	//convert 2 desimal
	return number_format((float)$average, 2, '.', '');
}

/*-------------------------SUHU 1--------------------*/
//Menghitung total record suhu node 1
function total_suhu_1(){
	include "koneksi.php";
	$sql = "SELECT COUNT(id_suhu) FROM reports_suhu_node1";
	$rs_result = mysqli_query($connect, $sql);  
	$row = mysqli_fetch_row($rs_result); 
	$total_records = $row[0];  
	return $total_records;
}
//Menghitung nilai MAX pada tabel suhu node 1
function max_suhu_1(){
	include "koneksi.php";
	$sql = "SELECT MAX(nilai_suhu) FROM reports_suhu_node1";
	$rs_result = mysqli_query($connect, $sql);  
	$row = mysqli_fetch_row($rs_result); 
	$max_records = $row[0];  
	return $max_records;
}
//Menghitung nilai MIN pada tabel suhu node 1
function min_suhu_1(){
	include "koneksi.php";
	$sql = "SELECT MIN(nilai_suhu) FROM reports_suhu_node1";
	$rs_result = mysqli_query($connect, $sql);  
	$row = mysqli_fetch_row($rs_result); 
	$min_records = $row[0];  
	return $min_records;
}
//Menghitung rata rata pada tabel suhu node 1
function average_suhu_1(){
	include "koneksi.php";
	$total_records = "SELECT COUNT(id_suhu) FROM reports_suhu_node1";
	$sum_kelembaban = "SELECT SUM(nilai_suhu) FROM reports_suhu_node1";
	$rs_result1 = mysqli_query($connect, $total_records);  
	$rs_result2 = mysqli_query($connect, $sum_kelembaban);  
	$row1 = mysqli_fetch_row($rs_result1);
	$row2 = mysqli_fetch_row($rs_result2);  
	$total_records = $row1[0];  
	$sum_kelembaban = $row2[0];  
	$average=$sum_kelembaban/$total_records;
	//convert 2 desimal
	return number_format((float)$average, 2, '.', '');
}

/*------------------------- SUHU 2 ---------------------*/
//Menghitung total record suhu node 2
function total_suhu_2(){
	include "koneksi.php";
	$sql = "SELECT COUNT(id_suhu) FROM reports_suhu_node2";
	$rs_result = mysqli_query($connect, $sql);  
	$row = mysqli_fetch_row($rs_result); 
	$total_records = $row[0];  
	return $total_records;
}
//Menghitung nilai MAX pada tabel suhu node 2
function max_suhu_2(){
	include "koneksi.php";
	$sql = "SELECT MAX(nilai_suhu) FROM reports_suhu_node2";
	$rs_result = mysqli_query($connect, $sql);  
	$row = mysqli_fetch_row($rs_result); 
	$max_records = $row[0];  
	return $max_records;
}
//Menghitung nilai MIN pada tabel suhu node 2
function min_suhu_2(){
	include "koneksi.php";
	$sql = "SELECT MIN(nilai_suhu) FROM reports_suhu_node2";
	$rs_result = mysqli_query($connect, $sql);  
	$row = mysqli_fetch_row($rs_result); 
	$min_records = $row[0];  
	return $min_records;
}
//Menghitung rata rata pada tabel suhu node 2
function average_suhu_2(){
	include "koneksi.php";
	$total_records = "SELECT COUNT(id_suhu) FROM reports_suhu_node2";
	$sum_kelembaban = "SELECT SUM(nilai_suhu) FROM reports_suhu_node2";
	$rs_result1 = mysqli_query($connect, $total_records);  
	$rs_result2 = mysqli_query($connect, $sum_kelembaban);  
	$row1 = mysqli_fetch_row($rs_result1);
	$row2 = mysqli_fetch_row($rs_result2);  
	$total_records = $row1[0];  
	$sum_kelembaban = $row2[0];  
	$average=$sum_kelembaban/$total_records;
	//convert 2 desimal
	return number_format((float)$average, 2, '.', '');
}


?>