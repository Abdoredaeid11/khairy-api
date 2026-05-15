<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="{{ app()->getLocale() }}"
  dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
  class="light-style layout-menu-fixed"
  data-theme="theme-default"
  data-assets-path="{{ asset('admin/assets') }}/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>{{ config('app.name') }} - Dashboard</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('admin/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
<link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css') }}" />

    <style>
        /* إعدادات RTL كاملة لموقع خيري */
        [dir='rtl'] .layout-wrapper:not(.layout-horizontal) .layout-menu {
            right: 0 !important;
            left: auto !important;
        }
        [dir='rtl'] .layout-page {
            padding-right: 16.25rem !important;
            padding-left: 0 !important;
        }
        /* ضبط المحتوى الداخلي */
        [dir='rtl'] .content-wrapper {
            width: 100% !important;
        }
        /* ضبط الهيدر (Navbar) */
        [dir='rtl'] .layout-navbar {
            left: auto !important;
            right: 16.25rem !important;
            width: calc(100% - 16.25rem) !important;
        }
        /* في حالة الـ Detached Navbar */
        [dir='rtl'] .layout-navbar.navbar-detached {
            width: calc(100% - 16.25rem - 3rem) !important;
            margin-right: 1.5rem !important;
            margin-left: 1.5rem !important;
        }
        
        [dir='rtl'] .app-brand-link {
            flex-direction: row-reverse;
        }
        [dir='rtl'] .app-brand-text {
            margin-right: 0.5rem;
            margin-left: 0;
        }
        [dir='rtl'] .app-brand {
            display: flex !important;
            flex-direction: row-reverse !important;
            justify-content: flex-end !important;
        }
        [dir='rtl'] .app-brand .layout-menu-toggle {
            margin-left: auto !important;
            margin-right: 0 !important;
            left: 0 !important;
        }
        [dir='rtl'] .app-brand .layout-menu-toggle i {
            transform: rotate(180deg);
        }
        [dir='rtl'] .menu-vertical .menu-item .menu-link {
            flex-direction: row-reverse;
            text-align: right;
        }
        [dir='rtl'] .menu-vertical .menu-item .menu-link i {
            margin-left: 0.5rem;
            margin-right: 0;
        }
        [dir='rtl'] .ms-auto {
            margin-right: auto !important;
            margin-left: 0 !important;
        }
        
        @media (max-width: 1199.98px) {
            [dir='rtl'] .layout-page {
                padding-right: 0 !important;
            }
            /* إخفاء القائمة في الموبايل لليمين */
            html[dir='rtl'] .layout-menu {
                transform: translate3d(100%, 0, 0) !important;
                left: auto !important;
                right: 0 !important;
            }
            /* إظهار القائمة عند التفعيل */
            html[dir='rtl'].layout-menu-expanded .layout-menu {
                transform: translate3d(0, 0, 0) !important;
            }
            [dir='rtl'] .layout-navbar {
                width: 100% !important;
                right: 0 !important;
            }
            [dir='rtl'] .layout-navbar.navbar-detached {
                width: calc(100% - 3rem) !important;
                margin-right: 1.5rem !important;
            }
        }

        /* تحسينات إضافية للموبايل */
        @media (max-width: 767.98px) {
            .table-responsive {
                border: 0;
            }
            .card-header {
                padding: 1rem !important;
            }
            .container-xxl {
                padding-left: 0.75rem !important;
                padding-right: 0.75rem !important;
            }
        }
    </style>

<!-- Vendors CSS -->
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

<!-- Helpers -->
<script src="{{ asset('admin/assets/vendor/js/helpers.js') }}"></script>


    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('admin/assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
