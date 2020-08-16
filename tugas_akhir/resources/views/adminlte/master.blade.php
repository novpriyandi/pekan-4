<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>StackOverflow KW | Group 4</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('/adminlte/dist/css/adminlte.min.css') }} ">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Custom Style -->
  <link rel="icon" href="{{ asset('/img/4.png') }}" type="image/x-icon"/>
  <link rel="stylesheet" href="{{ asset('/css/style.css') }} ">
  @stack('script-head')
</head>
<body class="hold-transition sidebar-collapse layout-top-nav">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  @include('adminlte.partials.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('adminlte.partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1 class="m-0 text-dark"> @yield('page-title') </h1>
          </div><!-- /.col -->
          <div class="col-sm-2">
            @if (request()->segment(2) != 'create')
              <a href="{{ route('pertanyaan.create') }}" class="btn btn-info float-right">Ask Question</a>
            @endif
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          @yield('content')
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  @include('adminlte.partials.footer')
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte/dist/js/demo.js')}}"></script>
<!-- Custom JS -->
@stack('scripts')
@include('sweetalert::alert')
</body>
</html>
