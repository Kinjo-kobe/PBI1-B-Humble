<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings KD-info</title>
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
    include '..\Components\src\renderHeader.php';
    // renderHeader('posting'); // または 'question' などのアクティブページを指定
    renderHeader('setting'); // または 'question' などのアクティブページを指定
?>
  <h1 class="text-white text-3xl font-bold p-4">Setting and Security</h1>
  <h2 class="text-white text-xl font-semibold p-4">パスワードの更新はこちら</h2>

  <!-- パスワード更新ページへのリンクボタン -->
  <a href="passwordUpdate.php" class="inline-block px-5 py-3 text-white bg-gray-700 font-medium text-lg rounded-lg shadow-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-opacity-50 transform active:translate-y-1 transition duration-300 ease-in-out">パスワードを更新する</a>

</body>
</html>
