<?php
session_start();
include 'C:/xampp/htdocs/KPTEST/Config/db.php'; // Sesuaikan dengan path db.php kamu

// Jika sudah login, arahkan ke dashboard sesuai role
if (isset($_SESSION['user'])) {
    switch ($_SESSION['user']['role']) {
        case 'teacher':
            header("Location: Teacher/dashboard_teacher.php");
            break;
        case 'student':
            header("Location: Student/dashboard_student.php");
            break;
        case 'admin':
            header("Location: Admin/dashboard_admin.php");
            break;
    }
    exit;
}

$error = "";

// Proses login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = trim($_POST["userid"]);
    $password = trim($_POST["password"]);
    $role = $_POST["role"];

    // Cek user berdasarkan username
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $userid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Cek role apakah cocok
        if ($user['role'] !== $role) {
            $error = "⚠️ Anda berada di menu login sebagai '$role', Do Not Try to Login as '{$user['role']}'.";
        }
        // Cek status aktif
        elseif ($user['status_aktif'] === 'nonaktif') {
            $error = "Akun Anda belum diaktifkan oleh admin!";
        }
        // Verifikasi password
        elseif (password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                "id" => $user['id_user'],
                "username" => $user['username'],
                "role" => $user['role'],
                "name" => $user['nama'] ?? $user['username']
            ];

            // Redirect ke dashboard sesuai role
            switch ($user['role']) {
                case 'teacher':
                    header("Location: Teacher/dashboard_teacher.php");
                    break;
                case 'student':
                    header("Location: Student/dashboard_student.php");
                    break;
                case 'admin':
                    header("Location: Admin/dashboard_admin.php");
                    break;
                default:
                    $error = "Role tidak dikenali.";
            }
            exit;
        } else {
            $error = "❌ Password salah!";
        }
    } else {
        $error = "❌ User ID tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - QUEST</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Ganti role (Student / Teacher)
        function setRole(role) {
            document.getElementById("role").value = role;
            document.getElementById("login-title").innerText =
                role === "student" ? "Login as Student" : "Login as Teacher";
            document.getElementById("btn-student").classList.toggle("active", role === "student");
            document.getElementById("btn-teacher").classList.toggle("active", role === "teacher");
        }
    </script>
</head>
<body onload="setRole('student')">

<div class="container">
    <div class="login-box">
        <div class="logo">
            <img src="Assets/logo_mumtazajhs2.png" alt="Logo" height="60">
            <h2>QUEST <br>Junior High School Test</h2>
        </div>

        <h1 id="login-title">Login as Student</h1>
        <p>(QUick Exam & Student Test)</p>

        <div class="role-switch">
            <button type="button" id="btn-student" onclick="setRole('student')">Student</button>
            <button type="button" id="btn-teacher" onclick="setRole('teacher')">Teacher</button>
        </div>

        <?php if ($error): ?>
            <p class="error" style="color:red; font-weight:bold;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="hidden" name="role" id="role" value="student">
            <input type="text" name="userid" placeholder="User ID" required>
            <input type="password" name="password" placeholder="Password" required>

            <div class="remember">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember my account</label>
            </div>

            <button type="submit" class="login-btn">Login</button>
            <a href="#" class="forgot">Forgot your password?</a>
        </form>

        <footer>
            <p>Copyright © SMP Islam Mumtaza 2025 <br> QUEST Development</p>
        </footer>
    </div>

    <div class="image-box">
        <img src="Assets/mumtazaschool.jpg" alt="School Building">
    </div>
</div>

</body>
</html>
