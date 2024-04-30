<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロジェクトホーム</title>
    <style>
        /* ボタンのスタイル */
        .deleteButton {
            background-color: #ff0000;
            color: #ffffff;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            border-radius: 5px;
        }
        #postButton {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .averageRating {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>投稿作品一覧</h1>
    <div id="projectList">
        <ul>
            <?php
            $servername = "localhost";
            $username = "username";
            $password = "password";
            $dbname = "projectDB";

            // データベース接続
            $conn = new mysqli($servername, $username, $password, $dbname);

            // 接続エラーの確認
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // データベースからプロジェクトと平均評価を取得
            $sql = "SELECT p.id, p.title, p.created_at, AVG(r.rating) AS average_rating
                    FROM projects p
                    LEFT JOIN ratings r ON p.id = r.project_id
                    GROUP BY p.id, p.title, p.created_at";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // レコードがある場合、それを一覧で表示
                while($row = $result->fetch_assoc()) {
                    echo "<li>";
                    echo "<a href='detail.php?id=" . $row["id"] . "'>" . $row["title"] . "</a> - " . $row["created_at"];
                    if ($row["average_rating"] !== null) {
                        echo " <span class='averageRating'>[評価: " . number_format($row["average_rating"], 1) . "]</span>";
                    }
                    echo "<button class='deleteButton' onclick='deleteProject(" . $row["id"] . ")'>削除</button>";
                    echo "</li>";
                }
            } else {
                echo "<p>投稿がありません</p>";
            }

            $conn->close();
            ?>
        </ul>
    </div>

    <!-- 投稿フォームに飛ぶボタン -->
    <a href="post_form.php" id="postButton">投稿する</a>

    <!-- JavaScript -->
    <script>
        function deleteProject(id) {
            if (confirm("本当に削除しますか？")) {
                window.location.href = "delete.php?id=" + id;
            }
        }
    </script>
</body>
</html>
