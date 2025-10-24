<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Comprehensive Assessment</title>
<link rel="stylesheet" href="soal.css">
</head>
<body>
<div class="quiz-container">
  <header>
    <h2>Islamic Studies - Comprehensive Assessment</h2>
    <div class="timer">
      ⏱ <span id="time">60:00</span>
    </div>
  </header>

  <main>
    <div id="question-container">
      <p>Loading questions...</p>
    </div>
    <div class="nav-buttons">
      <button id="prevBtn">Previous</button>
      <button id="nextBtn">Next</button>
    </div>
  </main>

  <footer>
    <button id="submitBtn">Submit Quiz</button>
  </footer>
</div>

<script>
let questions = [];
let current = 0;
let answers = {};
let timeLeft = 60 * 60; // 60 menit

// Countdown timer
const timerDisplay = document.getElementById("time");
setInterval(() => {
  if (timeLeft <= 0) {
    document.getElementById('submitBtn').click();
  }
  let m = Math.floor(timeLeft / 60);
  let s = timeLeft % 60;
  timerDisplay.textContent = `${m.toString().padStart(2,'0')}:${s.toString().padStart(2,'0')}`;
  timeLeft--;
}, 1000);

// Load questions
fetch("fetch_questions.php")
  .then(res => res.json())
  .then(data => {
    questions = data;
    showQuestion();
  });

function showQuestion() {
  if (!questions.length) return;
  const q = questions[current];
  document.getElementById("question-container").innerHTML = `
    <div class="question-box">
      <h3>Question ${current+1} of ${questions.length}</h3>
      <p>${q.question_text}</p>
      <div class="options">
        <label><input type="radio" name="answer" value="A" ${answers[q.id]=='A'?'checked':''}> ${q.option_a}</label><br>
        <label><input type="radio" name="answer" value="B" ${answers[q.id]=='B'?'checked':''}> ${q.option_b}</label><br>
        <label><input type="radio" name="answer" value="C" ${answers[q.id]=='C'?'checked':''}> ${q.option_c}</label><br>
        <label><input type="radio" name="answer" value="D" ${answers[q.id]=='D'?'checked':''}> ${q.option_d}</label>
      </div>
    </div>
  `;
  document.querySelectorAll("input[name=answer]").forEach(r => {
    r.onclick = () => { answers[q.id] = r.value; };
  });
}

document.getElementById("nextBtn").onclick = () => {
  if (current < questions.length - 1) {
    current++;
    showQuestion();
  }
};

document.getElementById("prevBtn").onclick = () => {
  if (current > 0) {
    current--;
    showQuestion();
  }
};

document.getElementById("submitBtn").onclick = () => {
  fetch("submit_quiz.php", {
    method: "POST",
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify(answers)
  })
  .then(() => {
    alert("Waktu habis / kuis telah selesai!");
    window.location = "thankyou.php";
  });
};
</script>
</body>
</html>
