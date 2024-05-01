<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロジェクトホーム</title>
    <style>
        .deleteButton, .sortButton {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            border-radius: 5px;
            margin-left: 5px;
        }
        .deleteButton {
            background-color: #ff0000;
        }
        #postButton {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
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
    <?php
    session_start(); // セッションの開始

    // ソート状態の管理
    if (!isset($_SESSION['sort'])) {
        $_SESSION['sort'] = ['field' => 'date', 'order' => 'desc'];
    }
    if (isset($_GET['change_sort'])) {
        if ($_SESSION['sort']['field'] == $_GET['change_sort']) {
            $_SESSION['sort']['order'] = $_SESSION['sort']['order'] == 'desc' ? 'asc' : 'desc';
        } else {
            $_SESSION['sort'] = ['field' => $_GET['change_sort'], 'order' => 'desc'];
        }
    }
    ?>

    <h1>投稿作品一覧</h1>
    <div style="text-align: right; padding-bottom: 10px;">
        <a href="?change_sort=rating" class="sortButton">評価順切替</a>
        <a href="?change_sort=date" class="sortButton">更新日切替</a>
    </div>
    <div id="projectList">
        <ul>
            <?php
            $servername = "localhost";
            $username = "username";
            $password = "password";
            $dbname = "projectDB";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $field = $_SESSION['sort']['field'];
            $order = $_SESSION['sort']['order'];
            $orderBy = "ORDER BY " . ($field == 'rating' ? "AVG(r.rating)" : "p.created_at") . " $order";

            $sql = "SELECT p.id, p.title, p.created_at, AVG(r.rating) AS average_rating
                    FROM projects p
                    LEFT JOIN ratings r ON p.id = r.project_id
                    GROUP BY p.id, p.title, p.created_at
                    $orderBy";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
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

    <a href="post_form.php" id="postButton" class="sortButton">投稿する</a>

    <script>
        function deleteProject(id) {
            if (confirm("本当に削除しますか？")) {
                window.location.href = "delete.php?id=" + id;
            }
        }
    </script>
</body>
</html>
