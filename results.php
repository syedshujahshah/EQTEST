<?php
session_start();

if (!isset($_SESSION['test_results'])) {
    header('Location: index.php');
    exit();
}

$results = $_SESSION['test_results'];
$overall_score = $results['overall_score'];
$percentage = $results['percentage'];
$categories = $results['categories'];

// Determine EQ level and feedback
function getEQLevel($score) {
    if ($score >= 4.5) return array('level' => 'Exceptional', 'color' => '#27ae60', 'description' => 'Outstanding emotional intelligence');
    if ($score >= 4.0) return array('level' => 'High', 'color' => '#2ecc71', 'description' => 'Strong emotional intelligence');
    if ($score >= 3.5) return array('level' => 'Above Average', 'color' => '#f39c12', 'description' => 'Good emotional intelligence');
    if ($score >= 3.0) return array('level' => 'Average', 'color' => '#e67e22', 'description' => 'Moderate emotional intelligence');
    if ($score >= 2.5) return array('level' => 'Below Average', 'color' => '#e74c3c', 'description' => 'Developing emotional intelligence');
    return array('level' => 'Low', 'color' => '#c0392b', 'description' => 'Needs significant improvement');
}

$eq_level = getEQLevel($overall_score);

// Category feedback
function getCategoryFeedback($category, $score) {
    $feedback = array(
        'self_awareness' => array(
            'name' => 'Self-Awareness',
            'icon' => '🧠',
            'high' => 'You have excellent self-awareness and understand your emotions well.',
            'medium' => 'You have good self-awareness but could benefit from more reflection.',
            'low' => 'Focus on understanding your emotions and their triggers better.'
        ),
        'empathy' => array(
            'name' => 'Empathy',
            'icon' => '❤️',
            'high' => 'You excel at understanding and connecting with others\' emotions.',
            'medium' => 'You show empathy but could work on reading emotional cues better.',
            'low' => 'Practice putting yourself in others\' shoes and listening actively.'
        ),
        'emotional_regulation' => array(
            'name' => 'Emotional Regulation',
            'icon' => '⚖️',
            'high' => 'You manage your emotions effectively and stay composed under pressure.',
            'medium' => 'You generally control your emotions well but could improve consistency.',
            'low' => 'Work on techniques like deep breathing and mindfulness to manage emotions.'
        ),
        'social_skills' => array(
            'name' => 'Social Skills',
            'icon' => '🤝',
            'high' => 'You have excellent interpersonal skills and build relationships easily.',
            'medium' => 'You interact well with others but could enhance your communication skills.',
            'low' => 'Focus on active listening and building rapport with others.'
        )
    );
    
    $cat_feedback = $feedback[$category];
    if ($score >= 4.0) return $cat_feedback['high'];
    if ($score >= 3.0) return $cat_feedback['medium'];
    return $cat_feedback['low'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your EQ Test Results</title>
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
            padding: 20px;
        }

        .results-container {
            max-width: 900px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            color: #2c3e50;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .header p {
            color: #7f8c8d;
            font-size: 1.1rem;
        }

        .overall-score {
            text-align: center;
            margin-bottom: 40px;
            padding: 30px;
            background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);
            border-radius: 20px;
            color: white;
        }

        .score-circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2.5rem;
            font-weight: bold;
            position: relative;
            overflow: hidden;
        }

        .score-circle::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: conic-gradient(
                rgba(255, 255, 255, 0.8) 0deg,
                rgba(255, 255, 255, 0.8) <?php echo $percentage * 3.6; ?>deg,
                rgba(255, 255, 255, 0.2) <?php echo $percentage * 3.6; ?>deg,
                rgba(255, 255, 255, 0.2) 360deg
            );
            border-radius: 50%;
            z-index: -1;
        }

        .eq-level {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .eq-description {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .category-card {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
            border-left: 5px solid #4ecdc4;
            transition: transform 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .category-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .category-icon {
            font-size: 1.5rem;
            margin-right: 10px;
        }

        .category-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .category-score {
            font-size: 2rem;
            font-weight: bold;
            color: #4ecdc4;
            margin-bottom: 10px;
        }

        .category-bar {
            width: 100%;
            height: 8px;
            background: #ecf0f1;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 15px;
        }

        .category-fill {
            height: 100%;
            background: linear-gradient(45deg, #4ecdc4, #44a08d);
            border-radius: 10px;
            transition: width 1s ease;
        }

        .category-feedback {
            color: #495057;
            line-height: 1.5;
            font-size: 0.95rem;
        }

        .recommendations {
            background: #e8f5e8;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .recommendations h3 {
            color: #27ae60;
            margin-bottom: 20px;
            font-size: 1.3rem;
        }

        .recommendation-list {
            list-style: none;
        }

        .recommendation-list li {
            margin-bottom: 10px;
            padding-left: 25px;
            position: relative;
            color: #2c3e50;
        }

        .recommendation-list li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #27ae60;
            font-weight: bold;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            color: white;
        }

        .btn-secondary {
            background: #95a5a6;
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .share-section {
            text-align: center;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 1px solid #ecf0f1;
        }

        @media (max-width: 768px) {
            .results-container {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 2rem;
            }

            .categories-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 300px;
            }
        }

        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>
    <div class="results-container fade-in">
        <div class="header">
            <h1>Your EQ Test Results</h1>
            <p>Congratulations on completing the Emotional Intelligence Assessment!</p>
        </div>

        <div class="overall-score pulse">
            <div class="score-circle">
                <?php echo $overall_score; ?>/5
            </div>
            <div class="eq-level"><?php echo $eq_level['level']; ?> EQ</div>
            <div class="eq-description"><?php echo $eq_level['description']; ?></div>
        </div>

        <div class="categories-grid">
            <?php 
            $category_info = array(
                'self_awareness' => array('name' => 'Self-Awareness', 'icon' => '🧠'),
                'empathy' => array('name' => 'Empathy', 'icon' => '❤️'),
                'emotional_regulation' => array('name' => 'Emotional Regulation', 'icon' => '⚖️'),
                'social_skills' => array('name' => 'Social Skills', 'icon' => '🤝')
            );
            
            foreach ($categories as $category => $score): 
                $percentage = (($score - 1) / 4) * 100;
            ?>
                <div class="category-card">
                    <div class="category-header">
                        <span class="category-icon"><?php echo $category_info[$category]['icon']; ?></span>
                        <span class="category-name"><?php echo $category_info[$category]['name']; ?></span>
                    </div>
                    <div class="category-score"><?php echo $score; ?>/5</div>
                    <div class="category-bar">
                        <div class="category-fill" style="width: <?php echo $percentage; ?>%"></div>
                    </div>
                    <div class="category-feedback">
                        <?php echo getCategoryFeedback($category, $score); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="recommendations">
            <h3>Recommendations for Growth</h3>
            <ul class="recommendation-list">
                <?php if ($overall_score < 3.5): ?>
                    <li>Practice mindfulness and self-reflection daily</li>
                    <li>Read books on emotional intelligence and psychology</li>
                    <li>Seek feedback from trusted friends and colleagues</li>
                    <li>Consider working with a coach or therapist</li>
                <?php elseif ($overall_score < 4.0): ?>
                    <li>Continue developing your emotional vocabulary</li>
                    <li>Practice active listening in conversations</li>
                    <li>Work on managing stress and difficult emotions</li>
                    <li>Seek leadership opportunities to practice social skills</li>
                <?php else: ?>
                    <li>Mentor others in developing their emotional intelligence</li>
                    <li>Continue refining your emotional skills through practice</li>
                    <li>Share your knowledge through teaching or writing</li>
                    <li>Explore advanced emotional intelligence concepts</li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="action-buttons">
            <button class="btn btn-primary" onclick="retakeTest()">Retake Test</button>
            <button class="btn btn-secondary" onclick="goHome()">Back to Home</button>
            <button class="btn btn-secondary" onclick="shareResults()">Share Results</button>
        </div>

        <div class="share-section">
            <p>Share your EQ journey with friends and help them discover their emotional intelligence too!</p>
        </div>
    </div>

    <script>
        function retakeTest() {
            if (confirm('Are you sure you want to retake the test? This will clear your current results.')) {
                window.location.href = 'index.php';
            }
        }

        function goHome() {
            window.location.href = 'index.php';
        }

        function shareResults() {
            const text = `I just completed an EQ test and scored <?php echo $overall_score; ?>/5 (<?php echo $eq_level['level']; ?>)! Test your emotional intelligence too.`;
            
            if (navigator.share) {
                navigator.share({
                    title: 'My EQ Test Results',
                    text: text,
                    url: window.location.origin
                });
            } else {
                // Fallback for browsers that don't support Web Share API
                navigator.clipboard.writeText(text + ' ' + window.location.origin).then(() => {
                    alert('Results copied to clipboard!');
                });
            }
        }

        // Animate category bars on load
        document.addEventListener('DOMContentLoaded', function() {
            const fills = document.querySelectorAll('.category-fill');
            fills.forEach((fill, index) => {
                setTimeout(() => {
                    fill.style.width = fill.style.width;
                }, index * 200);
            });
        });
    </script>
</body>
</html>
