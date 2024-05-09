document.getElementById('loginForm').onsubmit = function(event) {
  event.preventDefault();
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;

  // サーバーサイドにログイン要求を送信
  fetch('/Login', {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify({username, password})
  })
  .then(response => response.json())
  .then(data => {
      if (data.success) {
          window.location.href = 'TestHome.html'; // ホーム画面へ遷移
      } else {
          alert('Login failed!');
      }
  });
};
