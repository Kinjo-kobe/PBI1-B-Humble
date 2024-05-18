<?php
function renderHeader() {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RenderHeader KD-info</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .header {
            background-color: #111;
            border-bottom: 1px solid white;
        }
    </style>
</head>
<body>
    <div class="header flex justify-between items-center p-4 w-full">
        <!-- アイコン表示 -->
        <div class="flex items-center">
            <img src="\PBI1-B-Humble\KD-infoApp\public\Components\static\AppIcon\KD-info2.png" alt="App Icon" class="h-8">
            <a href="../posting/index.php" class="text-white pl-3">KD-info</a>
        </div>

        <!-- ヘッダーのナビゲーションメニュー -->
        <div class="flex items-center">
            <!-- 投稿に飛ぶボタン -->
            <a href="../posting/index.php" class="text-white pr-8">Posts</a>

            <!-- 質問に飛ぶボタン -->
            <a href="../question/index.php" class="text-white pr-40">Questions</a>

            <!-- アカウントナビゲーションのインクルード -->
            <?php include 'accountNavigation.php'; ?>
        </div>
    </div>
<?php
}
?>
