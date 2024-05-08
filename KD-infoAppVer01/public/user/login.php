<?php
// データベースへの接続
$servername = "localhost"; // データベースのホスト名
$username = "kobe"; // データベースのユーザー名
$password = "denshi"; // データベースのパスワード
$dbname = "prosito"; // 使用するデータベース名

// データベースへの接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続の確認
if ($conn->connect_error) {
    die("データベースへの接続に失敗しました: " . $conn->connect_error);
}

// ログインフォームから送信されたデータの取得
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // データベース内でユーザー名とパスワードが一致するか確認
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // 認証成功の場合、セッションを開始し、ホームページにリダイレクト
        session_start();
        $_SESSION['username'] = $username;
        header("location: home.php");
    } else {
        // 認証失敗の場合、エラーメッセージを表示
        $error = "ユーザー名またはパスワードが正しくありません";
    }
}

$conn->close();
