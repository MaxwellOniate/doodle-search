<?php

ob_start();

$host = "localhost";
$dbName = "doodle";
$user = "root";
$pass = "";

try {
  $con = new PDO("mysql:dbname=$dbName;host=$host", "$user", "$pass");
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOException $e) {
  echo 'Connection failed: ' . $e->getMessage();
}
