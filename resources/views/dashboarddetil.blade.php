@extends('layout')
@section('content')
<div class="container mt-5">
    <div class="row ">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Penerima BPNT</h5>
                    <p class="card-text">Kabupaten Pasuruan</p>
                    <p class="card-text font-weight-bold jml">{{ @$jbpnt==''?'0':$jbpnt }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3" >
            <div class="card" >
                <div class="card-body text-center">
                    <h5 class="card-title" style="color:red">Penerima BPUM</h5>
                    <p class="card-text">Kabupaten Pasuruan</p>
                    <p class="card-text font-weight-bold jml" style="color:red">{{ @$jbpum==''?'0':$jbpum }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color:yellow">Penerima PKH</h5>
                    <p class="card-text">Kabupaten Pasuruan</p>
                    <p class="card-text font-weight-bold jml" style="color:yellow">{{ @$jpkh==''?'0':$jpkh }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color:dodgerblue">Penerima BST</h5>
                    <p class="card-text">Kabupaten Pasuruan</p>
                    <p class="card-text font-weight-bold jml" style="color:dodgerblue">{{ @$jbst==''?'0':$jbst }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color:limegreen">Penerima SEMBAKO</h5>
                    <p class="card-text">Kabupaten Pasuruan</p>
                    <p class="card-text font-weight-bold jml" style="color:limegreen">{{ @$jsembako==''?'0':$jsembako }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Sasaran</h5>
                    <p class="card-text">Kabupaten Pasuruan</p>
                    <p class="card-text font-weight-bold jml">{{ @$jall==''?'0':$jall }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <canvas id="myChart2"></canvas>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div style="width: 40%; margin: auto;">
                <canvas id="myPieChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptheader')
<style>
    .jml{
        font-weight: bold;
    }
</style>
@endsection
@section('scriptfooter')
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($kecamatan['label']),
            datasets: [{
                label: 'Nilai',
                data: @json($kecamatan['nilai']),
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'JUMLAH KEMISKINAN EKSTREM KABUPATEN PASURUAN',
                    font: {
                        size: 18
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                },
                x: {
                    ticks: {
                        autoSkip: false, // Untuk memastikan semua label ditampilkan
                        maxRotation: 45, // Atur rotasi maksimum (dalam derajat)
                        minRotation: 45 // Atur rotasi minimum (dalam derajat)
                    }
                }
            }
        }
    });


    // Inisialisasi bar chart
    var ctx = document.getElementById('myChart2').getContext('2d');
    var myChart2 = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($kecamatan['label']),
            datasets: [{
                label: 'Laki-laki',
                data: @json($kecamatan['laki']),
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Perempuan',
                data: @json($kecamatan['perempuan']),
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {

            plugins: {
                title: {
                    display: true,
                    text: 'JUMLAH KEMISKINAN EKSTREM KABUPATEN PASURUAN DALAM PERBANDINGAN LAKI-LAKI DAN PEREMPUAN',
                    font: {
                        size: 18
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });


    // Warna untuk setiap bagian pie chart
    var colors = [
        'rgba(255, 99, 132, 0.5)',
        'rgba(54, 162, 235, 0.5)',
        'rgba(255, 206, 86, 0.5)',
        'rgba(75, 192, 192, 0.5)',
        'rgba(153, 102, 255, 0.5)',
        'rgba(255, 159, 64, 0.5)',
        'rgba(255, 77, 166, 0.5)',
        'rgba(75, 159, 64, 0.5)',
        'rgba(100, 102, 90, 0.5)'
    ];

    // Inisialisasi pie chart
    var ctx = document.getElementById('myPieChart').getContext('2d');
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: @json($jeniskerja),
            datasets: [{
                data: @json($jumlahjeniskerja),
                backgroundColor: colors,
                borderColor: colors,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins:{
                legend: {
                    position: 'right',
                },
                title: {
                    display: true,
                    text: 'Jenis Pekerjaan', // Your desired title here
                    fontSize: 20, // Optional font size for the title
                    padding: {
                        top: 10, // Optional padding for the title
                        bottom: 20 // Optional padding for the title
                    }
                },
                tooltip:{
                    callbacks: {
                        label: function(context) {
                            let total = 0;
                            // Calculate the total of all data points
                            context.dataset.data.forEach(function (value) {
                                total += value;
                            });
                            percent=Math.ceil((context.parsed/total)*100)


                            return percent + '%'
                        }
                    }
                }
            }

        }
    });
</script>

@endsection
