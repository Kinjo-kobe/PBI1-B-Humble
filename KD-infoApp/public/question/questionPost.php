<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Question KD-info</title>
    <!-- TailwindCSSに必要なリンク -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome CSSを追加 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- タブのアイコン設定(相対パスは非表示になるバグがあるので絶対パスで指定中) -->
    <link rel="icon" type="image/png" href="\PBI1-B-Humble\KD-infoApp\public\Components\static\AppIcon\KD-info2.png">

    <style>
      /* 全画面共通のバックグラウンドカラー設定 */
        body {
            background-color: #333;
        }
    </style>
</head>
<body>
  <?php
    // セッションの開始とヘッダーのインポート
    session_start();
    include '..\Components\src\header\header.php';
    renderHeader('question');

    // テスト用セッション情報表示
    if (isset($_SESSION['user_name'])) {
      // ログインしているユーザー名を表示
      echo "<h1>Welcome, " . htmlspecialchars($_SESSION['user_name']) . "!</h1>";
    } else {
      // ログイン情報がない場合のメッセージ
      echo "<h1>Welcome to Question Home</h1>";
      echo "<p>Please <a href='login.php'>login</a> to continue.</p>";
    }
  ?>
</body>
<body class="container mx-auto px-4 py-4">
    <h1 class="text-2xl font-bold mb-4 text-white">質問の新規作成</h1>
    <form action="submitQuestion.php" method="POST" class="bg-gray-900 p-4 rounded-lg border-black">
        <div class="mb-4">
            <label for="title" class="block text-sm font-bold mb-2 text-white">質問のタイトル:</label>
            <input type="text" name="title" id="title" required class="w-full p-2 rounded input-bg text-black" placeholder="Enter the title">
        </div>
        <div class="mb-6">
            <label for="text" class="block text-sm font-bold mb-2 text-white">質問内容:</label>
            <textarea name="text" id="text" required class="w-full p-2 rounded input-bg text-white" placeholder="Describe your question"></textarea>
        </div>
        <!-- user_idをセッションから取得して隠しフィールドとして送信 -->
        <?php
        // session_start();
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
