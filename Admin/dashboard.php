<?php
session_start();
include '../Config/db.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
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
    .welcome {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }
    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
    }
    .card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        transition: all 0.2s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 16px rgba(0,0,0,0.15);
    }
    .card h3 {
        margin: 15px 0 10px;
        font-size: 1.2rem;
        color: #1e40af;
    }
    .card p {
        color: #64748b;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }
    .card a {
        display: inline-block;
        background: #2563eb;
        color: white;
        text-decoration: none;
        padding: 8px 14px;
        border-radius: 6px;
        font-size: 0.9rem;
        transition: background 0.2s;
    }
    .card a:hover {
        background: #1d4ed8;
    }
</style>
</head>
<body>

<header>
    <h2>Admin Dashboard</h2>
    <a href="login.php">Logout</a>
</header>

<div class="container">
    <div class="welcome">
        <h3>Welcome, <?= $_SESSION['username']; ?>.</h3>
        <p>You are logged in as <b>Admin</b>. Please manage the exam and user data below.</p>
    </div>

    <div class="grid">
        <div class="card">
            <h3>🏫 Manage Classes</h3>
            <p>Add, edit, or delete class data.</p>
            <a href="AdminManage/manage_classes.php">Manage</a>
        </div>

        <div class="card">
            <h3>📘 Manage Subjects</h3>
            <p>Add, edit, or delete subject data.</p>
            <a href="AdminManage/manage_subjects.php">Manage</a>
        </div>

        <div class="card">
            <h3>👩‍🏫 Manage Teachers</h3>
            <p>Add, edit, or delete teacher data.</p>
            <a href="AdminManage/manage_teachers.php">Manage</a>
        </div>
    </div>
</div>

</body>
</html>
