# Manual


### **sample:** for simple writing to one table in database<br>

```php
include "Modules/database/conn.php";
$conn = new Connection('host', 'user', 'pass');<br>
$db = $conn->connection('database');<br>

include "Modules/visitorCount/visitorCount.php";<br>
$visitorsCount = new VisitorCount('table_name');<br>
$visitorsCount->vistorsCount($db);<br>
```

--------------------------------------------------------------------------------

### **My complete sample:** writing in two tables with relation with tables
 - "tbl_first_visit" and
 - "tbl_visitors"


 For database and tables you can use "database.sql" file.
 __________

### must include:
 - include "Modules/dotEnv/dotEnv.php"; // in .env file correct the users values
 - include "Modules/database/conn.php";
 - include "Modules/visitorCount/visitorCount.php";

```php
include "Modules/dotEnv/dotEnv.php"; // in .env file correct the users values
include "Modules/database/conn.php";
include "Modules/visitorCount/visitorCount.php";

$db = new Connection($env->dotEnv('db.default.hostname'), $env->dotEnv('db.default.username'), $env->dotEnv('db.default.password'));
$db = $db->connection($env->dotEnv('db.default.database'));


function sqlInsert(){
  global $db;
  $sqlQuery = "SELECT * FROM tbl_first_visit";
  $result = mysqli_query($db, $sqlQuery);

  foreach ($result as $row) {
    $data = $row;
  }
  if ($data['id_ip_strlen'] == post_slug($_SERVER['REMOTE_ADDR'])) {
    echo "exist";
    $visitorsCount = new VisitorCount('tbl_visitors');
    $visitorsCount->vistorsCount($db);
  }else {
    echo "not exist";
    $visitorsCount = new VisitorCount('tbl_first_visit');
    $visitorsCount->firstVisit($db);
  }
  mysqli_close($db);
}
sqlInsert('db_visit'); // db_visit is sample DB
```
