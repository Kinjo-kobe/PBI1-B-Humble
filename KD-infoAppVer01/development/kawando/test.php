<?php
// フォームから送信されたデータを受け取り、変数に保存する
$input_text = $_POST['input_text'];
$user_id = $_POST['userId'];
$user_pass = $_POST['userPass'];

// 受け取ったデータを表示する（デモンストレーション用）
echo "入力されたテキスト: " . $input_text;
echo "<br>";
echo "ユーザーID: " . $user_id;
echo "<br>";
echo "パスワード: " . $user_pass;
echo "<br>";
