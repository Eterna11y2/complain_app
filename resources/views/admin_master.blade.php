<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Customer complaint management is a system that allows customers to register their dissatisfaction with the organization. It allows organizations to obtain feedback on how to improve their services and to decrease the likelihood of problems with the customer base.">
  
    <!-- theme meta -->
    <meta name="theme-name" content="sleek" />
    
    <title>Complain Management System</title>
    
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />

    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
  
    <!-- PLUGINS CSS STYLE -->
    <link href="{{asset('assets/plugins/simplebar/simplebar.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/nprogress/nprogress.css')}}" rel="stylesheet" />

    <!-- No Extra plugin used -->
    <link href="{{asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css')}}" rel='stylesheet'>
    <link href="{{asset('assets/plugins/daterangepicker/daterangepicker.css')}}" rel='stylesheet'>
    
    
    <link href="{{asset('assets/plugins/toastr/toastr.min.css')}}" rel='stylesheet'>
    
    
    <link href='{{ asset("assets/plugins/data-tables/datatables.bootstrap4.min.css")}}' rel='stylesheet'>
    <link href='{{ asset("assets/plugins/data-tables/responsive.datatables.min.css")}}' rel='stylesheet'>
    
    
    
    

    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="{{asset('assets/css/sleek.css')}}" />
  
    <!-- FAVICON -->
    <!-- <img src="{{asset('assets/img/login-image.png')}}"  width="30" height="33" alt="">   -->
    <link href="{{asset('assets/img/login-image.png')}}" rel="shortcut icon" />
    <!-- <link href="{{asset('assets/img/favicon.png')}}" rel="shortcut icon" /> -->
  
    <!--
      HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
    -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="{{asset('assets/plugins/nprogress/nprogress.js')}}"></script>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />

    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
  
    <!-- PLUGINS CSS STYLE -->
    <link href="assets/plugins/simplebar/simplebar.css" rel="stylesheet" />
    <link href="assets/plugins/nprogress/nprogress.css" rel="stylesheet" />
  
    <!-- No Extra plugin used -->
    
    
    
    
    
    
    
    
    <link href='assets/plugins/data-tables/datatables.bootstrap4.min.css' rel='stylesheet'>
    
    <link href='assets/plugins/data-tables/jquery.datatables.min.css' rel='stylesheet'>

    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="assets/css/sleek.css" />
  
    <!-- FAVICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="assets/img/favicon.png" rel="shortcut icon" />
  
    <!--
      HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
    -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="assets/plugins/nprogress/nprogress.js"></script>   
  </head>
  <body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">
  <?php

use Illuminate\Support\Facades\URL;

$currentURL = URL::current();
$url = explode("/", $currentURL, 4);
$pagename = $url[3];

if($pagename!="login" && $pagename!="admin/login" && $pagename!="register" && $pagename!="password-rest"){
?>
    {{View::make('admin_header')}}
<?php } ?>   
  @yield('admin_content')
  
    
  <footer class="footer mt-auto">
      <div class="copyright bg-white">
        <p>
          Copyright &copy; <span id="copy-year"></span> <b class="text-primary" >Complain Management System</b>.
        </p>
      </div>
      <script>
        var d = new Date();
        var year = d.getFullYear();
        document.getElementById("copy-year").innerHTML = year;
      </script>
    </footer>

    

    </div> <!-- End Page Wrapper -->
  </div> <!-- End Wrapper -->


    <!-- <script type="module">
      import 'https://cdn.jsdelivr.net/npm/@pwabuilder/pwaupdate';

      const el = document.createElement('pwa-update');
      document.body.appendChild(el);
    </script> -->

    <!-- Javascript -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/simplebar/simplebar.min.js')}}"></script>
 
    <script src="{{ asset('assets/plugins/charts/Chart.min.js')}}"></script>
    <script src="{{ asset('assets/js/chart.js')}}"></script>

    <script src="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-world-mill.js')}}"></script>
    <script src="{{ asset('assets/js/vector-map.js')}}"></script>
    <script src='{{ asset("assets/plugins/data-tables/jquery.datatables.min.js")}}'></script>
    <script src='{{ asset("assets/plugins/data-tables/datatables.bootstrap4.min.js")}}'></script>
    <script src='{{ asset("assets/plugins/data-tables/datatables.responsive.min.js")}}'></script>


    <script src="{{ asset('assets/plugins/daterangepicker/moment.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{ asset('assets/js/date-range.js')}}"></script>
    
    <script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('assets/js/sleek.js')}}"></script>
    <link href="{{asset('assets/options/optionswitch.css')}}" rel="stylesheet">
    <script src="{{asset('assets/options/optionswitcher.js')}}"></script>
</body>
</html>




