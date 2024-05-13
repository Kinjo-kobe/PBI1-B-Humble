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

// Database connection
$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch questions based on sort order
$sort_order = $_GET['sort'] ?? 'newest'; // Default to newest if not specified
$sort_query = $sort_order === 'newest' ? "ORDER BY question_time DESC" : ($sort_order === 'oldest' ? "ORDER BY question_time ASC" : "ORDER BY question_good DESC");

$stmt = $conn->prepare("SELECT * FROM questions $sort_query");
$stmt->execute();
$questions = $stmt->fetchAll();
?>

<body>
    <div class="container mx-auto p-4">
        <h1 class="text-white text-xl">質問一覧</h1>
        <?php foreach ($questions as $question): ?>
            <div class="bg-gray-800 text-white p-4 mb-3 rounded">
                <h2 class="font-bold"><?php echo htmlspecialchars($question['question_title']); ?></h2>
                <p><?php echo htmlspecialchars($question['question_text']); ?></p>
                <a href="questionDetail.php?id=<?php echo $question['question_id']; ?>" class="text-blue-500 hover:text-blue-700">Read more</a>
                <span class="text-sm">Posted on <?php echo date('Y-m-d', strtotime($question['question_time'])); ?></span>
            </div>
        <?php endforeach; ?>
        <a href="questionSubmit.php" class="fixed bottom-5 right-5 bg-blue-500 text-white p-2 rounded-full text-lg">
            <i class="fa fa-plus"></i>
        </a>
    </div>
</body>
</html>
