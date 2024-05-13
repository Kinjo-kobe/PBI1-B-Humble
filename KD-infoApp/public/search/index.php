<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search KD-info</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="\PBI1-B-Humble\KD-infoApp\public\Components\static\AppIcon\KD-info2.png">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #333;
            color: #ccc;
        }
        .search-bar-container {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
        .search-bar {
            width: 80%;
            padding: 10px 20px;
            border-radius: 20px;
            border: 2px solid #555;
            background-color: #222;
            color: #ddd;
            outline: none;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 20px;
            width: 100%;
            max-width: 1200px;
            margin: auto;
            color: #ccc;
        }
        .icon {
            border: 1px solid #444;
            border-radius: 10px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #222;
            cursor: pointer;
            transition: box-shadow 0.2s;
        }
        .icon:hover {
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.1);
        }
        .icon-placeholder {
            width: 60px;
            height: 60px;
            background-color: #444;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-bottom: 10px;
        }
        .icon-label {
            text-align: center;
        }
        .header-button {
            padding: 6px 12px;
            font-size: 12px;
            background-color: #444;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        #header .header-button, #header a.button {
            max-width: 100px;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <?php
        session_start();
        include '..\Components\src\renderHeader.php';
        renderHeader('search');
    ?>
    <h1>検索画面 SPRINT#4で実装予定</h1>
    <div class="search-bar-container">
        <input type="text" class="search-bar" placeholder="キーワードを入力...">
    </div>
    <div class="grid-container">
        <script>
            const icons = [
                'Python', 'AWS', 'TypeScript', 'React', 'JavaScript', 'Flutter',
                'Next.js', 'Docker', 'Golang', 'Rails', 'Ruby', 'GitHub',
                'Rust', 'PHP', 'iOS', 'Linux', 'Swift', 'Android',
                'Unity', 'Git', 'VS Code', 'Node.js', 'CSS', 'Dart',
                'Azure', 'Laravel', 'Java', 'GCP', 'ChatGPT', 'Firebase'
            ];

            const gridContainer = document.querySelector('.grid-container');

            icons.forEach(icon => {
                const iconElement = document.createElement('div');
                iconElement.classList.add('icon');
                iconElement.innerHTML = `
                    <div class="icon-placeholder"></div>
                    <div class="icon-label">${icon}</div>
                `;
                gridContainer.appendChild(iconElement);
            });
        </script>
    </div>
</body>
</html>
