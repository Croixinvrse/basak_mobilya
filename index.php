<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mobilya Üretim Bilgi Sistemi</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <div class="content">
      <h1>Hoş Geldiniz!</h1>
      <p>Başak Mobilya Yönetim Sistemi</p>
      <form action="login_check.php" method="POST">
        <input type="text" name="username" placeholder="Kullanıcı Adı" required>
        <input type="password" name="password" placeholder="Şifre" required>
        <div class="form-options">
          <label>
            <input type="checkbox" name="remember"> Beni hatırla
          </label>
          <a href="sifremi-unuttum.html">Şifremi unuttum</a>
        </div>
        <button type="submit">Giriş Yap</button>
      </form>
    </div>
  </div>
</body>
</html>
