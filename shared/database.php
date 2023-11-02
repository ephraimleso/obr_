<?php

$db = mysqli_connect("localhost", "root", "P@w0rd321", "onlinebusregistration");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

?>