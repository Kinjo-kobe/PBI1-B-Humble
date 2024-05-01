document.addEventListener("DOMContentLoaded", function () {
    var logoutButton = document.getElementById("logoutButton");
    var logoutModal = document.getElementById("logoutModal");
    var yesButton = document.getElementById("yesButton");
    var noButton = document.getElementById("noButton");

    logoutButton.addEventListener("click", function () {
        logoutModal.style.display = "block";
    });

    yesButton.addEventListener("click", function () {
        // ログアウト処理
        // User.json の loggedIn を false に設定し、Login.html にリダイレクトする
        var userData = {
            loggedIn: false
        };

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "updateUser.php", true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.send(JSON.stringify(userData));

        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                window.location.href = "Login.html";
            } else {
                alert("Failed to logout");
            }
        };
    });

    noButton.addEventListener("click", function () {
        logoutModal.style.display = "none";
    });
});
