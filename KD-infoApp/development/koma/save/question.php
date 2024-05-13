<!-- // // テスト用セッション情報表示
    // if (isset($_SESSION['username'])) {
    //   // ログインしているユーザー名を表示
    //   echo "<h1>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</h1>";
    // } else {
    //   // ログイン情報がない場合のメッセージ
    //   echo "<h1>Welcome to Question Home</h1>";
    //   echo "<p>Please <a href='login.php'>login</a> to continue.</p>";
    // } -->


<!-- 廃棄 -->
<!-- <body class="bg-gray-800 flex flex-col items-center justify-center min-h-screen">
    <div class="container mx-auto px-4">
    <?php foreach ($posts as $post): ?>
            <div class="bg-gray-900 rounded-lg p-4 mb-4 shadow-lg max-w-4xl">
                <div class="flex items-center space-x-4 mb-4">
                    <img src="/path/to/default-avatar.png" alt="Avatar" class="w-12 h-12 rounded-full">
                    <div>
                        <p class="text-white text-lg"><?php echo htmlspecialchars($post['user_name']); ?></p>
                        <p class="text-gray-400 text-sm"><?php echo date("Y/m/d", strtotime($post['post_time'])); ?></p>
                    </div>
                </div>
                <h3 class="text-xl text-white font-bold mb-2"><?php echo htmlspecialchars($post['post_title']); ?></h3>
                <p class="text-white mb-2"><?php echo nl2br(htmlspecialchars($post['post_text'])); ?></p>
                <div class="flex items-center justify-between text-white">
                    <div>👍 <?php echo $post['like_count']; ?></div>
                    <div>💬 <?php echo $post['reply_count']; ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body> -->



// // Create a connection to the database
    // try {
    //     $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //     // SQL query to fetch posts and related user information
    //     $sql = "SELECT p.post_id, p.user_id, p.post_title, p.post_text, p.post_time, u.user_name,
    //             (SELECT COUNT(*) FROM replies WHERE post_id = p.post_id) as reply_count,
    //             (SELECT COUNT(*) FROM likes WHERE post_id = p.post_id) as like_count
    //             FROM posts p
    //             JOIN users u ON p.user_id = u.user_id
    //             ORDER BY p.post_time DESC";

    //     $stmt = $conn->prepare($sql);
    //     $stmt->execute();

    //     $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // } catch (PDOException $e) {
    //     echo "Connection failed: " . $e->getMessage();
    // }


    <!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>質問の新規作成</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
  <style>
    .input-bg { background-color: #333; } /* 入力フィールドの背景色を暗くする */
    .border-black { border: 1px solid black; } /* 枠を黒い線で囲む */
  </style>
</head>
<body class="container mx-auto px-4 py-4">
    <h1 class="text-2xl font-bold mb-4 text-white">質問の新規作成</h1>
    <form action="submitQuestion.php" method="POST" class="bg-gray-900 p-4 rounded-lg border-black">
        <div class="mb-4">
            <label for="title" class="block text-sm font-bold mb-2 text-white">質問のタイトル:</label>
            <input type="text" name="title" id="title" required class="w-full p-2 rounded input-bg text-white" placeholder="Enter the title">
        </div>
        <div class="mb-6">
            <label for="text" class="block text-sm font-bold mb-2 text-white">質問内容:</label>
            <textarea name="text" id="text" required class="w-full p-2 rounded input-bg text-white" placeholder="Describe your question"></textarea>
        </div>
        <!-- user_idをセッションから取得して隠しフィールドとして送信 -->
        <?php
        session_start();
        $user_id = $_SESSION['user_id'] ?? 'guest'; // セッションが設定されていない場合はゲストとして扱う
        echo "<input type='hidden' name='user_id' value='$user_id'>";
        ?>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                質問を送信
            </button>
        </div>
    </form>
</body>
</html>
