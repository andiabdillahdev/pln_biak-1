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
                    <div class="row">
                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-users"></i></span>
                                <p>
                                    <span class="number">{{ $data['agent'] }}</span>
                                    <span class="title">Agent</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-file-text"></i></span>
                                <p>
                                    <span class="number">{{ $data['total_laporan'] }}</span>
                                    <span class="title">Total Laporan</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-eye"></i></span>
                                <p>
                                    <span class="number">{{ $data['laporan_new'] }}</span>
                                    <span class="title">Belum Ditinjau</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-calendar-plus-o"></i></span>
                                <p>
                                    <span class="number">{{ $data['laporan_thisday'] }}</span>
                                    <span class="title">Laporan Hari Ini</span>
                                </p>
                            </div>
                        </div>
                    </div>

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
        $('.home-das').addClass('active');
    });
</script>
@endsection
