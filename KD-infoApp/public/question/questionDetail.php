<?php
session_start();

// DB connect
$dbname = "prosite";
$servername = "localhost";
$username = "kobe";
$password = "denshi";

$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// パラメータ検証と質問の詳細の取得
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

// Like機能の処理
if (isset($_POST['like'])) {
    // いいね数の更新処理
    $stmt = $conn->prepare("UPDATE questions SET question_good = question_good + 1 WHERE question_id = :question_id");
    $stmt->bindParam(':question_id', $question_id);
    $stmt->execute();
    header("Refresh:0");
}

// 回答の取得
$reply_stmt = $conn->prepare("SELECT r.*, u.user_name FROM replies r JOIN users u ON r.user_id = u.user_id WHERE r.question_id = :question_id ORDER BY r.reply_time");
$reply_stmt->bindParam(':question_id', $question_id);
$reply_stmt->execute();
$replies = $reply_stmt->fetchAll();

// 回答送信の処理
if (isset($_POST['submit_reply'])) {
    $user_name = $_SESSION['session_user_name'];
    $reply_text = $_POST['reply_text'];

    // user_idの取得
    $user_stmt = $conn->prepare("SELECT user_id FROM users WHERE user_name = :user_name");
    $user_stmt->bindParam(':user_name', $user_name);
    $user_stmt->execute();
    $user = $user_stmt->fetch();

    if ($user) {
        $user_id = $user['user_id'];

        // 回答をrepliesテーブルに挿入
        $reply_stmt = $conn->prepare("INSERT INTO replies (user_id, question_id, reply_text, reply_time) VALUES (:user_id, :question_id, :reply_text, NOW())");
        $reply_stmt->bindParam(':user_id', $user_id);
        $reply_stmt->bindParam(':question_id', $question_id);
        $reply_stmt->bindParam(':reply_text', $reply_text);
        $reply_stmt->execute();

        header("Location: questionDetail.php?id=$question_id"); // ページをリフレッシュ
    } else {
        echo "<p>ユーザー情報の取得に失敗しました。</p>";
    }
}
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
        <span class="text-white">質問者: <a href="userProfile.php?user_id=<?php echo $question['user_id']; ?>" class="text-blue-500 hover:text-blue-700"><?php echo htmlspecialchars($question['user_name']); ?></a> 投稿日: <?php echo date('Y-m-d', strtotime($question['question_time'])); ?></span>
        <p class="text-white">質問詳細内容: <?php echo htmlspecialchars($question['question_text']); ?></p>
        <div>
            <form method="post">
                <button name="like" class="bg-red-500 text-white p-2 rounded">いいね</button>
                <span class="text-white"><?php echo $question['question_good']; ?> いいね</span>
            </form>
        </div>

        <!-- 回答モーダルウィンドウ起動ボタン -->
        <button onclick="document.getElementById('replyModal').style.display='block'" class="bg-blue-500 hover:bg-blue-700 text-white p-2 rounded">回答する</button>
        <!-- 回答モーダルウィンドウ -->
        <div id="replyModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3 text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                        <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" strokeWidth="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">質問に回答する</h3>
                    <form method="post" class="mt-2">
                        <textarea name="reply_text" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="回答を入力してください"></textarea>
                        <button type="submit" name="submit_reply" class="mt-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">送信</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- 回答表示 -->
    <div class="mt-4">
        <h2 class="text-white text-xl mb-2">回答:</h2>
        <?php if ($replies): ?>
            <?php foreach ($replies as $reply): ?>
                <div class="bg-gray-800 text-white p-4 rounded mb-2">
                    <p><strong><?php echo htmlspecialchars($reply['user_name']); ?></strong> (<?php echo date('Y-m-d H:i', strtotime($reply['reply_time'])); ?>)</p>
                    <p><?php echo htmlspecialchars($reply['reply_text']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-white">まだ回答がありません。</p>
        <?php endif; ?>
    </div>

    </div>
</body>

<script>
    // モーダルウィンドウの外をクリックしたときに閉じる
    window.onclick = function(event) {
        if (event.target == document.getElementById('replyModal')) {
            document.getElementById('replyModal').style.display = "none";
        }
    }
</script>

</html>
