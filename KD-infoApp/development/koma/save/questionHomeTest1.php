<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions Home - KD-info</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-800 text-white">
    <div class="container mx-auto px-4 py-4">
        <h1 class="text-2xl font-bold mb-4">Questions List</h1>
        <?php
        // Database connection settings
        $servername = "localhost";
        $username = "kobe";
        $password = "denshi";
        $dbname = "prosite";
        $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8";

        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM questions ORDER BY question_time DESC";
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                foreach ($results as $result) {
                    echo "<div class='bg-gray-700 p-4 rounded-lg mb-3'>";
                    echo "<h3 class='font-semibold'>" . htmlspecialchars($result['question_title']) . "</h3>";
                    echo "<p>" . htmlspecialchars($result['question_text']) . "</p>";
                    echo "<small>Posted on: " . date('Y-m-d', strtotime($result['question_time'])) . "</small>";
                    echo "</div>";
                }
            } else {
                echo "<p>No questions found.</p>";
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        $pdo = null;
        ?>
        <button onclick="window.location.href='questionPost.php'" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded fixed bottom-4 right-4">
            質問を作成する
        </button>
    </div>
</body>
</html>
