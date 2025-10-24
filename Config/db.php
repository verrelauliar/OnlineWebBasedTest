<?php
$host = "127.0.0.1"; // use numeric host to avoid socket mismatch
$user = "root";
$pass = "";
$db   = "mumtaza_ujian";
$port = 3305; //DEBUGGING, ADJUST PORT IF NEEDED!!

$conn = @mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
