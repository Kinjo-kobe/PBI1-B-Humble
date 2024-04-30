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

// POSTリクエストから削除する返信のIDを取得
$replyId = $_POST['replyId'];

// 削除するSQL文を準備
$sql = "DELETE FROM replies WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $replyId);

// SQL文を実行して削除
if ($stmt->execute()) {
    echo "Reply deleted successfully";
} else {
    echo "Error deleting reply: " . $conn->error;
}

// 接続を閉じる
$conn->close();
?>
