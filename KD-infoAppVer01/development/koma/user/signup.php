<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #333;
        }

        .modal-content {
            background-color: #222;
            color: #fff;
            border: 1px solid #444;
        }

        .input-field input {
            background-color: #333;
            color: #ccc;
            border-color: #555;
        }

        .input-field input:focus {
            border-color: #777;
            outline: none;
        }
    </style>
</head>

<body class="flex justify-center items-center h-screen">
    <div class="modal-content p-8 rounded-lg w-96">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="space-y-4">
            <h1 class="text-lg font-bold text-center mb-4">Sign up</h1>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $servername = "localhost";
                    $username = "kobe";
                    $password = "denshi";
                    $dbname = "prosite";

                    // ユーザーからの入力を取得
                    $input_username = $_POST["username"];
                    $input_password = $_POST["password"];
                    $input_email = $_POST["email"];

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $stmt = $conn->prepare("INSERT INTO users (user_name, user_pass, email) VALUES (:username, :password, :email)");
                        $stmt->bindParam(':username', $input_username);
                        $stmt->bindParam(':password', $input_password);
                        $stmt->bindParam(':email', $input_email);
                        $stmt->execute();
                        echo "<p class='text-green-500'>ユーザー登録が成功しました。</p>";
                    } catch (PDOException $e) {
                        echo "<p class='text-red-500'>エラー: " . $e->getMessage() . "</p>";
                    }
                }
            ?>
            <div class="input-field">
                <input type="text" id="username" name="username" placeholder="ユーザー名" required class="mt-1 block w-full px-3 py-2 rounded-md">
            </div>
            <!-- <div class="input-field">
                <input type="email" id="email" name="email" placeholder="メールアドレス" required class="mt-1 block w-full px-3 py-2 rounded-md">
            </div> -->
            <div class="input-field">
                <input type="password" id="password" name="password" placeholder="パスワード" required class="mt-1 block w-full px-3 py-2 rounded-md">
            </div>
            <div class="input-field">
                <input type="password" id="password" name="password" placeholder="パスワード確認" required class="mt-1 block w-full px-3 py-2 rounded-md">
            </div>
            <button type="submit" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 w-full rounded focus:outline-none focus:shadow-outline">新規登録</button>
            <p class="text-xs text-gray-400 mt-3">すでにアカウントをお持ちですか？ <a href="login.php" class="text-red-500 hover:text-red-700">ログインはこちら</a></p>
        </form>
    </div>

    <!-- JavaScript for Modal, etc -->
    <script>
        // Add necessary JavaScript if needed
    </script>
</body>

</html>
