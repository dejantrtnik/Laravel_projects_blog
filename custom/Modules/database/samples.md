## Use at your own risk


samples:
```php
$conn = new Connection('host', 'user', 'pass');
$db = $conn->connection('some_database');
```
sample sql query:
```php
$sqlQuery = "SELECT * FROM some_table";
$result = mysqli_query($db, $sqlQuery);

//sample sql insert:
$stmt = $db->prepare("INSERT INTO some_table (column1, column2, column3) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $column1, $column2, $column3);
$stmt->execute();

//update
$tmp_file = $_SESSION['temp_file'];
$deleted = 1;
$stmt = $db->prepare("UPDATE uploads SET deleted = ? WHERE path_dir = ?");
$stmt->bind_param('is', $deleted, $tmp_file );
$stmt->execute();

// sample sql SELECT - while
$stmt = $db->prepare("SELECT * FROM users");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
  echo $row['ime'];
}

// sample sql SELECT - fetch() true-false
$stmt = $db->prepare("SELECT * FROM users WHERE uporabnisko_ime = '$u_ime' AND geslo = '$geslo'");
$stmt->execute();
$result = $stmt->fetch();
print_r($result); // if exist = 1
if ($result != 1) {
  //print_r($result);
  ```
  <script type="text/javascript">\
  alert('not exist');
  </script>
  ```php
}

// sample sql SELECT - foreach
$stmt = $db->prepare("SELECT * FROM users");
$stmt->execute();
$result = $stmt->get_result();
foreach ($result as $key => $value) {
  echo $value['geslo'];
}

// with function
function query($u_ime, $geslo){
  global $db;
  $stmt = $db->prepare("SELECT * FROM users WHERE uporabnisko_ime = '$u_ime' and geslo = '$geslo'");
  $stmt->execute();
  $result = $stmt->get_result();
  return $result;
}
$var = query('u_ime', sha1('pass'));
if ($var->num_rows != 0) {
  foreach ($var as $value) {
    if ($value['uporabnisko_ime'] == 'some_name') {
      $upo_ime = $value['uporabnisko_ime'];
    }
  }
  print_r($upo_ime);
}



$stmt->close();
mysqli_close($db);

//sample json:
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}
mysqli_close($conn);
echo json_encode($data);
```
