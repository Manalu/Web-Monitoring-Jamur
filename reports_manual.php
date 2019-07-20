<?php
session_start();
if(!isset($_SESSION["admin"])){
  header("Location: login.php");
}
  include "koneksi.php";

  $limit = 15;  
  if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
  $start_from = ($page-1) * $limit;  

  //penomoran pada tabel
   $no = 0;
   if(isset($_GET['page'])){
    $no = $_GET['page']-1;
    if($no < 0){
     $no = 0;
    }
 }
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="website monitoring suhu dan kelembaban jamur tiram">
    <meta name="author" content="katon gilang bagaskara">
    <meta http-equiv=Content-Type content="text/html; charset=windows-1252"/>
    <meta name=ProgId content=Excel.Sheet/>
    <meta name=Generator content="Microsoft Excel 16"/>
    <link rel="icon" href="image/icon.png">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="tamp/bootstrap.min.css" crossorigin="anonymous">

    <!-- Custom styles for this template -->

    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="dist/simplePagination.css" />

    <!-- Js -->
    <script src="tamp/mqtt-2.9.0.js"></script>
    <script type="text/javascript" src="tamp/jquery-3.3.1.min.js"></script>
    <script src="dist/jquery.simplePagination.js"></script>
   
	<title>Monitoring Jamur</title>
</head>
<body>
	<?php
		include ('navbar.php');
		include ('sidebar.php');
	?>
	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
		<div>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2" >REPORTS MODE MANUAL</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <input type="submit" name="export" value="Export" class="btn btn-sm btn-outline-secondary" onclick="window.location = 'export-to-excel/export-manual.php';">
        </div>
      </div>
      </div>
     
			<div class="table-responsive">
      <table class="table table-striped table-sm text-center">
          <thead>
            <tr>
              <th>#</th>
              <th>Waktu</th>
              <th>Status Mode</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <tbody>
            <?php
                //penomoran pada tabel (2)
                $sno = $no + 1;
                if(isset($_GET['page'])){
                 $sno = (($_GET['page']*$limit)+1) - $limit;
                 if($sno <=0) $sno = 1;
                }
               $sql = "SELECT * FROM reports_mode_manual ORDER BY id_mode_manual DESC LIMIT $start_from, $limit";  
               $hasil = mysqli_query($connect,$sql);
                while ($data = mysqli_fetch_assoc($hasil)){
                    echo "<tr>";
                    echo "<td>".$sno."</td>";        
                    echo "<td>".$data['waktu']."</td>";
                    echo "<td>".$data['status']."</td>";
                    echo "<td>".$data['keterangan']."</td>";
                    echo "</tr>";
                    $sno++;
                }?>
          </tbody>
        </table>

      <?php
        $sql = "SELECT COUNT(id_mode_manual) FROM reports_mode_manual";  
        $rs_result = mysqli_query($connect, $sql);  
        $row = mysqli_fetch_row($rs_result);  
        $total_records = $row[0];  
        $total_pages = ceil($total_records / $limit);  
        $pagLink = "<nav aria-label='Page navigation example' ><ul class='pagination justify-content-center'>";  
        for ($i=1; $i<=$total_pages; $i++) {  
          $pagLink .= "<li class='page-item' ><a href='reports_manual.php?page=".$i."'>".$i."</a></li>";  
        };  
        echo $pagLink . "</ul></nav>"; 

       ?>
      </div>
		</div>		
	</main>

	<!-- Icons -->
    <script src="tamp/feather.min.js"></script>
    
    <script>
      feather.replace()
    </script>

	</body>
	</html>

  <script type="text/javascript">
    $(document).ready(function(){
    $('.pagination').pagination({
            items: <?php echo $total_records;?>,
            itemsOnPage: <?php echo $limit;?>,
            cssStyle: 'light-theme',
        currentPage : <?php echo $page;?>,
        hrefTextPrefix : 'reports_manual.php?page='
        });
      });
    </script>