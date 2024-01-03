<body>
    <?php include 'Navbar.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stoklar</title>
    <style>
        /* Temel CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            height: 10%;
            margin: 0 auto;
        }

        /* Tablo Stilleri */
        #calisanlar {
            width: 100%;
            margin-top: 300px;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        #calisanlar th, #calisanlar td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        #calisanlar th {
            background-color: #f5f5f5;
        }

        #calisanlar tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        #calisanlar tbody tr:hover {
            background-color: #f0f0f0;
        }
        .form-container {
            width: 700px;
            height: 120px;
            position: absolute;
            top: 50px;
            left: 230px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Form stilleri */
        .form-container form {
            display: flex;
            flex-direction: row; /* Değişiklik burada */
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap; /* Daha fazla eleman olduğunda satır atlaması için */
        }
        .form-container label {
            margin-right: 10px;
            font-weight: bold;
            flex: 1 0 120px; /* Etiketlerin genişliği */
            text-align: right;
        }
        .form-container input[type="text"],
        .form-container select {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            flex: 2 0 200px; /* Kutuların genişliği */
        }
        .form-container input[type="submit"] {
            padding: 5px 10px;
            background-color: #795548;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        
        }
        .form-container input[type="submit"]:hover {
            background-color: #ccc4b9;
        }
        /* Yeni stiller */
        .select-box {
            padding: 10px;
            width: calc(100% - 22px);
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .submit-button {
            padding: 10px;
            background-color: #795548;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: #ccc4b9;
        }

    </style>
</head>
<body>
    
<div class="container">
        <table id="calisanlar">
            <thead>
                <tr>
                    <th>Tarih</th>
                    <th>Ürün</th>
                    <th>Adet</th>
                    <th>Toplam Maliyet</th>
                    <th>Birim Maliyet</th>
                    <th>Tedarikci</th>
                </tr>
            </thead>
            <tbody>
            
<?php
include("baglanti.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_purchase'])) {
    $purchase_id = $_POST['delete_purchase'];

    $sql = "DELETE FROM satin_alma WHERE islem_id = $purchase_id";

    if ($baglan->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Hata oluştu: " . $baglan->error;
    }
}

$sec = "SELECT * FROM satin_alma,malzemeler,tedarikci WHERE satin_alma.malzeme_id = malzemeler.malzeme_id AND satin_alma.tedarikci_id = tedarikci.tedarikci_id" ;
$sonuc = $baglan->query($sec);

if ($sonuc->num_rows > 0) {
    while ($cek = $sonuc->fetch_assoc()) {
        echo "<tr>
                <td>" . $cek['tarih'] . "</td>
                <td>" . $cek['malzeme_ad'] . "</td>
                <td>" . $cek['adet'] . "</td>
                <td>" . $cek['t_maliyet'] . "</td>
                <td>" . $cek['b_maliyet'] . "</td>
                <td>" . $cek['tedarikci_ad'] . "</td>
                <td>
                    <form method='POST' action=''>
                        <input type='hidden' name='delete_purchase' value='" . $cek['islem_id'] . "'>
                        <button type='submit' name='delete' style='padding: 5px 10px; background-color: #d8c100; color: white; border: none; border-radius: 3px; cursor: pointer; transition: background-color 0.3s ease;'>İptal</button>
                    </form>
                </td>
              </tr>";
    }
}
?>

            </tbody>
        </table>
    </div>
    
</body>
</html>
<body>
    <?php include 'Navbar.php' ?>
    <<div class="form-container">
    <form action="satin_alma_ekle.php" method="POST">
        <label for="malzeme_id">Malzeme seçiniz:</label>
        <select id="malzemeListesi" name="malzemeListesi" class="select-box">
            <?php
            include("baglanti.php");

            $sorgu = "SELECT malzeme_id, malzeme_ad FROM malzemeler";
            $sonuc = $baglan->query($sorgu);

            if ($sonuc->num_rows > 0) {
                while ($row = $sonuc->fetch_assoc()) {
                    echo "<option value='" . $row['malzeme_id'] ."'>" . $row['malzeme_ad'] ."</option>";
                }
            }
            ?>
        </select>

        <label for="adet">Ürün Adedi</label>
        <input type="text" id="adet" name="adet" required><br><br>

        <label for="t_maliyet">Toplam Maliyet</label>
        <input type="text" id="maliyet" name="maliyet" required><br><br>

        <label for="tedarikci_id">Tedarikçi seçiniz:</label>
        <select id="tedarikciListesi" name="tedarikciListesi" class="select-box">
            <?php
            $sorgu = "SELECT tedarikci_id, tedarikci_ad FROM tedarikci";
            $sonuc = $baglan->query($sorgu);

            if ($sonuc->num_rows > 0) {
                while ($row = $sonuc->fetch_assoc()) {
                    echo "<option value='" . $row['tedarikci_id'] ."'>" . $row['tedarikci_ad'] ."</option>";
                }
            }
            ?>
        </select>

        <input type="submit" value="Ürün Ekle">
    </form>
</div>
