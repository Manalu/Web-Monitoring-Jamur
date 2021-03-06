<?php
include '../koneksi.php';
# MENGAMBIL DATA DARI DATABASE MYSQL

$datetime = date('Ymd-His');
 
include "phpexcel/PHPExcel.php";
include "phpexcel/PHPExcel/Writer/Excel2007.php";
 
$excel = new PHPExcel;
 
$excel->getProperties()->setCreator("Katon Gilang Bagaskara");
$excel->getProperties()->setLastModifiedBy("Katon Gilang Bagaskara");
$excel->getProperties()->setTitle("Data Records Kelembaban Node 2");
$excel->removeSheetByIndex(0);
 
 
$sheet = $excel->createSheet();
$sheet->setTitle('sheet_1');
 $sheet->setCellValue("A1", "No");
 $sheet->setCellValue("B1", "Waktu Kelembaban");
 $sheet->setCellValue("C1", "Nilai Kelembaban");
 
 
$sql = "SELECT * FROM reports_kelembaban_node2 ORDER BY id_kelembaban ASC";
$q = mysqli_query($connect,$sql);
$i = 2; //Dimulai dengan baris ke dua, baris pertama digunakan oleh titel kolom
$no = 1;

while( $r = mysqli_fetch_array( $q ) ){
   $sheet->setCellValue( "A" . $i, $no );
   $sheet->setCellValue( "B" . $i, $r['waktu_kelembaban'] );
   $sheet->setCellValue( "C" . $i, $r['nilai_kelembaban'] );
   $i++;
   $no++;
}
 
 
 $writer = new PHPExcel_Writer_Excel2007($excel);
 $writer->save("Reports_Kelembaban_Node2.xlsx");
 
 header("location:./Reports_Kelembaban_Node2.xlsx");
?>