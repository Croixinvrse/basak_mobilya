<?php
include("baglanti.php");

$query = "SELECT 100 - SUM(satin_alma.adet) AS kalan_depolama
          FROM satin_alma, malzemeler, kategori
          WHERE satin_alma.malzeme_id = malzemeler.malzeme_id
          AND kategori.kategori_id = malzemeler.kategori_id
          AND kategori.kategori_ad = 'plaka'"; 

$result = $baglan->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $kalanDepolama = $row['kalan_depolama'];

    echo json_encode($kalanDepolama);
} else {
    echo json_encode(null);
}
?>
