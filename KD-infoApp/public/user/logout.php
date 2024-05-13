<?php
    if (isset($_POST["logout"])) {
        // セッション変数を全て解除
        $_SESSION = array();
        // クッキーに保存されているセッションIDを削除
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        // セッションを破棄
        session_destroy();
        // ログアウト後、エントリポイント(posting/index.php)にリダイレクト
        header("Location: ../posting/index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout KD-info</title>
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

<?php
    // session_start();

    // ヘッダーのインポート
    include '..\Components\src\renderHeader.php';
    renderHeader('question');
?>

<body>
    <div class="w-96 bg-gray-900 p-8 rounded-lg shadow-md text-white">
        <h1 class="text-xl text-center mb-4">KD-infoからログアウトしますか？</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="space-y-4">
            <button type="submit" class="w-full bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" name="logout">Yes</button>
            <button type="button" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="goHome()">No</button>
        </form>
    </div>

    <script>
        function goHome() {
            window.location.href = "../posting/index.php";
        }
    </script>
</body>
</html>
