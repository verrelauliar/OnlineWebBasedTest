<?php
session_start();
include '../../Config/db.php';

$editMode = false;
$subject = ['subject_name'=>'','subject_code'=>'','description'=>'','teacher_name'=>''];

if (isset($_GET['edit'])) {
    $editMode = true;
    $id = intval($_GET['edit']);
    $query = mysqli_query($conn, "SELECT * FROM subjects WHERE id=$id");
    $subject = mysqli_fetch_assoc($query);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['subject_name'];
    $code = $_POST['subject_code'];
    $desc = $_POST['description'];
    $teacher = $_POST['teacher_name'];

    if ($editMode) {
        $id = $_POST['id'];
        $sql = "UPDATE subjects SET 
                subject_name='$name', subject_code='$code', 
                description='$desc', teacher_name='$teacher' 
                WHERE id=$id";
    } else {
        $sql = "INSERT INTO subjects (subject_name, subject_code, description, teacher_name)
                VALUES ('$name', '$code', '$desc', '$teacher')";
    }

    mysqli_query($conn, $sql);
    header("Location: manageSubjects.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title><?= $editMode ? "Edit" : "Tambah"; ?> Pelajaran</title>
<style>
body {
    font-family: "Segoe UI", sans-serif;
    background: #f1f5f9;
    margin: 0;
}
header {
    background: #2563eb;
    color: white;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
header h2 { margin: 0; }
header a {
    background: #dc2626;
    color: white;
    padding: 8px 16px;
    border-radius: 8px;
    text-decoration: none;
}
.container {
    max-width: 600px;
    margin: 40px auto;
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}
label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
}
input, textarea {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #cbd5e1;
    margin-bottom: 15px;
}
button {
    background: #2563eb;
    color: white;
    padding: 10px 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 500;
}
button:hover {
    background: #1d4ed8;
}
</style>
</head>
<body>

<header>
    <h2><?= $editMode ? "Edit Pelajaran" : "Tambah Pelajaran"; ?></h2>
    <a href="manageSubjects.php">Kembali</a>
</header>

<div class="container">
<form method="POST">
    <?php if ($editMode): ?>
        <input type="hidden" name="id" value="<?= $subject['id']; ?>">
    <?php endif; ?>

    <label>Nama Pelajaran</label>
    <input type="text" name="subject_name" required value="<?= htmlspecialchars($subject['subject_name']); ?>">

    <label>Kode Pelajaran</label>
    <input type="text" name="subject_code" required value="<?= htmlspecialchars($subject['subject_code']); ?>">

    <label>Deskripsi</label>
    <textarea name="description"><?= htmlspecialchars($subject['description']); ?></textarea>

    <label>Guru Pengajar</label>
    <input type="text" name="teacher_name" value="<?= htmlspecialchars($subject['teacher_name']); ?>">

    <button type="submit"><?= $editMode ? "Simpan Perubahan" : "Tambah Pelajaran"; ?></button>
</form>
</div>

</body>
</html>
