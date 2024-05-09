<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿詳細</title>
    <style>
        /* ボタンのスタイル */
        .returnButton {
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
        .replyButton {
            position: fixed;
            bottom: 20px;
            left: 20px;
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
        .replyForm {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        .replyForm textarea {
            width: 100%;
            height: 100px;
            resize: none;
            margin-bottom: 10px;
        }
        .replyForm button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .replyList {
            margin-top: 20px;
        }
        .replyList ul {
            list-style-type: none;
            padding: 0;
        }
        .replyList li {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .deleteButton {
            background-color: red;
        }
    </style>
</head>
<body>
    <h1>投稿詳細</h1>
    <?php
    // データベース接続
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "projectDB";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // 接続エラーの確認
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // URLパラメータから投稿IDを取得
    $id = $_GET['id'];

    // 該当の投稿をデータベースから取得
    $sql = "SELECT * FROM projects WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false || $result->num_rows === 0) {
        echo "投稿が見つかりませんでした";
    } else {
        $row = $result->fetch_assoc();
        echo "<h1>" . $row["title"] . "</h1>";
        echo "<p>投稿日時: " . $row["created_at"] . "</p>";
        echo "<p>プログラムコード:</p>";
        echo "<pre>" . $row["code"] . "</pre>";
        echo "<p>作品の説明:</p>";
        echo "<p>" . $row["description"] . "</p>";

        echo '<div>評価: ';
        for ($i = 1; $i <= 5; $i++) {
            echo "<label><input type='radio' name='rating' value='$i'/> $i </label>";
        }
        echo '<button onclick="submitRating()">評価送信</button>';
        echo '</div>';

        // 返信一覧を取得して表示
        $sql = "SELECT * FROM replies WHERE project_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $replies = $stmt->get_result();

        echo "<div class='replyList'>";
        if ($replies->num_rows > 0) {
            echo "<h2>返信一覧</h2>";
            echo "<ul>";
            while ($reply = $replies->fetch_assoc()) {
                echo "<li>" . $reply["content"] . " <button class='deleteButton' onclick='deleteReply(" . $reply["id"] . ")'>削除</button></li>";
            }
            echo "</ul>";
        } else {
            echo "<p>返信はありません</p>";
        }
        echo "</div>";
    }
   
    $conn->close();
    ?>

    <!-- ホームに戻るボタン -->
    <button class="returnButton" onclick="returnHome()">ホームに戻る</button>

    <!-- 返信フォーム -->
    <div class="replyForm" id="replyForm">
        <textarea id="replyContent" placeholder="返信内容を入力してください"></textarea>
        <button onclick="submitReply()">返信する</button>
    </div>

    <!-- 返信ボタン -->
    <button class="replyButton" onclick="openReplyForm()">返信する</button>

    <!-- JavaScript -->
    <script>
        function returnHome() {
            window.location.href = "index.php";
        }

        function submitRating() {
            var radios = document.getElementsByName('rating');
            var ratingValue;
            for (var i = 0; i < radios.length; i++) {
                if (radios[i].checked) {
                    ratingValue = radios[i].value;
                    break;
                }
            }
            if (ratingValue) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "submit_rating.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onload = function () {
                    if (this.status == 200) {
                        console.log('Rating submitted successfully');
                    }
                }
                xhr.send("id=<?php echo $id; ?>&rating=" + ratingValue);
            }
        }

        function openReplyForm() {
            document.getElementById('replyForm').style.display = 'block';
        }

        function submitReply() {
            var content = document.getElementById('replyContent').value;
            if (content.trim() !== "") {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "submit_reply.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onload = function () {
                    if (this.status == 200) {
                        console.log('Reply submitted successfully');
                        // ページをリロードして返信を表示
                        location.reload();
                    }
                }
                xhr.send("id=<?php echo $id; ?>&content=" + encodeURIComponent(content));
            }
        }

        function deleteReply(replyId) {
            if (confirm("本当に削除しますか？")) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "delete_reply.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onload = function () {
                    if (this.status == 200) {
                        console.log('Reply deleted successfully');
                        // ページをリロードして返信を更新
                        location.reload();
                    }
                }
                xhr.send("replyId=" + replyId);
            }
        }
    </script>
</body>
</html>
