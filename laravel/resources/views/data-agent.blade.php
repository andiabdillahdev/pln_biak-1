@extends('layouts.layouts')

@section('content')
<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <!-- OVERVIEW -->
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">PT PLN (PERSERO) UP3 BIAK</h3>
                    <p class="panel-subtitle">{{ date('l, d-m-Y') }}</p>
                </div>
                <div class="panel-body">
                    <h2>Data Agent</h2>
                    <table id="dataAgent" class="table-border" style="width:100%; margin-top: 20px;">
                        <thead>
                            <tr>
                                <th width="10">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th width="100">Tanggal Daftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>

@foreach ($agent as $dta)
<!-- MODAL FOTO -->
<div class="modal modal-foto{{ $dta->id }}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Update Password</h4>
            </div>
            <form method="POST" action="{{ url('admin/updatepassword') }}">
                @csrf
                <div class="modal-body" style="padding: 20px 50px 0 50px">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control m-b-5" disabled="" value="{{ $dta->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control m-b-5" disabled="" value="{{ $dta->email }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Password Baru</label>
                        <div class="col-sm-9">
                            <input type="hidden" name="id" value="{{ $dta->id }}">
                            <input type="text" class="form-control m-b-5" id="password" placeholder="Password Baru..." name="password" autocomplete="off" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach


<!-- END MAIN -->
<div class="clearfix"></div>
@endsection
@section('js')
<script>
    $(document).ready(function($) {
        $('.data-agent').addClass('active');

        // GET DATA
        getData();
        function getData() {
            $("#dataAgent").dataTable().fnDestroy();
            var dt = $('#dataAgent').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('/laporan/serverside?req=dataAgent') }}",
                columns: [
                { data: 'no', name: 'no' },
                { data: 'nama', name: 'nama' },
                { data: 'email', name: 'email' },
                { data: 'tggl_daftar', name: 'tggl_daftar' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        }

        @isset ($_GET['success'])
        Swal.fire({
            title: 'Berhasil Diupdate',
            text: 'Password telah berhasil diupdate!',
            type: 'success'
        }).then(function() {
            window.history.pushState('', '', "{{ url('admin/data-agent') }}")
        });
        @endisset
    });
</script>
@endsection
