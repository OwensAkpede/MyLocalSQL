<?php

require_once("./localSQL.php");

$name = random_int(1, 1000000);
$name = "item";


$mysql = new LocalSQL("localhost", "root", "");

$localStorage = $mysql->localStorage("my store");

$localStorage->setItem($name, "hello . world");

print_r($localStorage->getItem($name));
print_r($localStorage);

?>