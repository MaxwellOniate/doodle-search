<?php

ob_start();

try {
  $con = new PDO("mysql:dbname=doodle;host=localhost", "root", "pass");
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOException $e) {
  echo 'Connection failed: ' . $e->getMessage();
}
