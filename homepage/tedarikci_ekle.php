<?php
include("baglanti.php"); // Veritabanı bağlantısını yapmak için gerekli dosya

// POST verilerini al
$tedarikci_ad = $_POST['tedarikci_ad'];
$tedarikci_iletisim = $_POST['iletisim'];

// SQL sorgusu oluştur
$sql = "INSERT INTO tedarikci (tedarikci_ad, iletisim) VALUES ('$tedarikci_ad','$tedarikci_iletisim')";

// Sorguyu çalıştır ve sonucu kontrol et
if ($baglan->query($sql) === TRUE) {
    echo "Yeni çalışan başarıyla eklendi! Yönlendiriliyor...";
} else {
    echo "Hata oluştu: " . $sql . "<br>" . $baglan->error;
}

$baglan->close(); // Bağlantıyı kapat

header("Location: tedarikciler.php");
exit; //

?>
