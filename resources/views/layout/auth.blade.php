<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<head>
  <base href="">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <meta charset="utf-8" />
  <meta name="description" content="Sistem Pakar Diagnosis Mental Ilness" />
  <meta name="keywords" content="Sistem Pakar, Diagnosis, Mental ilness" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="author" content="salwa" />
  <meta property="og:locale" content="en_US" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="Mental Illness" />
  <meta property="og:url" content="" />
  <meta property="og:site_name" content="" />
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <link rel="shortcut icon" href="{{ asset('assets/media/logos/logo.svg') }}" />

  <link href="{{ asset('css/pkgmgr.css') }}" rel="stylesheet">

  <!--begin::Fonts-->
  {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" /> --}}
  <!--end::Fonts-->

  <style>
    .hint {
      position: relative;
      float: right;
      margin-right: 13px;
      margin-top: -35px;
      cursor: pointer;
      z-index: 10;
    }

    .spass:before {
      font-family: "Font Awesome 5 Free";
      content: "\f06e";
      font-weight: 900;
      color: #818bab;
      font-size: 18px;
    }

    .hpass:before {
      font-family: "Font Awesome 5 Free";
      content: "\f070";
      font-weight: 900;
      color: #b5b5b5;
      font-size: 18px;
    }

  </style>

  @yield('customcss')

</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="bg-body waitMe_body">
  <!--begin::Main-->
  <!--begin::Root-->

  <div class="waitMe_container img" style="background:#fff; z-index:99999999;">
    <div style="background:url({{asset('assets/media/logos/logo.svg')}}); background-size: auto 70px;" class="ld ld-breath"></div>
  </div>

  @yield('content')

  <!--end::Root-->
  <!--end::Main-->
  <!--begin::Javascript-->
  <script>
    var hostUrl = "assets/";

  </script>

  <script src="{{ asset('js/pkgmgr.js') }}"></script>


  @yield('customjs')

</body>
<!--end::Body-->
</html>
