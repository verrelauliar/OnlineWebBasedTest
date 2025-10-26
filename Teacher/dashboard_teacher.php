<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'teacher') {
    header("Location: index.php");
    exit;
}

// pastikan user adalah array dan name ada di dalamnya
$user = $_SESSION['user'];
$username = isset($user['name']) && !is_array($user['name']) ? $user['name'] : 'Teacher';
?>
<h2>Welcome back, <?= htmlspecialchars($username) ?> 👋</h2>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Teacher Dashboard | Mumtaza</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root {
    --primary: #064663;
    --gray-bg: #f9fafb;
    --border: #e5e7eb;
    --text-dark: #111827;
    --text-gray: #6b7280;
    --green: #16a34a;
    --red: #dc2626;
  }

  body {
    font-family: 'Inter', sans-serif;
    background-color: var(--gray-bg);
    margin: 0;
    padding: 0;
  }

  header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 24px 60px;
    background: white;
    border-bottom: 1px solid var(--border);
  }

  header h2 {
    color: var(--primary);
    font-size: 24px;
    margin: 0;
  }

  header p {
    color: var(--text-gray);
    margin: 4px 0 0 0;
  }

  .logout-btn {
    border: 1px solid var(--border);
    background: white;
    padding: 8px 18px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
  }

  .logout-btn:hover {
    background: #f3f4f6;
  }

  /* Stats Section */
  .stats {
    display: flex;
    gap: 30px;
    margin: 40px 60px;
  }

  .stat-card {
    flex: 1;
    background: white;
    border-radius: 10px;
    border: 1px solid var(--border);
    padding: 22px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
  }

  .stat-card h3 {
    font-size: 16px;
    color: var(--text-dark);
    margin-bottom: 6px;
  }

  .stat-card p {
    font-size: 22px;
    font-weight: 600;
    color: var(--text-dark);
    margin: 6px 0;
  }

  .stat-card small {
    color: var(--text-gray);
  }

  /* Actions */
  .actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin: 0 60px 10px;
  }

  .btn {
    padding: 10px 16px;
    border-radius: 8px;
    font-weight: 600;
    border: 1px solid var(--border);
    cursor: pointer;
    transition: 0.3s;
  }

  .btn-upload {
    background: white;
  }

  .btn-upload:hover {
    background: #f9fafb;
  }

  .btn-create {
    background: var(--primary);
    color: white;
    border: none;
  }

  .btn-create:hover {
    background: #05364f;
  }

  /* Quiz Section */
  .quiz-section {
    margin: 30px 60px 80px;
  }

  .quiz-section h3 {
    color: var(--text-dark);
    font-size: 20px;
    margin-bottom: 4px;
  }

  .quiz-section p {
    color: var(--text-gray);
    font-size: 14px;
    margin-bottom: 20px;
  }

  .quiz-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(500px, 1fr));
    gap: 25px;
  }

  .quiz-card {
    background: white;
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 24px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
  }

  .quiz-card h4 {
    margin: 0 0 6px;
    color: var(--text-dark);
  }

  .tag {
    display: inline-block;
    background: #e0f2fe;
    color: #0369a1;
    font-size: 12px;
    font-weight: 500;
    padding: 2px 8px;
    border-radius: 8px;
    margin-bottom: 14px;
  }

  .quiz-info {
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    color: var(--text-dark);
    margin-bottom: 8px;
  }

  hr {
    border: none;
    border-top: 1px solid var(--border);
    margin: 12px 0;
  }

  .progress-label {
    font-size: 14px;
    color: var(--text-gray);
    margin-bottom: 4px;
  }

  .progress-bar {
    height: 6px;
    background-color: #e5e7eb;
    border-radius: 6px;
    overflow: hidden;
  }

  .progress-fill {
    height: 6px;
    background-color: var(--primary);
    border-radius: 6px;
  }

  .score-and-view {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 8px;
  }

  .average-score {
    color: var(--text-dark);
    font-size: 14px;
    font-weight: 500;
  }

  .view-btn {
    padding: 10px;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    border: 1px solid var(--border);
    background: #009b65;
    color: white;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }

  .quiz-actions {
    display: flex;
    justify-content: flex-start;
    gap: 10px;
    margin-top: 12px;
  }

  .quiz-actions button {
    flex: 1;
    padding: 10px;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    border: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }

  .view-btn {
    background: var(--green);
    color: white;
    border: none;
  }

  .edit-btn {
    background: #f9fafb;
  }

  .delete-btn {
    background: #fee2e2;
    color: var(--red);
    border: none;
  }
</style>
</head>
<body>

<header>
  <div>
    <h2>Teacher Dashboard</h2>
<p>Welcome back, <?= htmlspecialchars($user['name']); ?></p>
  </div>
  <form method="POST" action="../logout.php">
    <button class="logout-btn">Logout</button>
  </form>
</header>

<section class="stats">
  <div class="stat-card">
    <h3>Total Quizzes</h3>
    <p>3</p>
    <small>Active assessments</small>
  </div>
  <div class="stat-card">
    <h3>Total Students</h3>
    <p>25</p>
    <small>Enrolled students</small>
  </div>
  <div class="stat-card">
    <h3>Completion Rate</h3>
    <p style="color:#b91c1c;">71%</p>
    <small>Average completion</small>
  </div>
</section>

