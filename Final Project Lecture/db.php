<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname   = "hobbycycle_db";

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>