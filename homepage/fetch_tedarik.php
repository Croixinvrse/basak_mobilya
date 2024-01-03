 <?php
// Veritabanı bağlantısı yapılıyor
include("baglanti.php");

// Veritabanından stok verilerini çekmek için sorgu
$query = "SELECT tedarikci.tedarikci_ad, sum(satin_alma.t_maliyet) as toplam FROM satin_alma,tedarikci WHERE tedarikci.tedarikci_id = satin_alma.tedarikci_id GROUP BY tedarikci.tedarikci_id"; // Örnek tablo ve sütun isimleri

$result = $baglan->query($query);

// Verileri almak ve JSON formatında döndürmek
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data); // Verileri JSON formatında döndürme
?>
