<!-- http://localhost/PBI1-B-Humble/KD-infoApp/development/kawando/profile_test.php -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>仮データを作成</title>
</head>

<body>
    <form>
        <?php
        $dsn = 'mysql:host=localhost;dbname=prosite;charset=utf8'; // データベースの接続情報（prositeに接続）
        $user = 'kobe'; // ユーザー名
        $password = 'denshi'; // パスワード
        // データベースに接続
        try {
            $pdo = new PDO($dsn, $user, $password); // データベースに接続
            echo '接続に成功しました'; // 成功した場合に表示
            echo "<br>";
        } catch (PDOException $e) {
            echo '接続に失敗しました'; // 失敗した場合に表示
            var_dump($e->getMessage()); // エラー内容を出力
            exit; // プログラムを終了
            die();
        }
        ?>
    </form>
    </form>
    <form method="POST" action="myProfile.php">
        <div class="login-container">
            <h3>マイプロフィールに飛ぶ</h3>
            <form>
                <input type="text" id="userName" name="userName" placeholder="ユーザー名" required>
                <input type="password" id="userPass" name="userPass" placeholder="パスワード" required>
                <button type="submit">飛ぶ</button>
            </form>
        </div>
    </form>
    <form method="POST" action="./test/insert_post_test.php">
        <div class="login-container">
            <h3>投稿テーブルに仮データを追加する</h3>
            <form>
                <input type="text" id="userName" name="userName" placeholder="ユーザー名" required>
                <input type="password" id="userPass" name="userPass" placeholder="パスワード" required>
                <br>
                <input type="text" id="postTitle" name="postTitle" placeholder="投稿タイトル" required>
                <input type="text" id="postText" name="postText" placeholder="投稿内容" required>
                <button type="submit">追加する</button>
            </form>
        </div>
    </form>
    <form method="POST" action="./test/insert_question_test.php">
        <div class="login-container">
            <h3>Q&Aテーブルに仮データを追加する</h3>
            <form>
                <input type="text" id="userName" name="userName" placeholder="ユーザー名" required>
                <input type="password" id="userPass" name="userPass" placeholder="パスワード" required>
                <br>
                <input type="text" id="questionTitle" name="questionTitle" placeholder="Q&Aタイトル" required>
                <input type="text" id="questionText" name="questionText" placeholder="Q&A内容" required>
                <button type="submit">追加する</button>
            </form>
        </div>
    </form>
    <?php
    // select文を変数に代入し実行(usersテーブルのデータを取得)
    try {
        $sql = 'select * from users'; // SQL文を変数に代入
        $stmt = $pdo->query($sql); // SQL文を実行
        $results = $stmt->fetchALL(); // 実行結果を取得
        echo '<br>';
        echo '----------usersテーブルのデータ一覧----------';
        echo '<br>';
        echo 'user_id | user_name | user_pass | email_address | profile_title | profile_text' . '<br>';
        foreach ($results as $result) {
            echo $result['user_id'] . ' ,' . $result['email_address'] . ' ,' . $result['user_name'] . ' ,' . $result['user_pass'] . ' ,'; // sql文の結果を出力
            echo $result['profile_title'] . ' ,' . $result['profile_text'];
            echo '<br>';
        }
    } catch (PDOException $e) {
        echo '接続に失敗しました'; // 失敗した場合に表示
        var_dump($e->getMessage()); // エラー内容を出力
        exit; // プログラムを終了
        die();
    }
    ?>
</body>

</html>