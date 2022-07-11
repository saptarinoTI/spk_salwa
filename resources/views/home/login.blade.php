@extends('layout.auth')


@section('customcss')
<style>
  @media only screen and (max-width: 600px) {

    .lottieanim {
      width: 60%;
      height: auto;
    }
  }

  @media only screen and (min-width: 601px) {

    .lottieanim {
      width: 70%;
      height: auto;
    }
  }

</style>
@endsection

@section('content')

<div class="d-flex flex-column flex-root">
  <!--begin::Authentication - Sign-in -->
  <div class="d-flex flex-column flex-lg-row flex-column-fluid">
    <!--begin::Aside-->
    <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative" style="background-color: #FFECA2">
      <!--begin::Wrapper-->
      <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
        <!--begin::Content-->
        <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
          <!--begin::Logo-->
          {{-- Mengarah ke halamana awalnya --}}
          <a href="." class="py-9 mb-5">
            <img alt="Logo" src="{{ asset('assets/media/logos/logo.svg') }}" class="h-60px">
          </a>
          <!--end::Logo-->
          <!--begin::Title-->
          <h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #0a0a0a;">Welcome to {{ config('app.name', 'Laravel') }}</h1>
          <!--end::Title-->
          <!--begin::Description-->
          {{-- <p class="fw-bold fs-2" style="color: #f8f8f8;">{{ config('app.name', 'Laravel') }} --}}

          <!--end::Description-->
        </div>
        <!--end::Content-->
        <!--begin::Illustration-->
        <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px">
          <img src="{{asset('assets/img/mental1.png')}}" width="100%" height="100%" alt="">
          {{-- <lottie-player class="lottieanim mx-auto" src="{{asset('assets/media/lottie/signin.json')}}" background="transparent" speed="1" style="" loop autoplay></lottie-player> --}}
        </div>
        <!--end::Illustration-->
      </div>
      <!--end::Wrapper-->
    </div>
    <!--end::Aside-->
    <!--begin::Body-->
    <div class="d-flex flex-column flex-lg-row-fluid py-10">
      <!--begin::Content-->
      <div class="d-flex flex-center flex-column flex-column-fluid">
        <!--begin::Wrapper-->
        <div class="w-lg-500px p-10 p-lg-15 mx-auto">
          <!--begin::Form-->

          @if(Session::has('fail'))
          <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10">
            <span class="svg-icon svg-icon-2hx svg-icon-danger me-4 mb-5 mb-sm-0">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="black"></path>
                <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="black"></path>
              </svg>
            </span>
            <div class="d-flex flex-column pe-0 pe-sm-10">
              <h5 class="mb-1">Whoops!</h5>
              <span>Username atau Password Salah!</span>
            </div>
            <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
              <i class="bi bi-x fs-1 text-danger"></i>
            </button>
          </div>
          @endif

          <div id="alertx"></div>

          <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route('login.cek') }}" method="POST">
            @csrf
            <!--begin::Heading-->
            <div class="text-center mb-10">
              <!--begin::Title-->
              <h1 class="text-dark mb-3">Sign In</h1>
              <!--end::Title-->
              <!--begin::Link-->
            </div>

            <div class="fv-row mb-5">
              <!--begin::Label-->
              <label class="form-label fs-6 fw-bolder text-dark">Username</label>
              <!--end::Label-->
              <!--begin::Input-->
              <input class="form-control form-control-lg form-control-solid" type="text" id="username" name="username" placeholder="Username" autocomplete="off" autofocus required />
              <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-5">
              <!--begin::Wrapper-->
              <div class="d-flex flex-stack mb-2">
                <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
              </div>
              <div>
                <input class="form-control form-control-lg form-control-solid pswd" type="password" id="password" name="password" placeholder="Password" autocomplete="off" style="padding-right:45px;" required />
                <span class="hint spass tpass"></span>
              </div>
            </div>

            <div class="text-center mt-10">
              <!--begin::Submit button-->
              <button class="btn btn-lg btn-warning w-100 mb-5">Login</button>
              <!--end::Submit button-->
            </div>
            <!--end::Actions-->
            <div></div>
          </form>
          <!--end::Form-->
        </div>
        <!--end::Wrapper-->
      </div>
      <!--end::Content-->
      <!--begin::Footer-->
      <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
        <!--begin::Links-->
        <div class="d-flex flex-center fw-bold fs-6">
          <small class="text-center" style="color: #6a96d7;">2022© Sistem Pendukung Keputusan Beasiswa</small>
        </div>
        <!--end::Links-->
      </div>
      <!--end::Footer-->
    </div>
    <!--end::Body-->
  </div>
  <!--end::Authentication - Sign-in-->
</div>

@endsection


@section('customjs')
<script src="{{ asset('js/signin.js') }}"></script>

@endsection
