@extends('layouts.layouts')

@section('content')
<!-- MAIN -->
<style type="text/css">
    td.details-control {
        background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
        cursor: pointer;
    }
    tr.details td.details-control {
        background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
    }
</style>
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
                                <th width="5"></th>
                                <th width="10">No</th>
                                <th>Nama</th>
                                <th>Nomor KTP</th>
                                <th>Telepon</th>
                                <th>Status</th>
                                <th width="200">Aksi</th>
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
<!-- MODAL AGENT -->
<div class="modal modal-foto{{ $dta->id }}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Update Password</h4>
            </div>
            <form method="POST" action="{{ url('admin/updateakunagent') }}">
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
                        <label class="col-sm-3 col-form-label">Status Akun</label>
                        <div class="col-sm-9">
                            @php $status = ['Active', 'Suspend'] @endphp
                            <select class="form-control m-b-5" name="status">
                                @foreach($status as $sts)
                                <option value="{{ $sts }}" <?php if($dta->status == $sts) echo "selected"; ?>>{{ $sts }}</option>
                                @endforeach
                            </select>
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
    function format (dta) {
        return `<div style="margin-left: 40px;">
        <div style="margin-bottom: 10px;"><b>Email: </b><span>`+dta.email+`</span></div>
        <div style="margin-bottom: 10px;"><b>Rekening: </b><span>`+dta.no_rekening+` (`+dta.atas_nama+`)</span></div>
        <div style="margin-bottom: 10px;"><b>Nama Bank: </b><span>`+dta.nama_bank+`</span></div>
        <div style="margin-bottom: 10px;"><b>Tanggal Daftar: </b><span>`+dta.tggl_daftar+`</span></div>
        <hr>
        </div>`;
    }

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
                {
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { data: 'no', name: 'no' },
                { data: 'nama', name: 'nama' },
                { data: 'no_ktp', name: 'no_ktp' },
                { data: 'no_telepon', name: 'no_telepon' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                order: [[1, 'asc']]
            });

            // Array to track the ids of the details displayed rows
            var detailRows = [];

            $('#dataAgent tbody').on( 'click', 'tr td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = dt.row( tr );
                var idx = $.inArray( tr.attr('id'), detailRows );

                if ( row.child.isShown() ) {
                    tr.removeClass( 'details' );
                    row.child.hide();

                    // Remove from the 'open' array
                    detailRows.splice( idx, 1 );
                }
                else {
                    tr.addClass( 'details' );
                    row.child( format( row.data() ) ).show();

                    // Add to the 'open' array
                    if ( idx === -1 ) {
                        detailRows.push( tr.attr('id') );
                    }
                }
            } );

            // On each draw, loop over the `detailRows` array and show any child rows
            dt.on( 'draw', function () {
                $.each( detailRows, function ( i, id ) {
                    $('#'+id+' td.details-control').trigger( 'click' );
                } );
            } );
        }

        @isset ($_GET['success'])
        Swal.fire({
            title: 'Berhasil Diupdate',
            text: 'Akun agent berhasil diupdate!',
            type: 'success'
        }).then(function() {
            window.history.pushState('', '', "{{ url('admin/data-agent') }}")
        });
        @endisset
    });
</script>
@endsection
