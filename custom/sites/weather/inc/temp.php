<?php
define('BASEPATH', true);
header('Content-Type: application/json');
include "../../../Modules/dotEnv/dotEnv.php";
include "../../../Modules/database/conn.php";
$env = new Env('../.env');

$conn = new Connection($env->dotEnv('db.pi.hostname'), $env->dotEnv('db.pi.username'), $env->dotEnv('db.pi.password'));
$db   = $conn->connection('temp_database');
$sqlQuery = "SELECT * FROM (SELECT id, hour(dateTime) as date, pressure, temperature FROM bmp180 ORDER BY id DESC LIMIT 12)as id ORDER BY id ASC";
$result = mysqli_query($db, $sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
echo json_encode($data);
?>
