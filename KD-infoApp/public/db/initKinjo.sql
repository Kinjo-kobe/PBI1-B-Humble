# クライアントから送信される文字コードをutf8に設定
set names utf8;
# もし「projectdb」というデータベースが存在すれば削除
drop database if exists projectdb;
# もし「username'@'localhost」が存在すれば削除
DROP USER IF EXISTS 'username'@'localhost';
# ユーザー「username」にパスワード「password」を設定し、データベース「projectdb」に対する全ての権限を付与
CREATE USER 'username'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON projectdb.* TO 'username'@'localhost';
# 権限を即時に反映
FLUSH PRIVILEGES;
# projectdbというデータベースを作成
create database projectdb character set utf8 collate utf8_general_ci;
# データベース「projectdb」を使用
use projectdb;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2024-05-16 12:04:02
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `projectdb`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_title` varchar(100) NOT NULL,
  `post_text` varchar(1000) NOT NULL,
  `post_good` int(3) DEFAULT NULL,
  `post_code` text DEFAULT NULL,
  `post_image_name` varchar(100) DEFAULT NULL,
  `post_image` mediumblob DEFAULT NULL,
  `post_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `code` text NOT NULL,
  `description` text NOT NULL,
  `language` varchar(50) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `projects`
--

INSERT INTO `projects` (`id`, `title`, `code`, `description`, `language`, `image_name`, `created_at`, `image`) VALUES
(68, '計算機プログラム', '#include <stdio.h>\r\n\r\nint main() {\r\n    char operator;\r\n    double num1, num2, result;\r\n\r\n    printf(\"演算子を入力してください(+, -, *, /): \");\r\n    scanf(\"%c\", &operator);\r\n\r\n    printf(\"2つの数値を入力してください: \");\r\n    scanf(\"%lf %lf\", &num1, &num2);\r\n\r\n    switch(operator) {\r\n        case \'+\':\r\n            result = num1 + num2;\r\n            break;\r\n        case \'-\':\r\n            result = num1 - num2;\r\n            break;\r\n        case \'*\':\r\n            result = num1 * num2;\r\n            break;\r\n        case \'/\':\r\n            if (num2 != 0) {\r\n                result = num1 / num2;\r\n            } else {\r\n                printf(\"エラー: 0で割ることはできません。\\n\");\r\n                return 1; // エラーコード1を返してプログラムを終了\r\n            }\r\n            break;\r\n        default:\r\n            printf(\"無効な演算子です。\\n\");\r\n            return 1; // エラーコード1を返してプログラムを終了\r\n    }\r\n\r\n    printf(\"結果: %lf\\n\", result);\r\n    \r\n    return 0; // プログラムの正常終了\r\n}\r\n', 'このプログラムは、ユーザーに演算子（+、-、*、/）を入力し、その後に2つの数値を入力してもらいます。次に、指定された演算を実行して結果を表示します。0で割るエラーが発生した場合はエラーメッセージを表示し、プログラムを終了します。', 'C', '', '2024-05-13 02:20:21', NULL),
(69, '簡単なユーザー入力を扱うプログラム', 'import java.util.Scanner;\r\n\r\npublic class Calculator {\r\n    public static void main(String[] args) {\r\n        Scanner scanner = new Scanner(System.in);\r\n\r\n        System.out.print(\"演算子を入力してください(+, -, *, /): \");\r\n        char operator = scanner.next().charAt(0);\r\n\r\n        System.out.print(\"2つの数値を入力してください: \");\r\n        double num1 = scanner.nextDouble();\r\n        double num2 = scanner.nextDouble();\r\n\r\n        double result = 0.0;\r\n\r\n        switch (operator) {\r\n            case \'+\':\r\n                result = num1 + num2;\r\n                break;\r\n            case \'-\':\r\n                result = num1 - num2;\r\n                break;\r\n            case \'*\':\r\n                result = num1 * num2;\r\n                break;\r\n            case \'/\':\r\n                if (num2 != 0) {\r\n                    result = num1 / num2;\r\n                } else {\r\n                    System.out.println(\"エラー: 0で割ることはできません。\");\r\n                    return; // プログラムを終了\r\n                }\r\n                break;\r\n            default:\r\n                System.out.println(\"無効な演算子です。\");\r\n                return; // プログラムを終了\r\n        }\r\n\r\n        System.out.println(\"結果: \" + result);\r\n    }\r\n}\r\n', 'このプログラムは、ユーザーに演算子（+、-、*、/）を入力し、その後に2つの数値を入力してもらいます。次に、指定された演算を実行して結果を表示します。0で割るエラーが発生した場合はエラーメッセージを表示し、プログラムを終了します。', 'Java', '', '2024-05-13 02:22:11', NULL),
(70, '四則演算を行うプログラム', 'def calculator():\r\n    operator = input(\"演算子を入力してください(+, -, *, /): \")\r\n    num1 = float(input(\"1つ目の数値を入力してください: \"))\r\n    num2 = float(input(\"2つ目の数値を入力してください: \"))\r\n\r\n    if operator == \'+\':\r\n        result = num1 + num2\r\n    elif operator == \'-\':\r\n        result = num1 - num2\r\n    elif operator == \'*\':\r\n        result = num1 * num2\r\n    elif operator == \'/\':\r\n        if num2 != 0:\r\n            result = num1 / num2\r\n        else:\r\n            print(\"エラー: 0で割ることはできません。\")\r\n            return  # プログラムを終了\r\n    else:\r\n        print(\"無効な演算子です。\")\r\n        return  # プログラムを終了\r\n\r\n    print(\"結果:\", result)\r\n\r\ncalculator()\r\n', 'このプログラムは、ユーザーに演算子（+、-、*、/）を入力し、その後に2つの数値を入力してもらいます。次に、指定された演算を実行して結果を表示します。0で割るエラーが発生した場合はエラーメッセージを表示し、プログラムを終了します。', 'Python', '', '2024-05-13 02:23:11', NULL),
(71, '簡単な四則演算を行うプログラム', 'function calculator() {\r\n    let operator = prompt(\"演算子を入力してください(+, -, *, /):\");\r\n    let num1 = parseFloat(prompt(\"1つ目の数値を入力してください:\"));\r\n    let num2 = parseFloat(prompt(\"2つ目の数値を入力してください:\"));\r\n    let result;\r\n\r\n    switch (operator) {\r\n        case \'+\':\r\n            result = num1 + num2;\r\n            break;\r\n        case \'-\':\r\n            result = num1 - num2;\r\n            break;\r\n        case \'*\':\r\n            result = num1 * num2;\r\n            break;\r\n        case \'/\':\r\n            if (num2 !== 0) {\r\n                result = num1 / num2;\r\n            } else {\r\n                alert(\"エラー: 0で割ることはできません。\");\r\n                return; // プログラムを終了\r\n            }\r\n            break;\r\n        default:\r\n            alert(\"無効な演算子です。\");\r\n            return; // プログラムを終了\r\n    }\r\n\r\n    alert(\"結果: \" + result);\r\n}\r\n\r\ncalculator();\r\n', 'このプログラムは、ユーザーに演算子（+、-、*、/）を入力し、その後に2つの数値を入力してもらいます。次に、指定された演算を実行して結果をアラートで表示します。0で割るエラーが発生した場合はエラーメッセージを表示し、プログラムを終了します。', 'JavaScript', '', '2024-05-13 02:24:54', NULL),
(72, '簡単な計算機', '<!DOCTYPE html>\r\n<html lang=\"ja\">\r\n<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>簡単な計算機</title>\r\n</head>\r\n<body>\r\n    <h1>簡単な計算機</h1>\r\n    <p>1つ目の数値: <input type=\"number\" id=\"num1\"></p>\r\n    <p>2つ目の数値: <input type=\"number\" id=\"num2\"></p>\r\n    <p>演算子: <select id=\"operator\">\r\n        <option value=\"add\">＋</option>\r\n        <option value=\"subtract\">－</option>\r\n        <option value=\"multiply\">×</option>\r\n        <option value=\"divide\">÷</option>\r\n    </select></p>\r\n    <button onclick=\"calculate()\">計算する</button>\r\n    <p id=\"result\"></p>\r\n\r\n    <script>\r\n        function calculate() {\r\n            let num1 = parseFloat(document.getElementById(\"num1\").value);\r\n            let num2 = parseFloat(document.getElementById(\"num2\").value);\r\n            let operator = document.getElementById(\"operator\").value;\r\n            let result;\r\n\r\n            switch (operator) {\r\n                case \"add\":\r\n                    result = num1 + num2;\r\n                    break;\r\n                case \"subtract\":\r\n                    result = num1 - num2;\r\n                    break;\r\n                case \"multiply\":\r\n                    result = num1 * num2;\r\n                    break;\r\n                case \"divide\":\r\n                    if (num2 !== 0) {\r\n                        result = num1 / num2;\r\n                    } else {\r\n                        document.getElementById(\"result\").innerText = \"エラー: 0で割ることはできません。\";\r\n                        return; // プログラムを終了\r\n                    }\r\n                    break;\r\n                default:\r\n                    document.getElementById(\"result\").innerText = \"無効な演算子です。\";\r\n                    return; // プログラムを終了\r\n            }\r\n\r\n            document.getElementById(\"result\").innerText = \"結果: \" + result;\r\n        }\r\n    </script>\r\n</body>\r\n</html>\r\n', 'このコードは、HTMLのみを使って簡単な計算機を作成しています。ユーザーは2つの数値を入力し、演算子を選択してから「計算する」ボタンをクリックすると、結果が表示されます', 'HTML', '', '2024-05-13 02:27:08', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_title` varchar(100) NOT NULL,
  `question_text` varchar(1000) NOT NULL,
  `question_good` int(11) DEFAULT 0,
  `question_code` text DEFAULT NULL,
  `question_image_name` varchar(100) DEFAULT NULL,
  `question_image` mediumblob DEFAULT NULL,
  `question_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `ratings`
--

INSERT INTO `ratings` (`id`, `project_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(36, 72, 5, NULL, '2024-05-13 02:28:13', '2024-05-13 02:28:13'),
(37, 69, 4, NULL, '2024-05-13 02:28:25', '2024-05-13 02:28:25'),
(38, 68, 3, NULL, '2024-05-13 02:28:36', '2024-05-13 02:28:36'),
(39, 71, 2, NULL, '2024-05-13 02:28:51', '2024-05-13 02:28:51'),
(40, 70, 1, NULL, '2024-05-13 02:28:55', '2024-05-13 02:28:55'),
(41, 68, 5, NULL, '2024-05-14 00:43:15', '2024-05-14 00:43:15');

-- --------------------------------------------------------

--
-- テーブルの構造 `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `replies`
--

INSERT INTO `replies` (`id`, `project_id`, `content`, `created_at`) VALUES
(42, 72, 'いいね', '2024-05-13 02:27:26'),
(43, 72, 'あああああ', '2024-05-13 02:27:57'),
(44, 72, 'あああああ', '2024-05-13 02:28:01'),
(45, 72, 'あああああああ', '2024-05-13 02:28:05');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_pass` varchar(1000) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `profile_title` varchar(100) DEFAULT NULL,
  `profile_text` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- テーブルのインデックス `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `projects` ADD FULLTEXT KEY `image_name` (`image_name`);

--
-- テーブルのインデックス `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `user_id` (`user_id`);

--
-- テーブルのインデックス `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_address` (`email_address`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- テーブルの AUTO_INCREMENT `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- テーブルの AUTO_INCREMENT `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- テーブルの制約 `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
