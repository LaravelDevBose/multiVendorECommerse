
<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title> @yield('title') </title>
        @yield('metaTag')
        <link rel="shortcut icon" href="{{ asset('public/dorpon_logo.ico')}}" type="image/x-icon" />
        <link href="https://fonts.googleapis.com/css?family=Mr+Bedfort|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
        <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('public/frontEnd/css/megamenu.css')}}">
        <link rel="stylesheet" href="{{asset('public/frontEnd/css/header.css')}}">
        <link rel="stylesheet" href="{{asset('public/frontEnd/css/footer.css')}}">
        <script src="{{asset('public/frontEnd/js/jquery-3.2.1.min.js')}}"></script>
        <!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->

        @yield('headasset')
    </head>

    <body>


    <!-- / header -->
    @include('frontEnd.includes.headerContent')
    <!-- / header -->

    <!--  conteiner -->
    @yield('content')
    <!--  conteiner -->

    @include('frontEnd.includes.footerContent')

    @include('frontEnd.includes.frontEndModel')

    @yield('footerLink')

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5a831f4dd7591465c707a2d8/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{asset('public/frontEnd/js/bootstrap.min.js')}}"></script>
    
    
    <script src="{{asset('public/frontEnd/js/megamenu.js')}}"></script>
    <script src="{{asset('public/frontEnd/js/search.js')}}"></script>

    <script>
        $(document).ready(function(){$(".megamenu").megamenu();});

        function openCity(cityName,elmnt,color) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.backgroundColor = "";
            }
            document.getElementById(cityName).style.display = "block";
            elmnt.style.backgroundColor = color;

        }
    </script>

    </body>
</html>
