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
                    <a href="#" class="btn btn-primary"><i class="fa fa-trophy"></i> Berikan Reward</a>
                    <h2>Riwayat Reward</h2>
                    <table id="dataReward" class="table-border" style="width:100%; margin-top: 20px;">
                        <thead>
                            <tr>
                                <th width="10">No</th>
                                <th>Kode Laporan</th>
                                <th>Nama Agent (No KTP)</th>
                                <th>Nominal Reward</th>
                                <th>Status Reward</th>
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


<!-- END MAIN -->
<div class="clearfix"></div>
@endsection
@section('js')
<script>
    $(document).ready(function($) {
        $('.reward').addClass('active');

        // GET DATA
        getData();
        function getData() {
            $("#dataReward").dataTable().fnDestroy();
            var dt = $('#dataReward').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('/laporan/serverside?req=dataReward') }}",
                columns: [
                { data: 'no', name: 'no' },
                { data: 'kd_laporan', name: 'kd_laporan' },
                { data: 'nama_agent', name: 'nama_agent' },
                { data: 'nominal', name: 'nominal' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
            });
        }

        @isset ($_GET['success'])
        Swal.fire({
            title: 'Berhasil Diproses',
            text: 'Reward berhasil dibuat!',
            type: 'success'
        }).then(function() {
            window.history.pushState('', '', "{{ url('admin/reward') }}")
        });
        @endisset
    });
</script>
@endsection
