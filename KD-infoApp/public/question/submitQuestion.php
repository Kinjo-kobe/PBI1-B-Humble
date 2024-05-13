<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page
    header('Location: login.php');
    exit;
}

// Database connection settings
$servername = "localhost";
$username = "kobe";
$password = "denshi";
$dbname = "prosite";

try {
    // Create PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL statement
    $stmt = $pdo->prepare("INSERT INTO questions (user_id, question_title, question_text, question_time) VALUES (:user_id, :title, :text, NOW())");

    // Bind parameters to statement
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->bindParam(':title', $_POST['title']);
    $stmt->bindParam(':text', $_POST['text']);

    // Execute the statement
    $stmt->execute();

    // Redirect to the question home page with a success message
    $_SESSION['message'] = "Question posted successfully!";
    header('Location: questionHome.php');
    exit;
} catch (PDOException $e) {
    // If an error occurred, print the error
    echo "Connection failed: " . $e->getMessage();
}
?>
