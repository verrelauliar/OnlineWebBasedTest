<?php
session_start();
require_once("../Config/db.php"); // Pastikan koneksi database disini

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    header("Location: dashboard.php");
    exit();
}

// Ambil statistik
$total_admin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE role='admin'"))['total'];
$total_guru = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE role='guru'"))['total'];
$total_siswa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE role='siswa'"))['total'];

// Tambah akun baru
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['tambah_akun'])) {
    $username = trim($_POST['username']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $status = $_POST['status_aktif'];

    // Basic validation
    if (empty($username) || strlen($username) < 3) {
        $msg = "⚠️ Username harus diisi dan minimal 3 karakter!";
    } elseif (!in_array($role, ['admin', 'guru', 'siswa'])) {
        $msg = "⚠️ Role tidak valid!";
    } elseif (!in_array($status, ['aktif', 'nonaktif'])) {
        $msg = "⚠️ Status tidak valid!";
    } else {
        $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
        if (mysqli_num_rows($check) > 0) {
            $msg = "⚠️ Username sudah digunakan!";
        } else {
            $insert = mysqli_query($conn, "INSERT INTO users (username, password, role, status_aktif) 
                                           VALUES ('$username', '$password', '$role', '$status')");
            $msg = $insert ? "✅ Akun berhasil ditambahkan!" : "❌ Gagal menambah akun.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Manage User</title>
<style>
body { font-family: 'Segoe UI', sans-serif; background:#f8fafc; margin:0; color:#1e293b; }
header { background:#2563eb; color:white; padding:15px 25px; display:flex; justify-content:space-between; align-items:center; }
header h2 { margin:0; font-weight:600; }
header a { color:white; text-decoration:none; background:#dc2626; padding:8px 14px; border-radius:6px; }

.container { padding:30px; }
.cards { display:flex; gap:20px; flex-wrap:wrap; }
.card { background:white; padding:20px; border-radius:10px; flex:1; min-width:250px; box-shadow:0 2px 8px rgba(0,0,0,0.08); }
.card h3 { margin:0; font-size:18px; color:#2563eb; }
.card p { font-size:24px; font-weight:600; margin-top:8px; }

.table-container { margin-top:30px; background:white; padding:20px; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,0.08); }
table { width:100%; border-collapse:collapse; margin-top:15px; }
th, td { padding:10px; border-bottom:1px solid #e5e7eb; text-align:left; }
th { background:#f1f5f9; }
.add-form { margin-top:30px; background:white; padding:20px; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,0.08); }
input, select { padding:8px; width:100%; margin-bottom:10px; border:1px solid #cbd5e1; border-radius:5px; }
button { background:#2563eb; color:white; border:none; padding:10px 16px; border-radius:5px; cursor:pointer; }
button:hover { background:#1d4ed8; }
.message { margin:10px 0; font-weight:500; }
</style>
</head>
<body>
<header>
  <h2>Manage Users</h2>
  <a href="Admin/login.php">Logout</a>
</header>

<div class="container">
  <h2>Selamat Datang, <?= htmlspecialchars($_SESSION['username']); ?> 👋</h2>

  <div class="cards">
    <div class="card">
      <h3>Total Admin</h3>
      <p><?= $total_admin; ?></p>
    </div>
    <div class="card">
      <h3>Total Guru</h3>
      <p><?= $total_guru; ?></p>
    </div>
    <div class="card">
      <h3>Total Siswa</h3>
      <p><?= $total_siswa; ?></p>
    </div>
  </div>

  <div class="add-form">
    <h3>➕ Tambah Akun Baru</h3>
    <?php if (isset($msg)) echo "<div class='message'>$msg</div>"; ?>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <select name="role" required>
        <option value="">-- Pilih Role --</option>
        <option value="admin">Admin</option>
        <option value="guru">Guru</option>
        <option value="siswa">Siswa</option>
      </select>
      <select name="status_aktif" required>
        <option value="aktif">Aktif</option>
        <option value="nonaktif">Nonaktif</option>
      </select>
      <button type="submit" name="tambah_akun">Tambah Akun</button>
    </form>
  </div>

  <div class="table-container">
    <h3>📋 Daftar Akun</h3>
    <table>
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Role</th>
        <th>Status</th>
      </tr>
      <?php
      $users = mysqli_query($conn, "SELECT * FROM users ORDER BY id_user ASC");
      while ($row = mysqli_fetch_assoc($users)) {
          echo "<tr>
              <td>{$row['id_user']}</td>
              <td>{$row['username']}</td>
              <td>{$row['role']}</td>
              <td>{$row['status_aktif']}</td>
          </tr>";
      }
      ?>
    </table>
  </div>
</div>
</body>
</html>
