<?php
include("baglanti.php");

$query = "SELECT malzemeler.malzeme_ad,round(SUM(satin_alma.t_maliyet)/SUM(satin_alma.adet),2) as birim
FROM satin_alma,malzemeler,kategori
WHERE satin_alma.malzeme_id = malzemeler.malzeme_id
AND malzemeler.kategori_id = kategori.kategori_id
AND kategori.kategori_ad = 'plaka'
GROUP BY malzemeler.malzeme_id"; 
$result = $baglan->query($query);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data); 
?>
