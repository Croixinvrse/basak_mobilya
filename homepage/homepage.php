<body>
    <?php include 'Navbar.php' ?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Başak Mobilya</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">

    <style>
        #stockChartContainer {
            position: fixed;
            top: 350px;
            left: 200px;
            width: 500px;
            height: 300px;
            border: 2px solid #ccc;
        }
        canvas#stockChart {
            width: 100%;
            height: 100%;
        }
        #tedarikChartContainer{
            position: fixed;
            top: 20px;
            left: 850px;
            width: 500px;
            height: 300px;
            border: 2px solid #ccc;

        }
        #depolamaChartContainer {
            position: fixed;
            top: 20px;
            left: 200px;
            width: 500px;
            height: 300px;
            border: 2px solid #ccc;
            display: flex;
            justify-content: center;
            align-items: center;

        }
        #birimChartContainer {
            position: fixed;
            top: 350px;
            left: 850px;
            width: 500px;
            height: 300px;
            border: 2px solid #ccc;

        }

</style>


    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div id="stockChartContainer">
        <canvas id="stockChart"></canvas>
    </div>

    <script>
        // Stok verilerini çekmek için AJAX veya Fetch kullanabilirsiniz
        fetch('fetch_stock.php')
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => item.malzeme_ad);
                const stockData = data.map(item => item.stok_adet);

                // Grafik oluşturma
                const ctx = document.getElementById('stockChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'ADET',
                            data: stockData,
                            backgroundColor: 'rgba(187, 136, 102, 0.65)',
                            borderColor: 'rgba(0, 0, 0, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    </script>

<div id="tedarikChartContainer">
        <canvas id="tedarikChart"></canvas>
    </div>

    <script>
        // Stok verilerini çekmek için AJAX veya Fetch kullanabilirsiniz
        fetch('fetch_tedarik.php')
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => item.tedarikci_ad);
                const stockData = data.map(item => item.toplam);

                // Grafik oluşturma
                const ctx = document.getElementById('tedarikChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'TOPLAM TUTAR',
                            data: stockData,
                            backgroundColor: 'rgba(210, 180, 140, 0.65)',
                            borderColor: 'rgba(0, 0, 0, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    </script>
<div id="depolamaChartContainer">
    <canvas id="remainingStorageChart"></canvas>
</div>

<script>
    fetch('fetch_depolama.php')
        .then(response => response.json())
        .then(data => {
            const remainingStorage = data || 0; // Varsayılan olarak 0 ata, veri gelmezse

            const ctx = document.getElementById('remainingStorageChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Kullanılan Depolama', 'Kalan Depolama'],
                    datasets: [{
                        data: [100 - remainingStorage, remainingStorage],
                        backgroundColor: ['rgba(121, 85, 72, 0.6)', 'rgba(210, 180, 140, 0.65)'],
                        borderColor: ['rgba(0, 0, 0, 1)', 'rgba(0, 0, 0, 1)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    cutout: '0%', // İç kısmın boşluğunu belirle
                    plugins: {
                        title: {
                            display: true,
                            text: 'MDF Plaka Depolama'
                        }
                    }
                }
            });
        });
</script>

<div id="birimChartContainer">
        <canvas id="birimchart"></canvas>
    </div>

    <script>
        // Stok verilerini çekmek için AJAX veya Fetch kullanabilirsiniz
        fetch('fetch_maliyet.php')
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => item.malzeme_ad);
                const stockData = data.map(item => item.birim);

                // Grafik oluşturma
                const ctx = document.getElementById('birimchart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'BİRİM MALİYET',
                            data: stockData,
                            backgroundColor: 'rgba(121, 85, 72, 0.6)',
                            borderColor: 'rgba(0, 0, 0, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    </script>

</body>
</html>

