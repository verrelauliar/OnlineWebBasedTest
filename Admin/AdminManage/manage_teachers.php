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
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Teachers</title>
<style>
:root {
    --primary: #2563eb;
    --primary-dark: #1d4ed8;
    --muted: #475569;
    --card-bg: #ffffff;
    --page-bg: #f1f5f9;
    --accent: #e2e8f0;
}

html, body {
    height: 100%;
    margin: 0;
    font-family: "Segoe UI", Roboto, system-ui, -apple-system, "Helvetica Neue", Arial;
    background: var(--page-bg);
    color: #0f172a;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

/* ---------- Header ---------- */
header {
    background: var(--primary);
    color: white;
    padding: 14px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

header h2 { margin: 0; }

header a {
    background: #dc2626;
    color: white;
    text-decoration: none;
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 500;
}

header a:hover { background: #b91c1c; }

/* ---------- Container ---------- */
.container {
    padding: 30px;
    max-width: 1100px;
    margin: auto;
}

/* ---------- Stats Cards ---------- */
.stats {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 20px;
}

.stat-card {
    background: white;
    flex: 1 1 250px;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    text-align: center;
}

.stat-card h4 {
    color: #475569;
    font-weight: 600;
    margin-bottom: 8px;
}

.stat-card p {
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
}

.stat-green { color: #16a34a; }

/* ---------- Grid Layout ---------- */
.grid {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 24px;
    align-items: start;
}

/* ---------- Add Teacher Form ---------- */
.form-card {
    background: white;
    padding: 24px 28px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    display: flex;
    flex-direction: column;
    gap: 18px;
    box-sizing: border-box;
    width: 100%;
}

.form-card h3 {
    margin: 0 0 10px 0;
    font-size: 1.25rem;
}

.form-card form {
    display: flex;
    flex-direction: column;
    gap: 18px;
    width: 100%;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
    width: 100%;
}

label {
    font-weight: 600;
    font-size: 0.95rem;
    color: #1e293b;
}

input,
select {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid #cbd5e1;
    border-radius: 10px;
    font-size: 0.95rem;
    background: #f8fafc;
    color: #0f172a;
    box-sizing: border-box;
    transition: border-color 0.15s, background-color 0.15s;
}

input:focus,
select:focus {
    border-color: var(--primary);
    outline: none;
    background: #ffffff;
}

.add-btn {
    background: var(--primary);
    color: white;
    padding: 12px 16px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
    width: 100%;
    font-size: 1rem;
    transition: background 0.15s;
}

.add-btn:hover {
    background: var(--primary-dark);
}

/* ---------- Table Section ---------- */
.table-card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

th, td {
    text-align: left;
    padding: 12px 10px;
    border-bottom: 1px solid #e2e8f0;
    font-size: 0.95rem;
}

th { color: #334155; font-weight: 600; }
td { color: #475569; }

/* ---------- Status Badges ---------- */
.status {
    padding: 6px 10px;
    border-radius: 999px;
    font-weight: 600;
    font-size: 0.85rem;
    text-align: center;
    display: inline-block;
}

.status.aktif {
    background: #dcfce7;
    color: #15803d;
}

.status.non-aktif {
    background: #fee2e2;
    color: #b91c1c;
}

/* ---------- Action Buttons ---------- */
.actions {
    display: flex;
    gap: 10px;
}

.edit-btn, .delete-btn {
    border: none;
    border-radius: 6px;
    padding: 6px 10px;
    font-size: 0.9rem;
    cursor: pointer;
}

.edit-btn {
    background: var(--primary);
    color: white;
}

.edit-btn:hover { background: var(--primary-dark); }

.delete-btn {
    background: #dc2626;
    color: white;
}

.delete-btn:hover { background: #b91c1c; }
</style>
</head>

<body>

<header>
    <h2>Manage Teachers</h2>
    <nav>
        <a href="../dashboard.php">Return</a>
    </nav>
</header>

<div class="container">

    <!-- ---------- Statistics ---------- -->
    <div class="stats">
        <div class="stat-card">
            <h4>Total Teachers</h4>
            <p>150</p>
        </div>
        <div class="stat-card">
            <h4>Active Teachers</h4>
            <p class="stat-green">135</p>
        </div>
    </div>

    <!-- ---------- Main Grid ---------- -->
    <div class="grid">

        <!-- Add Teacher Form -->
        <div class="form-card">
            <h3>Add New Teacher</h3>
            <form>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" placeholder="Enter password">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select>
                        <option>Aktif</option>
                        <option>Non-Aktif</option>
                    </select>
                </div>
                <button type="submit" class="add-btn">Tambah Akun</button>
            </form>
        </div>

        <!-- Teacher List Table -->
        <div class="table-card">
            <h3>Teacher List</h3>
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Status Aktif</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>budi.susanto</td>
                        <td>guru</td>
                        <td><span class="status aktif">Aktif</span></td>
                        <td>
                            <div class="actions">
                                <button class="edit-btn">✏️</button>
                                <button class="delete-btn">🗑️</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>siti.rahayu</td>
                        <td>guru</td>
                        <td><span class="status aktif">Aktif</span></td>
                        <td>
                            <div class="actions">
                                <button class="edit-btn">✏️</button>
                                <button class="delete-btn">🗑️</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>agus.wijaya</td>
                        <td>guru</td>
                        <td><span class="status non-aktif">Non-Aktif</span></td>
                        <td>
                            <div class="actions">
                                <button class="edit-btn">✏️</button>
                                <button class="delete-btn">🗑️</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>dewi.lestari</td>
                        <td>guru</td>
                        <td><span class="status aktif">Aktif</span></td>
                        <td>
                            <div class="actions">
                                <button class="edit-btn">✏️</button>
                                <button class="delete-btn">🗑️</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
