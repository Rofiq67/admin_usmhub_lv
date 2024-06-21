<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/ico" href="{{ asset('storage/uploads/logo_pemkab_demak32.ico') }}">

    
    <title>USM HUB | Dahsboard</title>
</head>
<body>

@extends('layouts-admin.app')

@section('contents')
    
    <div class="container-fluid">
        <h2 class="mt-5"><b>Selamat Datang</b></h2>

        <!--Card--->
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Data Aduan
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ \App\Models\Aduan::count() }} aduan
                                </div>
                                <div class="text-xs font-weight-medium text-secondary text-uppercase mb-1">
                                    @if($todayAduanCount > 0)
                                        +{{ $todayAduanCount }} hari ini
                                    @else
                                        0 hari ini
                                    @endif
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-info-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Data Aspirasi
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ \App\Models\Aspirasi::count() }} aspirasi
                                </div>
                                <div class="text-xs font-weight-medium text-secondary text-uppercase mb-1">
                                    @if($todayAspirasiCount > 0)
                                        +{{ $todayAspirasiCount }} hari ini
                                    @else
                                        0 hari ini
                                    @endif
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-bell fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Data Mahasiswa
                                </div>
                                @php
                                    $totalMahasiswa = \App\Models\User::where('is_admin', false)->count();
                                @endphp
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $totalMahasiswa }} Mahasiswa
                                </div>
                                <div class="text-xs font-weight-medium text-secondary text-uppercase mb-1">
                                    @if($todayUserCount > 0)
                                        +{{ $todayUserCount }} hari ini
                                    @else
                                        0 hari ini
                                    @endif
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card-->

        <!--chart-->
        <div class="row">
            <!-- Area line Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Klasifikasi jenis laporan</h6>
                    </div>
                    <!-- Card Body -->
                     <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myLineChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- donat Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown klasifikasi jenis aduan/aspirasi -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Program Studi penerima laporan</h6>
                    </div>
                    <!-- Card Body data aduan, aspirasi -->
                    <div class="card-body">
                        <div class="chart-pie pt-6 pb-2">
                            <canvas id="newMyPieChart"></canvas>
                        </div>
                        <div class="mt-2 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Aduan - Teknik Informatika
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text" style="color: #14A44D"></i> Aduan - Sistem Informasi
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-danger"></i> Aduan - Ilmu Komunikasi
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-secondary"></i> Aduan - Pariwisata
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-info"></i> Aspirasi - Teknik Informatika
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-warning"></i> Aspirasi - Sistem Informasi
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text" style="color: #fd7e14"></i> Aspirasi - Ilmu Komunikasi
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text" style="color: #332D2D"></i> Aspirasi - Pariwisata
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end chart-->
    </div>



@endsection

{{-- chart --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- donat chart  --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('newMyPieChart').getContext('2d');
        const aduanByProgramStudi = @json($aduanByProgramStudi);
        const aspirasiByProgramStudi = @json($aspirasiByProgramStudi);

        // Extracting labels and data for the chart
        const labels = aduanByProgramStudi.map(data => data.program_studi);
        const aduanByProgramStudis = aduanByProgramStudi.map(data => data.count);
        const aspirasiByProgramStudis = aspirasiByProgramStudi.map(data => data.count);

        const newMyPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Aduan',
                        data: aduanByProgramStudis,
                        backgroundColor: ['#3B71CA', '#14A44D', '#dc3545', '#6c757d'],
                        hoverBackgroundColor: ['#0056b3', '#1e7e34', '#c82333', '#5a6268'],
                        hoverBorderColor: 'rgba(234, 236, 244, 1)',
                    },
                    {
                        label: 'Aspirasi',
                        data: aspirasiByProgramStudis,
                        backgroundColor: ['#17a2b8', '#ffc107', '#fd7e14', '#343a40'],
                        hoverBackgroundColor: ['#138496', '#e0a800', '#e36209', '#292d31'],
                        hoverBorderColor: 'rgba(234, 236, 244, 1)',
                    }
                ],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: 'rgb(255,255,255)',
                    bodyFontColor: '#858796',
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
    });
</script>

{{-- line chart  --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('myLineChart').getContext('2d');
        
        const kategoriAduan = @json($kategoriAduan);
        const kategoriAspirasi = @json($kategoriAspirasi);

        const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        // Prepare data for Chart.js
        const prepareData = (data, type) => {
            let result = { Kebijakan: Array(12).fill(0), Pelayanan: Array(12).fill(0), Fasilitas: Array(12).fill(0) };
            data.forEach(item => {
                if (item[type] === 'Kebijakan') result.Kebijakan[item.month - 1] = item.count;
                if (item[type] === 'Pelayanan') result.Pelayanan[item.month - 1] = item.count;
                if (item[type] === 'Fasilitas') result.Fasilitas[item.month - 1] = item.count;
            });
            return result;
        };

        const aduan = prepareData(kategoriAduan, 'jenis_pengaduan');
        const aspirasi = prepareData(kategoriAspirasi, 'jenis_aspirasi');

        const myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Aduan - Kebijakan',
                        data: aduan.Kebijakan,
                        borderColor: '#007bff',
                        fill: false
                    },
                    {
                        label: 'Aduan - Pelayanan',
                        data: aduan.Pelayanan,
                        borderColor: '#28a745',
                        fill: false
                    },
                    {
                        label: 'Aduan - Fasilitas',
                        data: aduan.Fasilitas,
                        borderColor: '#dc3545',
                        fill: false
                    },
                    {
                        label: 'Aspirasi - Kebijakan',
                        data: aspirasi.Kebijakan,
                        borderColor: '#17a2b8',
                        fill: false
                    },
                    {
                        label: 'Aspirasi - Pelayanan',
                        data: aspirasi.Pelayanan,
                        borderColor: '#ffc107',
                        fill: false
                    },
                    {
                        label: 'Aspirasi - Fasilitas',
                        data: aspirasi.Fasilitas,
                        borderColor: '#fd7e14',
                        fill: false
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: 'rgb(255,255,255)',
                    bodyFontColor: '#858796',
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: true,
                    position: 'bottom'
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'month'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 12
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        gridLines: {
                            color: 'rgb(234, 236, 244)',
                            zeroLineColor: 'rgb(234, 236, 244)',
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }]
                }
            }
        });
    });
</script>

<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>