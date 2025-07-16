<?php
// Database configuration
$host = 'localhost';
$dbname = 'dbke2vpxyvufqn';
$username = 'ulnrcogla9a1t';
$password = 'yolpwow1mwr2';

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // Set PDO attributes
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
} catch (PDOException $e) {
    // Log error and show user-friendly message
    error_log("Database connection failed: " . $e->getMessage());
    die("Database connection failed. Please try again later.");
}

// Function to test database connection
function testConnection() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT 1");
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

// Function to get database statistics
function getDatabaseStats() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT COUNT(*) as total_tests FROM eq_test_results");
        $result = $stmt->fetch();
        return $result['total_tests'];
    } catch (PDOException $e) {
        return 0;
    }
}

// Function to get average scores
function getAverageScores() {
    global $pdo;
    try {
        $stmt = $pdo->query("
            SELECT 
                ROUND(AVG(self_awareness), 2) as avg_self_awareness,
                ROUND(AVG(empathy), 2) as avg_empathy,
                ROUND(AVG(emotional_regulation), 2) as avg_emotional_regulation,
                ROUND(AVG(social_skills), 2) as avg_social_skills,
                ROUND(AVG(overall_score), 2) as avg_overall
            FROM eq_test_results
        ");
        return $stmt->fetch();
    } catch (PDOException $e) {
        return null;
    }
}
?>
