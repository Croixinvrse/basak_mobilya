<body>
    <?php include 'Navbar.php' ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tedarikçiler</title>
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
            width: 250px;
            height: 150px;
            position: absolute;
            top: 40px;
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
                    <th>Tedarikci AD</th>
                    <th>İletişim Numarası</th>
                    
                </tr>
            </thead>
            <tbody>
            <?php
include("baglanti.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_employee'])) {
    $employee_id = $_POST['delete_employee'];

    $sql = "DELETE FROM tedarikci WHERE tedarikci_id = $employee_id";

    if ($baglan->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Hata oluştu: " . $baglan->error;
    }
}

$sec = "SELECT * FROM tedarikci";
$sonuc = $baglan->query($sec);

if ($sonuc->num_rows > 0) {
    while ($cek = $sonuc->fetch_assoc()) {
        echo "<tr>
                <td>" . $cek['tedarikci_ad'] . "</td>
                <td>" . $cek['iletisim'] . "</td>
                <td>
                    <form action='' method='post'>
                        <input type='hidden' name='delete_employee' value='" . $cek['tedarikci_id'] . "'>
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
    <div class="form-container">
        <form action="tedarikci_ekle.php" method="POST">
            <label for="tedarikci_ad">Tedarikçi Adı:</label>
            <input type="text" id="tedarikci_ad" name="tedarikci_ad" required><br><br>
            <label for="iletisim">İletişim Numarası</label>
            <input maxlength=10 type="text" id="iletisim" name="iletisim" required><br><br>
            

            <input type="submit" value="Tedarikci Ekle">
        </form>
    </div>
</body>
