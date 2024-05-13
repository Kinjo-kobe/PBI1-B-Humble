<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- タブのタイトル -->
    <title>質問投稿 KD-info</title>
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
session_start();

// DB connect
$dbname = "prosite";
$servername = "localhost";
$username = "kobe";
$password = "denshi";
$dsn = 'mysql:host=localhost;dbname=prosite;charset=utf8'; // データベースの接続情報（prositeに接続）

// ヘッダーのインポート
include '..\Components\src\header\header.php';
renderHeader('question');

/* ----------------------------- */
// テスト用セッション情報表示
if (isset($_SESSION['user_name'])) {
  // ログインしているユーザー名を表示
  echo "<h1>Welcome, " . htmlspecialchars($_SESSION['user_name']) . "!</h1>";
} else {
  // ログイン情報がない場合のメッセージ
  echo "<h1>Welcome to Question Home</h1>";
  echo "<p>Please <a href='\PBI1-B-Humble\KD-infoApp\public\user\login.php'>login</a> to continue.</p>";
}
/* ----------------------------- */


// Handle question submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $text = $_POST['text'];
    $user_id = $_SESSION['user_name']; // Assume user_id is stored in session

    $stmt = $conn->prepare("INSERT INTO questions (user_id, question_title, question_text, question_time, question_good) VALUES (:user_id, :title, :text, NOW(), 0)");
    $stmt->bindParam(':user_name', $user_id);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':text', $text);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<body>
    <div class="container mx-auto p-4">
        <h1 class="text-white text-xl">新規質問を投稿</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="space-y-4">
            <div class="input-field">
                <label class="text-white">タイトル:</label>
                <input type="text" name="title" required class="block w-full px-3 py-2 rounded-md">
            </div>
            <div class="input-field">
                <label class="text-white">詳細:</label>
                <textarea name="text" required class="block w-full px-3 py-2 rounded-md"></textarea>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">質問を投稿</button>
        </form>
    </div>
</body>
</html>