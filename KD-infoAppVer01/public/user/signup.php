<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録</title>
</head>

<body>
    <h2>新規登録</h2>

    <?php
    // フォームが送信された場合の処理
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // データベース接続情報
        $servername = "localhost"; // データベースのホスト名
        $username = "kobe"; // データベースのユーザー名
        $password = "denshi"; // データベースのパスワード
        $dbname = "prosite"; // データベース名

        // フォームから受け取ったデータ
        $user_name = $_POST['user_name'];
        $email_address = $_POST['email_address'];
        $user_pass = $_POST['user_pass'];

        try {
            // データベースに接続
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // ユーザー名とメールアドレスの重複をチェック
            $stmt_check = $pdo->prepare("SELECT * FROM users WHERE user_name = :user_name OR email_address = :email_address");
            $stmt_check->bindParam(':user_name', $user_name);
            $stmt_check->bindParam(':email_address', $email_address);
            $stmt_check->execute();
            $result = $stmt_check->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                echo "すでにアカウントが存在しています";
            } else {
                // ユーザーが重複していない場合、新規登録を行う
                $stmt_insert = $pdo->prepare("INSERT INTO users (user_name, email_address, user_pass) VALUES (:user_name, :email_address, :user_pass)");
                $stmt_insert->bindParam(':user_name', $user_name);
                $stmt_insert->bindParam(':email_address', $email_address);
                $stmt_insert->bindParam(':user_pass', $user_pass);
                $stmt_insert->execute();

                echo "新規登録が完了しました。";
                // 登録が成功したらlogin.phpにリダイレクト
                header("Location: login.php");
                exit();
            }
        } catch (PDOException $e) {
            // エラーが発生した場合の処理
            echo "エラー: " . $e->getMessage();
        }
    }
    ?>

    <!-- 登録フォーム -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="user_name">ユーザー名:</label>
            <input type="text" id="user_name" name="user_name" required>
        </div>
        <div>
            <label for="email_address">メールアドレス:</label>
            <input type="email" id="email_address" name="email_address" required>
        </div>
        <div>
            <label for="user_pass">パスワード:</label>
            <input type="password" id="user_pass" name="user_pass" required>
        </div>
        <button type="submit">登録</button>
    </form>
</body>

</html>