<?php
// Include file koneksi.php untuk menyambungkan ke database
include 'output.php';

// Query untuk mengambil data dari tabel
$sql = "SELECT * FROM your_table"; // ganti 'nama_tabel' dengan nama tabel Anda
$result = $conn->query($sql);

$dataPoints1 = [];
$dataPoints2 = [];
$dataPoints3 = [];
$dataPoints4 = [];
$dataPoints5 = [];
$dataPoints6 = [];
$dataPoints7 = [];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Output Data Pengamatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #343a40;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 3px rgba(0,0,0,0.1);
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e9ecef;
        }
        .chart-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }           

        .chart {
            width: 30%;
            min-width: 300px; /* Untuk memastikan grafik tetap terlihat pada layar yang lebih kecil */
            margin: 20px;
        } 

    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>
    <h2>Data Obs</h2>
    <table>
        <thead>
            <tr>
                <!-- Ubah sesuai dengan nama kolom tabel Anda -->
                <th>datetime</th>
                <th>Windspeed</th>
                <th>Winddir</th>
                <th>Temp</th>
                <th>RH</th>
                <th>Pressure</th>
                <th>Rain</th>
                <th>Solrad</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Output data dari setiap baris
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["datetime"] . "</td>";
                    echo "<td>" . $row["windspeed"] . "</td>";
                    echo "<td>" . $row["winddir"] . "</td>";
                    echo "<td>" . $row["temp"] . "</td>";
                    echo "<td>" . $row["rh"] . "</td>";
                    echo "<td>" . $row["pressure"] . "</td>";
                    echo "<td>" . $row["rain"] . "</td>";
                    echo "<td>" . $row["solrad"] . "</td>";
                    echo "</tr>";

                    $dataPoints1[] = [
                      'label' => $row["datetime"], // atau kolom lain yang ingin Anda jadikan label
                      'value' => $row["windspeed"]  // ganti 'some_value' dengan kolom yang ingin Anda tampilkan dalam grafik
                    ];
                    $dataPoints2[] = [
                        'label' => $row["datetime"], // atau kolom lain yang ingin Anda jadikan label
                        'value' => $row["winddir"]  // ganti 'some_value' dengan kolom yang ingin Anda tampilkan dalam grafik
                    ];
                    $dataPoints3[] = [
                        'label' => $row["datetime"], // atau kolom lain yang ingin Anda jadikan label
                        'value' => $row["temp"]  // ganti 'some_value' dengan kolom yang ingin Anda tampilkan dalam grafik
                    ];
                    $dataPoints4[] = [
                        'label' => $row["datetime"], // atau kolom lain yang ingin Anda jadikan label
                        'value' => $row["rh"]  // ganti 'some_value' dengan kolom yang ingin Anda tampilkan dalam grafik
                    ];
                    $dataPoints5[] = [
                        'label' => $row["datetime"], // atau kolom lain yang ingin Anda jadikan label
                        'value' => $row["pressure"]  // ganti 'some_value' dengan kolom yang ingin Anda tampilkan dalam grafik
                    ];
                    $dataPoints6[] = [
                        'label' => $row["datetime"], // atau kolom lain yang ingin Anda jadikan label
                        'value' => $row["rain"]  // ganti 'some_value' dengan kolom yang ingin Anda tampilkan dalam grafik
                    ];
                    $dataPoints7[] = [
                        'label' => $row["datetime"], // atau kolom lain yang ingin Anda jadikan label
                        'value' => $row["solrad"]  // ganti 'some_value' dengan kolom yang ingin Anda tampilkan dalam grafik
                    ];
                }
            } else {
                echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
    <!-- Tambahkan elemen canvas untuk grafik pertama -->
    <div class="chart-container">
        <canvas id="myChart1"></canvas>
    </div>

    <!-- Tambahkan elemen canvas untuk grafik kedua -->
    <div class="chart-container">
        <canvas id="myChart2"></canvas>
    </div>
    <div class="chart-container">
        <canvas id="myChart3"></canvas>
    </div>
    <div class="chart-container">
        <canvas id="myChart4"></canvas>
    </div>
    <div class="chart-container">
        <canvas id="myChart5"></canvas>
    </div>
    <div class="chart-container">
        <canvas id="myChart6"></canvas>
    </div>
    <div class="chart-container">
        <canvas id="myChart7"></canvas>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx1 = document.getElementById('myChart1').getContext('2d');
        var dataPoints1 = <?php echo json_encode($dataPoints1); ?>;
        if (dataPoints1.length > 0) {
            var labels1 = dataPoints1.map(function(point) {
                return point.label;
            });
            var values1 = dataPoints1.map(function(point) {
                return point.value;
            });

            var myChart1 = new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: labels1,
                    datasets: [{
                        label: 'Data Terupdate Grafik 1',
                        data: values1,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        pointRadius: 3,
                        pointHoverRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        x: {
                            ticks: {
                                maxTicksLimit: 10
                            }
                        },
                        y: {
                            beginAtZero: false
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 10,
                            bottom: 10
                        }
                    }
                },

            });
        } else {
            document.getElementById('myChart1').style.display = 'none';
            console.warn("No data available for chart 1");
        }

        var ctx2 = document.getElementById('myChart2').getContext('2d');
        var dataPoints2 = <?php echo json_encode($dataPoints2); ?>;
        if (dataPoints2.length > 0) {
            var labels2 = dataPoints2.map(function(point) {
                return point.label;
            });
            var values2 = dataPoints2.map(function(point) {
                return point.value;
            });

            var myChart2 = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: labels2,
                    datasets: [{
                        label: 'Data Terupdate Grafik 2',
                        data: values2,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        pointRadius: 3,
                        pointHoverRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        x: {
                            ticks: {
                                maxTicksLimit: 10
                            }
                        },
                        y: {
                            beginAtZero: false
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 10,
                            bottom: 10
                        }
                    }
                }
            });
        } else {
            document.getElementById('myChart2').style.display = 'none';
            console.warn("No data available for chart 2");
        }

        var ctx3 = document.getElementById('myChart3').getContext('2d');
        var dataPoints3 = <?php echo json_encode($dataPoints3); ?>;
        if (dataPoints3.length > 0) {
            var labels3 = dataPoints3.map(function(point) {
                return point.label;
            });
            var values3 = dataPoints3.map(function(point) {
                return point.value;
            });

            var myChart3 = new Chart(ctx3, {
                type: 'line',
                data: {
                    labels: labels3,
                    datasets: [{
                        label: 'Data Terupdate Grafik 3',
                        data: values3,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        pointRadius: 3,
                        pointHoverRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        x: {
                            ticks: {
                                maxTicksLimit: 10
                            }
                        },
                        y: {
                            beginAtZero: false
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 10,
                            bottom: 10
                        }
                    }
                }
            });
        } else {
            document.getElementById('myChart3').style.display = 'none';
            console.warn("No data available for chart 1");
        }

        var ctx4 = document.getElementById('myChart4').getContext('2d');
        var dataPoints4 = <?php echo json_encode($dataPoints4); ?>;
        if (dataPoints4.length > 0) {
            var labels4 = dataPoints4.map(function(point) {
                return point.label;
            });
            var values4 = dataPoints4.map(function(point) {
                return point.value;
            });

            var myChart4 = new Chart(ctx4, {
                type: 'line',
                data: {
                    labels: labels4,
                    datasets: [{
                        label: 'Data Terupdate Grafik 4',
                        data: values2,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        pointRadius: 3,
                        pointHoverRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        x: {
                            ticks: {
                                maxTicksLimit: 10
                            }
                        },
                        y: {
                            beginAtZero: false
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 10,
                            bottom: 10
                        }
                    }
                }
            });
        } else {
            document.getElementById('myChart4').style.display = 'none';
            console.warn("No data available for chart 4");
        }

        var ctx5 = document.getElementById('myChart5').getContext('2d');
        var dataPoints5 = <?php echo json_encode($dataPoints5); ?>;
        if (dataPoints5.length > 0) {
            var labels5 = dataPoints5.map(function(point) {
                return point.label;
            });
            var values5 = dataPoints5.map(function(point) {
                return point.value;
            });

            var myChart5 = new Chart(ctx5, {
                type: 'line',
                data: {
                    labels: labels5,
                    datasets: [{
                        label: 'Data Terupdate Grafik 5',
                        data: values1,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        pointRadius: 3,
                        pointHoverRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        x: {
                            ticks: {
                                maxTicksLimit: 10
                            }
                        },
                        y: {
                            beginAtZero: false
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 10,
                            bottom: 10
                        }
                    }
                }
            });
        } else {
            document.getElementById('myChart5').style.display = 'none';
            console.warn("No data available for chart 5");
        }

        var ctx6 = document.getElementById('myChart6').getContext('2d');
        var dataPoints6 = <?php echo json_encode($dataPoints6); ?>;
        if (dataPoints6.length > 0) {
            var labels6 = dataPoints6.map(function(point) {
                return point.label;
            });
            var values6 = dataPoints6.map(function(point) {
                return point.value;
            });

            var myChart6 = new Chart(ctx6, {
                type: 'line',
                data: {
                    labels: labels6,
                    datasets: [{
                        label: 'Data Terupdate Grafik 6',
                        data: values6,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        pointRadius: 3,
                        pointHoverRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        x: {
                            ticks: {
                                maxTicksLimit: 10
                            }
                        },
                        y: {
                            beginAtZero: false
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 10,
                            bottom: 10
                        }
                    }
                }
            });
        } else {
            document.getElementById('myChart6').style.display = 'none';
            console.warn("No data available for chart 6");
        }

        var ctx7 = document.getElementById('myChart7').getContext('2d');
        var dataPoints7 = <?php echo json_encode($dataPoints7); ?>;
        if (dataPoints7.length > 0) {
            var labels7 = dataPoints7.map(function(point) {
                return point.label;
            });
            var values7 = dataPoints7.map(function(point) {
                return point.value;
            });

            var myChart7 = new Chart(ctx7, {
                type: 'line',
                data: {
                    labels: labels7,
                    datasets: [{
                        label: 'Data Terupdate Grafik 7',
                        data: values7,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        pointRadius: 3,
                        pointHoverRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        x: {
                            ticks: {
                                maxTicksLimit: 10
                            }
                        },
                        y: {
                            beginAtZero: false
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 10,
                            bottom: 10
                        }
                    }
                }
            });
        } else {
            document.getElementById('myChart7').style.display = 'none';
            console.warn("No data available for chart 7");
        }
    });
</script>
</body>
</html>
