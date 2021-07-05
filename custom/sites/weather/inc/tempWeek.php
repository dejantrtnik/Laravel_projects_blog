<?php
define('BASEPATH', true);
header('Content-Type: application/json');
include "../../../Modules/dotEnv/dotEnv.php";
include "../../../Modules/database/conn.php";
$env = new Env('../.env');

$conn = new Connection($env->dotEnv('db.pi.hostname'), $env->dotEnv('db.pi.username'), $env->dotEnv('db.pi.password'));
$db   = $conn->connection('temp_database');
$sqlQuery =
"SELECT * FROM
(SELECT id, (DATE_FORMAT(dateTime, '%d-%m-%Y %H:%i')) as date, pressure, temperature FROM bmp180 WHERE hour(dateTime) = 12 or hour(dateTime) = 00 or hour(dateTime) = 06 or hour(dateTime) = 18 ORDER BY id DESC LIMIT 12)as id
ORDER BY id ASC";



$result = mysqli_query($db, $sqlQuery);
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
echo json_encode($data);
//print_r($conn);
?>
