<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="host_url" content="{{ url('/') }}">
  <title>PT PLN (PERSERO) UP3 BIAK</title>
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/img/favicon.png') }}">

  <link rel="stylesheet" href="{{ asset('landing/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/icofont/icofont.min.css') }}">
  <link rel="stylesheet" href="{{ asset('landing/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/dropzone/min/basic.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/dropzone/min/dropzone.min.css') }}">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/bootstrap-select/dist/css/bootstrap-select.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
</head>
<body>
  <nav class="navbar navbar-expand-lg" id="header">

    <div class="container">
      <a class="navbar-brand" href="#">
        <div class="title_apps">PT. PLN (PERSERO) UP3 BIAK</div>
      </a>


      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="btn_toogler_icon"></span>
        <span class="btn_toogler_icon"></span>
        <span class="btn_toogler_icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Top Agent <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Sub Halaman</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Sub Halaman</a>
          </li>
          @if (Auth::user() && Auth::user()->role != 'admin')
          <li class="nav-item">
            <button type="button" class="btnx btnx-custom" style="width: auto;" data-toggle="modal" data-target=".modal-updtakn"><i class="fa fa-user"></i>&nbsp; {{ Auth::user()->name }}</button>
            <a href="{{ route('agent.logout') }}" class="ml-3" style="color: aliceblue"><i class="icofont-logout"></i> Logout</a>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link" onclick="red_login()" href="#"><i class="fa fa-user"></i> Login</a>
          </li>
          @endif
          
        </ul>
        <form class="form-inline grid_form_inline my-2 my-lg-0">
          @if (Auth::user() && Auth::user()->role != 'admin')
          <button type="button" class="btnx btnx-custom" style="width: auto;" data-toggle="modal" data-target=".modal-updtakn"><i class="fa fa-user"></i>&nbsp; {{ Auth::user()->name }}</button>
          <a href="{{ route('agent.logout') }}" class="ml-3" style="color: aliceblue"><i class="icofont-logout"></i> Logout</a>
          @else
          <button type="button" onclick="red_login()" class="btnx btnx-custom"><i class="fa fa-user"></i>&nbsp; Login</button>
          {{-- <a type="button" class="btnx btnx-custom-white ml-3" href="{{ route('agent.logout') }}">Log Out</a> --}}
          @endif
        </form>
      </div>
    </div>

  </nav>

  <div class="sub_nav">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <nav class="nav nav_grid">
            <a class="nav-link nav_links" href="{{ url('/') }}"> <img src="images/icon_magnifier.png" alt="" srcset=""> &nbsp; Top Agent</a>
            <a class="nav-link nav_links" href="{{url('/laporan')}}"><img src="images/icon_magnifier.png" alt="" srcset=""> &nbsp; Laporan </a>
            <a class="nav-link nav_links" href="#"><img src="images/icon_magnifier.png" alt="" srcset=""> &nbsp; Reward Agent</a>
          </nav>
        </div>
      </div>
    </div>
  </div>


  @yield('konten_isi')

 <footer>
   <div class="container">
    <div class="row pb-5">
      <div class="col-md-4">
        <div class="title_footer grid_title_footer">Kontak</div>
        <div class="button_kontak grid_button_kontak_phone"><span class="text_button_kontak">+62 21 988-4345</span></div>
        <div class="button_kontak mt-2"><span class="text_button_kontak">info.plnup3biak@gmail.com</span></div>
        <div class="address_footer">Jl. Ahmad Yani no 63,
          Kabupaten Biak
        Kode Pos 98234</div>
      </div>
      <div class="col-md-4">
        <div class="title_footer grid_title_footer ml-3">Jelajahi</div>
        <div class="text_footer_item ml-3">Top Agent</div>
        <div class="text_footer_item ml-3">Sub Halaman 1</div>
        <div class="text_footer_item ml-3">Sub Halaman 2</div>
      </div>
      <div class="col-md-4">
        <div class="title_footer grid_title_footer">Social Media</div>
        <img src="{{asset('landing/images/youtube.png')}}" alt="" srcset="">
        <img src="{{asset('landing/images/instagram.png')}}" alt="" srcset="">
      </div>
    </div>
    <div class="row">
      <div class="col-md-12"><div class="text_copyright">2020 Powered by PT. PLN (Persero) UP3 Biak</div></div>
    </div>
  </div>
