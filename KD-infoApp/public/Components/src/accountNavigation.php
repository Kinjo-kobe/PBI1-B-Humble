<?php
ob_start(); // バッファリングを開始
// ここから既存のコードを追加
?>

<div class="relative text-white">
    <button id="account-btn" class="bg-gray-800 text-white p-2 rounded-full">Account</button>
    <!-- <div id="account-menu" class="hidden absolute right-0 w-48 bg-gray-900 border border-gray-400 rounded-lg"> -->
    <div id="account-menu" class="hidden absolute right-0 w-48 border border-gray-400 rounded-lg" style="background-color: #111;"> <!-- 背景色を変更 -->
        <div class="p-2"><?php echo $_SESSION['session_user_name'] ?? 'Guest'; ?></div>
        <a href="../myProfile/index.php" class="block p-2 border-b border-gray-400">My Profile</a>
        <a href="../setting/index.php" class="block p-2 border-b border-gray-400">Settings</a>
        <a href="#" id="logout-btn" class="block p-2">Logout</a> <!-- ログアウトボタンのIDを追加 -->
    </div>
</div>

<!-- ログアウト用モーダル -->
<div id="logout-modal" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-gray-900 flex justify-center items-center hidden"> <!-- 背景色を変更 -->
    <div class="bg-gray-333 p-16 rounded-lg text-white text-2xl text-center border border-#444"> <!-- 背景色を変更 -->
        <p class="text-3xl mb-6">ログアウトしてもよろしいでしょうか？</p>
        <div class="flex justify-center"> <!-- justify-center に変更 -->
            <button id="logout-confirm" class="bg-red-500 text-white px-6 py-2 rounded mr-2">Yes</button>
            <button id="logout-cancel" class="bg-gray-700 text-gray-200 px-6 py-2 rounded">No</button> <!-- 背景色を変更 -->
        </div>
    </div>
</div>

<script>
    document.getElementById('account-btn').addEventListener('click', function() {
        var menu = document.getElementById('account-menu');
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    });

    window.addEventListener('click', function(e) {
        if (!document.getElementById('account-btn').contains(e.target)) {
            document.getElementById('account-menu').style.display = 'none';
        }
    });

    // ログアウトボタンをクリックしたときの処理
    document.getElementById('logout-btn').addEventListener('click', function(e) {
        e.preventDefault(); // リンクのデフォルト動作をキャンセル

        // モーダルを表示
        document.getElementById('logout-modal').style.display = 'flex';
    });

    // ログアウト確認モーダル内のキャンセルボタンをクリックしたときの処理
    document.getElementById('logout-cancel').addEventListener('click', function() {
        // モーダルを非表示
        document.getElementById('logout-modal').style.display = 'none';
    });

    // ログアウト確認モーダル内の確認ボタンをクリックしたときの処理
    document.getElementById('logout-confirm').addEventListener('click', function() {
        // ログアウト処理を実行（仮の処理）
        window.location.href = '../user/logout.php';
    });
</script>