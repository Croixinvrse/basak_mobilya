<?php
include("baglanti.php"); // Veritabanı bağlantısını yapmak için gerekli dosya

// POST verilerini al
$sa_m_id = $_POST['malzemeListesi']; // Malzeme id'si olarak güncellendi
$sa_adet = $_POST['adet'];
$sa_t_maliyet = $_POST['maliyet']; // Toplam maliyet alan adı güncellendi
$sa_tedarikci = $_POST['tedarikciListesi']; // Tedarikçi id'si olarak güncellendi

// SQL sorgusu oluştur
$sql = "INSERT INTO satin_alma (malzeme_id, adet, t_maliyet, tedarikci_id) VALUES ('$sa_m_id', '$sa_adet', '$sa_t_maliyet', '$sa_tedarikci')";

// Sorguyu çalıştır ve sonucu kontrol et
if ($baglan->query($sql) === TRUE) {
    echo "Yeni ürün başarıyla eklendi! Yönlendiriliyor...";
} else {
    echo "Hata oluştu: " . $sql . "<br>" . $baglan->error;
}

$baglan->close(); // Bağlantıyı kapat

header("Location: satin_alma.php");
exit;
?>
