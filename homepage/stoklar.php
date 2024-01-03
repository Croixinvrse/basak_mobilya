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
            height: 100%;
            margin: 0 auto;
        }

        /* Tablo Stilleri */
        #calisanlar {
            width: 30%;
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
            height: 210px;
            position: absolute;
            top: 10px;
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
            flex-direction: column;
            align-items: center;
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
        .product-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 20px;
}

.product {
    width: calc(20% - 20px);
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 15px;
    background-color: #f9f9f9;
}
.product-info {
    margin-bottom: 10px;
}

.product-id {
    font-weight: bold;
    color: #333;
}

.product-name {
    margin: 5px 0;
}

.stock-quantity {
    color: #888;
}

.reduce-stock-form {
    display: flex;
    align-items: center;
}

.quantity-input {
    padding: 8px;
    margin-right: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.reduce-button {
    padding: 8px 15px;
    background-color: #795548;
    color: white;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.reduce-button:hover {
    background-color: #4b3b2d;
}

    </style>
</head>
<body>
<div class="container">
        <table id="calisanlar">
            <thead>
                <tr>
                    
                

                </tr>
            </thead>
            <tbody>
 <div class="container">
    <div class="product-grid">
            <?php
            include("baglanti.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reduce_stock'])) {
    $product_id = $_POST['reduce_stock_product'];
    $quantity = $_POST['quantity'];

    $query = "SELECT stok_adet FROM malzemeler WHERE malzeme_id = $product_id";
    $result = $baglan->query($query);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $current_stock = $row['stok_adet'];
        
        $new_stock = $current_stock - $quantity;
        
        $update_query = "UPDATE malzemeler SET stok_adet = $new_stock WHERE malzeme_id = $product_id";
        
        if ($baglan->query($update_query) === TRUE) {
            echo "";
        } else {
            echo "Stok güncelleme hatası: " . $baglan->error;
        }
    } else {
        echo "Ürün bulunamadı!";
    }
}

$sec = "SELECT * FROM malzemeler,kategori,renk,yapi WHERE malzemeler.kategori_id = kategori.kategori_id AND malzemeler.renk_id = renk.renk_id AND malzemeler.yapi_id=yapi.yapi_id";
$sonuc = $baglan->query($sec);

if ($sonuc->num_rows > 0) {
    while ($cek = $sonuc->fetch_assoc()) {
        echo "<div class='product'>
                <div class='product-info'>
                    <h3 class='product-name'>" . $cek['malzeme_ad'] . "</h3>
                    <p class='stock-quantity'>" . $cek['stok_adet'] . " Adet Stokta</p>
                </div>
                <form class='reduce-stock-form' method='POST' action=''>
                    <input type='hidden' name='reduce_stock_product' value='" . $cek['malzeme_id'] . "'>
                    <input type='number' name='quantity' placeholder='Kullanılan Stok Miktarı' class='quantity-input'>
                    <button type='submit' name='reduce_stock' class='reduce-button'>Stok Azalt</button>
                </form>
              </div>";
    }
}
?>

            </tbody>
        </table>
    </div>
    
</body>
</html>