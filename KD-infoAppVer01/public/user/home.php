<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.html"); // ログインしていない場合はログインページにリダイレクト
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT分野情報共有サイト</title>
    <!-- CSSやJavaScriptのリンクなど -->
</head>

<body>
    <div class="container">
        <div class="title">IT分野情報共有サイト</div>
        <p>ようこそ、<?php echo $_SESSION['username']; ?>さん</p>
        <!-- 他のコンテンツなど -->
    </div>
</body>

</html>