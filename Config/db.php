<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "mumtaza_ujian";

// Default connection
$conn = @mysqli_connect($host, $user, $pass, $db);

// If failed, retry with custom port (DEV ONLY)
if (!$conn) {
    $conn = @mysqli_connect($host . ":3305", $user, $pass, $db);
}

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
