<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PT PLN (PERSERO) UP3 BIAK</title>
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/img/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('landing/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
</head>
<body>

    <div class="content-auten">
        <div class="container">
            <div class="title_page_auth">PT PLN (PERSERO) UP3 BIAK</div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="box_auth">

                        <div class="title_login grid_title_login">Login</div>
                        <div class="hr_auth"></div>

                                <form method="POST" action="{{ route('login') }}">
                                  @csrf
                                    <div class="form-group">
                                      <label for="alamat" class="labels_login">E-Mail</label>
                                      <input type="email" class="form-control grid_control_form_auth @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback ml-5" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                       @enderror
                                    </div>
                                    <div class="form-group">
                                      <label for="perihal" class="labels_login">Password</label>
                                      <input type="password" class="form-control grid_control_form_auth @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback ml-5" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="grid_button_box_auth">
                                      <button type="submit" class="btns-box-auth text-btns-auth bg_button_blue">Login</button>
                                    </div>
                                  </form>
                   </div>
                   <div class="note_auth">
                   Belum Punya Akun? <b><a href="{{route('agent.regis')}}">Daftar</a></b>
                   </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="{{ asset('landing/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('landing/js/popper.min.js') }}"></script>
<script src="{{ asset('landing/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('landing/js/mains.js') }}"></script>
