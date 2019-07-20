<?php
include '../koneksi.php';
# MENGAMBIL DATA DARI DATABASE MYSQL

$datetime = date('Ymd-His');
 
include "phpexcel/PHPExcel.php";
include "phpexcel/PHPExcel/Writer/Excel2007.php";
 
$excel = new PHPExcel;
 
$excel->getProperties()->setCreator("Katon Gilang Bagaskara");
$excel->getProperties()->setLastModifiedBy("Katon Gilang Bagaskara");
$excel->getProperties()->setTitle("Data Records Penyalaan Mode Otomatis");
$excel->removeSheetByIndex(0);
 
 
$sheet = $excel->createSheet();
$sheet->setTitle('sheet_1');
 $sheet->setCellValue("A1", "No");
 $sheet->setCellValue("B1", "Batas Kelembaban");
 $sheet->setCellValue("C1", "Batas Suhu");
 $sheet->setCellValue("D1", "Status");
 $sheet->setCellValue("E1", "Waktu");
 
 
$sql = "SELECT * FROM reports_mode_otomatis ORDER BY id_mode_otomatis ASC";
$q = mysqli_query($connect,$sql);
$i = 2; //Dimulai dengan baris ke dua, baris pertama digunakan oleh titel kolom
$no = 1;

while( $r = mysqli_fetch_array( $q ) ){
   $sheet->setCellValue( "A" . $i, $no );
   $sheet->setCellValue( "B" . $i, $r['batas_kelembaban'] );
   $sheet->setCellValue( "C" . $i, $r['batas_suhu'] );
   $sheet->setCellValue( "D" . $i, $r['status'] );
   $sheet->setCellValue( "E" . $i, $r['waktu'] );
   $i++;
   $no++;
}
 
 
 $writer = new PHPExcel_Writer_Excel2007($excel);
 $writer->save("Reports_Mode_Otomatis.xlsx");
 
 header("location:./Reports_Mode_Otomatis.xlsx");

?>