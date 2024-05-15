<?= $this->section('main'); ?>

<!-- Tambahkan CSS untuk Chart.js dan Bootstrap -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css"> -->
<style>
    .container {
        margin-top: 20px;
    }

    .dropdown-menu {
        background-color: #374151;
    }

    #chartContainer {
        display: none;
    }
</style>

<div class="container">
    <div class="mb-4">
        <h3>Dashboard</h3>
        <select class="form-select" id="filterSelect" aria-label="Default select example">
            <option selected>Pilih Filter</option>
            <option value="hari">Hari</option>
            <option value="bulan">Bulan</option>
            <option value="tahun">Tahun</option>
        </select>
    </div>

    <button class="btn btn-primary" id="submitButton" style="display:none;">Submit</button>

    <div id="chartContainer">
        <canvas id="myChart"></canvas>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.getElementById('filterSelect').addEventListener('change', function() {
        var filterValue = document.getElementById('filterSelect').value;
        var submitButton = document.getElementById('submitButton');
        if (filterValue !== 'Pilih Filter') {
            submitButton.style.display = 'block';
        } else {
            submitButton.style.display = 'none';
        }
    });

    document.getElementById('submitButton').addEventListener('click', function() {
        var filterValue = document.getElementById('filterSelect').value;
        var labels = [];
        var prediksiData = [];
        var pendapatanData = [];

        if (filterValue === 'hari') {
            labels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            prediksiData = [10, 20, 30, 40, 50, 60, 70];
            pendapatanData = [15, 25, 35, 45, 55, 65, 75];
        } else if (filterValue === 'bulan') {
            labels = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            // inputkan datanya //
            prediksiData = [100, 150, 200, 250, 300, 350, 400, 450, 500, 550, 600, 650];
            pendapatanData = [110, 160, 210, 260, 310, 360, 410, 460, 510, 560, 610, 660];
        } else if (filterValue === 'tahun') {
            labels = ['2020', '2021', '2022', '2023', '2024', '2025'];
            // inputkan datanya //
            prediksiData = [1000, 1200, 1400, 1600, 1800, 2000];
            pendapatanData = [1100, 1300, 1500, 1700, 1900, 2100];
        }

        if (labels.length > 0) {
            document.getElementById('chartContainer').style.display = 'block';
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Prediksi',
                            data: prediksiData,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            fill: true,
                            tension: 0.1
                        },
                        {
                            label: 'Pendapatan',
                            data: pendapatanData,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            fill: true,
                            tension: 0.1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    });
</script>


<?= $this->endSection(); ?>