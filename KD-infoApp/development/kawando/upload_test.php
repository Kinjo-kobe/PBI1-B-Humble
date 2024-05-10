<?php
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

// 許可する拡張子
$extensions = array("jpeg", "jpg", "png");

if (in_array($file_ext, $extensions) === false) {
    $errors[] = "許可されていないファイル拡張子です。 JPEG または PNG のみアップロードできます。";
    exit; // プログラムを終了
    die();
    $pdo = null;    // データベース接続を切断
}

if ($file_size > (15 * 1048576)) { // 15MBを超える場合(xMB = x*1048576 bytes)
    $errors[] = 'ファイルサイズが大きすぎます。15MB以下のファイルをアップロードしてください。';
    exit; // プログラムを終了
    die();
    $pdo = null;    // データベース接続を切断
}

// エラーがなければファイルをアップロード
if (empty($errors) == true) {
    move_uploaded_file($file_tmp, "images/" . $file_name);

    // アップロードされたファイルを処理する
    if (isset($_FILES['image'])) {
        $errors = array();
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];

        // 画像をバイナリデータに変換
        $imgData = addslashes(file_get_contents($_FILES['image']['tmp_name']));


        // 仮データ登録に必要な値を代入
        $question_title = 'テストtitle';
        $question_text = 'テストtext';

        // データベースに挿入
        $sql = "INSERT INTO questions (question_title,question_text,question_image_name, question_image) 
    VALUES ('$question_title','$question_text','$file_name', '$imgData')";
        if ($pdo->query($sql) === TRUE) {
            echo "画像がアップロードされ、データベースに保存されました。";
        } else {
            echo "エラー: " . $sql . "<br>" . $pdo->error;
        }
    }
}

$pdo = null;    // データベース接続を切断
