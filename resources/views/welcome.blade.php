  <!DOCTYPE html>
  <html lang="id">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Catering Bu Titin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
      }

      body {
        background-image: url('background.jpg');
        background-size: cover;
        background-position: center;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        backdrop-filter: brightness(0.8);
      }

      .login-container {
        background: rgba(255, 255, 255, 0.95);
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        width: 100%;
        max-width: 400px;
        text-align: center;
      }

      .login-container img {
        width: 100px;
        margin-bottom: 15px;
      }

      .login-container h2 {
        color: #2c3e50;
        margin-bottom: 20px;
        font-size: 24px;
      }

      .form-group {
        text-align: left;
        margin-bottom: 20px;
      }

      .form-group label {
        display: block;
        margin-bottom: 6px;
        color: #333;
      }

      .form-group input {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #ccc;
        border-radius: 8px;
      }

      .btn-login {
        width: 100%;
        padding: 12px;
        background-color: #3d5a40;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s ease;
      }

      .btn-login:hover {
        background-color: #2c4030;
      }

      .forgot {
        margin-top: 15px;
        display: block;
        color: #3d5a40;
        text-decoration: none;
        font-size: 14px;
      }

      .forgot:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
      <div class="login-container">
        <h1>Katering Bu Titin</h1>
        <h2>Login</h2>
        <form id="loginForm">
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" required>
          </div>
          <div class="form-group">
            <label for="password">Kata Sandi:</label>
            <input type="password" id="password" required>
          </div>
          <button type="submit" class="btn-login">Login</button>
          <p id="message" style="margin-top: 10px; color: red;"></p>
        </form>
      </div>
    
      <script>
        const loginForm = document.getElementById('loginForm');
        loginForm.addEventListener('submit', async function(e) {
          e.preventDefault();
    
          const email = document.getElementById('email').value;
          const password = document.getElementById('password').value;
          const message = document.getElementById('message');
    
          try {
            const response = await fetch('/api/login', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
              },
              body: JSON.stringify({ email, password })
            });
    
            const result = await response.json();
    
            if (response.ok) {
              // Login berhasil
              message.style.color = 'green';
              message.textContent = 'Login berhasil!';
    
              // Simpan token JWT ke localStorage atau lakukan redirect
              localStorage.setItem('token', result.token);
              window.location.href = '/transaction';
            } else {
              // Login gagal
              message.style.color = 'red';
              message.textContent = result.error || 'Login gagal.';
            }
          } catch (err) {
            message.style.color = 'red';
            message.textContent = 'Terjadi kesalahan. Coba lagi.';
          }
        });
      </script>
    </body>
  </html>
