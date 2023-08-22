@extends('layoutbackend')
@section('pagetitle')
<div class="row">
    <div class="col-5 align-self-center">
        <h4 class="page-title">Data Organisasi Perangkat Daerah</h4>
    </div>
    <div class="col-7 align-self-center">
        <div class="d-flex align-items-center justify-content-end">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Administrasi</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data Organisasi Perangkat Daerah</li>
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
                <button id="btnaddopd" class="btn btn-sm btn-primary" type="button" style="margin-bottom: 10px"><i class="fa fa-plus"></i> Tambah Data OPD</button>

                <div class="table-responsive">
                    <table id="tableopd" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Nama OPD</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($opd as $o)
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modalOpd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Data Desa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button onclick="validateFormDesa()" type="button" class="btn btn-danger waves-effect waves-light">Save changes</button>
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
        $('#tableopd').DataTable();
        $('#btnaddopd').click(function(){
            $('#modalOpd').modal('show')
        })
    })

</script>
@endsection
