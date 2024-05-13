<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- タブのタイトル -->
    <title>Questions KD-info</title>
    <!-- TailwindCSSに必要なリンク -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome CSSを追加 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- タブのアイコン設定(相対パスは非表示になるバグがあるので絶対パスで指定中) -->
    <link rel="icon" type="image/png" href="\PBI1-B-Humble\KD-infoApp\public\Components\static\AppIcon\KD-info2.png">
    <style>
        body {
            background-color: #333;
        }
    </style>
</head>

<body>
    <?php
    // セッション開始
    session_start();

    // ヘッダーのインポート
    include '..\Components\src\header\header.php';
    renderHeader('question');

    // ログアウト処理
    if (isset($_POST["logout"])) {
        // セッション変数を全て解除
        $_SESSION = array();
        // セッションを破棄
        session_destroy();
        // ログアウト後、エントリポイント(posting/index.php)にリダイレクト
        // header("Location: ../posting/index.php");
        exit;
    }
    ?>

    <div class="container">
        <div class="title">KD-infoからログアウトしますか？</div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <button type="submit" class="button" name="logout">Yes</button>
            <button type="button" class="button" onclick="goHome()">No</button>
        </form>
    </div>

    <script>
        function goHome() {
            window.location.href = "../posting/index.php";
        }
    </script>
</body>

</html>