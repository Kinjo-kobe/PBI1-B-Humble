<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Question Home</title>
</head>
<body>
  <?php
    include '..\Components\Header\header.php';
    session_start(); // セッションを開始または継続

    renderHeader('posting'); // または 'question' などのアクティブページを指定

    if (isset($_SESSION['username'])) {
      // ログインしているユーザー名を表示
      echo "<h1>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</h1>";
    } else {
      // ログイン情報がない場合のメッセージ
      echo "<h1>Welcome to Question Home</h1>";
      echo "<p>Please <a href='login.php'>login</a> to continue.</p>";
    }
  ?>
</body>
</html>
