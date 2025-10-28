<?php
session_start();
include '../../Config/db.php';

// --- Authorization ---
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}

// --- Delete Subject ---
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM subjects WHERE id = $id");
    header("Location: manageSubjects.php");
    exit();
}

// --- Get All Subjects ---
$result = mysqli_query($conn, "SELECT * FROM subjects ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola Pelajaran</title>

<style>
/* ---------- Global Styles ---------- */
body {
    font-family: "Segoe UI", sans-serif;
    margin: 0;
    background: #f1f5f9;
    color: #1e293b;
}
header {
    background: #2563eb;
    color: white;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
header h2 {
    margin: 0;
}
header a {
    background: #dc2626;
    color: white;
    text-decoration: none;
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 500;
}
.container {
    padding: 30px;
    max-width: 1100px;
    margin: auto;
}
.title-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}
.title-bar h3 {
    margin: 0;
}
.add-btn {
    background: #2563eb;
    color: white;
    padding: 10px 18px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-weight: 500;
    transition: background 0.2s;
}
.add-btn:hover {
    background: #1d4ed8;
}
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}
.card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    transition: all 0.2s ease;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 16px rgba(0,0,0,0.15);
}
.card h4 {
    color: #1e40af;
    margin-bottom: 8px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.info-icon {
    cursor: pointer;
    font-size: 1.2rem;
    color: #2563eb;
}
.card p {
    font-size: 0.9rem;
    color: #475569;
    margin-bottom: 12px;
}
.btn-group {
    display: flex;
    justify-content: space-between;
}
.edit-btn, .delete-btn {
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 0.85rem;
    text-decoration: none;
    text-align: center;
    width: 48%;
}
.edit-btn {
    background: #2563eb;
    color: white;
}
.edit-btn:hover {
    background: #1d4ed8;
}
.delete-btn {
    background: #dc2626;
    color: white;
}
.delete-btn:hover {
    background: #b91c1c;
}
</style>
</head>

<body>
<header>
    <h2>Kelola Pelajaran</h2>
    <a href="../dashboard.php">Kembali</a>
</header>

<div class="container">
    <div class="title-bar">
        <h3>📘 Daftar Pelajaran</h3>
        <button class="add-btn" onclick="window.location.href='subjectForm.php'">+ Tambah Pelajaran</button>
    </div>

    <div class="grid">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="card">
            <h4>
                <?= htmlspecialchars($row['subject_name']); ?>
                <span class="info-icon" onclick="toggleInfo(this)">ℹ️</span>
            </h4>
            <p>Kode: <?= htmlspecialchars($row['subject_code']); ?><br>
               <?= htmlspecialchars($row['description']); ?>
            </p>

            <div class="expandable" style="display:none;">
                <p><b>Guru Pengajar:</b> <?= htmlspecialchars($row['teacher_name']); ?><br>
                <b>Dibuat:</b> <?= htmlspecialchars($row['created_at']); ?></p>
            </div>

            <div class="btn-group">
                <a href="subjectForm.php?edit=<?= $row['id']; ?>" class="edit-btn">Edit</a>
                <a href="?delete=<?= $row['id']; ?>" class="delete-btn" onclick="return confirm('Yakin ingin menghapus pelajaran ini?');">Hapus</a>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<script>
function toggleInfo(icon){
    const expandable = icon.closest('.card').querySelector('.expandable');
    expandable.style.display = expandable.style.display === 'block' ? 'none' : 'block';
}
</script>

</body>
</html>
