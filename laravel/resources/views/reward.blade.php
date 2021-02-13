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
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target=".modal-reward"><i class="fa fa-trophy"></i> Berikan Reward</a>
                    <h2>Riwayat Reward</h2>
                    <table id="dataReward" class="table-border" style="width:100%; margin-top: 20px;">
                        <thead>
                            <tr>
                                <th width="10">No</th>
                                <th>Kode Laporan</th>
                                <th>Nama Agent (No KTP)</th>
                                <th>Nominal Reward</th>
                                <th>Status Reward</th>
                                <th>Tanggal</th>
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

@foreach ($reward as $dta)
@php
$lap = $laporan->where('id', $dta->laporan_id)->first();
$usr = $users->where('id', $dta->agent_id)->first();
@endphp
<!-- MODAL UPDATE -->
<div class="modal modal-detail{{ $dta->id }}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Detail Reward</h4>
            </div>
            <div class="modal-body" style="padding: 20px 50px 0 50px">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item row">
                        <b class="col-sm-4 p-0">Kode Laporan </b>
                        <span class="col-sm-8 p-0">: {{ '#TA'.sprintf('%05s', $dta->laporan_id) }}</span>
                    </li>
                    <li class="list-group-item row">
                        <b class="col-sm-4 p-0">Perihal </b>
                        <span class="col-sm-8 p-0">: {{ $lap->perihal }}</span>
                    </li>
                    <li class="list-group-item row">
                        <b class="col-sm-4 p-0">Tanggal Laporan </b>
                        <span class="col-sm-8 p-0">: {{ date('d/m/Y', strtotime($lap->created_at)) }}</span>
                    </li>
                    <li class="list-group-item row">
                        <b class="col-sm-4 p-0">Tanggal Reward </b>
                        <span class="col-sm-8 p-0">: {{ date('d/m/Y', strtotime($dta->created_at)) }}</span>
                    </li>
                    <li class="list-group-item row">
                        <b class="col-sm-4 p-0">Nama Agent </b>
                        <span class="col-sm-8 p-0">: {{ $usr->name }}</span>
                    </li>
                    <li class="list-group-item row">
                        <b class="col-sm-4 p-0">Nomor KTP </b>
                        <span class="col-sm-8 p-0">: {{ $usr->no_ktp }}</span>
                    </li>
                    <li class="list-group-item row">
                        <b class="col-sm-4 p-0">Email/Telepon </b>
                        <span class="col-sm-8 p-0">: {{ $usr->email }} / {{ $usr->no_telepon }}</span>
                    </li>
                    <li class="list-group-item row">
                        <b class="col-sm-4 p-0">Rekening </b>
                        <span class="col-sm-8 p-0">: {{ $usr->no_rekening }} ({{ $usr->atas_nama }})</span>
                    </li>
                    <li class="list-group-item row">
                        <b class="col-sm-4 p-0">Nama Bank </b>
                        <span class="col-sm-8 p-0">: {{ $usr->nama_bank }}</span>
                    </li>
                    <li class="list-group-item row" id="setMaps">
                        <b class="col-sm-4 p-0">Foto Bukti Transfer </b>
                        <div class="col-sm-12 p-0">
                            <img src="{{ asset('assets/img/foto_bukti/'.$dta->foto_bukti) }}" style="width: 100%; margin-top: 10px;">
                        </div>
                    </li>
                </ul>
            </div>
            <div class="modal-footer row" style="padding: 20px 50px 20px 50px">
                <div class="col-sm-4"></div>
                <div class="col-sm-8">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL UPDATE -->
<div class="modal modal-edt{{ $dta->id }}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Update Status Reward</h4>
            </div>
            <form method="POST" action="{{ url('admin/updatestatusreward') }}">
                @csrf
                <div class="modal-body" style="padding: 20px 50px 0 50px">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kode Laporan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" disabled="" value="{{ '#TA'.sprintf('%05s', $dta->laporan_id) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Agent</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" disabled="" value="{{ $usr->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Status Reward</label>
                        <div class="col-sm-9">
                            <input type="hidden" name="id" value="{{ $dta->id }}">
                            <textarea class="form-control" placeholder="Status Reward..." name="status" rows="4">{{ $dta->status }}</textarea>
                        </div>
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
                Data reward akan di hapus dari database!
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <a href="{{ url('admin/hapusreward/'.$dta->id) }}" role="button" class="btn btn-danger">Hapus</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- MODAL REWARD -->
<div class="modal modal-reward" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                        <label class="col-sm-4 col-form-label">Pilih Laporan</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="getLapId" name="laporan_id" required="">
                                <option value="">--Pilih Laporan--</option>
                                @foreach($laporan->where('status', 'Selesai')->all() as $lap)
                                @if(!$reward->where('laporan_id', $lap->id)->first())
                                <option value="{{ $lap->id }}">{{ '#TA'.sprintf('%05s', $lap->id).' / '.$lap->perihal }}</option>
                                @endif
                                @endforeach
                            </select>
                            <input type="hidden" name="agent_id" id="agent_id">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nama Agent</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" disabled="" id="nama_agent" value="-">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Rekening</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" disabled="" id="rekening" value="-">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nama Bank</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" disabled="" id="nama_bank" value="-">
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
                { data: 'tanggal', name: 'tanggal' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
            });
        }

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

        $('#getLapId').change(function(e) {
            e.preventDefault();
            var laporan_id = $(this).val();

            $.ajax({
                url: "{{ url('/admin/getagentajx') }}",
                method: "GET",
                data: { laporan_id: laporan_id },
                success: function (data) {
                    console.log(data);
                    $('#agent_id').val(data.agent_id);
                    $('#nama_agent').val(data.nama_agent);
                    $('#rekening').val(data.rekening);
                    $('#nama_bank').val(data.nama_bank);
               }
           });
        });

        @isset ($_GET['success'])
        @if ($_GET['success'] == 'update') 
        Swal.fire({
            title: 'Berhasil Diupdate',
            text: 'Status Reward berhasil diupdate!',
            type: 'success'
        }).then(function() {
            window.history.pushState('', '', "{{ url('admin/reward') }}")
        });
        @elseif ($_GET['success'] == 'delete') 
        Swal.fire({
            title: 'Berhasil Dihapus',
            text: 'Data Reward berhasil dihapus!',
            type: 'success'
        }).then(function() {
            window.history.pushState('', '', "{{ url('admin/reward') }}")
        });
        @elseif ($_GET['success'] == 'setreward') 
        Swal.fire({
            title: 'Berhasil Diproses',
            text: 'Reward berhasil dibuat!',
            type: 'success'
        }).then(function() {
            window.history.pushState('', '', "{{ url('admin/reward') }}")
        });
        @endif
        @endisset
    });
</script>
@endsection
