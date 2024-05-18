<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification KD-info</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="\PBI1-B-Humble\KD-infoApp\public\Components\static\AppIcon\KD-info2.png">
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            background-color: #333; /* ダークグレーの背景色 */
            color: #f1f1f1; /* 明るいグレーテキスト */
            margin: 0;
            padding: 20px;
        }

        .notification-list {
            max-width: 600px;
            margin: 20px auto;
            background-color: #222; /* より暗いグレー */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* 影を強調 */
        }

        .notification-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #444; /* アイテム間の境界線を暗く */
        }

        .user-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 20px;
        }

        .notification-content {
            flex-grow: 1;
        }

        .notification-content p {
            margin: 0;
            font-size: 16px;
            line-height: 1.5;
        }

        .timestamp {
            color: #999; /* 時刻表示を灰色に */
            font-size: 14px;
        }
    </style>
</head>
<body>
    <?php
        session_start(); // セッションを開始または継続
        include '..\Components\src\renderHeader.php';
        renderHeader('search'); // または 'question' などのアクティブページを指定
    ?>
    <h1 class="text-white">通知一覧表示画面 工数が未知数のためSPRINT#4で実装するか捨てるか決断します。</h1>
    <div class="notification-list">
        <div class="notification-item">
            <img src="https://via.placeholder.com/50" alt="User Icon" class="user-icon">
            <div class="notification-content">
                <p><strong>@username1</strong> があなたの投稿にコメントしました。</p>
                <p class="timestamp">1分前</p>
            </div>
        </div>
        <div class="notification-item">
            <img src="https://via.placeholder.com/50" alt="User Icon" class="user-icon">
            <div class="notification-content">
                <p><strong>@username2</strong> があなたの質問に回答しました。</p>
                <p class="timestamp">10分前</p>
            </div>
        </div>
        <div class="notification-item">
            <img src="https://via.placeholder.com/50" alt="User Icon" class="user-icon">
            <div class="notification-content">
                <p><strong>@username3</strong> があなたの投稿にコメントしました。</p>
                <p class="timestamp">20分前</p>
            </div>
        </div>
        <div class="notification-item">
            <img src="https://via.placeholder.com/50" alt="User Icon" class="user-icon">
            <div class="notification-content">
                <p><strong>@username4</strong> があなたの質問に回答しました。</p
                <p class="timestamp">30分前</p>
            </div>
        </div>
        <div class="notification-item">
            <img src="https://via.placeholder.com/50" alt="User Icon" class="user-icon">
            <div class="notification-content">
                <p><strong>@username5</strong> があなたの回答にいいねしました。</p>
                <p class="timestamp">40分前</p>
            </div>
        </div>
        <div class="notification-item">
            <img src="https://via.placeholder.com/50" alt="User Icon" class="user-icon">
            <div class="notification-content">
                <p><strong>@username6</strong> があなたの投稿にいいねしました。</p>
                <p class="timestamp">50分前</p>
            </div>
        </div>
    </div>
</body>
</html>
