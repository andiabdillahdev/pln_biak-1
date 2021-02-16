@extends('layouts.headfoot')
@section('konten_isi')
<div class="banner">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-md-8">
          <div class="title_banner">Laporkan Pelanggaran Listrik</div>
          <div class="text_banner">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vulputate id nibh etiam egestas diam. 
            Blandit diam purus habitant vestibulum, hac sagittis. Ante ornare scelerisque scelerisque morbi. 
          Cursus neque leo purus dictum.</div>

          <div class="row grid_button">
            <button type="button" formtarget="1" class="btnx btnx-banner-white active_nav">Lapor</button>
            <button type="button" formtarget="2" class="btnx btnx-banner-white">Lacak</button>
            <button type="button" formtarget="3" class="btnx btnx-banner-white">History Laporan</button>
          </div>
        </div>

        <div class="col-md-10">

          <div id="content1" class="box box_grid">

            {{-- CAPTURE --}}
              {{-- <video autoplay id="video"></video>
              
              <div class="row">
                <button class="btn btn-primary btn-xs" id="btnScreenshot">Capture</button>
                <button class="btn btn-primary btn-xs" id="btnChangeCamera">Switch</button>
              </div>

              <div id="screenshots"></div>
              <canvas class="is-hidden" id="canvas" width="100" height="100"></canvas>  --}}
              
              {{-- END CAPTURE --}}


              <div class="form-group">
                <label for="alamat" class="labels">Lampirkan Bukti (Gambar)</label>
              </div>
              <div class="sub_box" style="padding-top: 10px; padding-bottom: 10px; height: auto;">
                <form action="{{ url('/file-upload') }}" class="dropzone" id="my-awesome-dropzone" style="border: none;">
                  @csrf
                </form>
              </div>
              <form method="POS" id="formSubmit">
                <div class="form-group">
                  @if (Auth::user() && Auth::user()->role != 'admin')
                  <input type="hidden" name="id" id="id" value="{{ Auth::user()->id }}">
                  @else
                  <input type="hidden" name="id" id="id" value="">
                  @endif
                  <label for="alamat" class="labels">Alamat Lengkap</label>
                  <input type="text" class="form-control grid_control_form_general" id="alamat" name="alamat" placeholder="Alamat Lengkap lokasi dugaan pelanggaran" required="" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="perihal" class="labels">Perihal Laporan</label>
                  <input type="text" class="form-control grid_control_form_general" id="perihal" name="perihal" placeholder="Jenis Pelanggaran" required="" autocomplete="off">
                </div>
                <div class="grid_button_box">
                  <button type="submit" class="btns-box text-btns bg_button_red mb-5">Kirim Laporan</button>
                </div>
              </form>
            </div>

            <div id="content2" class="box box_grid" style="height: auto; padding-bottom: 52px;">
              <div class="title_history grid_text_history">Lacak Laporan</div>
              @if (Auth::user() && Auth::user()->role != 'admin')
              @php
              $cek = 0;
              @endphp
              @foreach ($laporan as $lap)
              @if ($lap->id_users == Auth::user()->id)
              @php
              $cek = $cek + 1;
              @endphp
              <div class="box_lacak grid_box_lacak">
                <div class="title_box_lacak grid_title_lacak">Kode Laporan: <span class="sub_title_kode">#TA{{ sprintf('%05s', $lap->id) }}</span> </div>
                <div class="title_box_lacak grid_text_progress">Progress Laporan</div>
                <div class="progress" style="height: 15px; margin: 20px 52px 5px 52px;">
                  <div class="progress-bar" role="progressbar" style="width: {{ $lap->progres }}%;" aria-valuenow="{{ $lap->progres }}" aria-valuemin="0" aria-valuemax="100">{{ $lap->progres }}%</div>
                </div>
                <span style="color: #0286FF; font-family: Raleway; margin: 0 52px; ">{{ $lap->status }}</span>
              </div>
              @endif

              @endforeach
              @if ($cek == 0)
              <div class="col-md-8">
                <div class="line_hr"></div>
                <ul class="history_laporan">
                  <li class="item_laporan"><i>Tidak ada data</i></li>
                </ul>
              </div>
              @endif
              @else
              <div class="col-md-8">
                <div class="line_hr"></div>
                <ul class="history_laporan">
                  <li class="item_laporan"><i>Anda harus login terlebih dahulu</i></li>
                </ul>
              </div>
              @endif
            </div>

            <div id="content3" class="box box_grid">
              <div class="container vertical-scrollable">
                <div class="title_history grid_text_history">History Laporan</div>
                <div class="row">
                  @if (Auth::user() && Auth::user()->role != 'admin')
                  @php
                  $cek = 0;
                  @endphp
                  @foreach ($laporan as $lap)
                  @if ($lap->id_users == Auth::user()->id)
                  @php
                  $cek = $cek + 1;
                  $rwd = $reward->where('laporan_id', $lap->id)->first();
                  @endphp
                  <div class="col-md-8">
                    <div class="line_hr"></div>
                    <ul class="history_laporan">
                      <li class="item_laporan">Kode Laporan :   <span class="sub_item kode_laporan">#TA{{ sprintf('%05s', $lap->id) }}</span></li>
                      <li class="item_laporan">Alamat Laporan : <span class="sub_item1">{{ $lap->alamat }}</span> </li>
                      <li class="item_laporan">Perihal Laporan : <span class="sub_item2">{{ $lap->perihal }}</span> </li>
                      <li class="item_laporan">Status Laporan : <span class="sub_item3 status_laporan">{{ $lap->status }}</span> </li>
                      <li class="item_laporan">Nominal Reward : <span class="sub_item3"><b>{{ $rwd ? 'Rp. '.number_format($rwd->nominal) : "Tidak ada reward" }}</b></span> </li>
                      <li class="item_laporan">Status Reward : <span class="sub_item3"><i>{{ $rwd ? $rwd->status : "Tidak ada reward" }}</i></span> </li>
                    </ul>
                  </div>
                  @endif

                  @endforeach
                  @if ($cek == 0)
                  <div class="col-md-8">
                    <div class="line_hr"></div>
                    <ul class="history_laporan">
                      <li class="item_laporan"><i>Tidak ada data</i></li>
                    </ul>
                  </div>
                  @endif
                  @else
                  <div class="col-md-8">
                    <div class="line_hr"></div>
                    <ul class="history_laporan">
                      <li class="item_laporan"><i>Anda harus login terlebih dahulu</i></li>
                    </ul>
                  </div>
                  @endif
                </div>
              </div>
            </div>

            <div class="box box_grid_step">
              <div class="grid_button_lapor">
                <button type="button" class="btns-box text-btns bg_button_blue">Cara Melaporkan Pelanggaran Listrik</button>
              </div>
              <div class="content_lapor">
                <div class="text_lapor">
                  Untuk dapat Melaporkan Pelanggaran Listrik, anda dapat mengikuti langkah-langkah di bawah ini:
                </div>
                <ol class="text_lapor grid_list">
                  <li class="grid_li">Buka Halaman Top Agent</li>
                  <li class="grid_li">Login pada akun anda</li>
                  <li class="grid_li">Pilih Menu Lapor</li>
                  <li class="grid_li">Isi form laporan pelanggaran dengan benar</li>
                  <li class="grid_li">Klik tombol "Kirim Laporan"</li>
                </ol>
              </div>
            </div>

          </div>


        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">    
        <div class="col-md-12">
          <img src="{{asset('landing/images/city_back.png')}}" alt="" srcset="" class="img_back">
        </div>
      </div>
    </div>

    <div class="indikasi">
      <div class="box_indikasi size_box_indikasi">
        <div class="title_indikasi">Ketahui Indikasi Pelanggaran Listrik</div>
        <div class="container">
          <div class="row text_group">
            <div class="col-md-4">
             <p class="text_indikasi">Lorem ipsum dolor sit amet,consectetur adipiscing elit. Vulputate id nibh etiam egestas diam. Blandit diam purus habitant vestibulum, hac sagittis. Ante ornare scelerisque scelerisque morbi. Cursus neque leo purus dictum.</p>
           </div>
           <div class="col-md-4">
            <p class="text_indikasi">Lorem ipsum dolor sit amet,consectetur adipiscing elit. Vulputate id nibh etiam egestas diam. Blandit diam purus habitant vestibulum, hac sagittis. Ante ornare scelerisque scelerisque morbi. Cursus neque leo purus dictum.</p>
          </div>
          <div class="col-md-4">
           <p class="text_indikasi">Lorem ipsum dolor sit amet,consectetur adipiscing elit. Vulputate id nibh etiam egestas diam. Blandit diam purus habitant vestibulum, hac sagittis. Ante ornare scelerisque scelerisque morbi. Cursus neque leo purus dictum.</p>
         </div>
       </div>
     </div>
   </div>
 </div>
