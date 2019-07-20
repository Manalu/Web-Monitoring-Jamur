<div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item" >
                <a class="nav-link" href="panel-home.php">
                  <span data-feather="home"></span>
                  Dashboard
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="panel-mode.php">
                  <span data-feather="layers"></span>
                  Mode Pengabutan
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Saved reports NODE 1</span>
              <a class="d-flex align-items-center text-muted" href="#" onclick="show_hide1();">
                <span data-feather="plus-circle" ></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">

              <li style="display: none;" id="kelembaban1" class="nav-item">
                <a class="nav-link" href="reports_kelembaban1.php">
                  <span data-feather="bar-chart-2"></span>
                  Kelembaban
                </a>
              </li>
              <li style="display: none;" id="suhu1" class="nav-item">
                <a class="nav-link" href="reports_suhu1.php">
                  <span data-feather="bar-chart-2"></span>
                  Suhu
                </a>
              </li>
              
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Saved reports NODE 2</span>
              <a class="d-flex align-items-center text-muted" href="#" onclick="show_hide2();">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
              
              <li style="display: none;" id="kelembaban2" class="nav-item">
                <a class="nav-link" href="reports_kelembaban2.php">
                  <span data-feather="bar-chart-2"></span>
                  Kelembaban
                </a>
              </li>
              <li style="display: none;" id="suhu2" class="nav-item">
                <a class="nav-link" href="reports_suhu2.php">
                  <span data-feather="bar-chart-2"></span>
                  Suhu
                </a>
              </li>

              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Saved reports Mode</span>
              <a class="d-flex align-items-center text-muted" href="#" onclick="show_hide3();">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
              
              <li style="display: none;" id="manual" class="nav-item">
                <a class="nav-link" href="reports_manual.php">
                  <span data-feather="bar-chart-2"></span>
                  Mode Manual
                </a>
              </li>
              <li style="display: none;" id="otomatis" class="nav-item">
                <a class="nav-link" href="reports_otomatis.php">
                  <span data-feather="bar-chart-2"></span>
                  Mode Otomatis
                </a>
              </li>
              <li style="display: none;" id="relay" class="nav-item">
                <a class="nav-link" href="reports_relay.php">
                  <span data-feather="bar-chart-2"></span>
                  Relay Mode Otomatis
                </a>
              </li>

            </ul>
          </div>
        </nav>

        <script type="text/javascript">
          function show_hide1() {
              var x = document.getElementById("kelembaban1");
              var y = document.getElementById("suhu1");
              if (x.style.display === "none" && y.style.display === "none" ) {
                  x.style.display = "block";
                  y.style.display = "block";
              } else {
                  x.style.display = "none";
                  y.style.display = "none";
              }
          }
          function show_hide2() {
              var x = document.getElementById("kelembaban2");
              var y = document.getElementById("suhu2");
              if (x.style.display === "none" && y.style.display === "none" ) {
                  x.style.display = "block";
                  y.style.display = "block";
              } else {
                  x.style.display = "none";
                  y.style.display = "none";
              }
          }
          function show_hide3() {
              var x = document.getElementById("manual");
              var y = document.getElementById("otomatis");
              var z = document.getElementById("relay");
              if (x.style.display === "none" && y.style.display === "none" ) {
                  x.style.display = "block";
                  y.style.display = "block";
                  z.style.display = "block";
              } else {
                  x.style.display = "none";
                  y.style.display = "none";
                  z.style.display = "none";
              }
          }
        </script>