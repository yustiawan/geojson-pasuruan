@extends('layoutbackend')
@section('pagetitle')
<div class="row">
    <div class="col-5 align-self-center">
        <h4 class="page-title">Data Desa/Kelurahan</h4>
    </div>
    <div class="col-7 align-self-center">
        <div class="d-flex align-items-center justify-content-end">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Administrasi</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data Desa/Kelurahan</li>
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
                <button id="btnadddesa" class="btn btn-sm btn-primary" type="button" style="margin-bottom: 10px"><i class="fa fa-plus"></i> Tambah Data Kelurahan</button>

                <div class="table-responsive">
                    <table id="tabledesa" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Nama Desa</th>
                            <th>Nama Kecamatan</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($desa as $d)
                        <tr>
                            <td>{{ $d->nama_desa }}</td>
                            <td>{{ $d->nama_kecamatan }}</td>
                            <td><button onclick="showdesa('{{ Crypt::encryptString($d->iddesa) }}','{{ Crypt::encryptString($d->idkecamatan) }}','{{ $d->nama_desa }}','{{ $d->nama_kecamatan }}')" type="button" class="btn btn-sm btn-primary">Edit</button>&nbsp;&nbsp;<button onclick="hapusDesa('{{ Crypt::encryptString($d->iddesa) }}')" type="button" class="btn btn-sm btn-danger">Hapus</button></td>
                        </tr>
                        @endforeach
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
                <form id="formdesa" method="post" action="">
                    @csrf
                    <input type="hidden" name="iddesa" id="iddesa">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Nama Kecamatan:</label>
                        <select class="form-control" id="idkecamatan" name="idkecamatan">
                            @foreach($kecamatan as $k)
                                <option value="{{ Crypt::encryptString($k->id) }}">{{ $k->nama_kecamatan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Nama Desa:</label>
                        <input type="text" class="form-control" id="nama_desa" name="nama_desa">
                    </div>

                </form>
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
        $('#tabledesa').DataTable();
        $('#btnadddesa').click(function(){
            $('#iddesa').val('')
            $('#nama_kecamatan').val('')
            $("#formdesa").attr("action", "{{ url('admin/createdesa') }}");
            $('#modalDesa').modal('show')
        })
    })
    function showdesa(iddesa,idkecamatan,namadesa,namakecamatan){
        $('#iddesa').val(iddesa)
        var selectedOption = $("#idkecamatan option:contains('" + namakecamatan + "')");
        // Hapus atribut selected dari semua opsi
        $("#idkecamatan option").removeAttr("selected");
        // Tandai opsi yang ditemukan sebagai pilihan yang dipilih (selected)
        selectedOption.prop("selected", true);

        $('#nama_desa').val(namadesa)
        $("#formdesa").attr("action", "{{ url('admin/updatedesa') }}");
        $('#modalDesa').modal('show')
    }
    function validateFormDesa(){
        if($('#nama_desa').val()===''){
            alert('Nama desa tidak boleh kosong !')
            return false
        }
        if(confirm('Simpan Form ?')){
            $("#formdesa").submit();
        }

    }
    function hapusDesa(id){
        $('#iddesa').val(id)
        if(confirm('Hapus data ?')){
            $("#formdesa").attr("action", "{{ url('admin/hapusdesa') }}");
            $("#formdesa").submit();
        }
    }
</script>
@endsection
