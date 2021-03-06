<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title')</title>

  <!--  Paper Dashboard core CSS    -->
  <link href="{{ asset('frontend-assets/css/paper-dashboard.css') }}" rel="stylesheet"/>
  <link href="{{ asset('frontend-assets/css/themify-icons.css') }}" rel="stylesheet"/>
  <link href="{{ asset('/frontend-assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/frontend-assets/css/custom-dashboard.css') }}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{ asset('/frontend-assets/fontawesome/css/all.min.css') }}" rel="stylesheet">
  <!--  CSS for Demo Purpose, don't include it in your project     -->

  <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>

@yield('styling')
</head>
<body style="background: #C3C3C3;">

  @include('frontend.includes.header')

  @yield('inner-header')
  
    <div class="wrapper row">
      @yield('content')
    </div>
  
  @include('frontend.includes.footer')

</body>

  <!--   Core JS Files   -->
  <script src="{{ asset('/frontend-assets/js/jquery.min.js') }}"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="{{ asset('/frontend-assets/bootstrap/js/bootstrap.min.js') }}"></script>
  <!-- Custom Script -->
  <script src="{{ asset('/frontend-assets/js/script.js') }}"></script>
  <script>
    $(window).scroll(function() {    
        var scroll = $(window).scrollTop();

         //>=, not <=
        if (scroll >= 50) {
            //clearHeader, not clearheader - caps H
            $(".header-inner").addClass("navbar-fixed-top");
        }else{
          $(".header-inner").removeClass("navbar-fixed-top");
        }
    });
    $("#toggle-btn").click(function() {
      $(".sf-menu").toggle(500); 
    });
    
    var $ = jQuery.noConflict();

    $(document).ready(function() {
        jQuery('ul.sf-menu').superfish({
            animation: {
                height: 'show'
            },  
            delay: 100 
        }); 
        $("#toggle-btn").click(function() {
            $(".sf-menu").toggle(500); 
        });

        $('.toggle-subarrow').click(
            function() {
                $(this).parent().toggleClass("mob-drop");
        });
        
        var header = $(".header-inner");
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            if (scroll >= 100 && $(this).width() > 769) {
                header.addClass("fixed-top");
            } else {
                header.removeClass('navbar-fixed-top');
            }
        });   
        $(this).find(".h4 i").each(function(){
                $(this).addClass("green");
        }); 
    }); 
    $(window).scroll(function() {
        var nav = $('#header-inner');
        var top = 200;
        if ($(window).scrollTop() >= top) {

            nav.addClass('navbar-fixed-top');

        } else {
            nav.removeClass('navbar-fixed-top');
        }
    });
  </script>
  <script>
        var current = location.pathname;
        $('.sf-menu li a').each(function(){
        var $this = $(this);
          // if the current path is like this link, make it active
          if($this.attr('href').indexOf(current) !== -1){
            $this.addClass('active');
          }
        })
    </script>
    @yield('script')
</body>
</html>
