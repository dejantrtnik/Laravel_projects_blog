<?php
class Connection
{
  function __construct($host, $username, $password){
    $this->host     = $host;
    $this->username = $username;
    $this->password = $password;
  }

  public function connection($db)
  {
    $host     = $this->host;
    $username = $this->username;
    $password = $this->password;
    $database = $db;
    $conn = new mysqli($host, $username, $password, $database);
    mysqli_set_charset($conn, "utf8");
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }else {
      return $conn;
    }
    $conn->close();
  }
}
?>
