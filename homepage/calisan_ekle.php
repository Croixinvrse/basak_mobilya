<?php
include("baglanti.php"); // Veritabanı bağlantısını yapmak için gerekli dosya

// POST verilerini al
$calisan_ad = $_POST['calisan_ad'];
$calisan_soyad = $_POST['calisan_soyad'];
$calisan_tc = $_POST['tc_no'];
$calisan_iletisim = $_POST['iletisim'];


// SQL sorgusu oluştur
$sql = "INSERT INTO calisan (calisan_ad, calisan_soyad,tc_no,iletisim) VALUES ('$calisan_ad', '$calisan_soyad',$calisan_tc,$calisan_iletisim)";

// Sorguyu çalıştır ve sonucu kontrol et
if ($baglan->query($sql) === TRUE) {
    echo "Yeni çalışan başarıyla eklendi! Yönlendiriliyor...";
} else {
    echo "Hata oluştu: " . $sql . "<br>" . $baglan->error;
}

$baglan->close(); // Bağlantıyı kapat

header("Location: calisanlar.php");
exit; //

?>

