@extends('layoutbackend')
@section('contentbackend')
<div class="row">
    @if (session('success'))
    <div class="col-12">
        <!-- Alert with content -->
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            <h3 class="text-success"><i class="fa fa-check-circle"></i> {{ session('success') }}</h3>
        </div>
    </div>
    @endif
    @if (session('error'))
    <div class="col-12">
        <!-- Alert with content -->
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            <h3 class="text-danger"><i class="fa fa-check-circle"></i> {{ session('error') }}</h3>
        </div>
    </div>
    @endif
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Desa/Kelurahan</h4>

                <div class="table-responsive">
                    <table id="tablesettingmap" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Nama Kecamatan</th>
                            <th>File Geojson</th>
                            <th>Penanda Warna</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($dataconfig as $c)
                                <tr>
                                    <td>{{ $c->nama_kecamatan }}</td>
                                    @if (Storage::disk('public')->exists('pasuruan/'.$c->filegeojson))
                                        <td>{{ $c->filegeojson }}</td>
                                    @else
                                        <td>{{ $c->filegeojson }}</td>
                                    @endif
                                    @if(@$c->warna!='')
                                        <td><div style="width: 80px;height: 20px; background-color:{{ $c->warna }} "></div></td>
                                    @else
                                        <td></td>
                                    @endif

                                    @php
                                        $idconfig=@$c->idconfig==''?'':Crypt::encryptString($c->idconfig);
                                    @endphp
                                    <td><button onclick="showModalConfig('{{ $idconfig }}','{{ Crypt::encryptString($c->idkecamatan) }}','{{ $c->nama_kecamatan }}','{{ $c->filegeojson }}','{{ @$c->warna }}')" type="button" class="btn btn-sm btn-primary">Setting Config</button></td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modalConfig" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Data Desa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="formconfig" method="post" action="{{ url('admin/savesettingmap') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="idconfig" id="idconfig">
                    <input type="hidden" name="idkecamatan" id="idkecamatan">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Nama Kecamatan:</label>
                        <input readonly="readonly" type="text" class="form-control" id="nama_kecamatan" name="nama_kecamatan">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">File geojson:</label>
                        @if(@$c->filegeojson!='')
                            <input type="text" class="form-control" id="nama_kecamatan" name="nama_kecamatan">
                        @else
                            <input type="file" class="form-control" id="filegeojson" name="filegeojson">

                        @endif

                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Warna Map:</label>
                        <input type="color" class="form-control" id="warna" name="warna" value="{{ @$c->warna }}">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button onclick="validateFormConfig()" type="button" class="btn btn-danger waves-effect waves-light">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptheader')
<link href="{{ url('NiceAdminMaster') }}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
@endsection
@section('scriptfooter')
<script src="{{ url('NiceAdminMaster') }}/assets/extra-libs/DataTables/datatables.min.js"></script>
<script>
    $(function(){
        $('#tablesettingmap').DataTable();
    })
    function showModalConfig(idconfig,idkecamatan,namakecamatan,filegeojson,warna){
        $('#idconfig').val(idconfig)
        $('#idkecamatan').val(idkecamatan)
        $('#nama_kecamatan').val(namakecamatan)
        $('#modalConfig').modal('show')
    }
    function validateFormConfig(){
        if($('idconfig').val()!==''){
            // Mengambil nilai input file
            var fileInput = $('#filegeojson')[0];
            var files = fileInput.files;

            // Mengecek apakah tidak ada file yang dipilih
            if (files.length === 0) {
                alert('Anda harus memilih file sebelum mengunggah.');
                return;
            }
        }

        if($('#warna').val()===''){
            alert('setting warna tidak boleh kosong !')
            return false
        }
        if(confirm('Simpan Form ?')){
            $("#formconfig").submit();
        }

    }

</script>
@endsection