</footer>
@if (Auth::user() && Auth::user()->role != 'admin')
<div class="modal modal-updtakn" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Update Akun</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form method="POST" action="{{ url('agent/updateakun') }}">
        @csrf
        <div class="modal-body">
          <div class="px-4">
            @php
            $usr = Auth::user();
            @endphp
            <input type="hidden" name="id" value="{{ $usr->id }}">
            <div class="form-group row">
              <label class="col-sm-4 form-label">Nama Lengkap</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="name" placeholder="Nama Lengkap..." required="" autocomplete="off" value="{{ $usr->name }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 form-label">Nomor KTP</label>
              <div class="col-sm-8">
                <input type="number" class="form-control" name="no_ktp" placeholder="Nomor KTP..." required="" autocomplete="off" value="{{ old('no_ktp') ? old('no_ktp') : $usr->no_ktp }}">
                @error('no_ktp')
                <small class="text-danger"><i>Nomor KTP telah terdaftar</i></small>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 form-label">Nomor Telepon</label>
              <div class="col-sm-8">
                <input type="number" class="form-control" name="no_telepon" placeholder="Nomor Telepon..." required="" autocomplete="off" value="{{ $usr->no_telepon }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 form-label">Email</label>
              <div class="col-sm-8">
                <input type="email" class="form-control" name="email" placeholder="Email..." required="" autocomplete="off" value="{{ old('email') ? old('email') : $usr->email }}">
                @error('email')
                <small class="text-danger"><i>Email telah digunakan</i></small>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label">Password Baru</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Isi jika ingin mengganti password" autocomplete="off" name="password">
                @error('password')
                <small class="text-danger"><i>{{ $message }}</i></small><br>
                @enderror
                <span class="text-info">*Isi Password untuk mengganti</span>
              </div>
            </div>
            <hr>
            <div class="form-group row">
              <label class="col-sm-4 form-label">No Rekening</label>
              <div class="col-sm-8">
                <input type="number" class="form-control" name="no_rekening" placeholder="Nomor Rekening..." required="" autocomplete="off" value="{{ $usr->no_rekening }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 form-label">Nama Bank</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="nama_bank" placeholder="Nama Bank..." required="" autocomplete="off" value="{{ $usr->nama_bank }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 form-label">Atas Nama</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="atas_nama" placeholder="Atas Nama..." required="" autocomplete="off" value="{{ $usr->atas_nama }}">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer px-4">
          <button type="submit" class="btn btn-primary mr-2">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endif

@if (Auth::user() && Auth::user()->role != 'admin' && Auth::user()->no_rekening == null)
<div class="modal modal-rek" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Tambahkan Informasi Rekening*</h4>
      </div>
      <form method="POST" action="{{ url('agent/setrek') }}">
        @csrf
        <div class="modal-body">
          <div class="alert alert-info">
            <strong>Info:</strong> Informasi rekening wajib diisi untuk keperluan reward.
          </div>
          <div class="px-4">
            <div class="form-group row">
              <input type="hidden" name="id" value="{{ Auth::user()->id }}">
              <label class="form-label">Nomor Rekening</label>
              <input type="number" class="form-control" name="no_rekening" placeholder="Nomor Rekening..." autocomplete="off" required="">
            </div>
            <div class="form-group row">
              <label class="form-label">Nama Bank</label>
              <input type="text" class="form-control" name="nama_bank" placeholder="Nama Bank..." autocomplete="off" required="">
            </div>
            <div class="form-group row">
              <label class="form-label">Atas Nama</label>
              <input type="text" class="form-control" name="atas_nama" placeholder="Atas Nama..." autocomplete="off" required="">
            </div>
          </div>
        </div>
        <div class="modal-footer px-4">
          <button type="submit" class="btn btn-primary mr-2">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
@endif


</body>
<script src="{{ asset('landing/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('landing/js/popper.min.js') }}"></script>
<script src="{{ asset('landing/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('landing/js/mains.js') }}"></script>
<script src="{{ asset('landing/js/capture.js') }}"></script>
<script src="{{ asset('assets/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
<script src="{{ asset('assets/fontawesome/js/all.min.js') }}"></script>
@stack('script')

</html>


