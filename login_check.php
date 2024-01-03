<?php
// Veritabanı bağlantı bilgileri
$servername = "localhost"; // MySQL sunucu adı
$username = "root"; // MySQL kullanıcı adı (varsayılan olarak genellikle "root")
$password = ""; // MySQL şifre (varsayılan olarak genellikle boş)
$database = "basak_mobilya"; // Veritabanı adı

// MySQL bağlantısını oluşturma
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Veritabanına bağlantı sağlanamadı: " . $conn->connect_error);
}

// Formdan gelen kullanıcı adı ve şifreyi alınması
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; // formdaki input'un "name" özelliğine göre alınır
    $password = $_POST['password']; // formdaki input'un "name" özelliğine göre alınır

    // Veritabanından kullanıcıyı sorgulama
    $sql = "SELECT * FROM yonetici WHERE yonetici_ad = '$username' AND yonetici_sifre = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Giriş başarılı, kullanıcı var
        header("Location: homepage/homepage.php"); // Ana sayfaya yönlendirme
        exit();
    } else {
        // Kullanıcı adı veya şifre hatalı
        echo "Hatalı kullanıcı adı veya şifre!";
    }
}

// Bağlantıyı kapatma
$conn->close();
?>
