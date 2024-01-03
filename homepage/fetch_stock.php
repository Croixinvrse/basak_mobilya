 <?php
include("baglanti.php");

// Veritabanından stok verilerini çekmek için sorgu
$query = "SELECT malzeme_ad, stok_adet FROM malzemeler,kategori where malzemeler.kategori_id = kategori.kategori_id and kategori.kategori_ad = 'plaka'"; // Örnek tablo ve sütun isimleri

$result = $baglan->query($query);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data); // Verileri JSON formatında döndürme
?>
