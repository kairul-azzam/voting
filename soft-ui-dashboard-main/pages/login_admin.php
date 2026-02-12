<!DOCTYPE html>
<!-- Coding By CodingNepal - www.codingnepalweb.com -->
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../assets_login/stylelogin.css">
</head>
<body>
  <div class="wrapper">
    <form action="proseslogin_admin.php" method="POST" autocomplete="off">
      <h2>Login admin</h2>
        <div class="input-field">
        <input type="text" required name="username">
        <label>Masukkan username</label>
      </div>
      <div class="input-field">
        <input type="password" required name="password">
        <label>Masukkan password</label>
      </div>
      <div class="forget">
        <label for="remember">
          <input type="checkbox" id="remember">
          <p>Ingatkan saya</p>
        </label>
        <a href="#">Lupa password?</a>
      </div>
      <button type="submit">Log In</button>
      <div class="register">
        <p>Tidak punya akun? <a href="#">Daftar</a></p>
      </div>
    </form>
  </div>
</body>
</html>