<?php
include "database.php";
$data = json_decode(file_get_contents("php://input"), true);

// Simpan ke tabel hasil
foreach ($data as $question_id => $answer) {
    // Simpan jawaban siswa di database (tambahkan id_siswa, waktu, dsb.)
}

echo json_encode(["status" => "ok"]);
?>
