<?php
$host = "127.0.0.1"; // numeric host to avoid socket mismatch
$user = "root";
$pass = "";
$db   = "mumtaza_ujian";

// === Auto-detect MySQL port (3306 or 3305) ===
$default_ports = [3306, 3305];
$port = null;
foreach ($default_ports as $p) {
    $sock = @fsockopen($host, $p, $errno, $errstr, 0.5);
    if ($sock) {
        $port = $p;
        fclose($sock);
        break;
    }
}
if ($port === null) {
    error_log("No active MySQL port detected (tried 3306 and 3305).");
    die("Tidak dapat menemukan port MySQL aktif.");
}

// === Connect to MySQL ===
$conn = @mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    error_log("Database connection failed: " . mysqli_connect_error());
    die("Koneksi database gagal. Silakan coba lagi nanti.");
}
?>
