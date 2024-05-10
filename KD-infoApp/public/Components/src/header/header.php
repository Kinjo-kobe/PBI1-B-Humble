<?php
function renderHeader($activePage) {
    // Determine active tab styles based on the current page
    $postingClass = $activePage == 'posting' ? 'bg-blue-700' : 'text-white';
    $questionClass = $activePage == 'question' ? 'bg-orange-700' : 'text-white';

    // Output the header HTML
    echo <<<HEADER
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KD-info</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        .header {
            background-color: #333;
            border-bottom: 1px solid white; // Adjusted to half the thickness and changed color to black
        }
        .icon {
            font-size: 1.4rem; // Icon size remains as previously adjusted
        }
        .space-x-large {
            margin-right: 40px; // Increased space for icons
        }
        .link-space {
            margin-right: 120px; // Triple space between links
        }
    </style>
</head>
<body>
    <div class="header text-white p-4 flex justify-between items-center">
        <div class="left flex items-center justify-center space-x-4">
            <img src="\PBI1-B-Humble\KD-infoApp\public\Components\static\AppIcon\KD-info2.png" alt="KD-info Logo" class="h-8">
            <h1 class="text-lg">KD-info</h1>
        </div>
        <div class="center flex space-x-4">
            <a href="../posting/index.php" class="$postingClass px-3 py-2 rounded link-space">投稿</a>
            <a href="../question/questionHome.php" class="$questionClass px-3 py-2 rounded">Q&A</a>
        </div>
        <div class="right flex items-center">
            <a href="../search/searchHome.php" class="icon space-x-large"><i class="fas fa-search"></i></a>
            <a href="../notification/Notification.php" class="icon space-x-large"><i class="fas fa-bell"></i></a>
            <a href="#" onclick="togglePopup()" class="icon"><i class="fas fa-user-circle"></i></a>
        </div>
    </div>
    <div id="accountPopup" class="hidden absolute right-0 mt-12 mr-10 bg-gray-700 text-white p-4 rounded">
        <ul>
            <li>ユーザーネーム: {$_SESSION['username']}</li>
            <li><a href="../MyProfile/MyProfile.php">マイプロフィール</a></li>
            <li><a href="../setting/settings.php">設定</a></li>
            <li><a href="logout.php">ログアウト</a></li>
        </ul>
    </div>
    <script>
        function togglePopup() {
            var popup = document.getElementById('accountPopup');
            popup.style.display = popup.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</body>
</html>
HEADER;
}
?>
