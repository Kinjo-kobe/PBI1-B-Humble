<!DOCTYPE html>

<html lang="ja">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT分野情報共有サイト - ログアウト</title>

    <style>
        /* CSSスタイル */
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }

        .container {
            text-align: center;
        }

        .title {
            font-size: 60px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .button {
            padding: 10px 20px;
            font-size: 18px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;

        }
    </style>

</head>

<body>

    <div class="container">
        <div class="title">IT分野情報共有サイトからログアウトしますか？</div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <button type="submit" class="button" name="logout">ログアウトする</button>
            <button type="button" class="button" onclick="goHome()">ログアウトしない</button>
        </form>

    </div>
    <script>
        function goHome() {
            window.location.href = "home.php";
        }
    </script>

    <?php
    // セッション開始
    session_start();
    // ログアウト処理
    if (isset($_POST["logout"])) {
        // セッション変数を全て解除
        $_SESSION = array();
        // セッションを破棄
        session_destroy();
        // ログアウト後、ログインページにリダイレクト
        header("Location: home.php");
        exit;
    }

    ?>

</body>

</html>