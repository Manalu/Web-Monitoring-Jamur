<?php
include '../koneksi.php';
# MENGAMBIL DATA DARI DATABASE MYSQL

$datetime = date('Ymd-His');
 
include "phpexcel/PHPExcel.php";
include "phpexcel/PHPExcel/Writer/Excel2007.php";
 
$excel = new PHPExcel;
 
$excel->getProperties()->setCreator("Katon Gilang Bagaskara");
$excel->getProperties()->setLastModifiedBy("Katon Gilang Bagaskara");
$excel->getProperties()->setTitle("Data Records Relay");
$excel->removeSheetByIndex(0);
 
 
$sheet = $excel->createSheet();
$sheet->setTitle('sheet_1');
 $sheet->setCellValue("A1", "No");
 $sheet->setCellValue("B1", "Status");
 $sheet->setCellValue("C1", "Waktu");
 $sheet->setCellValue("D1", "Node");
 $sheet->setCellValue("E1", "Mode");
 
 
$sql = "SELECT * FROM reports_relay ORDER BY id_reports_relay ASC";
$q = mysqli_query($connect,$sql);
$i = 2; //Dimulai dengan baris ke dua, baris pertama digunakan oleh titel kolom
$no = 1;

while( $r = mysqli_fetch_array( $q ) ){
   $sheet->setCellValue( "A" . $i, $no );
   $sheet->setCellValue( "B" . $i, $r['status'] );
   $sheet->setCellValue( "C" . $i, $r['waktu'] );
   $sheet->setCellValue( "D" . $i, $r['node'] );
   $sheet->setCellValue( "E" . $i, $r['mode'] );
   $i++;
   $no++;
}
 
 
 $writer = new PHPExcel_Writer_Excel2007($excel);
 $writer->save("Reports_Relay.xlsx");
 
 header("location:./Reports_Relay.xlsx");

?>