document.addEventListener("DOMContentLoaded", function () {
    var loginButton = document.getElementById("loginButton");
    var registerButton = document.getElementById("registerButton");
    var registerModal = document.getElementById("registerModal");
    var registerConfirmButton = document.getElementById("registerConfirm");

    loginButton.addEventListener("click", function () {
        var loginEmail = document.getElementById("loginEmail").value;
        var loginPassword = document.getElementById("loginPassword").value;

        var loginData = {
            "email": loginEmail,
            "password": loginPassword
        };

        // ログインAPIにログイン情報を送信し、サーバー側で認証を行う
        fetch("loginUser.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(loginData)
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Failed to login");
                }
                alert("Login successful!");
                window.location.href = "Home.html";
            })
            .catch(error => {
                alert(error.message);
            });
    });

    registerButton.addEventListener("click", function () {
        registerModal.style.display = "block";
    });

    registerConfirmButton.addEventListener("click", function () {
        var registerName = document.getElementById("registerName").value;
        var registerEmail = document.getElementById("registerEmail").value;
        var registerPassword = document.getElementById("registerPassword").value;

        var registerData = {
            "name": registerName,
            "email": registerEmail,
            "password": registerPassword
        };

        // 新規登録情報を一時的に newUser.json に保存する
        fetch("newUser.json")
            .then(response => response.json())
            .then(data => {
                data.push(registerData);
                return fetch("saveNewUser.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(data)
                });
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Failed to register user");
                }
                alert("User registered successfully!");
                registerModal.style.display = "none";
            })
            .catch(error => {
                alert(error.message);
            });
    });

    window.addEventListener("click", function (event) {
        if (event.target == registerModal) {
            registerModal.style.display = "none";
        }
    });
});
