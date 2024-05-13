<?php
// フォームから送信されたデータを受け取り、変数に保存する
$input_text = $_POST['input_text'];
$userId = $_POST['userId'];
$userPass = $_POST['userPass'];

// 受け取ったデータを表示する（デモンストレーション用）
echo "入力されたテキスト: " . $input_text;
echo "<br>";
echo "ユーザーID: " . $userId;
echo "<br>";
echo "パスワード: " . $userPass;
echo "<br>";

$dsn = 'mysql:host=localhost;dbname=prosite;charset=utf8'; // データベースの接続情報
$user = 'kobe'; // ユーザー名
$password = 'denshi'; // パスワード

// insert文を変数に代入し実行
try {
    $pdo = new PDO($dsn, $user, $password); // データベースに接続
    $sql = 'insert into users(email_address, user_name, user_pass) values(:input_text ,:userId ,:userPass)'; // SQL文を変数に代入
    $stmt = $pdo->prepare($sql); // SQL文実行する前にprepareメソッドを実行
    $stmt->execute(['input_text' => $input_text, 'userId' => $userId, 'userPass' => $userPass]); // 値を代入してSQL文を実行
    echo 'データが登録されました'; // 登録成功時に表示
} catch (PDOException $e) {
    echo '接続に失敗しました'; // 失敗した場合に表示
    var_dump($e->getMessage()); // エラー内容を出力
    exit; // プログラムを終了
    die();
}

$pdo = null;    // データベース接続を切断
