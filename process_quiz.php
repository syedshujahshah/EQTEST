<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['answers']) || empty($_SESSION['answers'])) {
    header('Location: index.php');
    exit();
}

// Calculate scores by category
$categories = array(
    'self_awareness' => 0,
    'empathy' => 0,
    'emotional_regulation' => 0,
    'social_skills' => 0
);

$category_counts = array(
    'self_awareness' => 0,
    'empathy' => 0,
    'emotional_regulation' => 0,
    'social_skills' => 0
);

// Question categories mapping
$question_categories = array(
    0 => 'self_awareness', 1 => 'empathy', 2 => 'emotional_regulation', 3 => 'social_skills',
    4 => 'self_awareness', 5 => 'empathy', 6 => 'emotional_regulation', 7 => 'social_skills',
    8 => 'self_awareness', 9 => 'empathy', 10 => 'emotional_regulation', 11 => 'social_skills',
    12 => 'self_awareness', 13 => 'empathy', 14 => 'emotional_regulation', 15 => 'social_skills',
    16 => 'self_awareness', 17 => 'empathy', 18 => 'emotional_regulation', 19 => 'social_skills',
    20 => 'self_awareness', 21 => 'empathy', 22 => 'emotional_regulation', 23 => 'social_skills',
    24 => 'self_awareness'
);

// Calculate category scores
foreach ($_SESSION['answers'] as $question_index => $answer) {
    if (isset($question_categories[$question_index])) {
        $category = $question_categories[$question_index];
        $categories[$category] += $answer;
        $category_counts[$category]++;
    }
}

// Calculate averages and total score
$total_score = 0;
$category_averages = array();

foreach ($categories as $category => $score) {
    if ($category_counts[$category] > 0) {
        $category_averages[$category] = round(($score / $category_counts[$category]), 2);
        $total_score += $category_averages[$category];
    }
}

$overall_eq_score = round(($total_score / 4), 2);
$eq_percentage = round((($overall_eq_score - 1) / 4) * 100);

// Store results in database
try {
    $stmt = $pdo->prepare("INSERT INTO eq_test_results (self_awareness, empathy, emotional_regulation, social_skills, overall_score, test_date) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->execute([
        $category_averages['self_awareness'],
        $category_averages['empathy'],
        $category_averages['emotional_regulation'],
        $category_averages['social_skills'],
        $overall_eq_score
    ]);
    $result_id = $pdo->lastInsertId();
} catch (PDOException $e) {
    // Continue without database storage if there's an error
    $result_id = null;
}

// Store results in session for display
$_SESSION['test_results'] = array(
    'overall_score' => $overall_eq_score,
    'percentage' => $eq_percentage,
    'categories' => $category_averages,
    'result_id' => $result_id
);

// Clear quiz session data
unset($_SESSION['current_question']);
unset($_SESSION['answers']);

// Redirect to results page
header('Location: results.php');
exit();
?>
