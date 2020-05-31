<?php
$hostname = "localhost";
$database = "emptimemgtsys";
$username = "root";
$password = "";
$conn = mysqli_connect($hostname, $username, $password,$database);
if (!$conn) {
  echo "app not connected to database";
}
if (!isset($_SESSION)) {
  session_start();
}
?>