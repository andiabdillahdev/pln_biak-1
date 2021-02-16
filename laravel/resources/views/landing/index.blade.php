@extends('layouts.headfoot')
@section('konten_isi')

<div class="home_top_agent">
  <img src="{{ asset('landing/images/background_home.png') }}" alt="" srcset="">
</div>

<div class="top_agent_info">
  <div class="container">
    <div class="row text-center">
      <div class="col-md-12">
        <span class="title_info">KETAHUI BAHAYA PENCURIAN LISTRIK</span>

        <div class="card_box_info pd_info mt-5">
          <div class="row">
            <div class="col-md-9 col-xs-3">
              <span class="text_info_agent">DENDA TAGIHAN SUSULAN  MULAI RP 1 JUTA 
                SAMPAI  DENGAN RP 10 MILYAR</span>
            </div>
            <div class="col-md-3 col-xs-3">
              <img src="{{ asset('landing/images/money.png') }}" class="image_fail_size1" alt="" srcset="">
            </div>
          </div>
        </div>

        <div class="card_box_info pd_info mt-3">
          <div class="row">
            <div class="col-md-9 col-xs-3">
              <span class="text_info_agent grid_text_info">RESIKO TERJADI KEBAKARAN</span>
            </div>
            <div class="col-md-3 col-xs-3">
              <img src="{{ asset('landing/images/fire.png') }}" class="image_fail_size" alt="" srcset="">
            </div>
          </div>
        </div>

        <div class="card_box_info pd_info mt-3">
          <div class="row">
            <div class="col-md-9 col-xs-3">
              <span class="text_info_agent grid_text_info">DAPAT DIJERAT HUKUM PIDANA</span>
            </div>
            <div class="col-md-3 col-xs-3">
              <img src="{{ asset('landing/images/palu.png') }}" class="image_fail_size" alt="" srcset="">
            </div>
          </div>
        </div>

        <div class="card_box_info pd_info mt-3">
          <div class="row">
            <div class="col-md-9 col-xs-3">
              <span class="text_info_agent grid_text_info">HARAM / DOSA</span>
            </div>
            <div class="col-md-3 col-xs-3">
              <img src="{{ asset('landing/images/hand.png') }}" class="image_fail_size" alt="" srcset="">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="top_agent_info">
  <div class="container">
    <div class="row text-center">
      <div class="col-md-12">
        <span class="title_info">KETAHUI BAHAYA PENCURIAN LISTRIK</span>

        <div class="image_fail">
          <img src="{{ asset('landing/images/image1.png') }}" class="image_info" alt="" srcset="">
        </div>

        <div class="image_fail">
          <img src="{{ asset('landing/images/image2.png') }}" class="image_info" alt="" srcset="">
        </div>

        <div class="image_fail">
          <img src="{{ asset('landing/images/image3.png') }}" class="image_info" alt="" srcset="">
        </div>

      </div>
    </div>
  </div>
</div>

<div class="top_agent_info_reward">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <span class="title_reward">Reward untuk kamu</span>
        <p class="text_reward">Laporkan Penyalahgunaan Penggunaan Listrik 
          di Sekitar Anda </p>
          <div class="notif_reward">
            <span>Dapatkan Komisi Hingga Rp 10.000.000</span>
          </div>
          <span class="note_reward">(*3% dari total tagihan susulan)</span>
      </div>
      <div class="col-md-4">
        <img src="{{ asset('landing/images/reward.png') }}" class="image-reward" alt="" srcset="">
      </div>
    </div>
  </div>
</div>
       

@endsection