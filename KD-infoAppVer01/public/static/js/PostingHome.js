var activeTab = 'Question'; // デフォルトアクティブタブ

function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
    activeTab = tabName; // 現在アクティブなタブを更新

    // プロフィールタブの場合はポップアップボタンを非表示にする
    document.getElementById('openPopup').style.display = activeTab === 'Profile' ? 'none' : 'block';
}

document.getElementById('openPopup').onclick = function () {
    var header = '';
    var placeholderText = '';
    if (activeTab === 'Question') {
        header = '質問内容を入力してください';
        placeholderText = '質問をここに入力...';
    } else if (activeTab === 'Post') {
        header = '投稿内容を入力してください';
        placeholderText = '投稿をここに入力...';
    } else {
        header = 'お問い合わせ内容を入力してください';
        placeholderText = 'お問い合わせ内容をここに入力...';
    }
    document.getElementById('popupFormHeader').innerHTML = header;
    document.getElementById('popupFormTextarea').placeholder = placeholderText;
    document.getElementById('popupForm').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
};

document.querySelector('.close').onclick = function () {
    hidePopup();
};

document.getElementById('overlay').onclick = function (event) {
    if (event.target === document.getElementById('overlay')) {
        hidePopup();
    }
};

function hidePopup() {
    document.getElementById('popupForm').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
}

function submitForm(event) {
    event.preventDefault(); // フォームのデフォルト送信を防止

    // テキスト内容を取得
    const textArea = document.getElementById('popupFormTextarea');
    const text = textArea.value.trim();
    const contentDiv = document.getElementById(activeTab);

    // 新しいコンテンツ要素を生成してコンテンツに追加
    const newContent = document.createElement('div');
    newContent.classList.add('content-item'); // 新しいコンテンツ要素にクラスを追加

    // テキストが入力されていれば追加
    if (text !== '') {
        const textElement = document.createElement('p');
        textElement.textContent = text;
        newContent.appendChild(textElement);
        textArea.value = ''; // テキストエリアをクリア
    }

    // 画像が選択されていれば追加
    const container = document.getElementById('imagePreviewContainer');
    if (container.children.length > 0) {
        const image = container.children[0].cloneNode(true);
        newContent.appendChild(image);
        container.innerHTML = ''; // プレビューコンテナをクリア
    }

    // 返信ボタンと削除ボタンを追加
    addButtonsToPopupContent(newContent);

    // 新しいコンテンツ要素をコンテンツに追加
    contentDiv.appendChild(newContent);

    hidePopup(); // ポップアップを閉じる
}

function previewImage(event) {
    const [file] = event.target.files;
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.maxWidth = '100%'; // プレビュー画像の最大幅を設定
            const container = document.getElementById('imagePreviewContainer');
            container.innerHTML = ''; // 既存のプレビューをクリア
            container.appendChild(img); // 新しい画像をコンテナに追加
        };
        reader.readAsDataURL(file);
    } else {
        alert('画像ファイルを選択してください。');
    }
}

// ポップアップから送信された内容に返信ボタンと削除ボタンを追加する
function addButtonsToPopupContent(contentDiv) {
    // 返信ボタンを追加
    const replyButton = document.createElement('button');
    replyButton.textContent = '返信';
    replyButton.classList.add('reply-button');
    replyButton.addEventListener('click', function () {
        const replyPopup = document.createElement('div');
        replyPopup.classList.add('reply-popup');

        const closeBtn = document.createElement('span');
        closeBtn.classList.add('close');
        closeBtn.innerHTML = '&times;';
        closeBtn.addEventListener('click', function () {
            replyPopup.style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        });

        const replyForm = document.createElement('form');
        replyForm.classList.add('reply-form');
        replyForm.onsubmit = function (event) {
            event.preventDefault(); // フォームのデフォルト送信を防止
            const textArea = replyForm.querySelector('.reply-textarea');
            const text = textArea.value.trim();
            if (text === '') {
                alert('返信内容を入力してください。');
                return;
            }

            const replyContentDiv = document.createElement('div');
            replyContentDiv.classList.add('reply-content');
            replyContentDiv.textContent = text;

            const closeReplyButton = document.createElement('button');
            closeReplyButton.textContent = '閉じる';
            closeReplyButton.addEventListener('click', function () {
                replyContentDiv.remove();
            });
            replyContentDiv.appendChild(closeReplyButton);

            contentDiv.appendChild(replyContentDiv);
            textArea.value = '';
            replyPopup.style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        };

        const replyTextarea = document.createElement('textarea');
        replyTextarea.classList.add('reply-textarea');
        replyTextarea.placeholder = '返信内容を入力してください...';

        const submitBtn = document.createElement('input');
        submitBtn.type = 'submit';
        submitBtn.value = '送信';

        replyForm.appendChild(replyTextarea);
        replyForm.appendChild(submitBtn);

        replyPopup.appendChild(closeBtn);
        replyPopup.appendChild(replyForm);

        document.getElementById('overlay').style.display = 'block';
        document.body.appendChild(replyPopup); // ポップアップフォームをbody要素に追加
        replyPopup.style.display = 'block';
    });
    contentDiv.appendChild(replyButton);

    // 削除ボタンを追加
    const deleteButton = document.createElement('button');
    deleteButton.textContent = '削除';
    deleteButton.classList.add('delete-button');
    deleteButton.addEventListener('click', function () {
        const contentToRemove = deleteButton.parentElement;
        contentToRemove.remove(); // 親要素を削除
    });
    contentDiv.appendChild(deleteButton);
}

// 検索バーに機能を追加する
function filterResults() {
    const searchBar = document.getElementById('searchBar');
    const searchText = searchBar.value.trim().toLowerCase();

    const tabContent = document.getElementById(activeTab);
    const contentItems = tabContent.getElementsByClassName('content-item');

    for (let item of contentItems) {
        const textElement = item.querySelector('p');
        if (textElement) {
            const text = textElement.textContent.toLowerCase();
            if (text.includes(searchText)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        }
    }
}

// ログアウト機能
function logout() {
    // ログアウトの処理をここに記述する
    // 例: ローカルストレージからユーザーデータを削除し、ログインページにリダイレクトする
    localStorage.removeItem('userData'); // 仮の例。実際の処理はシステムに応じて変わります。
    window.location.href = 'pages/Login.html'; // ログインページにリダイレクトする
}

