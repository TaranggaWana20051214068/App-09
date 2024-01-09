<?php
$host = "localhost";    // Nama host
$username = "root";         // Username database
$password = "";   // Password database
$database = "app_09";   // Nama database
$conn = new mysqli($host, $username, $password, $database);
if (!$conn . mysqli_connect_errno()) {
  die("Connection failed: " . mysqli_connect_error());
}