<?php
// データベース接続情報
$servername = "localhost";
$username = "username"; // ユーザー名
$password = "password"; // パスワード
$dbname = "projectDB"; // データベース名

// データベース接続
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// POSTリクエストから返信内容を取得
$content = $_POST['content'];
$projectId = $_POST['id'];

// SQLインジェクションを防ぐために、プリペアドステートメントを使用
$sql = "INSERT INTO replies (content, project_id) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $content, $projectId);

// 実行
if ($stmt->execute()) {
    // 成功した場合の処理
    echo json_encode(array("success" => true));
} else {
    // 失敗した場合の処理
    echo json_encode(array("success" => false, "error" => $conn->error));
}

// 接続を閉じる
$stmt->close();
$conn->close();
?>
