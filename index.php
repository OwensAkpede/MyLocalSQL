<?php
require_once("./localSQL.php");
//$name = random_int(1, 1000000);


$mysql = new LocalSQL("localhost", "root", "");
$localStorage = $mysql->localStorage("my store");

//$localStorage->setItem($name, "hello world");
print_r($localStorage->keys());


/***
 * 
 * 
 * 
 * 
 * require_once("./localSQL.php");

$mysql = new Database("localhost", "root", "");
$db = $mysql->openDB("my db");
$localStorage = $db->openTable("my table");
$localStorage->setItem("name", "john");
$name = $localStorage->getItem("name");
 * 
 * 
 * 
 */
?>