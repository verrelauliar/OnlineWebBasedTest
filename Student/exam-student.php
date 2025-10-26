<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Islamic Studies - Comprehensive Assessment</title>
    <link rel="stylesheet" href="/OnlineWebBasedTest/Student/exam-student.css">
</head>
<body>
    <!-- Header with logo, title, timer, and exit button -->
    <header class="top-bar" role="banner">
        <div class="left">
            <img src="/OnlineWebBasedTest/Assets/mumtaza_logo.png" alt="Mumtaza Logo" class="logo">
            <h1>Islamic Studies - Comprehensive Assessment</h1>
        </div>
        <div class="right">
            <div class="timer" aria-label="Time remaining">⏱ 59:57</div>
            <a href="dashboard_student.php" class="exit-btn" aria-label="Exit quiz">Exit Quiz</a>
        </div>
    </header>

    <!-- Main content with sidebar and question area -->
    <main class="content container-fluid">
        <!-- Sidebar for question navigation -->
        <aside class="sidebar" role="complementary" aria-label="Question navigation">
            <!-- Grid of question number buttons -->
            <div class="question-grid" role="navigation" aria-label="Question navigator">
                <button class="q-num active" aria-label="Question 1, current question">✓<br>1</button>
                <button class="q-num">✓<br>2</button>
                <button class="q-num">✓<br>3</button>
                <button class="q-num">✓<br>4</button>
                <button class="q-num">✓<br>5</button>
                <button class="q-num">✓<br>6</button>
                <button class="q-num">✓<br>7</button>
                <button class="q-num">✓<br>8</button>
                <button class="q-num">✓<br>9</button>
                <button class="q-num">✓<br>10</button>
                <button class="q-num">✓<br>11</button>
                <button class="q-num">✓<br>12</button>
                <button class="q-num">✓<br>13</button>
                <button class="q-num">✓<br>14</button>
                <button class="q-num">✓<br>15</button>
                <button class="q-num">✓<br>16</button>
                <button class="q-num">✓<br>17</button>
                <button class="q-num">✓<br>18</button>
                <button class="q-num">✓<br>19</button>
                <button class="q-num">✓<br>20</button>
            </div>
            <!-- Legend showing question status -->
            <div class="legend">
                <div><span class="dot current"></span> Current</div>
                <div><span class="dot answered"></span> Answered</div>
                <div><span class="dot unanswered"></span> Unanswered</div>
            </div>
        </aside>

        <!-- Main question area -->
        <section class="main" role="main" aria-label="Question content">
            <!-- Progress indicator -->
            <div class="progress">
                <p>Question 1 of 50</p>
                <div class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-fill"></div>
                </div>
            </div>
            <!-- Subject and question -->
            <div class="subject">Islamic Studies</div>
            <p class="question">During which month do Muslims fast from dawn to sunset?</p>
            <!-- Answer options -->
            <div class="options" role="radiogroup" aria-label="Answer options">
                <label><input type="radio" name="q" aria-label="Ramadan"> Ramadan</label>
                <label><input type="radio" name="q" aria-label="Dhul Hijah"> Dhul Hijah</label>
                <label><input type="radio" name="q" aria-label="Shawwal"> Shawwal</label>
                <label><input type="radio" name="q" aria-label="Muharram"> Muharram</label>
            </div>
            <!-- Navigation buttons -->
            <div class="nav-btns">
                <button class="prev" aria-label="Previous question">← Previous</button>
                <button class="next" aria-label="Next question">Next →</button>
            </div>
        </section>
    </main>

    <script>
        // Handle question number button clicks
        document.querySelectorAll('.q-num').forEach(button => {
            button.addEventListener('click', function() {
                // Remove active state from all buttons
                document.querySelectorAll('.q-num').forEach(btn => btn.classList.remove('active'));
                // Make clicked button active
                this.classList.add('active');
            });
        });

        // Handle navigation button clicks (prototype alerts)
        document.querySelector('.prev').addEventListener('click', () => {
            alert('Previous question (prototype)');
        });

        document.querySelector('.next').addEventListener('click', () => {
            alert('Next question (prototype)');
        });
    </script>
</body>
</html>