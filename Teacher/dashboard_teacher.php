<?php
// Start session to maintain user login state across page requests
session_start();

// Security check: Ensure user is logged in and has teacher privileges
// This prevents unauthorized access to teacher-only features
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'teacher') {
    header("Location: index.php");
    exit;
}

// Extract and validate user data safely to prevent errors if session data is malformed
$user = $_SESSION['user'];
$username = isset($user['name']) && !is_array($user['name']) ? $user['name'] : 'Teacher';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Teacher Dashboard | Mumtaza</title>
<!-- Load Inter font from Google Fonts for consistent, modern typography -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<!-- Link to external CSS file for better maintainability and performance -->
<link rel="stylesheet" href="dashboard_teacher.css">
</head>
<body>

<!-- Main header with school logo and user controls -->
<header>
  <!-- Left side: Logo and welcome message for school logo recognition and user orientation -->
  <div style="display: flex; align-items: center;">
    <img src="../Assets/mumtaza_logo.png" alt="Mumtaza Logo" class="logo">
    <div>
      <h2>Teacher Dashboard</h2>
      <p>Welcome back, <?= htmlspecialchars($user['name']); ?></p>
    </div>
  </div>
  <!-- Right side: Logout button for easy session termination -->
  <form method="POST" action="../logout.php">
    <button class="logout-btn">
      <?xml version="1.0"?><svg id="Layer_1" style="enable-background:new 0 0 24 24;" version="1.1" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><style type="text/css">
	.st0{fill:none;stroke:#000000;stroke-width:1.6724;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
	.st1{fill:none;stroke:#000000;stroke-width:1.5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
	.st2{fill:none;stroke:#000000;stroke-width:1.5;stroke-linejoin:round;stroke-miterlimit:10;}
</style><g><g><line class="st1" x1="7.6" x2="22" y1="12" y2="12"/></g><g><path class="st1" d="M11.9,0.8H4.5C3.1,0.8,2,1.9,2,3.2v17.5c0,1.4,1.1,2.5,2.5,2.5h7.4"/></g><polyline class="st1" points="18.2,8.2 22,12 18.2,15.8  "/></g></svg>
      Logout
    </button>
  </form>
</header>

<!-- Statistics overview section - provides quick insights into teaching activity -->
<section class="stats">
  <!-- Total quizzes created - shows teaching workload and content creation -->
  <div class="stat-card">
    <h3 class="stat-header">
      <span>Total Quizzes</span>
      <?xml version="1.0"?><svg fill="none" height="24" stroke-width="1.5" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M12 21V7C12 5.89543 12.8954 5 14 5H21.4C21.7314 5 22 5.26863 22 5.6V18.7143" stroke="currentColor" stroke-linecap="round"/><path d="M12 21V7C12 5.89543 11.1046 5 10 5H2.6C2.26863 5 2 5.26863 2 5.6V18.7143" stroke="currentColor" stroke-linecap="round"/><path d="M14 19L22 19" stroke="currentColor" stroke-linecap="round"/><path d="M10 19L2 19" stroke="currentColor" stroke-linecap="round"/><path d="M12 21C12 19.8954 12.8954 19 14 19" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 21C12 19.8954 11.1046 19 10 19" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </h3>
    <p>3</p>
    <small>Active assessments</small>
  </div>
  <!-- Total enrolled students - shows class size and reach -->
  <div class="stat-card">
    <h3 class="stat-header">
      <span>Total Students</span>
      <?xml version="1.0"?><svg height="24" viewBox="0 0 512 512" width="24" xmlns="http://www.w3.org/2000/svg"><title/><path d="M402,168c-2.93,40.67-33.1,72-66,72s-63.12-31.32-66-72c-3-42.31,26.37-72,66-72S405,126.46,402,168Z" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"/><path d="M336,304c-65.17,0-127.84,32.37-143.54,95.41-2.08,8.34,3.15,16.59,11.72,16.59H467.83c8.57,0,13.77-8.25,11.72-16.59C463.85,335.36,401.18,304,336,304Z" style="fill:none;stroke:#000;stroke-miterlimit:10;stroke-width:32px"/><path d="M200,185.94C197.66,218.42,173.28,244,147,244S96.3,218.43,94,185.94C91.61,152.15,115.34,128,147,128S202.39,152.77,200,185.94Z" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"/><path d="M206,306c-18.05-8.27-37.93-11.45-59-11.45-52,0-102.1,25.85-114.65,76.2C30.7,377.41,34.88,384,41.72,384H154" style="fill:none;stroke:#000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px"/></svg>
    </h3>
    <p>25</p>
    <small>Enrolled students</small>
  </div>
  <!-- Completion rate - indicates student engagement and quiz effectiveness -->
  <div class="stat-card">
    <h3 class="stat-header">
      <span>Completion Rate</span>
      <?xml version="1.0"?><svg viewBox="0 0 256 256" width="24" height="24" xmlns="http://www.w3.org/2000/svg"><rect fill="none" height="256" width="256"/><polyline fill="none" points="232 56 136 152 96 112 24 184" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline fill="none" points="232 120 232 56 168 56" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
    </h3>
    <p style="color:#b91c1c;">71%</p>
    <small>Average completion</small>
  </div>
</section>



<!-- Quiz Management Section - Core functionality for teachers to manage their quizzes -->
<!-- Displays existing quizzes with progress tracking, student completion rates, and management actions -->
<section class="quiz-section">
  <h3>Your Quizzes</h3>
  <!-- Quiz section header with description and action buttons for bulk operations -->
  <div class="quiz-section-subheader">
    <p>Manage and create quizzes for your students</p>
    <div class="actions">
      <button class="btn btn-upload"><?xml version="1.0"?><svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg"><rect fill="none" height="256" width="256"/><polyline fill="none" points="86 82 128 40 170 82" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" x1="128" x2="128" y1="152" y2="40"/><path d="M216,152v56a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V152" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg> Bulk Upload</button>
      <button class="btn btn-create">+ Create New Quiz</button>
    </div>
  </div>

  <!-- Quiz Grid - Responsive layout displaying quiz cards in a grid format -->
  <!-- Each card shows quiz details, progress, and management actions -->
  <div class="quiz-grid">
    <div class="quiz-card">
      <h4>Islamic Studies - Unit 1 Assessment</h4>
      <span class="tag">Islamic Studies</span>
      <div class="quiz-info">
        <div class="info-item">
          <div class="info-label">Questions</div>
          <div class="info-value">20</div>
        </div>
        <div class="info-item">
          <div class="info-label">Duration</div>
          <div class="info-value">30 minutes</div>
        </div>
      </div>
      <hr>
      <div class="progress-header">
        <span class="progress-label">Progress</span>
        <small class="students-count">18/25 students</small>
      </div>
      <div class="progress-bar"><div class="progress-fill" style="width:72%;"></div></div>
      <div class="score-and-view">
        <div class="average-score">
          <div class="score-label">Average Score</div>
          <div class="score-value">82%</div>
        </div>
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
        <div class="info-item">
          <div class="info-label">Questions</div>
          <div class="info-value">15</div>
        </div>
        <div class="info-item">
          <div class="info-label">Duration</div>
          <div class="info-value">45 minutes</div>
        </div>
      </div>
      <hr>
      <div class="progress-header">
        <span class="progress-label">Progress</span>
        <small class="students-count">20/25 students</small>
      </div>
      <div class="progress-bar"><div class="progress-fill" style="width:80%;"></div></div>
      <div class="score-and-view">
        <div class="average-score">
          <div class="score-label">Average Score</div>
          <div class="score-value">76%</div>
        </div>
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
        <div class="info-item">
          <div class="info-label">Questions</div>
          <div class="info-value">25</div>
        </div>
        <div class="info-item">
          <div class="info-label">Duration</div>
          <div class="info-value">40 minutes</div>
        </div>
      </div>
      <hr>
      <div class="progress-header">
        <span class="progress-label">Progress</span>
        <small class="students-count">15/25 students</small>
      </div>
      <div class="progress-bar"><div class="progress-fill" style="width:60%;"></div></div>
      <div class="score-and-view">
        <div class="average-score">
          <div class="score-label">Average Score</div>
          <div class="score-value">88%</div>
        </div>
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
