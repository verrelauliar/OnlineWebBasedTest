<?php
session_start();
include __DIR__ . '/../../Config/db.php';

$editMode = false;
$subject = ['subject_name'=>'','subject_code'=>'','description'=>'','teacher_name'=>''];

// detect modal usage
$isModal = isset($_GET['modal']) && $_GET['modal'] == '1';

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
    header("Location: manage_subjects.php");
    exit();
}

// If modal requested, return only the form fragment (scoped styles) and exit
if($isModal){
    ?>
    <style>
        /* Scoped modal form (iOS-like clean) */
        .modal-form{font-family:"Segoe UI",-apple-system,system-ui,Roboto,Helvetica,Arial;margin:0}
        .modal-card{width:100%;box-sizing: border-box;background:#fff;border-radius:14px;padding:18px 18px 16px;box-shadow:0 8px 30px rgba(2,6,23,0.08);}
        .modal-card h2{margin:0 0 12px 0;font-size:1.1rem;color:#0b2545}
        .form-row{display:flex;flex-direction:column;margin-bottom:12px}
        label{font-weight:600;margin-bottom:8px;color:#0f172a;font-size:0.95rem}
        input,textarea,select{width:100%;padding:10px;border-radius:10px;border:1px solid #e6eef8;background:#fbfdff;font-size:0.95rem}
        textarea{min-height:100px}
        .row{display:flex;gap:10px}
        .row .col{flex:1}
        .actions{display:flex;justify-content:flex-end;gap:8px;margin-top:8px}
        .btn{padding:8px 12px;border-radius:10px;border:none;cursor:pointer}
        .btn.primary{background:#007aff;color:#fff}
        .btn.ghost{background:transparent;border:1px solid rgba(0,0,0,0.06);color:#0b2545}
        @media (max-width:520px){ .row{flex-direction:column} }
    </style>

    <div class="modal-form">
        <div class="modal-card">
            <h2><?= $editMode ? "Edit Subject" : "Add Subject"; ?></h2>
            <form method="POST">
                <?php if ($editMode): ?>
                    <input type="hidden" name="id" value="<?= $subject['id']; ?>">
                <?php endif; ?>

                <div class="form-row">
                    <label for="subject_name">Subject Name</label>
                    <input id="subject_name" name="subject_name" type="text" required value="<?= htmlspecialchars($subject['subject_name']); ?>">
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-row">
                            <label for="subject_code">Code</label>
                            <input id="subject_code" name="subject_code" type="text" required value="<?= htmlspecialchars($subject['subject_code']); ?>">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-row">
                            <label for="teacher_name">Teacher</label>
                            <input id="teacher_name" name="teacher_name" type="text" value="<?= htmlspecialchars($subject['teacher_name']); ?>">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <label for="description">Description</label>
                    <textarea id="description" name="description"><?= htmlspecialchars($subject['description']); ?></textarea>
                </div>

                <div class="actions">
                    <button type="button" class="btn ghost modal-cancel">Cancel</button>
                    <button type="submit" class="btn primary"><?= $editMode ? "Save" : "Add"; ?></button>
                </div>
            </form>
        </div>
    </div>
    <?php
    exit();
}

// Full page fallback (if opened directly)
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title><?= $editMode ? "Edit" : "Tambah"; ?> Pelajaran</title>
<style>
/* keep original page styles for full page */
body {font-family: "Segoe UI", sans-serif;background:#f1f5f9;margin:0}
.container{max-width:600px;margin:40px auto;background:#fff;border-radius:12px;padding:30px;box-shadow:0 2px 10px rgba(0,0,0,0.08)}
label{display:block;margin-bottom:6px;font-weight:600}
input,textarea{width:100%;padding:10px;border-radius:8px;border:1px solid #cbd5e1;margin-bottom:15px}
.actions{display:flex;justify-content:flex-end;gap:8px}
.btn{padding:8px 12px;border-radius:8px;border:none;cursor:pointer}
.primary{background:#2563eb;color:#fff}
.ghost{background:transparent;border:1px solid rgba(0,0,0,0.06)}
</style>
</head>
<body>

<header>
    <h2><?= $editMode ? "Edit Pelajaran" : "Tambah Pelajaran"; ?></h2>
    <a href="manage_subjects.php">Kembali</a>
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

    <div class="actions">
        <button type="button" class="btn ghost" onclick="window.location.href='manage_subjects.php'">Cancel</button>
        <button type="submit" class="btn primary"><?= $editMode ? "Simpan Perubahan" : "Tambah Pelajaran"; ?></button>
    </div>
</form>
</div>

</body>
</html>
