<?php
session_start();

// DB connect
$dbname = "prosite";
$servername = "localhost";
$username = "kobe";
$password = "denshi";

$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Validate and fetch question details
if (!isset($_GET['id']) || empty($_SESSION['session_user_name'])) {
    header('Location: ../user/login.php'); // Redirect to login if not logged in or ID is not set
    exit;
}
$question_id = $_GET['id'];
$stmt = $conn->prepare("SELECT q.*, u.user_name FROM questions q JOIN users u ON q.user_id = u.user_id WHERE q.question_id = :question_id");
$stmt->bindParam(':question_id', $question_id);
$stmt->execute();
$question = $stmt->fetch();

if (!$question) {
    echo "<p>質問が見つかりませんでした。</p>";
    exit;
}

// Implement like button functionality here
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question Details KD-info</title>
    <!-- TailwindCSSに必要なリンク -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome CSSを追加 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- タブのアイコン設定(相対パスは非表示になるバグがあるので絶対パスで指定中) -->
    <link rel="icon" type="image/png" href="\PBI1-B-Humble\KD-infoApp\public\Components\static\AppIcon\KD-info2.png">
    <style>
        body { background-color: #111; }
    </style>
</head>

<?php
    // ヘッダーのインポート
    include '../Components/src/renderHeader.php';
    renderHeader('question');
?>

<body>
    <div class="container mx-auto p-4">
        <h1 class="text-white text-2xl">質問タイトル: <?php echo htmlspecialchars($question['question_title']); ?></h1>
        <span class="text-white">質問者:  <a href="userProfile.php?user_id=<?php echo $question['user_id']; ?>" class="text-blue-500 hover:text-blue-700"><?php echo htmlspecialchars($question['user_name']); ?></a> 投稿日:  <?php echo date('Y-m-d', strtotime($question['question_time'])); ?></span>
        <p class="text-white">質問詳細内容: <?php echo htmlspecialchars($question['question_text']); ?></p>
        <div>
            <button class="bg-red-500 text-white p-2 rounded">いいね</button>
            <span><?php echo $question['question_good']; ?> いいね</span>
        </div>
    </div>
</body>
</html>
