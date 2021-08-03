<?php
$hostname = "remotemysql.com";
$database = "jShk31QjLh";
$username = "jShk31QjLh";
$password = "adQtc2rSIo";
$conn = mysqli_connect($hostname, $username, $password,$database);
if (!$conn) {
  echo "app not connected to database";
}
if (!isset($_SESSION)) {
  session_start();
}