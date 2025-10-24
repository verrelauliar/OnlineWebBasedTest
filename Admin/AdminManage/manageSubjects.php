<?php
session_start();
include 'C:/xampp/htdocs/OnlineWebBasedTest/Config/db.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola Pelajaran</title>
<style>
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
        max-width: 1000px;
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
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
    }
    .card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        transition: all 0.2s ease;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 16px rgba(0,0,0,0.15);
    }
    .card h4 {
        color: #1e40af;
        margin-bottom: 8px;
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
    <a href="dashboard.php">Kembali</a>
</header>

<div class="container">
    <div class="title-bar">
        <h3>📘 Daftar Pelajaran</h3>
        <button class="add-btn">+ Tambah Pelajaran</button>
    </div>

    <div class="grid">
        <!-- Example cards (mock data) -->
        <div class="card">
            <div>
                <h4>Matematika</h4>
                <p>Kode: MATH01<br>Dasar-dasar perhitungan dan logika.</p>
            </div>
            <div class="btn-group">
                <a href="#" class="edit-btn">Edit</a>
                <a href="#" class="delete-btn">Hapus</a>
            </div>
        </div>

        <div class="card">
            <div>
                <h4>Bahasa Inggris</h4>
                <p>Kode: ENG01<br>Pemahaman dasar grammar dan speaking.</p>
            </div>
            <div class="btn-group">
                <a href="#" class="edit-btn">Edit</a>
                <a href="#" class="delete-btn">Hapus</a>
            </div>
        </div>

        <div class="card">
            <div>
                <h4>Fisika</h4>
                <p>Kode: PHY01<br>Konsep dasar energi dan gerak.</p>
            </div>
            <div class="btn-group">
                <a href="#" class="edit-btn">Edit</a>
                <a href="#" class="delete-btn">Hapus</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
