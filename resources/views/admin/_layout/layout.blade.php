<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>@yield('seo_title') | Blog</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{url('/themes/admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('/themes/admin/dist/css/adminlte.min.css')}}">
  <!-- Toastr -->
  <link href="{{url('/themes/admin/plugins/toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Datatables -->
  <link href="{{url('/themes/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
  <!-- select2 -->
  <link href="/themes/admin/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
  <link href="/themes/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css" rel="stylesheet" type="text/css"/>

  <link href="/themes/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
  
  @stack('head_links')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('admin._layout.navigation_top')

  @include('admin._layout.navigation_side')

  @yield('content')
  
  @include('admin._layout.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{url('/themes/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{url('/themes/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- jQuery Validation -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/additional-methods.min.js"></script>
<!--
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/localization/messages_sr_lat.js"></script>
-->
<!-- Toastr -->
<script src="{{url('/themes/admin/plugins/toastr/toastr.min.js')}}" type="text/javascript"></script>
<!-- Selelct2 -->
<script src="/themes/admin/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<!-- Datatables -->
<script src="{{url('/themes/admin/plugins/datatables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{url('/themes/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}" type="text/javascript"></script>

<script type="text/javascript">
    let systemMessage = "{{session()->pull('system_message')}}";
    
    if (systemMessage !== "") {
        toastr.success(systemMessage);
    }
    
    let systemError = "{{session()->pull('system_error')}}";
    
    if (systemError !== "") {
        toastr.error(systemError);
    }
</script>

<!-- AdminLTE App -->
<script src="{{url('/themes/admin/dist/js/adminlte.min.js')}}"></script>
@stack('footer_javascript')
</body>
</html>
