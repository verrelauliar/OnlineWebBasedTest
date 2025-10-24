<?php
session_start();

// Dummy data
$_SESSION['user_name'] = "Student";
$user = $_SESSION['user_name'];

$completed = 2;
$pending = 2;
$avg_score = 89.0;

// Pending quizzes
$pending_quizzes = [
  [
    "subject" => "Mathematics",
    "title" => "Algebra Basics",
    "questions" => 15,
    "duration" => 45,
    "due_date" => "2025-10-12"
  ],
  [
    "subject" => "Arabic Language",
    "title" => "Grammar Test",
    "questions" => 25,
    "duration" => 40,
    "due_date" => "2025-10-15"
  ]
];

// Completed quizzes
$completed_quizzes = [
  [
    "subject" => "Islamic Studies",
    "title" => "Unit 1 Assessment",
    "score" => 85,
    "completed_on" => "2025-10-02"
  ],
  [
    "subject" => "Science",
    "title" => "Chapter 3 Quiz",
    "score" => 92,
    "completed_on" => "2025-10-04"
  ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Dashboard | LMS</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
:root {
  --primary-color: #0F4C5C;
  --danger-color: #8B0000;
  --success-color: #1B6B43;
  --light-bg: #F9FAFB;
}

body {
  font-family: 'Segoe UI', sans-serif;
  background-color: var(--light-bg);
  color: #222;
}

.navbar {
  background-color: #fff;
  box-shadow: 0 1px 4px rgba(0,0,0,0.08);
}

.card {
  border-radius: 16px;
  transition: 0.2s;
}
.card:hover {
  transform: translateY(-3px);
}

.btn-custom {
  background-color: var(--primary-color);
  color: white;
  border-radius: 10px;
  border: none;
}
.btn-custom:hover {
  background-color: #0d3d4b;
}

.btn-outline-custom {
  border: 1px solid var(--primary-color);
  color: var(--primary-color);
  border-radius: 10px;
}
.btn-outline-custom:hover {
  background-color: var(--primary-color);
  color: white;
}

.badge {
  font-size: 0.8rem;
  padding: 0.4em 0.6em;
}

.badge-math { background-color: #E0F2F1; color: #0F4C5C; }
.badge-arabic { background-color: #FFF3E0; color: #E65100; }
.badge-islamic { background-color: #E8F5E9; color: #1B6B43; }
.badge-science { background-color: #E3F2FD; color: #0D47A1; }

.progress {
  background-color: #EAEAEA;
  border-radius: 10px;
  height: 8px;
}
.progress-bar {
  border-radius: 10px;
}
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-light px-4 py-3">
  <a class="navbar-brand fw-bold fs-4" href="#">Student Dashboard</a>
  <div class="d-flex align-items-center">
    <span class="me-3 text-muted">Welcome back, <?= $user ?></span>
    <a href="../logout.php" class="btn btn-outline-custom btn-sm">Logout</a>
  </div>
</nav>

<div class="container mt-4">

  <!-- STATISTICS -->
  <div class="row g-4 text-center">
    <div class="col-md-4">
      <div class="card border-0 shadow-sm p-3">
        <h6 class="fw-bold">Completed Quizzes</h6>
        <h2 class="text-success mb-1"><?= $completed ?></h2>
        <p class="text-muted small">Successfully completed</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 shadow-sm p-3">
        <h6 class="fw-bold">Pending Quizzes</h6>
        <h2 class="text-danger mb-1"><?= $pending ?></h2>
        <p class="text-muted small">Awaiting completion</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 shadow-sm p-3">
        <h6 class="fw-bold">Average Score</h6>
        <h2 class="text-primary mb-1"><?= round($avg_score,1) ?>%</h2>
        <p class="text-muted small">Overall performance</p>
      </div>
    </div>
  </div>

  <!-- PENDING QUIZZES -->
  <div class="mt-5">
    <h5 class="fw-bold">Pending Quizzes</h5>
    <p class="text-muted">Complete these quizzes before the due date</p>
    <div class="row g-4">
      <?php foreach($pending_quizzes as $q): ?>
      <div class="col-md-6">
        <div class="card border-2 shadow-sm p-4" style="border-color: var(--danger-color);">
          <h6 class="fw-semibold"><?= $q['subject'] ?> - <?= $q['title'] ?></h6>
          <?php if($q['subject']=="Mathematics"): ?>
            <span class="badge badge-math mt-2">Mathematics</span>
          <?php elseif($q['subject']=="Arabic Language"): ?>
            <span class="badge badge-arabic mt-2">Arabic</span>
          <?php endif; ?>

          <div class="mt-3 small text-muted">
            <div>Questions: <?= $q['questions'] ?></div>
            <div>Duration: <?= $q['duration'] ?> minutes</div>
            <div>Due Date: <?= date('m/d/Y', strtotime($q['due_date'])) ?></div>
          </div>
          <a href="#" class="btn btn-custom w-100 mt-3">Start Quiz</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- COMPLETED QUIZZES -->
  <div class="mt-5">
    <h5 class="fw-bold">Completed Quizzes</h5>
    <p class="text-muted">Review your past quiz results</p>
    <div class="row g-4">
      <?php foreach($completed_quizzes as $c): ?>
      <div class="col-md-6">
        <div class="card border-2 shadow-sm p-4" style="border-color: var(--success-color);">
          <h6 class="fw-semibold"><?= $c['subject'] ?> - <?= $c['title'] ?></h6>
          <?php if($c['subject']=="Islamic Studies"): ?>
            <span class="badge badge-islamic mt-2">Islamic Studies</span>
          <?php elseif($c['subject']=="Science"): ?>
            <span class="badge badge-science mt-2">Science</span>
          <?php endif; ?>

          <p class="mt-3 mb-1">Your Score: <b><?= $c['score'] ?>%</b></p>
          <small class="text-muted">Completed On: <?= date('m/d/Y', strtotime($c['completed_on'])) ?></small>
          <div class="progress mt-2">
            <div class="progress-bar bg-success" style="width: <?= $c['score'] ?>%"></div>
          </div>
          <a href="#" class="btn btn-outline-custom w-100 mt-3">View Results</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

</div>
</body>
</html>
