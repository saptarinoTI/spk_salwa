<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--begin::Head-->

<head>
  <base href="">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <meta charset="utf-8" />
  <meta name="description" content="Sistem Pakar Diagnosa Kesehatan Mental" />
  <meta name="keywords" content="Sistem Pakar, Kesehatan Mental, Mental, Diagnosa Mental, Mental Illness" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="author" content="salwa" />
  <meta property="og:locale" content="en_US" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="Mental" />
  <meta property="og:url" content="http::127.0.0.1" />
  <meta property="og:site_name" content="  Mental Health" />
  <meta name="csrf-token" id="token" content="{{ csrf_token() }}">

  <link rel="canonical" href="http::127.0.0.1" />
  <link rel="shortcut icon" href="{{asset('assets/media/logos/logo.svg')}}" />

  <link href="{{ asset('css/pkgmgr.css') }}" rel="stylesheet">

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


    .btnx-xs {
      padding: 1px 5px !important;
      font-size: 12px;
      line-height: 1.5;
      border-radius: 3px;
    }

    .btnx {
      display: inline-block;
      padding: 6px 12px;
      margin-bottom: 0;
      font-size: 14px;
      font-weight: 400;
      line-height: 1.42857143;
      text-align: center;
      white-space: nowrap;
      vertical-align: middle;
      -ms-touch-action: manipulation;
      touch-action: manipulation;
      cursor: pointer;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
      background-image: none;
      border: 1px solid transparent;
      border-radius: 4px;
    }

    /* input.form-control, select.form-control{
            padding: 0.25rem 0.5rem !important;
        } */

    table.dataTable tbody>tr.selected,
    table.dataTable tbody>tr>.selected {
      background-color: #f7ff80 !important;
    }


    div.dataTables_wrapper {
      margin-bottom: 100px;
    }

    /* add border loading panel datatable */
    div.dataTables_processing {
      border: 2px solid;
    }

    /* fixing dropdown in header datatable */
    .dataTables_scrollHead {
      overflow: visible !important;
    }

    .btnf {
      border-radius: 0.25rem;
      font-size: 12px;
      -webkit-transition: all 0.3s ease-in-out;
      transition: all 0.3s ease-in-out;
    }

    .menuf {
      z-index: 9999 !important;
    }


    .select2-selection--single:not(.s2x) {
      height: 32px !important;
    }

    .errtext label {
      color: red !important;
    }


    .switch input[type=checkbox] {
      opacity: 0;
      position: absolute;
    }

    .switch input[type=checkbox]+.cr {
      position: relative;
      display: inline-block;
      -webkit-transition: 0.4s ease;
      transition: 0.4s ease;
      height: 20px;
      width: 35px;
      border: 1px solid #e9eaec;
      border-radius: 60px;
      cursor: pointer;
      z-index: 0;
      top: 0;
    }

    .switch input[type=checkbox]+.cr:after,
    .switch input[type=checkbox]+.cr:before {
      content: "";
      position: absolute;
      display: block;
      top: 0;
      left: 0;
    }

    .switch input[type=checkbox]+.cr:before {
      -webkit-transition: 0.2s cubic-bezier(0.24, 0, 0.5, 1);
      transition: 0.2s cubic-bezier(0.24, 0, 0.5, 1);
      height: 20px;
      width: 35px;
      border-radius: 30px;
    }

    .switch input[type=checkbox]+.cr:after {
      -webkit-box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1), 0 4px 0 0 rgba(0, 0, 0, 0.04), 0 4px 9px rgba(0, 0, 0, 0.13), 0 3px 3px rgba(0, 0, 0, 0.05);
      box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1), 0 4px 0 0 rgba(0, 0, 0, 0.04), 0 4px 9px rgba(0, 0, 0, 0.13), 0 3px 3px rgba(0, 0, 0, 0.05);
      -webkit-transition: 0.35s cubic-bezier(0.54, 1.6, 0.5, 1);
      transition: 0.35s cubic-bezier(0.54, 1.6, 0.5, 1);
      background: #f7f7f7;
      height: 19px;
      width: 19px;
      border-radius: 60px;
    }

    .switch input[type=checkbox]:checked+.cr:before {
      background: linear-gradient(-135deg, #1de9b6 0%, #1dc4e9 100%);
      -webkit-transition: width 0.2s cubic-bezier(0, 0, 0, 0.1);
      transition: width 0.2s cubic-bezier(0, 0, 0, 0.1);
    }

    .switch input[type=checkbox]:checked+.cr:after {
      left: 16px;
    }

    .switch input[type=checkbox]:disabled+label {
      opacity: 0.5;
      -webkit-filter: grayscale(0.4);
      filter: grayscale(0.4);
      cursor: not-allowed;
    }

    .switch.switch-primary input[type=checkbox]:checked+.cr:before {
      background: #04a9f5;
    }

    .switch.switch-danger input[type=checkbox]:checked+.cr:before {
      background: #f44236;
    }

    .switch.switch-success input[type=checkbox]:checked+.cr:before {
      background: #1de9b6;
    }

    .switch.switch-warning input[type=checkbox]:checked+.cr:before {
      background: #f4c22b;
    }

    .switch.switch-info input[type=checkbox]:checked+.cr:before {
      background: #3ebfea;
    }

    .switch.switch-alternative input[type=checkbox]:checked+.cr:before {
      background: linear-gradient(-135deg, #899FD4 0%, #A389D4 100%);
    }

  </style>
  @yield('customcss')
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" style="background-image: url({{asset('assets/media/patterns/header-bg.png')}})" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled waitMe_body">

  <div class="waitMe_container img" style="background:#fff; z-index:99999999;">
    <div style="background:url({{asset('assets/media/logos/logo.svg')}}); background-size: auto 80px;" class="ld ld-breath"></div>
  </div>

  <!--begin::Main-->
  <!--begin::Root-->
  <div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
      <!--begin::Wrapper-->
      <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
        <!--begin::Header-->
        <div id="kt_header" class="header align-items-stretch" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '60px', lg: '150px'}">
          <!--begin::Container-->
          <div class="container-fluid d-flex align-items-center">
            <!--begin::Heaeder menu toggle-->
            <div class="d-flex align-items-center d-lg-none ms-n2 me-3" title="Show aside menu">
              <div class="btn btn-icon btn-custom w-30px h-30px w-md-40px h-md-40px" id="kt_header_menu_mobile_toggle">
                <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                <span class="svg-icon svg-icon-2x">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
                    <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
                  </svg>
                </span>
                <!--end::Svg Icon-->
              </div>
            </div>
            <!--end::Heaeder menu toggle-->
            <!--begin::Header Logo-->
            <div class="header-logo me-5 me-md-10 flex-grow-1 flex-lg-grow-0">
              <a href=".">
                <img alt="Logo" src="{{asset('assets/media/logos/logo.svg')}}" class="h-15px h-lg-20px logo-default" />
                <img alt="Logo" src="{{asset('assets/media/logos/logo.svg')}}" class="h-15px h-lg-20px logo-sticky" />
              </a>
            </div>
            <!--end::Header Logo-->
            <!--begin::Wrapper-->
            <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
              <!--begin::Navbar-->
              <div class="d-flex align-items-stretch" id="kt_header_nav">
                <!--begin::Menu wrapper-->
                <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                  <!--begin::Menu-->
                  <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">

                    @include('layout.menus')


                  </div>
                  <!--end::Menu-->
                </div>
                <!--end::Menu wrapper-->
              </div>
              <!--end::Navbar-->
              <!--begin::Topbar-->
              <div class="d-flex align-items-stretch flex-shrink-0">
                <!--begin::Toolbar wrapper-->
                <div class="topbar d-flex align-items-stretch flex-shrink-0">
                  <!--begin::Activities-->

                  <!--begin::User-->
                  <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                    <!--begin::Menu wrapper-->
                    <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                      {{-- <img alt="Pic" src="{{\File::exists(public_path('storage/foto_user/'.Auth::user()->foto_user)) ? asset('storage/foto_user/'.Auth::user()->foto_user) : asset('storage/foto_user/default.png')}}" /> --}}
                    </div>
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                      <!--begin::Menu item-->
                      <div class="menu-item px-3">
                        <div class="menu-content d-flex align-items-center px-3">
                          <!--begin::Avatar-->
                          <div class="symbol symbol-50px me-5">
                            {{-- <img alt="Logo" src="{{\File::exists(public_path('storage/foto_user/'.Auth::user()->foto_user)) ? asset('storage/foto_user/'.Auth::user()->foto_user) : asset('storage/foto_user/default.png')}}" /> --}}
                          </div>
                          <!--end::Avatar-->
                          <!--begin::Username-->
                          <div class="d-flex flex-column">
                            <div class="fw-bolder d-flex align-items-center fs-5">
                              {{-- <span class="text-truncate w-150px">{{Auth::user()->nama}}</span> --}}
                            </div>
                            {{-- <div class="badge badge-light-success fw-bolder fs-8 px-2 py-1">{{Auth::user()->role_user}}
                          </div> --}}
                          {{-- <a href="javascript:void(0)" class="fw-bold text-muted text-hover-primary fs-7">{{Omjin::tglWaktu1(Auth::user()->last_login)}}</a> --}}
                        </div>
                        <!--end::Username-->
                      </div>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5">
                      <a href="." class="menu-link px-5">My Profile</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5">
                      <a href="." class="menu-link px-5">Sign Out</a>
                    </div>
                    <!--end::Menu item-->

                  </div>
                  <!--end::Menu-->
                  <!--end::Menu wrapper-->
                </div>
                <!--end::User -->
                <!--begin::Aside mobile toggle-->
                <!--end::Aside mobile toggle-->
              </div>
              <!--end::Toolbar wrapper-->
            </div>
            <!--end::Topbar-->
          </div>
          <!--end::Wrapper-->
        </div>
        <!--end::Container-->
      </div>
      <!--end::Header-->
      <!--begin::Toolbar-->
      <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack flex-wrap">
          <!--begin::Title-->

          @yield('panelhead')

          <!--end::Actions-->
        </div>
        <!--end::Container-->
      </div>
      <!--end::Toolbar-->
      <!--begin::Container-->
      <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-fluid">
        <!--begin::Post-->
        <div class="content flex-row-fluid" id="kt_content">

          @yield('content')

        </div>
        <!--end::Post-->
      </div>
      <!--end::Container-->
      <!--begin::Footer-->
      <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
        <!--begin::Container-->
        <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
          <!--begin::Copyright-->
          <div class="text-dark order-2 order-md-1">
            <span class="text-muted fw-bold me-1">2022©</span>
            <a href="#" target="_blank" class="text-gray-800 text-hover-primary">Sistem Pendukung Keputusan Beasiswa</a>
          </div>
          <!--end::Copyright-->
          <!--begin::Menu-->
          <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">

          </ul>
          <!--end::Menu-->
        </div>
        <!--end::Container-->
      </div>
      <!--end::Footer-->
    </div>
    <!--end::Wrapper-->
  </div>
  <!--end::Page-->
  </div>
  <!--end::Root-->

  <!--begin::Scrolltop-->
  <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
    <span class="svg-icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
        <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
        <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
      </svg>
    </span>
    <!--end::Svg Icon-->
  </div>
  <!--end::Scrolltop-->
  <!--end::Main-->
  @yield('modals')


  <script src="{{ asset('js/pkgmgr.js') }}"></script>

  @yield('customjs')

</body>
<!--end::Body-->

</html>
