<?php
// 1. Mulai atau lanjutkan sesi
session_start();

// 2. Hancurkan semua data yang terdaftar dalam sesi
$_SESSION = array();

// 3. Jika menggunakan cookies sesi, hapus juga cookie-nya
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 4. Hancurkan sesi secara keseluruhan
session_destroy();

// 5. Arahkan kembali ke index.php atau halaman login
// Menggunakan header Location untuk pengalihan
header("Location: index.php");
exit; // Selalu gunakan exit/die setelah header Location
?>