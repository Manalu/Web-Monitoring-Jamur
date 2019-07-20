<?php
session_start();
if(!isset($_SESSION["admin"])){
	header("Location: login.php");
}
include ("koneksi.php");
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
   
	<title>Monitoring Jamur</title>
</head>
<body>
	<?php
		include ('navbar.php');
		include ('sidebar.php');
	?>
	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<h1 class="h2" >DASHBOARD</h1>
			<div class="btn-toolbar mb-2 mb-md-0">
	            <?php
					date_default_timezone_set('Asia/Jakarta');
					echo "Tanggal dan Waktu sekarang adalah " . date("Y-m-d H:i:sa");
				?>
			</div>
		</div>
		<div class="card">
		  <div class="card-header">
		    NODE 1
		  </div>
		  <div class="card-body">
		  	<div id="id_graph_line_kelembaban1"></div>	
			<div id="id_graph_line_suhu1"></div>	
		  </div>
		</div>

		<div class="card">
		  <div class="card-header">
		    NODE 2
		  </div>
		  <div class="card-body">
		  	<div id="id_graph_line_kelembaban2"></div>	
			<div id="id_graph_line_suhu2"></div>	
		  </div>
		</div>
		<div>			
		</div>
	</main>
	
	<!-- Icons -->
    <script src="tamp/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!-- Highcharts -->
    <script src="tamp/highcharts/highcharts.js"></script>
	<script src="tamp/highcharts/series-label.js"></script>
	<script src="tamp/highcharts/exporting.js"></script>
	<script src="tamp/highcharts/export-data.js"></script>
	
	<?php
		$sql = "SELECT * from reports_kelembaban_node1 ORDER BY id_kelembaban DESC LIMIT 8";
	    $hasil = mysqli_query($connect,$sql);
	      while ($data = mysqli_fetch_assoc($hasil)){
	          $nilai_kelembaban1[] = intval($data['nilai_kelembaban']);
	          $waktu_kelembaban1[] = $data['waktu_kelembaban'];
	          
	      }
	      //print_r(json_encode($nilai_kelembaban));
	    $sql = "SELECT * from reports_kelembaban_node2 ORDER BY id_kelembaban DESC LIMIT 8";
	    $hasil = mysqli_query($connect,$sql);
	      while ($data = mysqli_fetch_assoc($hasil)){
	          $nilai_kelembaban2[] = intval($data['nilai_kelembaban']);
	          $waktu_kelembaban2[] = $data['waktu_kelembaban'];
	          
	      }
		$sql = "SELECT * from reports_suhu_node1 ORDER BY id_suhu DESC LIMIT 8";
	    $hasil = mysqli_query($connect,$sql);
	      while ($data = mysqli_fetch_assoc($hasil)){
	          $nilai_suhu1[] = intval($data['nilai_suhu']);
	          $waktu_suhu1[] = $data['waktu_suhu'];
	      }
	      //print_r(json_encode($nilai_kelembaban));
	    $sql = "SELECT * from reports_suhu_node2 ORDER BY id_suhu DESC LIMIT 8";
	    $hasil = mysqli_query($connect,$sql);
	      while ($data = mysqli_fetch_assoc($hasil)){
	          $nilai_suhu2[] = intval($data['nilai_suhu']);
	          $waktu_suhu2[] = $data['waktu_suhu'];
	      }
	?>

	<!-------------------- GRAFIK LINE --------------------->
	<!--- grafik ini harus ada di file ini .php ----->

	<!-------------------------------- NODE 1 ------------------------------------->
	<script type="text/javascript">
    Highcharts.chart('id_graph_line_kelembaban1', {
	    title: {
	        text: 'Grafik Line Kelembaban'
	    },
	    subtitle: {
	        text: 'Menampilkan grafik kelembaban secara realtime'
	    },
	    xAxis:{
	    	categories: <?=json_encode(array_reverse($waktu_kelembaban1));?>,
	    	tickmarkPlacement: 'on',
	    	title: {
	    		enabled : false
	    	}
	    },
	    yAxis: {
	        title: {
	            text: 'Kelembaban (%)'
	        }
	    },
	    tooltip:{
	    	split: true,
	    	valueSuffix: ' %'
	    },
	    legend: {
	        layout: 'vertical',
	        align: 'right',
	        verticalAlign: 'middle'
	    },
	    plotOptions: {
	        series: {
	            label: {
	                connectorAllowed: false
	            }
	        }
	    },
	    series: [
	        {name: 'Node 1',
	        data: <?=json_encode(array_reverse($nilai_kelembaban1)); ?>
	    	}
	    ],
	    responsive: {
	        rules: [{
	            condition: {
	                maxWidth: 500
	            },
	            chartOptions: {
	                legend: {
	                    layout: 'horizontal',
	                    align: 'center',
	                    verticalAlign: 'bottom'
	                }
	            }
	        }]
	    }
	});
    </script>


    <script type="text/javascript">
    Highcharts.chart('id_graph_line_suhu1', {

	    title: {
	        text: 'Grafik Line Suhu'
	    },

	    subtitle: {
	        text: 'Menampilkan grafik suhu secara realtime'
	    },
	    xAxis:{
	    	categories: <?=json_encode(array_reverse($waktu_suhu1)); ?>,
	    	tickmarkPlacement: 'on',
	    	title: {
	    		enabled : false
	    	}
	    },
	    yAxis: {
	        title: {
	            text: 'Suhu (°C)'
	        }
	    },
	    tooltip:{
	    	split: true,
	    	valueSuffix: ' °C'
	    },
	    legend: {
	        layout: 'vertical',
	        align: 'right',
	        verticalAlign: 'middle'
	    },

	    plotOptions: {
	        series: {
	            label: {
	                connectorAllowed: false
	            }
	        }
	    },

	    series: [
	        {name: 'Node 1',
	        data: <?=json_encode(array_reverse($nilai_suhu1)); ?>
	    }
	    ],

	    responsive: {
	        rules: [{
	            condition: {
	                maxWidth: 500
	            },
	            chartOptions: {
	                legend: {
	                    layout: 'horizontal',
	                    align: 'center',
	                    verticalAlign: 'bottom'
	                }
	            }
	        }]
	    }

	});
    </script>


	<!-------------------------------- END NODE 1 ------------------------------------->    


	<!-------------------------------- NODE 2 ------------------------------------->

    <script type="text/javascript">
    Highcharts.chart('id_graph_line_kelembaban2', {

	    title: {
	        text: 'Grafik Line Kelembaban'
	    },

	    subtitle: {
	        text: 'Menampilkan grafik kelembaban secara realtime'
	    },
	    xAxis:{
	    	categories: <?=json_encode(array_reverse($waktu_kelembaban2));?>,
	    	tickmarkPlacement: 'on',
	    	title: {
	    		enabled : false
	    	}
	    },
	    yAxis: {
	        title: {
	            text: 'Kelembaban (%)'
	        }
	    },
	    tooltip:{
	    	split: true,
	    	valueSuffix: ' %'
	    },
	    legend: {
	        layout: 'vertical',
	        align: 'right',
	        verticalAlign: 'middle'
	    },

	    plotOptions: {
	        series: {
	            label: {
	                connectorAllowed: false
	            }
	        }
	    },

	    series: [
	        {name: 'Node 2',
	        data: <?=json_encode(array_reverse($nilai_kelembaban2)); ?>
	    	}
	    ],

	    responsive: {
	        rules: [{
	            condition: {
	                maxWidth: 500
	            },
	            chartOptions: {
	                legend: {
	                    layout: 'horizontal',
	                    align: 'center',
	                    verticalAlign: 'bottom'
	                }
	            }
	        }]
	    }

	});
    </script>


    <script type="text/javascript">
    Highcharts.chart('id_graph_line_suhu2', {

	    title: {
	        text: 'Grafik Line Suhu'
	    },

	    subtitle: {
	        text: 'Menampilkan grafik suhu secara realtime'
	    },
	    xAxis:{
	    	categories: <?=json_encode(array_reverse($waktu_suhu2)); ?>,
	    	tickmarkPlacement: 'on',
	    	title: {
	    		enabled : false
	    	}
	    },
	    yAxis: {
	        title: {
	            text: 'Suhu (°C)'
	        }
	    },
	    tooltip:{
	    	split: true,
	    	valueSuffix: ' °C'
	    },
	    legend: {
	        layout: 'vertical',
	        align: 'right',
	        verticalAlign: 'middle'
	    },

	    plotOptions: {
	        series: {
	            label: {
	                connectorAllowed: false
	            }
	        }
	    },

	    series: [
	        {name: 'Node 2',
	        data: <?=json_encode(array_reverse($nilai_suhu2)); ?>
	    }
	    ],

	    responsive: {
	        rules: [{
	            condition: {
	                maxWidth: 500
	            },
	            chartOptions: {
	                legend: {
	                    layout: 'horizontal',
	                    align: 'center',
	                    verticalAlign: 'bottom'
	                }
	            }
	        }]
	    }

	});
    </script>

	<!-------------------------------- END NODE 2 ------------------------------------->    

	</body>
	</html>