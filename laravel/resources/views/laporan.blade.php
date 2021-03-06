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
                    <h2 style="margin-bottom: 20px;">Laporan Masuk</h2>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Tampilkan Data Berdasarkan:</label>
                            <select class="form-control" name="jenis" id="jenis-view">
                                <option value="All">Semua</option>
                                <option value="Agent">Agent</option>
                                <option value="Tanggal">Tanggal</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Pilih Agent Berikut:</label>
                            <select class="form-control select2-opt" name="agent" id="agent-select">
                                <option value="">Pilih Agent</option>
                                @foreach($users as $dta)
                                <option value="{{ $dta->id }}">{{ $dta->name.' ('.$dta->no_ktp.')' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Pilih Tanggal:</label>
                            <input type="date" name="tanggal" class="form-control" id="date-select" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary waves-effect waves-light" style="margin-top: 28px;" id="view-data"><i class="fa fa-search"></i> Tampilkan Data</button>
                        </div>
                    </div>
                    <table id="dataLaporan" class="table-border" style="width:100%; margin-top: 20px;">
                        <thead>
                            <tr>
                                <th width="5"></th>
                                <th width="10">No</th>
                                <th>KD Laporan</th>
                                <th>Nama Agent</th>
                                <th width="200">Perihal</th>
                                <th width="50">Tanggal</th>
                                <th width="150">Status/Progres</th>
                                <th width="50">Aksi</th>
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

<!-- MODAL FOTO -->
<div class="modal modal-foto" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Lampiran Foto Laporan</h4>
            </div>
            <div class="modal-body" id="set-media">
                {{-- @php
                $foto = $media->where('laporan_id', $dta->id)->all();
                @endphp
                @foreach ($foto as $ft)
                <img src="{{ asset('assets/img/laporan/'.$ft->foto) }}" class="img-responsive img-thumbnail" style="width: 100%; margin-bottom: 10px;">
                @endforeach --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@foreach ($laporan as $dta)
@php
$usr = $users->where('id', $dta->id_users)->first();
@endphp
<!-- MODAL UPDATE -->
<div class="modal modal-edt{{ $dta->id }}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Update Progres</h4>
            </div>
            <form method="POST" action="{{ url('admin/updateprogress') }}">
                @csrf
                <div class="modal-body" style="padding: 20px 50px 0 50px">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Perihal</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" disabled="" value="{{ $dta->perihal }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <input type="hidden" name="id" value="{{ $dta->id }}">
                            <select class="form-control this-sts{{ $dta->id }} set-status" required="" data-id="{{ $dta->id }}" name="status">
                                <option value="Laporan Terkirim">Laporan Terkirim</option>
                                <option value="Laporan Diterima">Laporan Diterima</option>
                                <option value="Sedang Ditinjau">Sedang Ditinjau</option>
                                <option value="Selesai">Selesai</option>
                                <option value="Laporan Ditolak">Laporan Ditolak</option>
                            </select>
                        </div>
                        <script type="text/javascript">
                            document.getElementsByClassName('this-sts{{ $dta->id }}')[0].value = '{{ $dta->status }}';
                            
                        </script>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Progres</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="set-progres{{ $dta->id }}" required="" placeholder="Progres..." name="progres" autocomplete="off" value="{{ $dta->progres }}" readonly="">
                        </div>
                        <b style="font-size: 18px;">%</b>
                    </div>
                </div>
                <div class="modal-footer row" style="padding: 20px 50px 20px 50px">
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

<!-- MODAL HAPUS -->
<div class="modal modal-del{{ $dta->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Yakin ingin menghapus?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Agent yang membuat laporan tidak dapat melihat laporan ini lagi!
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <a href="{{ url('admin/hapuslaporan/'.$dta->id) }}" role="button" class="btn btn-danger">Hapus</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL REWARD -->
<div class="modal modal-reward{{ $dta->id }}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Berikan Reward Agent</h4>
            </div>
            <form method="POST" action="{{ url('admin/setreward') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="padding: 20px 50px 0 50px">
                    <div class="form-group row">
                        <input type="hidden" name="agent_id" value="{{ $dta->id_users }}">
                        <input type="hidden" name="laporan_id" value="{{ $dta->id }}">
                        <label class="col-sm-4 col-form-label">Kode Laporan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" disabled="" value="{{ '#TA'.sprintf('%05s', $dta->id) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nama Agent</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" disabled="" value="{{ $usr->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Rekening</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" disabled="" value="{{ $usr->no_rekening }} (an: {{ $usr->atas_nama }})">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nama Bank</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" disabled="" value="{{ $usr->nama_bank }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nominal Reward</label>
                        <div class="input-group col-sm-8" style="padding: 0 15px 0 15px;">
                            <span class="input-group-addon">Rp.</span>
                            <input type="number" class="form-control" name="nominal" placeholder="Nominal Reward...">
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Status Reward</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" placeholder="Status Reward..." name="status" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Bukti Transfer</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control foto_bukti" name="foto_bukti" required="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer row"  style="padding: 20px 50px 20px 50px">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-primary mr-2">Buat Reward</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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
        <div style="margin-bottom: 10px;"><b>Alamat Laporan: </b><span>`+dta.alamat+`</span></div>
        <div style="margin-bottom: 10px;"><b>Email Agent: </b><span>`+dta.email+`</span></div>
        <div style="margin-bottom: 10px;"><b>Telepon Agent: </b><span>`+dta.no_telepon+`</span></div>
        <div style="margin-bottom: 10px;"><b>Status Reward: </b><span>`+dta.status_reward+`</span></div>
        `+dta.btn_reward+`
        <hr>
        </div>`;
    }
    $(document).ready(function($) {
        $('.laporan').addClass('active');

        // GET DATA
        getData('All');
        function getData(jenis='All', agent=null, date=null) {
            $("#dataLaporan").dataTable().fnDestroy();
            var dt = $('#dataLaporan').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'GET',
                    url: "{{ url('/laporan/serverside') }}",
                    data: {
                        req: 'dataLaporan',
                        jenis: jenis,
                        agent: agent,
                        date: date
                    }
                },
                columns: [
                {
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { data: 'no', name: 'no' },
                { data: 'kd_laporan', name: 'kd_laporan' },
                { data: 'nama', name: 'nama' },
                { data: 'perihal', name: 'perihal' },
                { data: 'tanggal', name: 'tanggal' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                order: [[1, 'asc']]
            });

            // Array to track the ids of the details displayed rows
            var detailRows = [];

            $('#dataLaporan tbody').on( 'click', 'tr td.details-control', function () {
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

        $('#agent-select').parents('.form-group').hide();
        $('#date-select').parents('.form-group').hide();
        $('#jenis-view').change(function(e) {
            e.preventDefault();
            var value = $(this).val();

            if (value == 'All') {
                $('#agent-select').parents('.form-group').hide();
                $('#date-select').parents('.form-group').hide();
            } else if (value == 'Agent') {
                $('#agent-select').val('');
                $('#agent-select').parents('.form-group').show();
                $('#date-select').parents('.form-group').hide();
                $('.select2-opt').select2({
                    placeholder: 'Pilih Agent'
                });
            } else if (value == 'Tanggal') {
                $('#date-select').val('');
                $('#agent-select').parents('.form-group').hide();
                $('#date-select').parents('.form-group').show();
            }
        });

        $('#view-data').click(function(e) {
            e.preventDefault();

            var jenis = $('#jenis-view').val();
            var agent = $('#agent-select').val();
            var date = $('#date-select').val();

            getData(jenis, agent, date);
        });

        $('.set-status').change(function(e) {
            e.preventDefault();

            var value = $(this).val();
            var id = $(this).attr('data-id');

            if (value == 'Laporan Terkirim') $('#set-progres'+id).val('20');
            else if (value == 'Laporan Diterima') $('#set-progres'+id).val('50');
            else if (value == 'Sedang Ditinjau') $('#set-progres'+id).val('75');
            else if (value == 'Selesai') $('#set-progres'+id).val('100');
            else if (value == 'Laporan Ditolak') $('#set-progres'+id).val('100');
        });

        $(document).on('click', '#view-media', function(e) {
            e.preventDefault();

            $('#set-media').html('');
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{ url('admin/getmedia') }}/"+id,
                method: "GET",
                success: function (data) {
                    $('#set-media').html(data);
                }
            });
        });

        $('.foto_bukti').change(function(e) {
            var media = $(this).prop('files')[0];
            var check = 0;
            var ext = ['image/jpeg', 'image/png', 'image/bmp'];

            $.each(ext, function(key, val) {
                if (media.type == val) check = check + 1;
            });

            if (check == 0) {
                Swal.fire({
                    title: 'File Tidak Didukung',
                    text: 'Masukkan file yang bertipe foto!',
                    type: 'warning'
                });
                $(this).val('');
            }
        });

        $(document).on('click', '.btn-reward', function() {
            var action = $(this).attr('data-action');

            if(action == 'inProgres') {
                Swal.fire({
                    title: 'Selesaikan Laporan',
                    text: 'Laporan masih dalam progres. Selesaikan terlebih dahulu!',
                    type: 'warning'
                });
            } else if(action == 'rewardDone') {
                Swal.fire({
                    title: 'Reward Telah Diberikan',
                    text: 'Reward telah diberikan untuk laporan ini!',
                    type: 'info'
                });
            }
        });

        @isset ($_GET['success'])
        @if ($_GET['success'] == 'update') 
        Swal.fire({
            title: 'Berhasil Diupdate',
            text: 'Progres telah berhasil diupdate!',
            type: 'success'
        }).then(function() {
            window.history.pushState('', '', "{{ url('admin/laporan') }}")
        });
        @elseif ($_GET['success'] == 'delete') 
        Swal.fire({
            title: 'Berhasil Dihapus',
            text: 'Laporan telah berhasil dihapus!',
            type: 'success'
        }).then(function() {
            window.history.pushState('', '', "{{ url('admin/laporan') }}")
        });
        @elseif ($_GET['success'] == 'setreward') 
        Swal.fire({
            title: 'Berhasil Diproses',
            text: 'Reward berhasil dibuat!',
            type: 'success'
        }).then(function() {
            location.href = "{{ url('admin/reward') }}";
        });
        @endif
        @endisset
    });
</script>
@endsection
