var activeTab = 'Question'; // デフォルトアクティブタブ

// グッドボタンのクリック状態を管理するオブジェクト
var goodButtonStates = {};

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

document.getElementById('openPopup').onclick = function() {
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

document.querySelector('.close').onclick = function() {
    hidePopup();
};

document.getElementById('overlay').onclick = function(event) {
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

    // 返信ボタンとグッドボタンを追加
    addButtonsToPopupContent(newContent);

    // 新しいコンテンツ要素をコンテンツに追加
    contentDiv.appendChild(newContent);

    hidePopup(); // ポップアップを閉じる
}

function previewImage(event) {
    const [file] = event.target.files;
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
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

// ポップアップから送信された内容に返信ボタンとグッドボタンを追加する
function addButtonsToPopupContent(contentDiv) {
    const replyButton = document.createElement('button');
    replyButton.textContent = '返信';
    replyButton.classList.add('reply-button');
    replyButton.onclick = function() {
        openReplyPopup(contentDiv);
    };
    contentDiv.appendChild(replyButton);

    const goodButton = document.createElement('button');
    goodButton.textContent = 'グッド';
    goodButton.classList.add('good-button');
    goodButton.onclick = function() {
        toggleGoodButtonState(activeTab);
        updateGoodButtonStyle(goodButton, activeTab);
    };
    contentDiv.appendChild(goodButton);

    const deleteButton = document.createElement('button');
    deleteButton.textContent = '削除';
    deleteButton.classList.add('delete-button');
    deleteButton.onclick = function() {
        contentDiv.remove();
    };
    contentDiv.appendChild(deleteButton);
}
// 返信ポップアップを開く
function openReplyPopup(contentDiv) {
    const overlay = document.getElementById('overlay');
    const replyPopup = document.createElement('div');
    replyPopup.classList.add('reply-popup');
    replyPopup.style.display = 'block'; // 確実にポップアップを表示する

    const closeBtn = document.createElement('span');
    closeBtn.textContent = '閉じる';
    closeBtn.onclick = function() {
        replyPopup.style.display = 'none';
        overlay.style.display = 'none';
    };

    const replyForm = document.createElement('form');
    replyForm.onsubmit = function(event) {
        event.preventDefault();
        submitReplyForm(event, contentDiv, replyForm.querySelector('textarea').value);
        replyPopup.style.display = 'none';
        overlay.style.display = 'none';
    };

    const textarea = document.createElement('textarea');
    replyForm.appendChild(textarea);

    const submitBtn = document.createElement('input');
    submitBtn.type = 'submit';
    submitBtn.value = '送信';
    replyForm.appendChild(submitBtn);

    replyPopup.appendChild(closeBtn);
    replyPopup.appendChild(replyForm);
    overlay.appendChild(replyPopup); // overlay内にポップアップを追加

    overlay.style.display = 'block'; // overlayを表示する
}

// 返信フォームを送信
function submitReplyForm(event, contentDiv, text) {
    const replyContentDiv = document.createElement('div');
    replyContentDiv.textContent = text;
    contentDiv.appendChild(replyContentDiv);
}

// グッドボタンのクリック状態を切り替える関数
function toggleGoodButtonState(tabName) {
    if (!goodButtonStates[tabName]) {
        goodButtonStates[tabName] = { clicked: false };
    }
    goodButtonStates[tabName].clicked = !goodButtonStates[tabName].clicked;
}

// グッドボタンのスタイルを更新する関数
function updateGoodButtonStyle(goodButton, tabName) {
    if (goodButtonStates[tabName] && goodButtonStates[tabName].clicked) {
        goodButton.classList.add('good-button-clicked');
    } else {
        goodButton.classList.remove('good-button-clicked');
    }
}
