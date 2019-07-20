<?php
session_start();
if(!isset($_SESSION["admin"])){
  header("Location: login.php");
}

function reports_kelembaban_node1(){
  include "koneksi.php"; 
?>
  <table class="table table-striped table-sm text-center">
          <thead>
            <tr>
              <th>#</th>
              <th>Waktu</th>
              <th>Kelembaban (%)</th>
            </tr>
          </thead>
          <tbody>
            <?php
  
              $sql = "SELECT * from reports_kelembaban_node1 ORDER BY id_kelembaban DESC";
              $i=1;
               $hasil = mysqli_query($connect,$sql);
                while ($data = mysqli_fetch_assoc($hasil)){
                    echo "<tr>";
                    echo "<td>".$i."</td>";        
                    echo "<td>".$data['waktu_kelembaban']."</td>";
                    echo "<td>".$data['nilai_kelembaban']."</td>";
                    echo "</tr>";
                    $i++;
                }
            ?>
          </tbody>
        </table>
<?php } ?>

<?php
function reports_kelembaban_node2(){
?>
<table class="table table-striped table-sm text-center">
        <thead>
          <tr>
            <th>#</th>
            <th>Waktu</th>
            <th>Kelembaban (%)</th>
          </tr>
        </thead>
        <tbody>
          <?php
            include "koneksi.php";

            $sql = "SELECT * from reports_kelembaban_node2 ORDER BY id_kelembaban DESC";
            $i=1;
            $hasil = mysqli_query($connect,$sql);
            while ($data = mysqli_fetch_assoc($hasil)){
                echo "<tr>";
                echo "<td>".$i."</td>";        
                echo "<td>".$data['waktu_kelembaban']."</td>";
                echo "<td>".$data['nilai_kelembaban']."</td>";
                echo "</tr>";
                $i++;
            }
          ?>
        </tbody>
      </table>
<?php } ?>

<?php
function reports_suhu_node1(){ ?>

  <table class="table table-striped table-sm text-center">
        <thead>
          <tr>
            <th>#</th>
            <th>Waktu</th>
            <th>Suhu (°C)</th>
          </tr>
        </thead>
        <tbody>
          <?php
            include "koneksi.php";

            $sql = "SELECT * from reports_suhu_node1 ORDER BY id_suhu DESC";
            $i=1;
                   $hasil = mysqli_query($connect,$sql);
                    while ($data = mysqli_fetch_assoc($hasil)){
                        echo "<tr>";
                        echo "<td>".$i."</td>";        
                        echo "<td>".$data['waktu_suhu']."</td>";
                        echo "<td>".$data['nilai_suhu']."</td>";
                        echo "</tr>";
                        $i++;
                    }
          ?>
        </tbody>
      </table>
  <?php } ?>

<?php
function reports_suhu_node2(){ ?>

<table class="table table-striped table-sm text-center">
      <thead>
        <tr>
          <th>#</th>
          <th>Waktu</th>
          <th>Suhu (°C)</th>
        </tr>
      </thead>
      <tbody>
        <?php
          include "koneksi.php";

          $sql = "SELECT * from reports_suhu_node2 ORDER BY id_suhu DESC";
          $i=1;
                 $hasil = mysqli_query($connect,$sql);
                  while ($data = mysqli_fetch_assoc($hasil)){
                      echo "<tr>";
                      echo "<td>".$i."</td>";        
                      echo "<td>".$data['waktu_suhu']."</td>";
                      echo "<td>".$data['nilai_suhu']."</td>";
                      echo "</tr>";
                      $i++;
                  }
        ?>
      </tbody>
    </table>
<?php } ?>