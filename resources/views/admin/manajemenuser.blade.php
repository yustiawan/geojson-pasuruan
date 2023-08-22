@extends('layoutbackend')
@section('pagetitle')
<div class="row">
    <div class="col-5 align-self-center">
        <h4 class="page-title">Manajemen User</h4>
    </div>
    <div class="col-7 align-self-center">
        <div class="d-flex align-items-center justify-content-end">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Admin</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Manajemen User</li>
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
                <div class="row" style="width:100%;overflow: hidden">
                    <div style="float: left;width: 50%">
                        Manajemen User
                    </div>

                </div>


                <div class="table-responsive">
                    <table id="tableuser" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Jenis User</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modalDesa" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                <button onclick="" type="button" class="btn btn-danger waves-effect waves-light">Save changes</button>
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
        $('#tableuser').DataTable();

    })

</script>
@endsection
