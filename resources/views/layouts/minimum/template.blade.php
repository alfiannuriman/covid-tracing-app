<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard

* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com
=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Argon Dashboard - Free Dashboard for Bootstrap 4</title>
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('static/img/brand/favicon.png') }}" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('static/vendor/nucleo/css/nucleo.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('static/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{ asset('static/css/argon/argon.css') }}" type="text/css">
</head>

<body class="bg-default">
  @include('layouts.minimum.navbar')
  @include('layouts.minimum.header', ['page_title' => isset($page_title) ? $page_title : '', 'page_subtitle' => isset($page_subtitle) ? $page_subtitle : ''])
  <!-- Main content -->
  <div class="main-content">
    <!-- Page content -->
    @yield('content')
  </div>
  <!-- Footer -->
  @include('layouts.minimum.footer')
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{ asset('static/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('static/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('static/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ asset('static/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('static/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
  <!-- Argon JS -->
  <script src="{{ asset('static/js/argon/argon.js?v=1.2.0') }}"></script>
</body>

</html>