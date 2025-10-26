<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Islamic Studies - Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="view-results-student.css">
</head>
<body>
    <!-- Header with logo, title, and exit button -->
    <header class="top-bar">
        <div class="left">
            <img src="/OnlineWebBasedTest/Assets/mumtaza_logo.png" alt="Logo" class="logo">
            <div class="title-section">
                <h1>Islamic Studies - Comprehensive Assessment</h1>
                <h2>Islamic Studies</h2>
            </div>
        </div>
        <div class="right">
            <a href="dashboard_student.php" class="exit-btn">Back to Dashboard</a>
        </div>
    </header>

    <!-- Main content with sidebar and results area -->
    <main class="content">
        <!-- Sidebar with score summary and question navigator -->
        <aside class="sidebar">
            <!-- Score summary cards -->
            <div class="score-card">
                <h3>Your Score</h3>
                <div class="score">85%</div>
                <p>Excellent!</p>
            </div>

            <div class="stats-card correct-stats">
                <p><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg> Correct: 8</p>
            </div>

            <div class="stats-card wrong-stats">
                <p><i class="bi bi-x-circle text-danger"></i> Wrong: 2</p>
            </div>

            <!-- Divider -->
            <hr class="divider">

            <!-- Completion details -->
            <div class="details">
                <p>Completed On: 10/5/2025</p>
                <p>Total Questions: 10</p>
            </div>

            <!-- Another divider -->
            <hr class="divider">

            <!-- Question navigator -->
            <h4>Question Navigator</h4>
            <div class="question-grid">
                <button class="q-result correct"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg></button>
                <button class="q-result correct"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg></button>
                <button class="q-result correct"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg></button>
                <button class="q-result correct"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg></button>
                <button class="q-result correct"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg></button>
                <button class="q-result wrong"><i class="bi bi-x-circle"></i></button>
                <button class="q-result correct"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg></button>
                <button class="q-result correct"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg></button>
                <button class="q-result correct"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg></button>
                <button class="q-result wrong"><i class="bi bi-x-circle"></i></button>
            </div>
        </aside>

        <!-- Main results area -->
        <section class="main">
            <!-- Progress indicator -->
            <div class="progress">
                <p>Question 1 of 10</p>
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
            </div>
            <!-- Subject and question -->
            <div class="subject">Islamic Studies</div>
            <p class="question">During which month do Muslims fast from dawn to sunset?</p>
            <!-- Answer options with correct/incorrect indicators -->
            <div class="options">
                <div class="answer-option correct-answer">
                    <div class="centered-answer">
                        <span class="tick-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg>
                        </span>
                        <div class="answer-lines">
                            <div class="answer-text">Ramadan</div>
                            <div class="correct-label">Correct Answer</div>
                        </div>
                    </div>
                </div>
                <div class="answer-option">
                    <div class="answer-text">
                        <div class="radio-circle"></div>
                        Dhul Hijah
                    </div>
                </div>
                <div class="answer-option">
                    <div class="answer-text">
                        <div class="radio-circle"></div>
                        Shawwal
                    </div>
                </div>
                <div class="answer-option">
                    <div class="answer-text">
                        <div class="radio-circle"></div>
                        Muharram
                    </div>
                </div>
            </div>
            <!-- Navigation buttons -->
            <div class="nav-btns">
                <button class="prev">← Previous</button>
                <button class="next">Next →</button>
            </div>
        </section>
    </main>

    <script>
        // Handle question result button clicks
        document.querySelectorAll('.q-result').forEach(button => {
            button.addEventListener('click', function() {
                // Could add functionality to show specific question results
                console.log('Question clicked:', this.textContent);
            });
        });

        // Handle navigation button clicks
        document.querySelector('.prev').addEventListener('click', () => {
            alert('Previous question results');
        });

        document.querySelector('.next').addEventListener('click', () => {
            alert('Next question results');
        });
    </script>
</body>
</html>