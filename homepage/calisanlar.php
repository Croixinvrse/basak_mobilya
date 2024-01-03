<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Çalışanlar</title>
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
            height: 5px;
            margin: 0 auto;
        }

        /* Tablo Stilleri */
        #calisanlar {
            width: 100%;
            margin-top: 400px;
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
            width: 250px;
            height: 275px;
            position: absolute;
            top: 20px;
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
             flex-wrap: wrap;
             justify-content: space-between;
        }
        .form-container label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-container input[type="text"] {
            padding: 8px;
            margin-bottom: 10px;
            width: calc(100% - 20px);
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
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
    </style>
</head>
<body>
    <div class="container">
        <table id="calisanlar">
            <thead>
                <tr>
                    <th>Çalışan TC_NO</th>
                    <th>Çalışan AD</th>
                    <th>Çalışan SOYAD</th>
                    <th>Çalışan İLETİŞİM</th>
                    <th>Çalışan Alacaklı Gün Sayısı</th>
                </tr>
            </thead>
            <tbody>
            <?php
include("baglanti.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_employee'])) {
    $employee_id = $_POST['delete_employee'];

    $sql = "DELETE FROM calisan WHERE calisan_id = $employee_id";

    if ($baglan->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Hata oluştu: " . $baglan->error;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_day'])) {
    $employee_id = $_POST['add_day'];

    $sql = "UPDATE calisan SET calisan.gun_sayisi = calisan.gun_sayisi + 1 WHERE calisan_id = $employee_id";

    if ($baglan->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Hata oluştu: " . $baglan->error;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['subtract_day'])) {
    $employee_id = $_POST['subtract_day'];

    $sql = "UPDATE calisan SET calisan.gun_sayisi = calisan.gun_sayisi - 1 WHERE calisan_id = $employee_id";

    if ($baglan->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Hata oluştu: " . $baglan->error;
    }
}

$sec = "SELECT * FROM calisan";
$sonuc = $baglan->query($sec);

if ($sonuc->num_rows > 0) {
    while ($cek = $sonuc->fetch_assoc()) {
        echo "<tr>
                <td>" . $cek['tc_no'] . "</td>
                <td>" . $cek['calisan_ad'] . "</td>
                <td>" . $cek['calisan_soyad'] . "</td>
                <td>" . $cek['iletisim'] . "</td>
                <td>" . $cek['gun_sayisi'] . "</td>
                <td>
                    <form action='' method='post'>
                        <input type='hidden' name='add_day' value='" . $cek['calisan_id'] . "'>
                        <button type='submit' name='add' style='padding: 5px 5px; background-color: #00FF00; color: white; border: none; border-radius: 20%; cursor: pointer; transition: background-color 0.3s ease;'>+</button>
                    </form>
                </td>

                <td>
                    <form action='' method='post'>
                        <input type='hidden' name='subtract_day' value='" . $cek['calisan_id'] . "'>
                        <button type='submit' name='subtract' style='padding: 5px 5px; background-color: #FFA500; color: white; border: none; border-radius: 20%; cursor: pointer; transition: background-color 0.3s ease;'>-</button>
                    </form>
                </td>
                
                <td>
                    <form action='' method='post'>
                        <input type='hidden' name='delete_employee' value='" . $cek['calisan_id'] . "'>
                        <button type='submit' name='delete' style='padding: 5px 10px; background-color: #ff3333; color: white; border: none; border-radius: 3px; cursor: pointer; transition: background-color 0.3s ease;'>Sil</button>
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
    <div class="container">
        <div class="form-container">
            <form action="calisan_ekle.php" method="POST">
                <label for="calisan_ad">Çalışan Adı:</label>
                <input type="text" id="calisan_ad" name="calisan_ad" required><br><br>

                <label for="calisan_soyad">Çalışan Soyadı:</label>
                <input type="text" id="calisan_soyad" name="calisan_soyad" required><br><br>

                <label for="tc_no">Çalışan TC_NO:</label>
                <input type="text" id="tc_no" name="tc_no" required><br><br>

                <label for="iletisim">Çalışan İLETİŞİM:</label>
                <input type="text" id="iletisim" name="iletisim" required><br><br>


                <input type="submit" value="Çalışan Ekle">
            </form>
    </div>
</body>