@endsection
@push('script')
<script>
    var formData = new FormData();
    var chek = 0
  
    Dropzone.options.myAwesomeDropzone = {
      init: function() {
        this.on("addedfile", function(file) {
          formData.append('file[]', file);
          chek = chek + 1;
        });
      }
    };
  
    $(document).ready(function($) {
  
      @if (Auth::user() && Auth::user()->role != 'admin' && Auth::user()->no_rekening == null)
      // $('.modal-rek').modal('show');
      $('.modal-rek').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
      });
      @endif
  
      @isset ($_GET['success'])
      Swal.fire({
        title: 'Berhasil Diproses',
        text: 'Data akun berhasil diperbahaui!',
        type: 'success'
      }).then(function() {
        window.history.pushState('', '', "{{ url('agent') }}")
      });
      @endisset
  
      @if($errors->any())
      $('.modal-updtakn').modal('show');
      @endif
  
      var headers = {
        "Accept": "application/json",
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
      }
  
  
      $('#formSubmit').submit(function(e) {
        e.preventDefault();
  
        var id = $('#id').val();
        var alamat = $('#alamat').val();
        var perihal = $('#perihal').val();
  
        if (id == '') {
          Swal.fire({
            title: 'Login Terlebih Dahulu',
            text: 'Anda harus login sebelum membuat laporan!',
            type: 'warning',
            onClose: () => {
              location.href = "{{ url('/login') }}";
            }
          });
          return
        }
  
        if (chek == 0) {
          Swal.fire({
            title: 'Lampirkan Foto!',
            text: 'Paastikan anda telah melampirkan foto',
            type: 'warning'
          });
          return
        }
  
        formData.append('id', id);
        formData.append('alamat', alamat);
        formData.append('perihal', perihal);
  
        $.ajax({
          url: "{{ url('/createlaporan') }}",
          enctype: "multipart/form-data",
          method: "POST",
          headers: headers,
          data: formData,
          success: function (data) {
            Swal.fire({
              title: 'Berhasil Diproses',
              text: 'Laporan berhasil dibuat',
              type: 'success',
              onClose: () => {
                location.href = "{{ url('/agent') }}";
              }
            });
          },
          contentType: false,
          processData: false,
        });
  
      });
  
    });
  
  
  
  </script>
@endpush