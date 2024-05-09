document.getElementById('registerForm').onsubmit = function(event) {
  event.preventDefault();
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;

  // サーバーサイドに登録要求を送信
  fetch('/register', {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify({username, password})
  })
  .then(response => response.json())
  .then(data => {
      if (data.success) {
          window.location.href = 'Login.html'; // ログインページへ遷移
      } else {
          alert('Registration failed!');
      }
  });
};
