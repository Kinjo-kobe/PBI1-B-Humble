<?php
session_start();

// もしログインしていない場合、ログインページにリダイレクト
if (!isset($_SESSION['username'])) {
    header("Location: ../user/login.php");
    exit();
}

// データベース接続情報
$servername = "localhost"; // データベースのホスト名
$username = "kobe"; // データベースのユーザー名
$password = "denshi"; // データベースのパスワード
$dbname = "prosite"; // データベース名

// POSTリクエストがあるかどうかをチェック
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 現在のパスワードを取得
    $current_password = $_POST["current_password"];
    // 新しいパスワードを取得
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    // 新しいパスワードが現在のパスワードと同じかどうかを確認
    if ($current_password === $new_password) {
        echo "<script>alert('現在のパスワードと新しいパスワードが一緒です。もう一度やり直してください。');</script>";
    } else {
        try {
            // データベースに接続
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // 現在のパスワードを検証
            $stmt = $conn->prepare("SELECT user_pass FROM users WHERE user_name = :username");
            $stmt->bindParam(':username', $_SESSION['username']);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $hashed_password = $result['user_pass'];
                if (password_verify($current_password, $hashed_password)) {
                    // パスワードが一致する場合の処理
                    // 新しいパスワードが8文字以上であることを確認
                    if (strlen($new_password) < 8) {
                        echo "<script>alert('新しいパスワードは8文字以上である必要があります。');</script>";
                    } elseif ($new_password !== $confirm_password) {
                        echo "<script>alert('新しいパスワードが一致しません。もう一度お試しください。');</script>";
                    } else {
                        // パスワードをハッシュ化
                        $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

                        // パスワードを更新するクエリ
                        $stmt = $conn->prepare("UPDATE users SET user_pass = :hashed_password WHERE user_name = :username");
                        $stmt->bindParam(':hashed_password', $hashed_new_password);
                        $stmt->bindParam(':username', $_SESSION['username']);
                        $stmt->execute();

                        // パスワードが更新されたらホームページにリダイレクト
                        header("Location: ../user/home.php");
                        exit();
                    }
                } else {
                    echo "<script>alert('現在のパスワードが正しくありません。');</script>";
                }
            }
        } catch (PDOException $e) {
            echo "<p>エラー: " . $e->getMessage() . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード変更</title>
    <script>
        function showError(message) {
            alert(message);
        }
    </script>
</head>

<body>
    <h2>パスワード変更</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="current_password">現在のパスワード：</label>
        <input type="password" id="current_password" name="current_password" required><br><br>
        <label for="new_password">新しいパスワード：</label>
        <input type="password" id="new_password" name="new_password" required><br><br>
        <label for="confirm_password">新しいパスワード（確認）：</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        <input type="submit" value="変更">
    </form>
</body>

</html>