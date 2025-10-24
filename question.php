<?php
include "database.php";

$result = $conn->query("SELECT * FROM questions ORDER BY id ASC");
$questions = [];

while ($row = $result->fetch_assoc()) {
    $questions[] = $row;
}

echo json_encode($questions);
?>
