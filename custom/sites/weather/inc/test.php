<?php
define('BASEPATH', true);
include "../Modules/dotEnv/dotEnv.php";
include "../Modules/database/conn.php";
$env = new Env('../.env');
header('Content-Type: application/json');

$conn = new Connection($env->dotEnv('db.pi.hostname'), $env->dotEnv('db.pi.username'), $env->dotEnv('db.pi.password'));
$db   = $conn->connection('temp_database');

//$sql = $db->query('SELECT * FROM (SELECT id, temperature, pressure, hour(dateTime) as dateTime FROM bmpSensor WHERE minute(dateTime) = 00 ORDER BY id DESC LIMIT 12) as dateTime ORDER BY id ASC');
$sql = "SELECT * FROM bmpSensor "; // SQL with parameters
$stmt = $db->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result
$user = $result->fetch_assoc(); // fetch data
//$result = mysqli_query($db, $sqlQuery);

//$data = array();
//foreach ($stmt_s as $row) {
//	$data[] = $row;
//}
//mysqli_close($conn);
echo json_encode($user);
//print_r($user);
?>