<div class="actions">
  <button class="btn btn-upload">📤 Bulk Upload</button>
  <button class="btn btn-create">+ Create New Quiz</button>
</div>

<section class="quiz-section">
  <h3>Your Quizzes</h3>
  <p>Manage and create quizzes for your students</p>

  <div class="quiz-grid">
    <div class="quiz-card">
      <h4>Islamic Studies - Unit 1 Assessment</h4>
      <span class="tag">Islamic Studies</span>
      <div class="quiz-info">
        <span>Questions: 20</span>
        <span>Duration: 30 minutes</span>
      </div>
      <hr>
      <div class="progress-label">Progress</div>
      <div class="progress-bar"><div class="progress-fill" style="width:72%;"></div></div>
      <small>18/25 students</small>
      <div class="score-and-view">
        <div class="average-score">Average Score: 82%</div>
        <button class="view-btn"><?xml version="1.0"?><svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 18H17V16H7V18Z" fill="currentColor"/><path d="M17 14H7V12H17V14Z" fill="currentColor"/><path d="M7 10H11V8H7V10Z" fill="currentColor"/><path clip-rule="evenodd" d="M6 2C4.34315 2 3 3.34315 3 5V19C3 20.6569 4.34315 22 6 22H18C19.6569 22 21 20.6569 21 19V9C21 5.13401 17.866 2 14 2H6ZM6 4H13V9H19V19C19 19.5523 18.5523 20 18 20H6C5.44772 20 5 19.5523 5 19V5C5 4.44772 5.44772 4 6 4ZM15 4.10002C16.6113 4.4271 17.9413 5.52906 18.584 7H15V4.10002Z" fill="currentColor" fill-rule="evenodd"/></svg> View Results</button>
      </div>
      <div class="quiz-actions">
        <button class="edit-btn"><?xml version="1.0"?><svg class="feather feather-edit" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg> Edit</button>
        <button class="delete-btn"><?xml version="1.0"?><svg class="feather feather-trash-2" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg> Delete</button>
      </div>
    </div>

    <div class="quiz-card">
      <h4>Mathematics - Algebra Basics</h4>
      <span class="tag">Mathematics</span>
      <div class="quiz-info">
        <span>Questions: 15</span>
        <span>Duration: 45 minutes</span>
      </div>
      <hr>
      <div class="progress-label">Progress</div>
      <div class="progress-bar"><div class="progress-fill" style="width:80%;"></div></div>
      <small>20/25 students</small>
      <div class="score-and-view">
        <div class="average-score">Average Score: 76%</div>
        <button class="view-btn"><?xml version="1.0"?><svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 18H17V16H7V18Z" fill="currentColor"/><path d="M17 14H7V12H17V14Z" fill="currentColor"/><path d="M7 10H11V8H7V10Z" fill="currentColor"/><path clip-rule="evenodd" d="M6 2C4.34315 2 3 3.34315 3 5V19C3 20.6569 4.34315 22 6 22H18C19.6569 22 21 20.6569 21 19V9C21 5.13401 17.866 2 14 2H6ZM6 4H13V9H19V19C19 19.5523 18.5523 20 18 20H6C5.44772 20 5 19.5523 5 19V5C5 4.44772 5.44772 4 6 4ZM15 4.10002C16.6113 4.4271 17.9413 5.52906 18.584 7H15V4.10002Z" fill="currentColor" fill-rule="evenodd"/></svg> View Results</button>
      </div>
      <div class="quiz-actions">
        <button class="edit-btn"><?xml version="1.0"?><svg class="feather feather-edit" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg> Edit</button>
        <button class="delete-btn"><?xml version="1.0"?><svg class="feather feather-trash-2" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg> Delete</button>
      </div>
    </div>

    <div class="quiz-card">
      <h4>Arabic Language - Grammar Test</h4>
      <span class="tag">Arabic</span>
      <div class="quiz-info">
        <span>Questions: 25</span>
        <span>Duration: 40 minutes</span>
      </div>
      <hr>
      <div class="progress-label">Progress</div>
      <div class="progress-bar"><div class="progress-fill" style="width:60%;"></div></div>
      <small>15/25 students</small>
      <div class="score-and-view">
        <div class="average-score">Average Score: 88%</div>
        <button class="view-btn"><?xml version="1.0"?><svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 18H17V16H7V18Z" fill="currentColor"/><path d="M17 14H7V12H17V14Z" fill="currentColor"/><path d="M7 10H11V8H7V10Z" fill="currentColor"/><path clip-rule="evenodd" d="M6 2C4.34315 2 3 3.34315 3 5V19C3 20.6569 4.34315 22 6 22H18C19.6569 22 21 20.6569 21 19V9C21 5.13401 17.866 2 14 2H6ZM6 4H13V9H19V19C19 19.5523 18.5523 20 18 20H6C5.44772 20 5 19.5523 5 19V5C5 4.44772 5.44772 4 6 4ZM15 4.10002C16.6113 4.4271 17.9413 5.52906 18.584 7H15V4.10002Z" fill="currentColor" fill-rule="evenodd"/></svg> View Results</button>
      </div>
      <div class="quiz-actions">
        <button class="edit-btn"><?xml version="1.0"?><svg class="feather feather-edit" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg> Edit</button>
        <button class="delete-btn"><?xml version="1.0"?><svg class="feather feather-trash-2" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg> Delete</button>
      </div>
    </div>
  </div>
</section>

</body>
</html>
