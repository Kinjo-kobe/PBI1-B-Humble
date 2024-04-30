<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "projectDB";

// データベース接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続エラーの確認
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// フォームからのデータを取得
$title = $_POST['title'];
$code = $_POST['code'];
$description = $_POST['description'];

// SQLを使ってデータをデータベースに挿入
$sql = "INSERT INTO projects (title, code, description) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $title, $code, $description);

if ($stmt->execute()) {
    echo "New record created successfully";
    header("Location: index.php"); // ホームページにリダイレクト
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
