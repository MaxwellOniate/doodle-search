<?php

ob_start();

$host = "us-cdbr-iron-east-05.cleardb.net";
$dbName = "heroku_ef2e315d80d3684";
$user = "bcdf1ea6907400";
$pass = "9a2fdc80";

try {
  $con = new PDO("mysql:dbname=$dbName;host=$host", "$user", "$pass");
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOException $e) {
  echo 'Connection failed: ' . $e->getMessage();
}
