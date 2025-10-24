<?php
session_start();

$role = $_POST['role'] ?? "student"; 
$user = $_POST['userid'];
$pass = $_POST['password'];

// Dummy akun Student
$student_user = "student";
$student_pass = "12345";

// Dummy akun Teacher
$teacher_user = "teacher";
$teacher_pass = "54321";

if ($role === "student" && $user === $student_user && $pass === $student_pass) {
    $_SESSION['user'] = $user;
    $_SESSION['role'] = "student";
    header("Location: dashboard.php");
} elseif ($role === "teacher" && $user === $teacher_user && $pass === $teacher_pass) {
    $_SESSION['user'] = $user;
    $_SESSION['role'] = "teacher";
    header("Location: dashboard.php");
} else {
    echo "<script>alert('User ID atau Password salah untuk $role!'); window.location='index.php';</script>";
}