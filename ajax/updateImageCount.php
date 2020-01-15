<?php

require('../config.php');

if (isset($_POST['imageURL'])) {
  $query = $con->prepare("UPDATE images SET clicks = clicks + 1 WHERE imageURL = :imageURL");
  $query->bindParam(':imageURL', $_POST['imageURL']);
  $query->execute();
}
