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
<body>
  <?php
    session_start(); // セッションを開始または継続
    include '..\Components\src\header\header.php';
    renderHeader('question'); // または 'question' などのアクティブページを指定

    // // テスト用セッション情報表示
    // if (isset($_SESSION['username'])) {
    //   // ログインしているユーザー名を表示
    //   echo "<h1>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</h1>";
    // } else {
    //   // ログイン情報がない場合のメッセージ
    //   echo "<h1>Welcome to Question Home</h1>";
    //   echo "<p>Please <a href='login.php'>login</a> to continue.</p>";
    // }

    // Database connection settings
    $servername = "localhost";
    $username = "kobe";
    $password = "denshi";
    $dbname = "prosite";

    $dsn = 'mysql:host=localhost;dbname=prosite;charset=utf8'; // データベースの接続情報（prositeに接続）
    $user = 'kobe'; // ユーザー名
    $password = 'denshi'; // パスワード

    // select文を変数に代入し実行(questionsテーブルのデータを取得)
    // READ
    try {
      $pdo = new PDO($dsn, $user, $password); // データベースに接続
      $sql = 'select * from questions'; // SQL文を変数に代入
      $stmt = $pdo->query($sql); // SQL文を実行
      $results = $stmt->fetchALL(); // 実行結果を取得
      echo '----------questionsテーブルのデータ一覧----------';
      echo '<br>';
      foreach ($results as $result) {
          echo $result['question_id'] . ' ,' . $result['user_id'] . ' ,' . $result['question_title'] . ' ,' . $result['question_text'] . ' ,'; // sql文の結果を出力
          echo $result['question_good'] . ' ,' . $result['question_code'] . ' ,' . $result['question_image_name'] . ' ,' . $result['question_image'] . ' ,';
          echo $result['question_time'];
          echo '<br>';
      }
    } catch (PDOException $e) {
        echo '接続に失敗しました'; // 失敗した場合に表示
        var_dump($e->getMessage()); // エラー内容を出力
        exit; // プログラムを終了
        die();
    }
    $pdo = null;    // データベース接続を切断


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
  ?>
</body>
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
</html>
