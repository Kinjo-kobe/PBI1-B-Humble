<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions KD-info</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome CSSを追加 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="\PBI1-B-Humble\KD-infoApp\public\Components\static\AppIcon\KD-info2.png">

    <style>
        body {
            background-color: #333;
        }
    </style>
</head>
<body>
  <?php
    session_start(); // セッションを開始または継続
    include '..\Components\src\header\header.php';
    // renderHeader('posting'); // または 'question' などのアクティブページを指定
    renderHeader('question'); // または 'question' などのアクティブページを指定

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
