<?php
session_start();

// Initialize quiz if not started
if (!isset($_SESSION['current_question'])) {
    $_SESSION['current_question'] = 0;
    $_SESSION['answers'] = array();
}

// EQ Test Questions
$questions = array(
    array(
        'question' => 'When I feel upset, I usually know why.',
        'category' => 'self_awareness',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    ),
    array(
        'question' => 'I can easily tell when someone else is feeling sad or happy.',
        'category' => 'empathy',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    ),
    array(
        'question' => 'I can control my temper when I get angry.',
        'category' => 'emotional_regulation',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    ),
    array(
        'question' => 'I find it easy to make friends.',
        'category' => 'social_skills',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    ),
    array(
        'question' => 'I understand what triggers my emotions.',
        'category' => 'self_awareness',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    ),
    array(
        'question' => 'I can sense when someone is uncomfortable in a conversation.',
        'category' => 'empathy',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    ),
    array(
        'question' => 'I stay calm under pressure.',
        'category' => 'emotional_regulation',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    ),
    array(
        'question' => 'I can easily start conversations with strangers.',
        'category' => 'social_skills',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    ),
    array(
        'question' => 'I am aware of my emotional state throughout the day.',
        'category' => 'self_awareness',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    ),
    array(
        'question' => 'I can tell when someone needs emotional support.',
        'category' => 'empathy',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    ),
    array(
        'question' => 'I can bounce back quickly from setbacks.',
        'category' => 'emotional_regulation',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    ),
    array(
        'question' => 'I am good at resolving conflicts between people.',
        'category' => 'social_skills',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    ),
    array(
        'question' => 'I recognize my strengths and weaknesses.',
        'category' => 'self_awareness',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    ),
    array(
        'question' => 'I can put myself in other people\'s shoes.',
        'category' => 'empathy',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    ),
    array(
        'question' => 'I think before I act when I\'m emotional.',
        'category' => 'emotional_regulation',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    ),
    array(
        'question' => 'I can influence others in a positive way.',
        'category' => 'social_skills',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    ),
    array(
        'question' => 'I know what motivates me.',
        'category' => 'self_awareness',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    ),
    array(
        'question' => 'I notice when someone\'s mood changes.',
        'category' => 'empathy',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    ),
    array(
        'question' => 'I can manage my stress effectively.',
        'category' => 'emotional_regulation',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    ),
    array(
        'question' => 'I am comfortable speaking in front of groups.',
        'category' => 'social_skills',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    ),
    array(
        'question' => 'I understand how my behavior affects others.',
        'category' => 'self_awareness',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    ),
    array(
        'question' => 'I can comfort others when they are upset.',
        'category' => 'empathy',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    ),
    array(
        'question' => 'I remain optimistic even during difficult times.',
        'category' => 'emotional_regulation',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    ),
    array(
        'question' => 'I can build rapport with people quickly.',
        'category' => 'social_skills',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    ),
    array(
        'question' => 'I trust my gut feelings when making decisions.',
        'category' => 'self_awareness',
        'options' => array(
            'Never' => 1,
            'Rarely' => 2,
            'Sometimes' => 3,
            'Often' => 4,
            'Always' => 5
        )
    )
);

$current_question = $_SESSION['current_question'];
$total_questions = count($questions);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['answer'])) {
    $_SESSION['answers'][$current_question] = $_POST['answer'];
    $_SESSION['current_question']++;
    
    if ($_SESSION['current_question'] >= $total_questions) {
        header('Location: process_quiz.php');
        exit();
    }
    
    $current_question = $_SESSION['current_question'];
}

