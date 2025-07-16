<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EQ Test - Emotional Intelligence Assessment</title>
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
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .hero-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 60px 40px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            border-radius: 50%;
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            color: white;
            font-weight: bold;
        }

        h1 {
            color: #2c3e50;
            font-size: 2.5rem;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .subtitle {
            color: #7f8c8d;
            font-size: 1.2rem;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 40px 0;
        }

        .feature {
            background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 25px 20px;
            border-radius: 15px;
            text-align: center;
            transform: translateY(0);
            transition: all 0.3s ease;
        }

        .feature:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .feature-icon {
            font-size: 2rem;
            margin-bottom: 15px;
        }

        .feature h3 {
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        .feature p {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .start-btn {
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            color: white;
            border: none;
            padding: 18px 40px;
            font-size: 1.2rem;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 1px;
            margin-top: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .start-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
            background: linear-gradient(45deg, #ff5252, #26a69a);
        }

        .info-section {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 30px;
            margin-top: 30px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .info-section h2 {
            color: white;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        .info-section p {
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .stats {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .stat {
            text-align: center;
            color: white;
            margin: 10px;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            display: block;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 40px 20px;
            }

            h1 {
                font-size: 2rem;
            }

            .features {
                grid-template-columns: 1fr;
            }

            .stats {
                flex-direction: column;
                align-items: center;
            }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="hero-section">
            <div class="logo pulse">EQ</div>
            <h1>Emotional Intelligence Test</h1>
            <p class="subtitle">Discover your emotional intelligence level and unlock your potential for better relationships and personal growth.</p>
            
            <div class="features">
                <div class="feature">
                    <div class="feature-icon">🧠</div>
                    <h3>Self-Awareness</h3>
                    <p>Understand your emotions and their impact</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">❤️</div>
                    <h3>Empathy</h3>
                    <p>Measure your ability to understand others</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">⚖️</div>
                    <h3>Emotional Regulation</h3>
                    <p>Assess your emotional control skills</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">🤝</div>
                    <h3>Social Skills</h3>
                    <p>Evaluate your interpersonal abilities</p>
                </div>
            </div>

            <button class="start-btn" onclick="startTest()">Start Your EQ Test</button>
        </div>

        <div class="info-section">
            <h2>Why Take This Test?</h2>
            <p>Emotional Intelligence (EQ) is your ability to recognize, understand, and manage your own emotions while effectively recognizing and responding to others' emotions.</p>
            <p>Research shows that people with higher EQ tend to have better relationships, perform better at work, and experience greater life satisfaction.</p>
            <p>This comprehensive test will evaluate your emotional intelligence across multiple dimensions and provide personalized feedback to help you grow.</p>
            
            <div class="stats">
                <div class="stat">
                    <span class="stat-number">25</span>
                    <span class="stat-label">Questions</span>
                </div>
                <div class="stat">
                    <span class="stat-number">10</span>
                    <span class="stat-label">Minutes</span>
                </div>
                <div class="stat">
                    <span class="stat-number">4</span>
                    <span class="stat-label">EQ Dimensions</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        function startTest() {
            // Add a smooth transition effect
            document.body.style.opacity = '0';
            document.body.style.transition = 'opacity 0.5s ease';
            
            setTimeout(() => {
                window.location.href = 'quiz.php';
            }, 500);
        }

        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const features = document.querySelectorAll('.feature');
            
            features.forEach((feature, index) => {
                feature.style.animationDelay = `${index * 0.2}s`;
                feature.style.animation = 'fadeInUp 0.6s ease forwards';
            });
        });

        // Add fadeInUp animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
