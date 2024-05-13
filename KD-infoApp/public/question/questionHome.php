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
    session_start();  // セッションを開始または継続
    include '..\Components\src\header\header.php';    // ヘッダーの読み込み
    renderHeader('question');   // または 'question' などのアクティブページを指定

    // DB connect
    $dbname = "prosite";
    $servername = "localhost";
    $username = "kobe";
    $password = "denshi";

    $dsn = 'mysql:host=localhost;dbname=prosite;charset=utf8'; // データベースの接続情報（prositeに接続）

    // READ_Questions
    try {
      $pdo = new PDO($dsn, $username, $password); // データベースに接続
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
        echo "接続に失敗" . $e->getMessage();
        // echo '接続に失敗しました'; // 失敗した場合に表示
        // var_dump($e->getMessage()); // エラー内容を出力
        // exit; // プログラムを終了
        // die();
    }
    $pdo = null;    // データベース接続を切断
  ?>
  <button onclick="window.location.href='questionPost.php'" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded fixed bottom-4 right-4">
      質問を作成する
  </button>
</body>
</html>
