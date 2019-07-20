<link href="css/navbar.css" rel="stylesheet">

<!-------------------------------AKTIF JIKA LAYAR MAXIMAZE-------------------------------------->
<header class="headerMaxsimize">
  <!-- Fixed navbar -->
  <nav class="navbar p-0 navbar-expand-md navbar-dark shadow fixed-top bg-dark">
    <a class="navbar-brand" href="panel-home.php"><span><img style="height: 30px;" src="image/icon.png"></span> Monitoring Jamur</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
      </ul>
        <input style="margin: 0px 20px 0 20px; " class="btn btn-outline-light my-2 my-sm-0" type="submit" value="Keluar" onclick="window.location = 'proseslogout.php';">
    </div>
  </nav>
</header>
<!-------------------------------AKTIF JIKA LAYAR MINIMIZE-------------------------------------->
<header class="headerMinimize">
  <!-- Fixed navbar -->
  <nav class="navbar p-0 navbar-expand-md navbar-dark shadow fixed-top bg-dark">
      <a style="color: white;" class="link" href="panel-home.php">Dashboard </a>
      <a style="color: white;" class="link" href="panel-mode.php">Mode </a>
      <a style="color: white;" class="link" href="reports_kelembaban1.php">Kelembaban1 </a>
      <a style="color: white;" class="link" href="reports_suhu1.php">Suhu1 </a>
      <a style="color: white;" class="link" href="reports_kelembaban2.php">Kelembaban2 </a>
      <a style="color: white;" class="link" href="reports_suhu2.php">Suhu2 </a>
      <a style="color: white;" class="link" href="reports_manual.php">Mode Manual </a>
      <a style="color: white;" class="link" href="reports_otomatis.php">Mode Otomatis </a>
      <a style="color: white;" class="link" href="reports_relay.php">Relay Mode Otomatis </a>
      <a style="color: white;" class="link" href="proseslogout.php">Keluar</a>
    </nav>
</header>