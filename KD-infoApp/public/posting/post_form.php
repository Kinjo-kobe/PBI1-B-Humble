<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プログラム作品投稿フォーム</title>
</head>
<body>
    <h1>プログラム作品投稿フォーム</h1>
    <form action="submit.php" method="post">
        <label for="title">作品の題名:</label><br>
        <input type="text" id="title" name="title" required><br><br>
        
        <label for="code">プログラムコード:</label><br>
        <textarea id="code" name="code" rows="10" required></textarea><br><br>
        
        <label for="description">作品の説明:</label><br>
        <textarea id="description" name="description" rows="5" required></textarea><br><br>
        
        <label for="language">使用言語:</label><br>
        <select id="language" name="language">
            <option value="C">C</option>
            <option value="C++">C++</option>
            <option value="Java">Java</option>
            <option value="Python">Python</option>
            <option value="JavaScript">JavaScript</option>
            <option value="HTML">HTML</option>
            <option value="CSS">CSS</option>
            <option value="PHP">PHP</option>
            <option value="Ruby">Ruby</option>
            <option value="Swift">Swift</option>
            <option value="Kotlin">Kotlin</option>
            <option value="Go">Go</option>
            <option value="Rust">Rust</option>
            <!-- 新しく追加する言語オプション -->
            <option value="Scala">Scala</option>
            <option value="Haskell">Haskell</option>
            <option value="Erlang">Erlang</option>
            <option value="Lua">Lua</option>
            <option value="TypeScript">TypeScript</option>
            <option value="Perl">Perl</option>
            <option value="Elixir">Elixir</option>
            <option value="Clojure">Clojure</option>
        </select><br><br>
        
        <input type="submit" value="投稿">
    </form>

    <!-- 投稿一覧ボタン -->
    <form action="index.php">
        <input type="submit" value="投稿一覧" style="position: fixed; bottom: 20px; right: 20px;">
    </form>
</body>
</html>
