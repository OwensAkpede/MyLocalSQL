<?php
/**
*
*/




class LocalSQL
{
  public $DB_HOST;
  public $DB_USER;
  public $DB_PASSWORD;
  private $DB;
  public function __construct(string $host, string $user, string $password) {
    $this->DB_HOST = $host;
    $this->DB_USER = $user;
    $this->DB_PASSWORD = $password;
    $this->DB = new mysqli($host, $user, $password);
  }
  
  public function openDB(string $name) {
    $name = __san__($name, FALSE);

    $DB = $this->DB;
    $exist = $DB->query(
      "SELECT SCHEMA_NAME FROM
       INFORMATION_SCHEMA.SCHEMATA WHERE
       SCHEMA_NAME='$name'")
    ->num_rows;
    if ($exist > 0) {
      return __openDB__($name, $this, $DB);
    } else {
      try {
        $DB->query("CREATE DATABASE `$name`");
        return __openDB__($name, $this, $DB);
      } catch (Exception $Err) {
        echo($Err);
        throw new Exception("Error while attempting to create DATABASE".$name);
      }
    }
  }

  public function hasDB(string $name) {
    $name = __san__($name, FALSE);

    $DB = $this->DB;
    $exist = $DB->query(
      "SELECT SCHEMA_NAME FROM
       INFORMATION_SCHEMA.SCHEMATA WHERE
       SCHEMA_NAME='$name'")
    ->num_rows;
    if ($exist > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function removeDB(string $name) {
    $name = __san__($name, FALSE);
    $result = FALSE;
    $DB = $this->DB;
    $exist = $DB->query(
      "SELECT SCHEMA_NAME FROM
       INFORMATION_SCHEMA.SCHEMATA WHERE
       SCHEMA_NAME='$name' AND SCHEMA_NAME NOT IN ('mysql', 'information_schema', 'performance_schema', 'sys')")
    ->num_rows > 0;
    if ($exist) {
      $result = $DB->query("DROP DATABASE `$name`");
    }
    return $result;
  }

  public function keys() {
    $DB = $this->DB;
    $result = $DB->query("SHOW DATABASES");
    $arr = [];
    if ($result->num_rows > 0) {
      while ($n = $result->fetch_assoc()) {
        array_push($arr, $n["Database"]);
      }
    }
    return $arr;
  }

  public function removeAllDB() {
    $DB = $this->DB;
    $query = "SELECT schema_name FROM information_schema.schemata WHERE schema_name NOT IN ('mysql', 'information_schema', 'performance_schema', 'sys')";
    $result = $DB->query($query);

    if ($result) {
      while ($row = $result->fetch_assoc()) {
        $db_name = $row['schema_name'];
        $DB->query("DROP DATABASE `$db_name`");
      }
      $result->free();
    return TRUE;
    }
  }
  
  public function localStorage(string $name){
   return $this->openDB("localStorage")->openTable($name);
  }
}


class Table
{
  public $DB;
  public function __construct(mysqli $DB) {
    $this->DB = $DB;
  }
  
  public function openTable(string $name) {
    $name = __san__($name, FALSE);
    $DB = $this->DB;
    $result = $DB->query("SHOW TABLES LIKE '$name'");
      if ($result->num_rows == 0) {
        $DB->query(
          "CREATE TABLE `$name` (
  name VARCHAR(255) NOT NULL,
  value LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  type VARCHAR(255) DEFAULT 'string',
  PRIMARY KEY (name)
)"
        );
        return new Item($name, $DB);
      } else {
        return new Item($name, $DB);
      }
  }
  
  public function hasTable(string $name) {
    $name = __san__($name, FALSE);
    $DB = $this->DB;
    $result = $DB->query("SHOW TABLES LIKE '$name'");
      if ($result->num_rows == 0) {
        return FALSE;
      } else {
        return TRUE;
      }
  }
  
  public function keys() {
    $DB = $this->DB;
    $result = $DB->query("SHOW TABLES");
    $arr=[];
      if ($result->num_rows> 0) {
        while($n = $result->fetch_assoc()){
        array_push($arr,$n["Tables_in_my db"]);
        }
      } 
     return $arr;
  }
  
  public function removeTable(string $name) {
    $name = __san__($name, FALSE);
    $DB = $this->DB;
    $result = $DB->query("DROP TABLE `$name`");
    return $result;
  }
  
  public function removeAllTable() {
    $result = $this->DB->query("SHOW TABLES");
if ($result) {
    while ($row = $result->fetch_row()) {
        $table = $row[0];
        $this->DB->query("DROP TABLE `$table`");
    }
   // $result->close();
}

  }
}


class Item
{
  public $DB;
  public $name;
  public function __construct(string $name, mysqli $DB) {
    $this->name = $name;
    $this->DB = $DB;
  }

  public function setItem(string $name, string $value) {
    $name = __san__($name, FALSE);
    $type = "string";

    $value = __san__($value, TRUE);

    $result = $this->DB->query("
   SELECT name FROM `$this->name`
   WHERE name = '$name'
   ");

    if ($result->num_rows > 0) {
      $this->DB->query("
   UPDATE `$this->name`
   SET value = '$value', type = '$type' 
   WHERE name = '$name'
   ");
    } else {
      $this->DB->query("
   INSERT INTO `$this->name` (name, value) VALUES ('$name','$value')
   ");
    }

  }
  
  public function getItem(string $name){
    $name = __san__($name, FALSE);
    $result = $this->DB->query("
    SELECT value FROM `$this->name`
    WHERE name = '$name'
    ");
    if($result->num_rows > 0){
    return $result->fetch_assoc()["value"];
    }
  }
  
  public function hasItem(string $name){
    $name = __san__($name, FALSE);
    $result = $this->DB->query("
    SELECT name FROM `$this->name`
    WHERE name = '$name'
    ");
    if($result->num_rows > 0){
    return TRUE;
    }
    return FALSE;
  }
  
  public function keys(){
    $result = $this->DB->query("
    SELECT name FROM `$this->name`
    ");
    $arr = [];
    if($result->num_rows > 0){
      $n;
      while ($n = $result->fetch_assoc()) {
        array_push($arr, $n["name"]);
      }
    }
    return $arr;
  }
  
  public function removeItem(string $name){
    $name = __san__($name, FALSE);
    $result = $this->DB->query("
    DELETE FROM `$this->name`
    WHERE name = '$name'
    ");
    return $result;
  }
  
  public function removeAllItem(){
    $result = $this->DB->query("
    DELETE FROM `$this->name`
    ");
    return $result;
  }
  
  public function getAllItem(){
    $result = $this->DB->query("
    SELECT * FROM `$this->name`
    ");
    $arr = [];
    if($result->num_rows > 0){
      $n;
      while ($n = $result->fetch_assoc()) {
        $arr[$n["name"]]=$n["value"];
      }
    }
    return $arr;
  }
}


function __san__(string $v, $is_val) {
  if ($is_val === TRUE) {
    $v = preg_replace("/(['])/i", "\\\\$0", $v);
    //echo($v);
  } else {
    // $v = preg_replace("/[\n ]/i", "", $v);
    // $v = preg_replace("/[^a-z0-9]/i", "_", $v);
    $v = preg_replace("/\n\r|\n|\r\n/i", " ", $v);
    $v = preg_replace("/([`'])/i", "\\\\$0", $v);
  }

  return $v;
}
function __openDB__($name, $self, $DB) {
  $DB = new mysqli($self->DB_HOST, $self->DB_USER, $self->DB_PASSWORD, $name);
  $DB->set_charset("utf8mb4");
  return new Table($DB);
}




