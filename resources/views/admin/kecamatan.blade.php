@extends('layoutbackend')
@section('pagetitle')
<div class="row">
    <div class="col-5 align-self-center">
        <h4 class="page-title">Data Kecamatan</h4>
    </div>
    <div class="col-7 align-self-center">
        <div class="d-flex align-items-center justify-content-end">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Administrasi</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data Kecamatan</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection
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
            <button id="btnaddkecamatan" class="btn btn-sm btn-primary" type="button" style="margin-bottom: 10px"><i class="fa fa-plus"></i> Tambah Data Kecamatan</button>

            <div class="table-responsive">
                <table id="tablekecamatan" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Nama Kecamatan</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($kecamatan as $k)
                        <tr><td>{{ $k->nama_kecamatan }}</td><td><button onclick="showKecamatan('{{ Crypt::encryptString($k->id) }}','{{ $k->nama_kecamatan }}')" type="button" class="btn btn-sm btn-primary">Edit</button>&nbsp;&nbsp;<button onclick="hapusKecamatan('{{ Crypt::encryptString($k->id) }}')" type="button" class="btn btn-sm btn-danger">Hapus</button></td></tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
</div>
<div id="modalKecamatan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Data Kecamatan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="formkecamatan" method="post" action="">
                    @csrf
                    <input type="hidden" name="idkecamatan" id="idkecamatan">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Nama Kecamatan:</label>
                        <input type="text" class="form-control" id="nama_kecamatan" name="nama_kecamatan">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button onclick="validateFormKecamatan()" type="button" class="btn btn-danger waves-effect waves-light">Save changes</button>
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
        $('#tablekecamatan').DataTable();
        $('#btnaddkecamatan').click(function(){
            $('#idkecamatan').val('')
            $('#nama_kecamatan').val('')
            $("#formkecamatan").attr("action", "{{ url('admin/createkecamatan') }}");
            $('#modalKecamatan').modal('show')
        })
    })

    function showKecamatan(id,nama){
        $('#idkecamatan').val(id)
        $('#nama_kecamatan').val(nama)
        $("#formkecamatan").attr("action", "{{ url('admin/updatekecamatan') }}");
        $('#modalKecamatan').modal('show')
    }
    function validateFormKecamatan(){
        if($('#nama_kecamatan').val()===''){
            alert('Nama kecamatan tidak boleh kosong !')
            return false
        }
        if(confirm('Simpan Form ?')){
            $("#formkecamatan").submit();
        }

    }
    function hapusKecamatan(id){
        $('#idkecamatan').val(id)
        if(confirm('Hapus data ?')){
            $("#formkecamatan").attr("action", "{{ url('admin/hapuskecamatan') }}");
            $("#formkecamatan").submit();
        }
    }
</script>
@endsection
