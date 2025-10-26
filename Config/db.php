<?php
$host = "127.0.0.1"; // use numeric host to avoid socket mismatch
$user = "root";
$pass = "";
$db   = "mumtaza_ujian";
$port = 3306; //DEBUGGING, ADJUST PORT IF NEEDED!!

$conn = @mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    error_log("Database connection failed: " . mysqli_connect_error());
    die("Koneksi database gagal. Silakan coba lagi nanti.");
}
?>
