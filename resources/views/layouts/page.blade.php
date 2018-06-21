<?php
# Iniciando la variable de control que permitirá mostrar o no el modal
$exibirModal = false;
# Verificando si existe o no la cookie
if (!isset($_COOKIE["mostrarModal"])) {
    # Caso no exista la cookie entra aquí
    # Creamos la cookie con la duración que queramos
    //$expirar = 3600; // muestra cada 1 hora
    //$expirar = 10800; // muestra cada 3 horas
    //$expirar = 21600; //muestra cada 6 horas
    $expirar = 43200; //muestra cada 12 horas
    //$expirar = 86400;  // muestra cada 24 horas
    setcookie('mostrarModal', 'SI', (time() + $expirar)); // mostrará cada 12 horas.
    # Ahora nuestra variable de control pasará a tener el valor TRUE (Verdadero)
    $exibirModal = true;
}
clearstatcache();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Pragma" content="no-cache">
        <title>SuperFüds</title>
        <script>var PATH = '{{url("/")}}'</script>
        <link rel="shortcut icon" href="{{ asset('assets/images/logoico.png') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

        <!-- Fonts -->

        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <meta name="keywords" content="organico,saludable">
        <meta name="description" content="Your website does not contain an XML sitemap and that can weaken your SEO.">
        <!-- Styles -->

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


        <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


        <!-- Add the slick-theme.css if you want default styling -->
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css"/>
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
        <script src="https://www.gstatic.com/firebasejs/4.12.1/firebase.js"></script>
        <script src="https://www.gstatic.com/firebasejs/4.12.1/firebase-firestore.js"></script>

        {!!Html::style('/css/page.css')!!}
        {!!Html::script('/vendor/plugins.js')!!}
        {!!Html::style('/vendor/select2/css/select2.min.css')!!}
        {!!Html::script('/vendor/select2/js/select2.js')!!}
           {!!Html::style('/css/edited.css')!!}
    </head>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
            var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
            (function () {
                var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = 'https://embed.tawk.to/5a2ea31bd0795768aaf8e9a6/default';
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
    </script>
    <!--End of Tawk.to Script-->

    <style>
        .carousel-control-prev-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000000' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E") !important;
        }

        .carousel-control-next-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000000' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E") !important;
        }

        /* Para 960px */  
        @media only screen and (max-width: 980px) and (min-width: 821px) {  
            #slider-main{
                padding-top: 100px
            }
        }  

        /* Para 800px */  
        @media only screen and (max-width: 820px) and (min-width: 621px) {  
            #slider-main{
                padding-top: 98px
            }
        }  

        /* Para 600px */  
        @media only screen and (max-width: 620px) and (min-width: 501px) {  
            #slider-main{
                padding-top: 98px
            }
        }  

        /* Para 480px */  
        @media only screen and (max-width: 500px) and (min-width: 341px) {  
            #slider-main{
                /*padding-top: 98px*/
            }
        }  

        /* Para 320px */  
        @media only screen and (max-width: 340px) and (min-width: 5px)  {  
            #slider-main{
                padding-top: 100px
            }
        } 

        .go-top {
            position: fixed;
            bottom: 4em;
            right: 2em;
            text-decoration: none;
            color: #fff;
            background-color: rgb(90,176,153,0.8);
            font-size: 12px;
            padding: 1em;
            display: none;
            z-index: 1000;
            border-radius: 50% 50% 50% 50%;
        }

        .go-top:hover {
            background-color: rgba(0, 0, 0, 0.6);
            color:white;
        }

        .slider-main{
            position:fixed;
        }

        .link-green{
            color:rgba(91,175,152,1);
            font-weight: 600
        }

        .card{
            -webkit-box-shadow: -9px 8px 12px -2px rgba(0,0,0,0.25);
            -moz-box-shadow: -9px 8px 12px -2px rgba(0,0,0,0.25);
            box-shadow: -9px 8px 12px -2px rgba(0,0,0,0.25);
            border-radius:10px;
            margin-bottom: 3%;
            margin-left: 4%
        }

        /* Para 960px */  
        @media only screen and (max-width: 980px) and (min-width: 821px) {  
            #slider-main{
                padding-top: 100px
            }
        }  

        /* Para 800px */  
        @media only screen and (max-width: 820px) and (min-width: 621px) {  
            #slider-main{
                padding-top: 98px
            }
        }  

        /* Para 600px */  
        @media only screen and (max-width: 620px) and (min-width: 501px) {  
            #slider-main{
                padding-top: 98px
            }
        }  

        /* Para 480px */  
        @media only screen and (max-width: 500px) and (min-width: 341px) {  
            #slider-main{
                padding-top: 98px
            }
        }  

        /* Para 320px */  
        @media only screen and (max-width: 340px) and (min-width: 5px)  {  
            #slider-main{
                padding-top: 100px
            }
        } 



        /* CSS REQUIRED */
        .state-icon {
            left: -5px;
        }
        .list-group-item-primary {
            color: rgb(255, 255, 255);
            background-color: rgb(66, 139, 202);
        }

        /* DEMO ONLY - REMOVES UNWANTED MARGIN */
        .well .list-group {
            margin-bottom: 0px;
        }


        .list-group-item {
            background-color: rgba(255,255,255,0);
            padding: .40rem 1.25rem;
            border: 0px;
            font-size: 20px;color: black;
        }

        #categories-filter .list-group .list-group-item.active{
            background-color: #30c594 !important;
            color:#ffffff
        }

    </style>

    <body >
        @include("modalRegister")
        <div class="container-fluid" style="padding-left: 0; padding-right: 0">
            @include("header")

            @yield('content')
        </div>
        @include("footer")
    </body>

    <script>
        $('#menuProduct').click(function () {
            $("#menuProduct span").addClass("underline-green");
            $("#menuInicio").removeClass("underline-green");
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                    && location.hostname == this.hostname) {

                var $target = $(this.hash);
                $target = $target.length && $target || $('[name=' + this.hash.slice(1) + ']');
                if ($target.length) {
                    var targetOffset = $target.offset().top;
                    $('html,body').animate({scrollTop: targetOffset}, 1000);
                    return false;
                }
            }

        });</script>

</html>

<?php if ($exibirModal === true) : // Si nuestra variable de control "$exibirModal" es igual a TRUE activa nuestro modal y será visible a nuestro usuario.            ?>
    <script>
        $(function () {
            $("#myModal").modal("show");
        });
    </script>
<?php endif; ?>


<link href="{{ asset('/css/fonts.css') }}" rel="stylesheet" type="text/css">