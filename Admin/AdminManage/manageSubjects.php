<?php
session_start();
include '../../Config/db.php';

// Authorization check
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
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
            max-width: 1000px;
            margin: auto;
        }

        /* ---------- Title Bar ---------- */
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

        /* ---------- Grid Layout ---------- */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        /* ---------- Card Styles ---------- */
        .card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: all 0.2s ease;
            position: relative;
            align-self: start;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        .card h4 {
            color: #1e40af;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .info-icon {
            cursor: pointer;
            font-size: 1.2rem;
            color: #2563eb;
            transition: color 0.2s;
        }

        .info-icon:hover {
            color: #1d4ed8;
        }

        .card p {
            font-size: 0.9rem;
            color: #475569;
            margin-bottom: 12px;
        }

        /* ---------- Expandable Info Section ---------- */
        .expandable {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, opacity 0.3s ease;
            opacity: 0;
            margin-top: 0;
        }

        .expandable.open {
            max-height: 200px;
            opacity: 1;
            margin-top: 10px;
        }

        .expandable p {
            background: #f8fafc;
            padding: 10px;
            border-radius: 8px;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        /* ---------- Buttons ---------- */
        .btn-group {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
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

    <!-- ---------- Header ---------- -->
    <header>
        <h2>Kelola Pelajaran</h2>
        <a href="dashboard.php">Kembali</a>
    </header>

    <!-- ---------- Main Container ---------- -->
    <div class="container">
        <div class="title-bar">
            <h3>📘 Daftar Pelajaran</h3>
            <button class="add-btn">+ Tambah Pelajaran</button>
        </div>

        <!-- ---------- Subject Grid ---------- -->
        <div class="grid">

            <!-- Example Card 1 -->
            <div class="card">
                <h4>
                    Matematika 
                    <span class="info-icon" onclick="toggleInfo(this)">ℹ️</span>
                </h4>
                <p>Kode: MATH01<br>Dasar-dasar perhitungan dan logika.</p>

                <div class="expandable">
                    <p>
                        <b>Guru Pengajar:</b> Ibu Rina Kusuma<br>
                        <b>Dibuat:</b> 12 Oktober 2025<br>
                        <b>Durasi Ujian:</b> 60 menit<br>
                        <b>Keterangan:</b> Wajib untuk kelas 10 dan 11.
                    </p>
                </div>

                <div class="btn-group">
                    <a href="#" class="edit-btn">Edit</a>
                    <a href="#" class="delete-btn">Hapus</a>
                </div>
            </div>

            <!-- Example Card 2 -->
            <div class="card">
                <h4>
                    Bahasa Inggris 
                    <span class="info-icon" onclick="toggleInfo(this)">ℹ️</span>
                </h4>
                <p>Kode: ENG01<br>Pemahaman grammar dan speaking dasar.</p>

                <div class="expandable">
                    <p>
                        <b>Guru Pengajar:</b> Pak Dimas Santoso<br>
                        <b>Dibuat:</b> 10 Oktober 2025<br>
                        <b>Durasi Ujian:</b> 45 menit<br>
                        <b>Keterangan:</b> Materi listening dan reading.
                    </p>
                </div>

                <div class="btn-group">
                    <a href="#" class="edit-btn">Edit</a>
                    <a href="#" class="delete-btn">Hapus</a>
                </div>
            </div>

        </div>
    </div>

    <!-- ---------- Scripts ---------- -->
    <script>
        function toggleInfo(icon) {
            const expandable = icon.closest('.card').querySelector('.expandable');
            expandable.classList.toggle('open');
        }
    </script>

</body>
</html>
