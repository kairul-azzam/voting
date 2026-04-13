<!DOCTYPE html>
<!-- Coding By CodingNepal - www.codingnepalweb.com -->
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../assets_login/stylelogin.css">
  <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQc7BzfAOGrygvQ8AwkEkcarwJVRQ9YO01FZg&s">
  <title>
    login siswa
  </title>
</head>
<body>
  <div class="wrapper">
    <form action="proseslogin.php" method="POST" autocomplete="off">
      <h2>Login</h2>
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