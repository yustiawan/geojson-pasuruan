@extends('layout')
@section('content')
<div class="container mt-5">
    <div class="row ">
        <div style="width: 80%; margin: auto;">
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <div class="row ">
        <div class="col-xs-12">
            <table id="tabledesa" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th></th>
                    <th>Desa</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>NIK</th>
                    <th>Penerima <br>BPNT</th>
                    <th>Penerima <br>BPUM</th>
                    <th>Penerima <br>BST</th>
                    <th>Penerima <br>PKH</th>
                    <th>Penerima <br>SEMBAKO</th>
                    <th>Rekomendasi Sekda</th>
                    <th>Tanggal</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalloading" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Please Wait...</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: center">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scriptheader')
<link href="{{ url('NiceAdminMaster') }}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
<style>
    .jml{
        font-weight: bold;
    }
    .dataTables_wrapper {
        font-size: 10px;
    }
    td.details-control {
        /* Image in the first column to
            indicate expand*/
        background: url('more.png')
        no-repeat center;

        cursor: pointer;
    }

    tr.shown td.details-control {
        background: url('expand-arrow.png')
        no-repeat center;
    }
</style>
@endsection
@section('scriptfooter')
<script src="{{ url('NiceAdminMaster') }}/assets/libs/jquery/dist/jquery.min.js "></script>
<script src="{{ url('NiceAdminMaster') }}/assets/extra-libs/DataTables/datatables.min.js"></script>
<script>
        var dataLabels=@json($namadesa);
        var dataJumlah=@json($jmlpendudukmiskindesa);
        var dataId=@json($iddesa);
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
                    },
                    subtitle: {
                        display: true,
                        text: 'Klik Bar Untuk Menampilkan Detail Data',
                        position:'bottom',
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
            showData(dataId[res[0].index])

        };
        $('#tabledesa').DataTable({

        });
        $('#tabledesa tbody').on('click',
            'td.details-control', function () {

                var tr = $(this).closest('tr');
                var row = $('#tabledesa').DataTable().row(tr);

                if (row.child.isShown()) {
                    // Closing the already opened row
                    row.child.hide();
                    // Removing class to hide
                    tr.removeClass('shown');
                }
                else {
                    // Show the child row for detail
                    // information
                    row.child(getChildRow(row.data())).show();
                    // To show details,add the below class
                    tr.addClass('shown');
                }
            });
        /* Function for child row details*/
        function getChildRow(data) {

            // `data` is the data object for the row
            return '<table cellpadding="5" cellspacing="0"'
                + ' style="padding-left:50px;">' +
                '<tr>' +
                '<td>Kepemilikan Rumah </td>' +
                '<td>: ' + data.kepemilikanrumah + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Memiliki Simpanan Uang/Perhiasan/Ternak/Lainnya </td>' +
                '<td>: ' + data.ispunyasimpanan + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Jenis Atap </td>' +
                '<td>: ' + data.namajenisatap + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Jenis Dinding </td>' +
                '<td>: ' + data.namajenisdinding + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Jenis Lantai </td>' +
                '<td>: ' + data.namajenislantai + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Sumber Penerangan </td>' +
                '<td>: ' + data.namajenissumberpenerangan + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Bahan Bakar Memasak</td>' +
                '<td>: ' + data.namabahanbakarmasak + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Sumber Air Minum </td>' +
                '<td>: ' + data.namasumberminum + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Memiliki Fasilitas Buang Air Besar </td>' +
                '<td>: ' + data.namastatuskepemilikan + '</td>' +
                '</tr>' +
                '</table>';
        }
        function showData(iddesa){
            $('#tabledesa').DataTable().destroy();
            $('#tabledesa').DataTable({
                "processing": true,
                "serverSide": true,
                "columns": [{
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
                    { "data": "desa" },
                    { "data": "nama" },
                    { "data": "alamat" },
                    { "data": "nik" },
                    { "data": "bpnt" ,"render":function(data, type, row, meta){
                        if(data=='1'){
                            return 'YA'
                        }else{
                            return 'TIDAK'
                        }
                        }},
                    { "data": "bpum","render":function(data, type, row, meta){
                            if(data=='1'){
                                return 'YA'
                            }else{
                                return 'TIDAK'
                            }
                        } },
                    { "data": "bst","render":function(data, type, row, meta){
                            if(data=='1'){
                                return 'YA'
                            }else{
                                return 'TIDAK'
                            }
                        } },
                    { "data": "pkh","render":function(data, type, row, meta){
                            if(data=='1'){
                                return 'YA'
                            }else{
                                return 'TIDAK'
                            }
                        } },
                    { "data": "sembako","render":function(data, type, row, meta){
                            if(data=='1'){
                                return 'YA'
                            }else{
                                return 'TIDAK'
                            }
                        } },
                    { "data": "rekomendasi" },
                    { "data": "tgl" }
                ],
                "ajax":{
                    "url": "{{ url('admin/getdatakemiskikanbydesa') }}",
                    "dataType": "json",
                    "type": "POST",
                    data: function (d) {
                        d.iddesa=iddesa
                    },
                    beforeSend: function(req) {

                        var csrfToken = '{{ csrf_token() }}'
                        req.setRequestHeader("X-CSRF-Token", csrfToken)
                    },
                    complete:function(){

                    }

                }

            });
        }
</script>

@endsection
