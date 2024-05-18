<?php
session_start();

// DB connect
$dbname = "prosite";
$servername = "localhost";
$username = "kobe";
$password = "denshi";

$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch questions based on sort order
$sort_order = $_GET['sort'] ?? 'newest'; // Default to newest if not specified
$sort_query = $sort_order === 'newest' ? "ORDER BY question_time DESC" : ($sort_order === 'oldest' ? "ORDER BY question_time ASC" : "ORDER BY question_good DESC");

$stmt = $conn->prepare("SELECT q.*, COUNT(r.reply_id) AS comment_count FROM questions q LEFT JOIN replies r ON q.question_id = r.question_id GROUP BY q.question_id $sort_query");
$stmt->execute();
$questions = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- タブのタイトル -->
    <title>Questions KD-info</title>
    <!-- TailwindCSSに必要なリンク -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome CSSを追加 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- タブのアイコン設定(相対パスは非表示になるバグがあるので絶対パスで指定中) -->
    <link rel="icon" type="image/png" href="\PBI1-B-Humble\KD-infoApp\public\Components\static\AppIcon\KD-info2.png">
    <style>
        body { background-color: #111; }
    </style>
</head>

<?php
    // ヘッダーのインポート
    include '../Components/src/renderHeader.php';
    renderHeader('question');
?>

<body>
    <div class="container mx-auto pt-5 pl-40 pr-40">
        <div id="searchBar" class="flex justify-center pb-1">
            <input type="text" id="searchInput" placeholder="質問を検索..." oninput="filterQuestions()" class="form-input block w-full px-4 py-2 text-black bg-gray-800 text-gray-300 border-gray-700 focus:border-gray-500 rounded">
        </div>

        <h1 class="pb-3 text-white text-xl pt-6">質問一覧</h1>
        <div id="questionsContainer">
            <?php foreach ($questions as $question): ?>
                <div class="question-item w-full text-left text-white p-4 mb-3 rounded bg-gray-800" data-title="<?php echo strtolower(htmlspecialchars($question['question_title'])); ?>" data-text="<?php echo strtolower(htmlspecialchars($question['question_text'])); ?>">
                    <h2 class="font-bold"><?php echo htmlspecialchars($question['question_title']); ?></h2>
                    <p><?php echo htmlspecialchars($question['question_text']); ?></p>
                    <span class="text-sm">質問日: <?php echo date('Y-m-d', strtotime($question['question_time'])); ?></span>
                    <span> | いいね: <?php echo $question['question_good'] ?: 0; ?></span>
                    <span> | 回答: <?php echo $question['comment_count'] ?: 0; ?>件</span>
                </div>
            <?php endforeach; ?>
        </div>
        <a href="questionSubmit.php" class="fixed bottom-10 right-10 bg-gray-500 text-white pr-10 pl-10 pb-2 pt-2 rounded text-lg">
            <i class="fa fa-plus"></i>
        </a>
    </div>

    <script>
        function filterQuestions() {
            let input = document.getElementById('searchInput').value.toLowerCase();
            let questionItems = document.querySelectorAll('.question-item');

            questionItems.forEach(item => {
                let title = item.getAttribute('data-title');
                let text = item.getAttribute('data-text');
                if (title.includes(input) || text.includes(input)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>

</body>
</html>
