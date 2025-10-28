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
    header("Location: manage_subjects.php");
    exit();
}

// --- Get All Subjects ---
$result = mysqli_query($conn, "SELECT * FROM subjects ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
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
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        align-items: start;
    }

    @media (max-width:1100px){ .grid{grid-template-columns:repeat(3,1fr)} }
    @media (max-width:820px){ .grid{grid-template-columns:repeat(2,1fr)} }
    @media (max-width:480px){ .grid{grid-template-columns:1fr} }

.card {
    background: white;
    border-radius: 10px;
    padding: 14px 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.06);
    transition: transform .18s ease, box-shadow .18s ease;
    position: relative;
    overflow: visible; /* allow expandable overlay */
    display:flex;flex-direction:column;gap:8px;
    min-height:72px;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 16px rgba(0,0,0,0.15);
}

.card h4 {
    color: #1e40af;
    margin-bottom: 8px;
    padding: 0 8px;
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
    font-size: 0.88rem;
    padding: 0 8px;
    color: #475569;
    margin: 6px 0 8px 0;
}

.btn-group {
    display: flex;
    justify-content: center; /* center horizontally */
    align-items: center;      /* align vertically */
    gap: 8px;
    margin-top: auto;
    text-align: center;
}

.edit-btn, .delete-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 500;
    text-decoration: none;
    color: #fff;
    border: none;
    cursor: pointer;
    width: 80px; /* fixed equal width */
    height: 24px; /* fixed equal height */
    box-sizing: border-box;
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
    <h2>Manage Subjects</h2>
    <a href="../dashboard.php">Return</a>
</header>

<div class="container">
    <div class="title-bar">
        <h3>📘 Subject List</h3>
        <button class="add-btn" type="button" onclick="openSubjectModal();">+ Add Subject</button>
    </div>

    <div class="grid">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="card">
            <h4>
                <?= htmlspecialchars($row['subject_name']); ?>
                <span class="info-icon" onclick="toggleInfo(this)">ⓘ</span>
            </h4>
            <p>Kode: <?= htmlspecialchars($row['subject_code']); ?><br>
               <?= htmlspecialchars($row['description']); ?>
            </p>

            <div class="expandable" style="display:none;">
                <p><b>Teacher:</b> <?= htmlspecialchars($row['teacher_name']); ?><br>
                <b>Created At:</b> <?= htmlspecialchars($row['created_at']); ?></p>
            </div>

            <div class="btn-group">
                <button type="button" class="edit-btn" onclick="openSubjectModal(<?= $row['id']; ?>)">Edit</button>
                <a href="?delete=<?= $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure?');">Delete</a>
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

<!-- Modal overlay for Add/Edit subject (loads fragment from subjectForm.php?modal=1) -->
<style>
.modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(2,6,23,0.45);
  display: none;
  align-items: center;
  justify-content: center;
  z-index: 9999;
  padding: 16px;
}
.modal-inner {
  width: 100%;
  max-width: 700px;
  background: #fff;
  border-radius: 14px;
  box-shadow: 0 8px 30px rgba(0,0,0,0.15);
  overflow-y: auto;
  max-height: 90vh;
  padding: 20px;
}
@media (max-width: 520px) {
  .modal-inner {
    width: 95%;
    padding: 16px;
  }
}
</style>

<div id="modalOverlay" class="modal-overlay" aria-hidden="true">
  <div id="modalInner" class="modal-inner" role="dialog" aria-modal="true"></div>
</div>

<script>
function openSubjectModal(editId){
  const url = 'subjectForm.php?modal=1' + (editId ? '&edit=' + encodeURIComponent(editId) : '');
  const overlay = document.getElementById('modalOverlay');
  const inner = document.getElementById('modalInner');

  fetch(url, { credentials: 'same-origin' })
    .then(r => {
      if (!r.ok) throw new Error('HTTP ' + r.status);
      return r.text();
    })
    .then(html => {
      inner.innerHTML = html;
      overlay.style.display = 'flex';
      overlay.setAttribute('aria-hidden', 'false');

      // Attach cancel buttons
      inner.querySelectorAll('.modal-cancel').forEach(btn =>
        btn.addEventListener('click', closeModal)
      );

      // Close on backdrop
      overlay.onclick = e => { if (e.target === overlay) closeModal(); };

      // Close on Escape
      const escHandler = e => { if (e.key === 'Escape') closeModal(); };
      document.addEventListener('keydown', escHandler);
      overlay._escHandler = escHandler;

      // Focus first input
      const firstInput = inner.querySelector('input,textarea,select');
      if (firstInput) firstInput.focus();
    })
    .catch(err => {
      console.error('Failed to load modal form:', err);
      alert('Unable to load form.');
    });
}

function closeModal(){
  const overlay = document.getElementById('modalOverlay');
  const inner = document.getElementById('modalInner');
  if (overlay._escHandler) document.removeEventListener('keydown', overlay._escHandler);
  overlay.style.display = 'none';
  overlay.setAttribute('aria-hidden', 'true');
  inner.innerHTML = '';
}
</script>

