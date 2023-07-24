@extends('layout')
@section('content')
<div class="container mt-5">
    <div class="row ">
        <div style="width: 80%; margin: auto;">
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <div class="row ">
        <div class="col-xs-3">

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
        var dataLabels=@json($namadesa);
        var dataJumlah=@json($jmlpendudukmiskindesa);
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dataLabels,
                datasets: [{
                    label: 'Total Penduduk Miskin',
                    data: dataJumlah,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'JUMLAH KEMISKINAN EKSTREM KECAMATAN {{ $namakecamatan }}',
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
        // Make sure to attach `onclick` to the canvas, **not** the chart instance
        canvas=document.getElementById('myChart')
        canvas.onclick = (evt) => {
            const res = myChart.getElementsAtEventForMode(
                evt,
                'nearest',
                { intersect: true },
                true
            );
            // If didn't click on a bar, `res` will be an empty array
            if (res.length === 0) {
                return;
            }
            // Alerts "You clicked on A" if you click the "A" chart
            alert('You clicked on ' + myChart.data.labels[res[0].index]);
            console.log(res[0].index)
        };
</script>

@endsection
