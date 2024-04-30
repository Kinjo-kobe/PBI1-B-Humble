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

// URLパラメータから投稿IDを取得
$id = $_GET['id'];

// SQLを使ってデータを削除
$sql = "DELETE FROM projects WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Record deleted successfully";
    header("Location: index.php"); // ホームページにリダイレクト
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
