<?php
session_start();
if(!isset($_SESSION["admin"])){
	header("Location: login.php");
}
include ("koneksi.php");
$status;
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="website monitoring suhu dan kelembaban jamur tiram">
    <meta name="author" content="katon gilang bagaskara">
    <link rel="icon" href="image/icon.png">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="tamp/bootstrap.min.css" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Js -->
    <script src="tamp/mqtt-2.9.0.js"></script>
    <script type="text/javascript" src="tamp/jquery-3.3.1.min.js"></script>
    <script src="js/script-mode.js" charset="utf-8"></script>
   
	<title>Monitoring Jamur</title>
</head>
<body>
	<?php
		include ('navbar.php');
		include ('sidebar.php');
	?>
	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<h1 class="h2" >MODE PENGABUTAN</h1>
			<div class="btn-toolbar mb-2 mb-md-0">
	            <?php
					date_default_timezone_set('Asia/Jakarta');
					echo "Tanggal dan Waktu sekarang adalah " . date("Y-m-d H:i:sa");
				?>
			</div>
		</div>
		<div>
		<!-- STATISTIC NODE 1-->
		<h4>NODE 1</h4>
	      <section>
	          <div class="container">
	              <div class="row justify-content-center">
	                  <div class="col-md-6 col-lg-3">
	                      <div class="bg-statistic-grey">
	                          <h2 class="text-white"><span id="kelembaban-1"></span>%</h2>
	                          <span class="text-white">Kelembaban Sekarang</span>
	                      </div>
	                  </div>
	                  <div class="col-md-6 col-lg-3">
	                      <div class="bg-statistic-purple">
	                          <h2 class="text-white"><span id="suhu-celcius1"></span>°C</h2>
	                          <span class="text-white">Suhu Sekarang (Celcius)</span>
	                      </div>
	                  </div>
	                  <div class="col-md-6 col-lg-3">
	                      <div class="bg-statistic-purple">
	                          <h2 class="text-white"><span id="suhu-fahrenheit1"></span>°F</h2>
	                          <span class="text-white">Suhu Sekarang (Fahrenheit)</span>
	                      </div>
	                  </div>
	              </div>
	          </div>
	      </section>
	      <!-- END STATISTIC 1-->

	      <!-- STATISTIC NODE 2 -->
	      <h4>NODE 2</h4>
	      <section>
	          <div class="container">
	              <div class="row justify-content-center">
	                  <div class="col-md-6 col-lg-3">
	                      <div class="bg-statistic-grey">
	                          <h2 class="text-white"><span id="kelembaban-2"></span>%</h2>
	                          <span class="text-white">Kelembaban Sekarang</span>
	                      </div>
	                  </div>
	                  <div class="col-md-6 col-lg-3">
	                      <div class="bg-statistic-purple">
	                          <h2 class="text-white"><span id="suhu-celcius2"></span>°C</h2>
	                          <span class="text-white">Suhu Sekarang (Celcius)</span>
	                      </div>
	                  </div>
	                  <div class="col-md-6 col-lg-3">
	                      <div class="bg-statistic-purple">
	                          <h2 class="text-white"><span id="suhu-fahrenheit2"></span>°F</h2>
	                          <span class="text-white">Suhu Sekarang (Fahrenheit)</span>
	                      </div>
	                  </div>
	              </div>
	          </div>
	      </section>
	      <!-- END STATISTIC 2-->

	      <!-- PANEL MODE -->
			<section>
	          <div class="container">
	              <div class="row">

	              	<!-- MODE MANUAL -->
	              	<div class="col-sm-6">
	                  <div class="card mode">
						  <div class="card-header">MODE MANUAL</div>
						  <div class="card-body">
					        <p class="card-text">Fitur perintah pengabutan tanpa mempertimbangkan batas suhu/kelembaban
					        	Dijalankan sesuai keinginan user. Cara menjalankan dengan cara menekan tombol dibawah, maka pengabutan akan menyala</p>

					        <!----------------------- MODE MANUAL NODE 1 ----------------------->
					        <?php 
					        $query1 = "SELECT * FROM reports_mode_manual WHERE keterangan='node1' ORDER BY id_mode_manual DESC LIMIT 1";
							$hasil = mysqli_query($connect,$query1);
						 	while($data = mysqli_fetch_assoc($hasil))
						    {
							?>
							<form action="panel-mode.php" method="post" enctype="multipart/form-data">		      		
								<?php
								if ($data['status']=="mati") {
									echo '<div class="input-group-sm mb-3 row"><label class="col-sm-5 col-form-label">NODE 1 :</label><input type="submit" name="simpan_manual1" class="btn btn-success" value="Nyalakan Sekarang">				  </div>';
									$statusModeManual="aktif";
								}
								else{
									echo '<div class="input-group-sm mb-3 row">
									<label class="col-sm-5 col-form-label">NODE 1 :</label>
									<input type="submit" name="simpan_manual1" class="btn btn-danger" value="Matikan Sekarang">
									</div>';
									$statusModeManual="mati";
								}
								?>
								<input hidden="true" type="text" type="text" name="status" id="onoff_mode_manual1" value="<?php echo $data['status']; ?>">
							</form>							
					    	<?php 
					    	} 
					    	if (!empty($_POST['simpan_manual1'])){
									date_default_timezone_set('Asia/Jakarta');
									$tanggalManual = date("Y-m-d H:i:sa");
									$keterangan = "node1";

								    $q = "INSERT INTO reports_mode_manual (status, waktu,keterangan) VALUES ('$statusModeManual', '$tanggalManual', '$keterangan')";
								    if (mysqli_query($connect,$q)){
									echo "<script type='text/javascript'>window.location.replace('panel-mode.php');</script>";
								  }
								}
					    	?>


					    	<!----------------------- MODE MANUAL NODE 2 ----------------------->
					    	<?php 
					        $query2 = "SELECT * FROM reports_mode_manual WHERE keterangan='node2' ORDER BY id_mode_manual DESC LIMIT 1";
							$hasil = mysqli_query($connect,$query2);
						 	while($data = mysqli_fetch_assoc($hasil))
						    {
							?>
							<form action="panel-mode.php" method="post" enctype="multipart/form-data">		      		
								<?php
								if ($data['status']=="mati") {
									echo '<div class="input-group-sm mb-3 row"><label class="col-sm-5 col-form-label">NODE 2 :</label><input type="submit" name="simpan_manual2" class="btn btn-success" value="Nyalakan Sekarang">				  </div>';
									$statusModeManual="aktif";
								}
								else{
									echo '<div class="input-group-sm mb-3 row">
									<label class="col-sm-5 col-form-label">NODE 2 :</label>
									<input type="submit" name="simpan_manual2" class="btn btn-danger" value="Matikan Sekarang">
									</div>';
									$statusModeManual="mati";
								}
								?>
								<input hidden="true" type="text" type="text" name="status" id="onoff_mode_manual2" value="<?php echo $data['status']; ?>">
							</form>							
					    	<?php 
					    	} 					    	
								if (!empty($_POST['simpan_manual2'])){
									date_default_timezone_set('Asia/Jakarta');
									$tanggalManual = date("Y-m-d H:i:sa");
									$keterangan = "node2";

								    $q = "INSERT INTO reports_mode_manual (status, waktu,keterangan) VALUES ('$statusModeManual', '$tanggalManual', '$keterangan')";
								    if (mysqli_query($connect,$q)){
									echo "<script type='text/javascript'>window.location.replace('panel-mode.php');</script>";
								  }
								}
					    	?>

					      </div>
						</div>
					</div>
					<!-- END MODE MANUAL -->

					<!-- MODE OTOMATIS -->
					<div class="col-sm-6">
	                  <div class="card mode">
						  <div class="card-header">MODE OTOMATIS</div>
						  <div class="card-body">
					        <p class="card-text">Edit batas kelembaban/suhu, jika suhu/kelembaban tidak sesuai dengan batas yang sudah di edit, maka pengabutan akan otomatis menyala susuai mode ini</p>
					      	
					        <?php 
					        $query = "SELECT * FROM reports_mode_otomatis ORDER BY id_mode_otomatis DESC LIMIT 1";

							  $hasil = mysqli_query($connect,$query);
							  while($data = mysqli_fetch_assoc($hasil))
							  {
							?>

					      	<form action="panel-mode.php" method="post" enctype="multipart/form-data">
					      		<div class="input-group-sm mb-3 row">
								 	<label class="col-sm-5 col-form-label">Batas Kelembaban (<)</label>
								    <?php
									if ($data['status']=="mati") {
										echo "<input type='number' name='batas_kelembaban' style='width: 20%' class='form-control' value=".$data['batas_kelembaban']." id='id_kelembaban'>";
										$status="aktif";
									}
									else{
										echo "<input readonly type='number' name='batas_kelembaban' style='width: 20%' class='form-control' value=".$data['batas_kelembaban']." id='id_kelembaban'>";
										$status="mati";
									}
									?>	
								    <div class="input-group-append">
									  <span class="input-group-text">%</span>
									</div>
								</div>
								<div class="input-group-sm mb-3 row">
								 	<label class="col-sm-5 col-form-label">Batas Suhu (>)</label>
								 	 <?php
									if ($data['status']=="mati") {
										echo "<input type='number' name='batas_suhu' style='width: 20%' class='form-control' value=".$data['batas_suhu']." id='id_suhu' >";
										$status="aktif";
									}
									else{
										echo "<input readonly type='number' name='batas_suhu' style='width: 20%' class='form-control' value=".$data['batas_suhu']." id='id_suhu' >";
										$status="mati";
									}
									?>	
								    <div class="input-group-append">
									  <span class="input-group-text">°C</span>
									</div>
								</div>
								<span><a class="text-muted" href="#" onclick="reset();"><span data-feather="repeat"></span></a><center>
								<?php
								if ($data['status']=="mati") {
									echo "<input type='submit' name='simpan_otomatis' class='btn btn-success' value='Aktifkan Mode'>";
									$statusModeOtomatis="aktif";
								}
								else{
									echo "<input type='submit' name='simpan_otomatis' class='btn btn-danger' value='Matikan Mode'>";
									$statusModeOtomatis="mati";
								}
								?>
								<!--untuk keperluan penjalanan mode otomatis-->
								</center></span>
								<input hidden="true" type="text" type="text" name="status" id="onoff_mode_otomatis" value="<?php echo $data['status']; ?>">
							</form>

							<?php
								}
								//UNTUK POST MODE OTOMATIS
								if (!empty($_POST['simpan_otomatis'])){
									$batas_kelembaban = $_POST['batas_kelembaban'];
								    $batas_suhu = $_POST['batas_suhu'];
								    date_default_timezone_set('Asia/Jakarta');
									$tanggalManual = date("Y-m-d H:i:sa");

								    $query = "INSERT INTO reports_mode_otomatis (batas_kelembaban,batas_suhu,status,waktu) VALUES ('$batas_kelembaban','$batas_suhu', '$statusModeOtomatis' ,'$tanggalManual')";

								    if (mysqli_query($connect,$query)){
									echo "<script type='text/javascript'>window.location.replace('panel-mode.php');</script>";
								  }
								}							
							?>
					      </div>
					  </div>
	              	</div>
					<!--END MODE OTOMATIS -->
	          	</div>
	          </div>
	      </section>
		</div>
		<!-- END PANEL MODE -->		
		
	</main>

	<!-- Icons -->
    <script src="tamp/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
    
	</body>
	<script type="text/javascript">
          function reset() {
              document.getElementById("id_kelembaban").value = "80";
              document.getElementById("id_suhu").value = "28";
          }
      </script>
	</html>