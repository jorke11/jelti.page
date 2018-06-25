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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>


        <!-- Add the slick-theme.css if you want default styling -->
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css"/>
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
        <script src="https://www.gstatic.com/firebasejs/4.12.1/firebase.js"></script>
        <script src="https://www.gstatic.com/firebasejs/4.12.1/firebase-firestore.js"></script>

        {!!Html::style('/css/page.css')!!}

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
    <body>
        @include("modalRegister")

        <style>


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
        @include("header")
        <div class="container-fluid">
            <div class="row center-block justify-content-center" style="margin-top: 5%">
                <div class="col-6">
                    <h2 class="text-center" style="font-weight: bold;color:#756d6d">TU COMPRA HA SIDO PROCESADO CORRECTAMENTE.</h2>
                    <h3 class="text-center" style="font-weight: bold;color:#756d6d">GRACIAS POR TU COMPRA.</h3>
                </div>
            </div>

            @if(Session::has('success'))
            <div class="row center-block justify-content-center">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-success"><strong> Compra Realizada! Orden #123343</strong></div>
                            <p>Recibiras un mensaje con el detalle de tu Pedido</p>
                            <p>Cuando se despache tu pedido recibiras un Email</p>
                            <p>Recuerda revisar tambien tu bandeja de "spam" o correo no deseado</p>
                        </div>
                    </div>
                                        <!--<div class="alert alert-success"><strong> {{Session::get('success')}}</strong></div>-->
                </div>
            </div>
            @else
            <?php
            header('Location: http://www.superfuds.com/');
            ?>
            @endif

            <div class="row center-block justify-content-center" style="margin-top: 1%;margin-bottom: 5%">
                <div class="col-3">
                    <a href="{{url("/")}}" class="btn btn-success text-center form-control">Seguir Comprando</a>
                </div>
            </div>

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
    {!!Html::script('js/Page/detail.js')!!}

</html>