$progress = (($current_question + 1) / $total_questions) * 100;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EQ Test - Question <?php echo $current_question + 1; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .quiz-container {
            max-width: 700px;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .progress-container {
            margin-bottom: 30px;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .question-counter {
            font-size: 1.1rem;
            color: #2c3e50;
            font-weight: 600;
        }

        .progress-percentage {
            font-size: 1rem;
            color: #7f8c8d;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: #ecf0f1;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            border-radius: 10px;
            transition: width 0.5s ease;
            width: <?php echo $progress; ?>%;
        }

        .question-section {
            margin-bottom: 40px;
        }

        .question-text {
            font-size: 1.4rem;
            color: #2c3e50;
            line-height: 1.6;
            margin-bottom: 30px;
            text-align: center;
            font-weight: 500;
        }

        .options-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .option {
            position: relative;
        }

        .option input[type="radio"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .option label {
            display: block;
            padding: 20px 25px;
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.1rem;
            color: #495057;
            position: relative;
            overflow: hidden;
        }

        .option label:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            transition: left 0.3s ease;
            z-index: -1;
        }

        .option input[type="radio"]:checked + label {
            color: white;
            border-color: #4ecdc4;
            transform: translateX(5px);
        }

        .option input[type="radio"]:checked + label:before {
            left: 0;
        }

        .option label:hover {
            border-color: #4ecdc4;
            transform: translateX(3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 40px;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-back {
            background: #95a5a6;
            color: white;
        }

        .btn-back:hover {
            background: #7f8c8d;
            transform: translateY(-2px);
        }

        .btn-next {
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            color: white;
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-next.enabled {
            opacity: 1;
            cursor: pointer;
        }

        .btn-next.enabled:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .category-indicator {
            display: inline-block;
            padding: 8px 16px;
            background: linear-gradient(45deg, #f093fb, #f5576c);
            color: white;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-bottom: 20px;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .quiz-container {
                padding: 30px 20px;
            }

            .question-text {
                font-size: 1.2rem;
            }

            .option label {
                padding: 15px 20px;
                font-size: 1rem;
            }

            .navigation-buttons {
                flex-direction: column;
                gap: 15px;
            }

            .btn {
                width: 100%;
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="quiz-container fade-in">
        <div class="progress-container">
            <div class="progress-info">
                <span class="question-counter">Question <?php echo $current_question + 1; ?> of <?php echo $total_questions; ?></span>
                <span class="progress-percentage"><?php echo round($progress); ?>% Complete</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>
        </div>

        <div class="question-section">
            <div class="category-indicator">
                <?php 
                $category_names = array(
                    'self_awareness' => '🧠 Self-Awareness',
                    'empathy' => '❤️ Empathy',
                    'emotional_regulation' => '⚖️ Emotional Regulation',
                    'social_skills' => '🤝 Social Skills'
                );
                echo $category_names[$questions[$current_question]['category']];
                ?>
            </div>
            
            <div class="question-text">
                <?php echo $questions[$current_question]['question']; ?>
            </div>

            <form method="POST" id="quizForm">
                <div class="options-container">
                    <?php foreach ($questions[$current_question]['options'] as $option => $value): ?>
                        <div class="option">
                            <input type="radio" name="answer" value="<?php echo $value; ?>" id="option_<?php echo $value; ?>" onchange="enableNext()">
                            <label for="option_<?php echo $value; ?>"><?php echo $option; ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="navigation-buttons">
                    <?php if ($current_question > 0): ?>
                        <button type="button" class="btn btn-back" onclick="goBack()">← Previous</button>
                    <?php else: ?>
                        <button type="button" class="btn btn-back" onclick="goHome()">← Home</button>
                    <?php endif; ?>
                    
                    <button type="submit" class="btn btn-next" id="nextBtn" disabled>
                        <?php echo ($current_question == $total_questions - 1) ? 'Finish Test →' : 'Next →'; ?>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function enableNext() {
            const nextBtn = document.getElementById('nextBtn');
            nextBtn.disabled = false;
            nextBtn.classList.add('enabled');
        }

        function goBack() {
            window.location.href = 'quiz.php?back=1';
        }

        function goHome() {
            if (confirm('Are you sure you want to go back to home? Your progress will be lost.')) {
                window.location.href = 'index.php';
            }
        }

        // Auto-submit form when option is selected (optional enhancement)
        document.querySelectorAll('input[name="answer"]').forEach(radio => {
            radio.addEventListener('change', function() {
                setTimeout(() => {
                    if (this.checked) {
                        document.getElementById('quizForm').submit();
                    }
                }, 300);
            });
        });

        // Prevent form submission without selection
        document.getElementById('quizForm').addEventListener('submit', function(e) {
            const selected = document.querySelector('input[name="answer"]:checked');
            if (!selected) {
                e.preventDefault();
                alert('Please select an answer before proceeding.');
            }
        });
    </script>
</body>
</html>
