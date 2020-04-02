<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('seo_title') - Blog</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{url('/themes/front/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{url('/themes/front/vendor/font-awesome/css/font-awesome.min.css')}}">
    <!-- Custom icon font-->
    <link rel="stylesheet" href="{{url('/themes/front/css/fontastic.css')}}">
    <!-- Google fonts - Open Sans-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <!-- Fancybox-->
    <link rel="stylesheet" href="{{url('/themes/front/vendor/@fancyapps/fancybox/jquery.fancybox.min.css')}}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{url('/themes/front/css/style.default.css')}}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{url('/themes/front/css/custom.css')}}">
    <link href="{{url('/themes/front/plugins/toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Favicon-->
    <link rel="shortcut icon" href="favicon.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->


    
    <!-- owl carousel 2 stylesheet-->
    <link rel="stylesheet" href="{{url('/themes/front/plugins/owl-carousel2/assets/owl.carousel.min.css')}}" id="theme-stylesheet">
    <link rel="stylesheet" href="{{url('/themes/front/plugins/owl-carousel2/assets/owl.theme.default.min.css')}}" id="theme-stylesheet">
  </head>
  <body>
    <header class="header">
      @include('front._layout.navigation')
    </header>
    
    @yield('content')
    
   
    @include('front._layout.footer')
    <!-- JavaScript files-->
    <script src="{{url('/themes/front/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{url('/themes/front/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{url('/themes/front/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{url('/themes/front/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{url('/themes/front/vendor/@fancyapps/fancybox/jquery.fancybox.min.js')}}"></script>
    <script src="{{url('/themes/front/js/front.js')}}"></script>
    <script src="{{url('/themes/front/plugins/toastr/toastr.min.js')}})" type="text/javascript"></script>
    <script>
        let systemMessage = "{{session()->pull('system_message')}}";

      if (systemMessage !== "") {
          toastr.success(systemMessage);
      }

      let systemError = "{{session()->pull('system_error')}}";

      if (systemError !== "") {
          toastr.error(systemError);
      }
    </script>
    <script src="{{url('/themes/front/plugins/owl-carousel2/owl.carousel.min.js')}}"></script>
    <script>
        
        
        
        
      $("#index-slider").owlCarousel({
        "items": 1,
        "loop": true,
        "autoplay": true,
        "autoplayHoverPause": true
      });

      $("#latest-posts-slider").owlCarousel({
        "items": 1,
        "loop": true,
        "autoplay": true,
        "autoplayHoverPause": true
      });
    </script>
    
  </body>
</html>