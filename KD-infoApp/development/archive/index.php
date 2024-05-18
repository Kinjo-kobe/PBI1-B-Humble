<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロジェクトホーム</title>
    <style>
        .post {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .post .title {
            flex: 1;
            margin-right: 20px;
            font-size: 18px;
        }
        .post .title a {
            text-decoration: none;
            color: #1a0dab;
        }
        .post .title a:hover {
            text-decoration: underline;
        }
        .post .info {
            flex: 3;
            font-size: 14px;
        }
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
        .sortButton.desc:after {
            content: "▲";
        }
        .sortButton.asc:after {
            content: "▼";
        }
        .sortButton.asc {
            background-color: #ff0000;
        }
        #searchBar {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>
    <div id="searchBar">
        <input type="text" id="searchInput" placeholder="投稿を検索..." oninput="filterPosts(this.value)">
    </div>

    <?php
    session_start();

    // headerインポート
    include '..\Components\src\renderHeader.php';
    renderHeader('posting'); // または 'question' などのアクティブページを指定

    // ソート状態と言語フィルタの管理
    if (!isset($_SESSION['sort'])) {
        $_SESSION['sort'] = ['field' => 'date', 'order' => 'desc'];
    }
    if (!isset($_SESSION['filter_language'])) {
        $_SESSION['filter_language'] = '';
    }
    if (isset($_GET['change_sort'])) {
        if ($_SESSION['sort']['field'] == $_GET['change_sort']) {
            $_SESSION['sort']['order'] = $_SESSION['sort']['order'] == 'desc' ? 'asc' : 'desc';
        } else {
            $_SESSION['sort'] = ['field' => $_GET['change_sort'], 'order' => 'desc'];
        }
    }
    if (isset($_GET['language'])) {
        $_SESSION['filter_language'] = $_GET['language'];
    }
    ?>

    <h1>投稿作品一覧</h1>
    <div style="text-align: right; padding-bottom: 10px;">
        <select onchange="window.location.href='?language='+this.value">
            <option value="">すべての言語</option>
            <option value="C" <?php echo $_SESSION['filter_language'] == 'C' ? 'selected' : ''; ?>>C</option>
            <option value="C++" <?php echo $_SESSION['filter_language'] == 'C++' ? 'selected' : ''; ?>>C++</option>
            <option value="Java" <?php echo $_SESSION['filter_language'] == 'Java' ? 'selected' : ''; ?>>Java</option>
            <option value="Python" <?php echo $_SESSION['filter_language'] == 'Python' ? 'selected' : ''; ?>>Python</option>
            <option value="JavaScript" <?php echo $_SESSION['filter_language'] == 'JavaScript' ? 'selected' : ''; ?>>JavaScript</option>
            <option value="HTML" <?php echo $_SESSION['filter_language'] == 'HTML' ? 'selected' : ''; ?>>HTML</option>
            <option value="CSS" <?php echo $_SESSION['filter_language'] == 'CSS' ? 'selected' : ''; ?>>CSS</option>
            <option value="PHP" <?php echo $_SESSION['filter_language'] == 'PHP' ? 'selected' : ''; ?>>PHP</option>
            <option value="Ruby" <?php echo $_SESSION['filter_language'] == 'Ruby' ? 'selected' : ''; ?>>Ruby</option>
            <option value="Swift" <?php echo $_SESSION['filter_language'] == 'Swift' ? 'selected' : ''; ?>>Swift</option>
            <option value="Kotlin" <?php echo $_SESSION['filter_language'] == 'Kotlin' ? 'selected' : ''; ?>>Kotlin</option>
            <option value="Go" <?php echo $_SESSION['filter_language'] == 'Go' ? 'selected' : ''; ?>>Go</option>
            <option value="Rust" <?php echo $_SESSION['filter_language'] == 'Rust' ? 'selected' : ''; ?>>Rust</option>
            <option value="TypeScript" <?php echo $_SESSION['filter_language'] == 'TypeScript' ? 'selected' : ''; ?>>TypeScript</option>
            <option value="SQL" <?php echo $_SESSION['filter_language'] == 'SQL' ? 'selected' : ''; ?>>SQL</option>
            <option value="Perl" <?php echo $_SESSION['filter_language'] == 'Perl' ? 'selected' : ''; ?>>Perl</option>
            <option value="Scala" <?php echo $_SESSION['filter_language'] == 'Scala' ? 'selected' : ''; ?>>Scala</option>
            <option value="Haskell" <?php echo $_SESSION['filter_language'] == 'Haskell' ? 'selected' : ''; ?>>Haskell</option>
            <option value="Erlang" <?php echo $_SESSION['filter_language'] == 'Erlang' ? 'selected' : ''; ?>>Erlang</option>
            <option value="Lua" <?php echo $_SESSION['filter_language'] == 'Lua' ? 'selected' : ''; ?>>Lua</option>
        </select>
        <a href="?change_sort=rating" class="sortButton <?php echo ($_SESSION['sort']['field'] == 'rating' ? $_SESSION['sort']['order'] : 'desc'); ?>">評価順切替</a>
        <a href="?change_sort=date" class="sortButton <?php echo ($_SESSION['sort']['field'] == 'date' ? $_SESSION['sort']['order'] : 'desc'); ?>">更新日切替</a>
    </div>
    <div id="projectList">
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
        $languageFilter = $_SESSION['filter_language'];
        $languageCondition = $languageFilter ? "WHERE p.language = '$languageFilter'" : '';

        $orderBy = "ORDER BY " . ($field == 'rating' ? "AVG(r.rating)" : "p.created_at") . " $order";

        $sql = "SELECT p.id, LEFT(p.title, 30) AS title, p.created_at, AVG(r.rating) AS average_rating, p.language
                FROM projects p
                LEFT JOIN ratings r ON p.id = r.project_id
                $languageCondition
                GROUP BY p.id, p.title, p.created_at, p.language
                $orderBy";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='post'>";
                echo "<div class='title'><a href='detail.php?id=" . $row["id"] . "'>" . $row["title"];
                if (strlen($row["title"]) > 30) {
                    echo "...";
                }
                echo "</a></div>";
                echo "<div class='info'>";
                echo "使用言語: " . $row["language"] . "<br>";
                echo "投稿日時: " . $row["created_at"] . "<br>";
                if ($row["average_rating"] !== null) {
                    echo "評価: " . number_format($row["average_rating"], 1) . "<br>";
                }
                echo "<button class='deleteButton' onclick='deleteProject(" . $row["id"] . ")'>削除</button>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>投稿がありません</p>";
        }

        $conn->close();
        ?>
    </div>

    <a href="post_form.php" id="postButton" class="sortButton">投稿する</a>

    <script>
        function deleteProject(id) {
            if (confirm("本当に削除しますか？")) {
                window.location.href = "delete.php?id=" + id;
            }
        }

        function filterPosts(searchTerm) {
            var posts = document.querySelectorAll('.post');
            for (var i = 0; i < posts.length; i++) {
                var title = posts[i].querySelector('.title').textContent.toLowerCase();
                if (title.includes(searchTerm.toLowerCase())) {
                    posts[i].style.display = 'flex';
                } else {
                    posts[i].style.display = 'none';
                }
            }
        }
    </script>
</body>
</html>
