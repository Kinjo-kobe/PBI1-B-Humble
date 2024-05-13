<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイプロフィール</title>
</head>

<body>
    <?php
    // フォームから送信されたデータを受け取り、変数に保存する
    $userName = $_POST['userName'];
    $userPass = $_POST['userPass'];
    $postTitle = $_POST['postTitle'];
    $postText = $_POST['postText'];

    // データベースへの接続確認
    try {
        $dsn = 'mysql:host=localhost;dbname=prosite;charset=utf8'; // データベースの接続情報
        $user = 'kobe'; // ユーザー名
        $password = 'denshi'; // パスワード
        $pdo = new PDO($dsn, $user, $password); // データベースに接続
        echo '接続に成功しました'; // 成功した場合に表示
        echo "<br>";
    } catch (PDOException $e) {
        echo '接続に失敗しました'; // 失敗した場合に表示
        var_dump($e->getMessage()); // エラー内容を出力
        exit; // プログラムを終了
        die();
        $pdo = null;    // データベース接続を切断
    }
    // Postで受け取ったデータからユーザーの主キーを取得
    $sql = 'select user_id from users where user_name = :userName and user_pass = :userPass'; // SQL文を変数に代入
    $stmt = $pdo->prepare($sql); // SQL文実行する前にprepareメソッドを実行
    $stmt->execute(['userName' => $userName, 'userPass' => $userPass]); // 値を代入してSQL文を実行
    // 結果を取得
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $userId = $row['user_id'];  // ユーザーのuser_idがあれば取得
        echo 'ユーザーの主キーは: ' . $userId;
        echo "<br>";
    } else {
        echo 'ユーザーが見つかりませんでした';
        $pdo = null;    // データベース接続を切断
    }

    // 仮データを挿入する
    try {
        $sql = 'insert into posts (user_id, post_title, post_text) values (:userId, :postTitle, :postText)'; // SQL文を変数に代入
        $stmt = $pdo->prepare($sql); // SQL文実行する前にprepareメソッドを実行
        $stmt->execute(['userId' => $userId, 'postTitle' => $postTitle, 'postText' => $postText]); // 値を代入してSQL文を実行
        echo 'データが追加されました' . '<br>'; // 登録成功時に表示
    } catch (PDOException $e) {
        echo '接続に失敗しました'; // 失敗した場合に表示
        var_dump($e->getMessage()); // エラー内容を出力
        exit; // プログラムを終了
        die();
    }
    ?>

    <?php
    $pdo = null;    // データベース接続を切断
    ?>
</body>

</html>