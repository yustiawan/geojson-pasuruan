<?php
?>
<script>
    $(function(){
        var map = L.map('map').setView([-7.6839, 112.8255], 10);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(map);


            @foreach($sumKecamatan as $kec)
            fetch('{{ url('storage/pasuruan/'.$kec['filegeojson']) }}')
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    var gg=L.geoJSON(data, {
                        style: function(feature) {
                            return {
                                color: '{{ $kec['warna'] }}',
                                weight: 2,
                            };
                        },
                        onEachFeature: function(feature, layer) {
                            var tb='<table class="table-sum" style="width:250px;font-size:13px;">'
                            tb+='<tr><td colspan="3" style="height: 40px;font-weight: bold">Kecamatan '+'{{ $kec['namakecamatan'] }}'+'</td></tr>'
                            tb+='<tr><td class="kolom-kiri kolom-warna" style="width:170px;height: 30px;"">Penerima BPNT</td><td></td><td style="width:70px;" class="kolom-kanan kolom-warna">{{ $kec['bpnt'] }}</td></tr>'
                            tb+='<tr><td style="height: 30px">Penerima BPUM</td><td></td><td class="kolom-kanan">{{ $kec['bpum'] }}</td></tr>'
                            tb+='<tr><td class="kolom-warna" style="height: 30px">Penerima BST</td><td></td><td class="kolom-kanan kolom-warna">{{ $kec['bst'] }}</td></tr>'
                            tb+='<tr><td style="height: 30px">Penerima PKH</td><td></td><td class="kolom-kanan">{{ $kec['pkh'] }}</td></tr>'
                            tb+='<tr><td class="kolom-warna" style="height: 30px">Penerima Sembako</td><td></td><td class="kolom-kanan kolom-warna">{{ $kec['sembako'] }}</td></tr>'
                            tb+='<tr><td style="height: 30px">Jumlah Desa</td><td></td><td class="kolom-kanan">{{ $kec['jmldesa'] }}</td></tr>'
                            tb+='<tr><td colspan="3" ><button onclick="showDetailKecamatan(\'{{ Crypt::encryptString($kec['idkecamatan']) }}\')" class="btn btn-sm btn-success" style="width:100%">Lihat Perkembangan Data</button></td></tr>'
                            tb+='</table>'
                            layer.bindPopup(tb);
                        }
                    }).addTo(map);
                    // Tambahkan event "on click" pada marker
                    gg.on('click', function(event) {

                    });
                });
            @endforeach
    })


    function muncul(){
        $("#exampleModal").modal('show');
    }
    function showDetailKecamatan(idkecamatan){
        if(idkecamatan!==''){
            $('#idkecamatan').val(idkecamatan)
            $('#frmdetailkecamatan').attr('action','{{ url('admin/detailkecamatan') }}')
            $('#frmdetailkecamatan').submit()
        }
    }
</script>
