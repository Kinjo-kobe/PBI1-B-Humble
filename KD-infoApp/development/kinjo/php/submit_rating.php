<?php
// データベース接続
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "projectDB";
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続エラーの確認
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// POSTリクエストから評価と投稿IDを取得
$rating = $_POST['rating'];
$projectId = $_POST['id'];

// 評価をデータベースに保存
$sql = "INSERT INTO ratings (project_id, rating) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $projectId, $rating);
$stmt->execute();

$conn->close();
?>
