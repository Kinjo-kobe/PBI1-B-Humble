<!-- http://localhost/PBI1-B-Humble/KD-infoAppVer01/development/kawando/rogin_test.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインページ</title>
    <!-- CSSの反映 -->
    <!-- <link rel="stylesheet" href="styles.css"> -->
</head>

<body>
    <form method="POST" action="test.php">
        <div class="login-container">
            <h2>ログイン</h2>
            <form>
                <input type="text" id="input_text" name="input_text" placeholder="メールアドレス">
                <input type="text" id="userId" name="userId" placeholder="ユーザー名" required>
                <input type="password" id="userPass" name="userPass" placeholder="パスワード" required>
                <button type="submit">送る</button>
            </form>
        </div>
        <?php
        $dsn = 'mysql:host=localhost;dbname=prosite;charset=utf8'; // データベースの接続情報（prositeに接続）
        $user = 'kobe'; // ユーザー名
        $password = 'denshi'; // パスワード

        // // insert文を変数に代入し実行
        // try {
        //     $pdo = new PDO($dsn, $user, $password); // データベースに接続
        //     $sql = 'insert into users(email_address, user_name, user_pass) values(? ,? ,?)'; // SQL文を変数に代入
        //     $stmt = $pdo->query($sql); // SQL文を実行
        // } catch (PDOException $e) {
        //     echo '接続に失敗しました'; // 失敗した場合に表示
        //     var_dump($e->getMessage()); // エラー内容を出力
        //     exit; // プログラムを終了
        //     die();
        // }

        // select文を変数に代入し実行
        try {
            $pdo = new PDO($dsn, $user, $password); // データベースに接続
            $sql = 'select * from users'; // SQL文を変数に代入
            $stmt = $pdo->query($sql); // SQL文を実行
            $results = $stmt->fetchALL(); // 実行結果を取得
            foreach ($results as $result) {
                echo $result['user_id'] . ' ,' . $result['email_address'] . ' ,' . $result['user_pass'] . ' ,' . $result['user_name'] . ' ,'; // sql文の結果を出力
                echo $result['profile_title'] . ' ,' . $result['profile_text'];
            }
        } catch (PDOException $e) {
            echo '接続に失敗しました'; // 失敗した場合に表示
            var_dump($e->getMessage()); // エラー内容を出力
            exit; // プログラムを終了
            die();
        }

        ?>
    </form>
</body>

</html>