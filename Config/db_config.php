<?php
// Default MySQL connection settings
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'mumtaza_quest';

//DEV SETTINGS
// Detect available MySQL port (INSERT PORT HERE IF UNAVAILABLE)
$possible_ports = [3306, 3307, 3308, 3305];
$db_port = null;

foreach ($possible_ports as $port) {
    $connection = @mysqli_connect($db_host, $db_user, $db_pass, $db_name, $port);
    if ($connection) {
        $db_port = $port;
        mysqli_close($connection);
        break;
    }
}

if ($db_port === null) {
    die("MySQL not running on expected ports (3306–3308 or 3305).");
}
?>
