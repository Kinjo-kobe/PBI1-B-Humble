<?php

$question_id = $_POST['question_id']; // フォームから送信されたデータを受け取り、変数に保存する

// データベースに接続する
$dsn = 'mysql:host=localhost;dbname=prosite;charset=utf8'; // データベースの接続情報
$user = 'kobe'; // ユーザー名
$password = 'denshi'; // パスワード

try {
    $pdo = new PDO($dsn, $user, $password); // データベースに接続
    echo 'データベースに接続できました'; // 登録成功時に表示
} catch (PDOException $e) {
    echo '接続に失敗しました'; // 失敗した場合に表示
    var_dump($e->getMessage()); // エラー内容を出力
    exit; // プログラムを終了
    die();
}

// データベースから画像を取得する
$sql = "SELECT question_image_name, question_image FROM questions WHERE question_id = :question_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
$stmt->execute();

// 画像が見つかった場合は表示する(レコードが1件以上ある場合)
if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $filename = $row["question_image_name"];
    $imageData = $row["question_image"];

    // 画像を表示する
    echo '<h2>' . $filename . '</h2>';
    echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '">';
} else {
    echo "画像が見つかりませんでした。";
}

$pdo = null; // データベース接続を切断
