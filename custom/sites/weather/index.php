<?php
define('BASEPATH', true);


include "../../Modules/dotEnv/dotEnv.php";
include "../../Modules/telegram/telegram.php";
include "../../Modules/database/conn.php";
$env = new Env('.env');





$conn_pi = new Connection($env->dotEnv('db.pi.hostname'), $env->dotEnv('db.pi.username'), $env->dotEnv('db.pi.password'));
$db   = $conn_pi->connection('temp_database');
$sqlQuery = "SELECT * FROM bmp180 ORDER BY dateTime DESC LIMIT 1";
$result = mysqli_query($db, $sqlQuery);
foreach ($result as $row) {
	$press = $row['pressure'];
}
$db->close();
?>
<!DOCTYPE html>
<html>
<head>
<title>Meritve ozračja</title>
<?php include 'inc/header.php'; ?>
<link rel="stylesheet" href="assets/css/index.css">
<script src="assets/js/chart.js"></script>
<script src="assets/js/temp.js"></script>
<script src="assets/js/chart_press_week.js"></script>
<script src="assets/js/modal.js"></script>
</head>
  <body>
    <div class="container">
      <div class="col">
        <center><h3>Meritve</h3></center>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col">
          <div id="chart-container">
            <canvas id="graphCanvasTemp"></canvas>
            <center id="ds18b20_raw"><span style="color: blue; font-size: 30px;">Loading...</span></center>
          </div>
        </div>
        <div class="col">
          <div id="chart-container">
            <canvas id="graphCanvasPress"></canvas>
            <center><span style="color: blue; font-size: 40px;"><?= $press ?></span> mb (milibarov)</center>
          </div>
        </div>
      </div>
      <div class="row">
        <div id="chart-container">
          <canvas id="graphCanvasPressWeek"></canvas>
          <center><span style="color: blue; font-size: 40px;"><?= $press ?></span> mb (milibarov)</center>
        </div>
      </div>
      <marquee behavior="" direction="left"><font size="3" color="black">Meritev temperature in pritiska se izvaja v središču Domžal. Merjenje temperature se izvaja vsako sekundo. Grafi prikazujejo podatke na eno uro</font></marquee>
    </div>
    <div class="row">
      <div class="container">
        <?php include 'inc/footer.php'; ?>
        <?php include 'inc/modal.php'; ?>
        <?php include 'inc/pogoji.php'; ?>
      </div>
    </div>
  </body>
</html>
