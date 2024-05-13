<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Question - KD-info</title>
    <!-- TailwindCSSに必要なリンク -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome CSSを追加 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- タブのアイコン設定(相対パスは非表示になるバグがあるので絶対パスで指定中) -->
    <link rel="icon" type="image/png" href="\PBI1-B-Humble\KD-infoApp\public\Components\static\AppIcon\KD-info2.png">

    <style>
        body {
            background-color: #333;
        }
    </style>
</head>
<body class="bg-gray-800 text-white">
    <div class="container mx-auto px-4 py-4">
        <h1 class="text-2xl font-bold mb-4">Post a New Question</h1>
        <form action="submitQuestion.php" method="POST" class="bg-gray-700 p-4 rounded-lg">
            <div class="mb-4">
                <label for="title" class="block text-sm font-bold mb-2">Title:</label>
                <input type="text" name="title" id="title" required class="w-full p-2 rounded text-gray-900" placeholder="Enter the title">
            </div>
            <div class="mb-6">
                <label for="text" class="block text-sm font-bold mb-2">Question:</label>
                <textarea name="text" id="text" required class="w-full p-2 rounded text-gray-900" placeholder="Describe your question"></textarea>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Submit Question
            </button>
        </form>
    </div>
</body>
</html>
