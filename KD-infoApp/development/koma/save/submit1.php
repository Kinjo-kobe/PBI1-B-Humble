<?php
session_start();
require_once 'path/to/database/config.php'; // データベース設定のパスは適宜調整してください。

// フォームからのデータ送信を処理
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $text = $_POST['text'];
    $user_id = $_SESSION['user_id']; // セッションからユーザーIDを取得

    // データベースへの質問登録
    $stmt = $conn->prepare("INSERT INTO questions (user_id, question_title, question_text, question_time, question_good) VALUES (:user_id, :title, :text, NOW(), 0)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':text', $text);
    $stmt->execute();

    header("Location: index.php"); // 投稿後は質問一覧ページへリダイレクト
    exit;
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>質問新規作成 KD-info</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="\PBI1-B-Humble\KD-infoApp\public\Components\static\AppIcon\KD-info2.png">
    <style>
        body {
            background-color: #333;
        }
    </style>
</head>
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
