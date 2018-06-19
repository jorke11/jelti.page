
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

        </style>

        <div class="container-fluid" style="padding-left: 0; padding-right: 0">
            <div class="">
                @include("header")
            </div>
        </div>

        <section id="slider-main" class="main-slider" style="position:relative;top: -66px">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="images/banner1.png" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/banner2.png" alt="First slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </section>



        <section id="divProduct" style="padding-top:2%" class="d-none d-lg-block">
            <div class="container-fluid">
                <div class="row" style="padding-bottom: 20px">
                    <div class="col-lg-12">
                        <h1 class="text-center title-color" >Conoce Nuestras Dietas</h1>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class='col-3'>
                        <div class="card">
                            <img class="card-img-top" src="{{url("images/page/dietas/paleo.png")}}" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title text-center">Paleo</h4>
                                <p class="text-center justify-content-center"><a href="{{url("search/s=paleo")}}" class="link-green">Ver todos</a></p>
                            </div>
                        </div>
                    </div>
                    <div class='col-3'>
                        <div class="card">
                            <img class="card-img-top" src="{{url("images/page/dietas/vegana.png")}}" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title text-center">Vegana</h4>
                                <p class="text-center justify-content-center"><a href="{{url("search/s=vegano")}}" class="link-green">Ver todos</a></p>
                            </div>
                        </div>
                    </div>
                    <div class='col-3'>
                        <div class="card">
                            <img class="card-img-top" src="{{url("images/page/dietas/sin_gluten.png")}}" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title text-center">Sin gluten</h4>
                                <p class="text-center justify-content-center"><a href="{{url("search/s=sin_gluten")}}" class="link-green">Ver todos</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center" style="padding-top: 50px">
                    <div class='col-3'>
                        <div class="card">
                            <img class="card-img-top" src="{{url("images/page/dietas/organico.png")}}" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title text-center">Organico</h4>
                                <p class="text-center justify-content-center"><a href="{{url("search/organico")}}" class="link-green">Ver todos</a></p>
                            </div>
                        </div>
                    </div>
                    <div class='col-3'>
                        <div class="card">
                            <img class="card-img-top" src="{{url("images/page/dietas/singrasastrans.png")}}" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title text-center">Sin grasas trans</h4>
                                <p class="text-center justify-content-center"><a href="{{url("search/sin_grasas_trans")}}" class="link-green" >Ver todos</a></p>
                            </div>
                        </div>
                    </div>
                    <div class='col-3'>
                        <div class="card">
                            <img class="card-img-top" src="{{url("images/page/dietas/sinazucar.png")}}" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title text-center">Sin Azucar</h4>
                                <p class="text-center justify-content-center"><a href="{{url("search/sin_azucar")}}" class="link-green" >Ver todos</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <style>
            .card{
                -webkit-box-shadow: -9px 8px 12px -2px rgba(0,0,0,0.25);
                -moz-box-shadow: -9px 8px 12px -2px rgba(0,0,0,0.25);
                box-shadow: -9px 8px 12px -2px rgba(0,0,0,0.25);
                border-radius:10px;
                margin-bottom: 3%;
                margin-left: 4%
            }

            /*            #carouselExampleIndicators3.carousel-item{
                            padding-bottom:5x;
                            padding-left: 5px
                        }
            
                        .height-img{
                            heigth:10px !important;
                        }*/
        </style>

        <!--Web-->
        <section style="padding-top: 3%;padding-bottom: 2%">   
            <div class="container-fluid test">
                <div class="row row-center text-center d-none d-md-block d-lg-none" >
                    <div class="col-10 offset-1" style="background-color: #f8f7f5">
                        <h1 class="text-center">Lo Más Nuevo <br>en SuperFuds</h1>
                        <p class="text-center"><a href="#" class="link-green">Ver todos</a></p>
                    </div>
                </div>

                <div class="row row-center test" >
                    <!--<div class="col-3 d-none d-md-none d-lg-block" style="background-color: #f8f7f5">-->
                    <div class="col-3 d-lg-block d-md-none " style="background-color: #f8f7f5">
                        <h1 class="text-center"style="padding-top: 30%">Lo Más Nuevo <br>en SuperFuds</h1>
                        <p class="text-center"><a href="#" class="link-green">Ver todos</a></p>

                    </div>
                    <div class="col-lg-8 col-md-12 offset-md-0" style="background-color: #f8f7f5;margin-left: 10px;padding-top: 1%;padding-bottom: 1%">

                        <div class="row">
                            <div class="col-10 offset-1 ">
                                <div id="carouselExampleIndicators3" class="carousel slide" data-ride="carousel">

                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="row text-center">
                                                <?php
                                                $cont = 0;

                                                foreach ($newproducts as $i => $value) {
                                                    ?>
                                                    <div class="col-3">
                                                        <div class="card" >
                                                            <img class="card-img-top" src="/{{$value->thumbnail}}" alt="Card image cap" onclick="obj.redirectProduct('{{$value->slug}}')" style="cursor: pointer;width:60%;position: relative;margin-left: 20%;padding-top: 15px">
                                                            <div class="card-body text-center">
                                                                <h5 class="card-title" style="min-height:60px" onclick="obj.redirectProduct('{{$value->slug}}')">
                                                                    <?php echo substr($value->short_description, 0, 30); ?>
                                                                </h5>
                                                                <p>
                                                                    <svg id="i-star" viewBox="0 0 32 32" width="22" height="22" color="#ffa608" fill="#ffa608" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                                    <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                                    </svg>
                                                                    <svg id="i-star" viewBox="0 0 32 32" width="22" height="22" color="#ffa608" fill="#ffa608" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                                    <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                                    </svg>
                                                                    <svg id="i-star" viewBox="0 0 32 32" width="22" height="22" color="#ffa608" fill="#ffa608" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                                    <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                                    </svg>
                                                                    <svg id="i-star" viewBox="0 0 32 32" width="22" height="22" color="#ffa608" fill="#ffa608" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                                    <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                                    </svg>
                                                                    <svg id="i-star" viewBox="0 0 32 32" width="22" height="22" color="#ffa608" fill="#ffa608" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                                    <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                                    </svg>
                                                                </p>

                                                                @guest
                                                                <p>
                                                                    <button class="btn btn-info" type="button" onclick="obj.registerClient()">
                                                                        Registrate
                                                                    </button>
                                                                </p>

                                                                @else

                                                                <p>
                                                                    $ {{number_format($value->price_sf,0,",",'.')}}
                                                                </p>
                                                                @endguest

                                                                                                                             <!--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
                                                                <a href="/productDetail/{{$value->slug}}" class="btn btn-primary btn-sm" style="
                                                                   display:scroll;
                                                                   position:fixed;
                                                                   bottom:200px;
                                                                   margin-left: 7%;
                                                                   margin-bottom: 1%;
                                                                   border-radius: 10px;
                                                                   background-color: #5baf98;
                                                                   border: 1px solid #5baf98
                                                                   ">
                                                                    <svg id="i-plus" viewBox="0 0 32 32" width="20" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                                    <path d="M16 2 L16 30 M2 16 L30 16" />
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $cont++;
                                                    if ($cont == 4) {
                                                        $cont = 0;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="carousel-item ">
                                                    <div class="row">
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <a class="carousel-control-prev" href="#carouselExampleIndicators3" role="button" data-slide="prev" style="left:-15%;">
                                        <span class="carousel-control-prev-icon" aria-hidden="true" style="color:red"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators3" role="button" data-slide="next" style="right: -15%;">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </section>



        <section style="padding-top: 3%;padding-bottom: 2%">   
            <div class="container-fluid test">

                <div class="row row-center text-center d-none d-md-block d-lg-none" >
                    <div class="col-8 offset-2" style="background-color: #f8f7f5">
                        <h1 class="text-center">Lo Más <br>Vendidos</h1>
                        <p class="text-center"><a href="#" class="link-green">Ver todos</a></p>
                    </div>
                </div>

                <div class="row row-center test" >
                    <div class="col-3 d-md-none d-lg-block" style="background-color: #f8f7f5">
                        <h1 class="text-center"style="padding-top: 30%">Lo Más <br>Vendidos</h1>
                        <p class="text-center"><a href="#" class="link-green">Ver todos</a></p>
                    </div>
                    <div class="col-lg-8 col-md-12 offset-md-0" style="background-color: #f8f7f5;margin-left: 10px;padding-top: 1%;padding-bottom: 1%">

                        <div class="row">
                            <div class="col-10 offset-1">
                                <div id="most_sales" class="carousel slide" data-ride="carousel">

                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="row text-center">
                                                <?php
                                                $cont = 0;

                                                foreach ($most_sales as $i => $value) {
                                                    ?>
                                                    <div class="col-3">
                                                        <div class="card" >
                                                            <img class="card-img-top" src="/{{$value->thumbnail}}" alt="Card image cap" onclick="obj.redirectProduct('{{$value->slug}}')" style="cursor: pointer;width:60%;position: relative;margin-left: 20%;padding-top: 15px">
                                                            <div class="card-body text-center">
                                                                <h5 class="card-title" style="min-height:60px" onclick="obj.redirectProduct('{{$value->slug}}')">
                                                                    <?php echo substr($value->short_description, 0, 25); ?>
                                                                </h5>
                                                                <p>
                                                                    <svg id="i-star" viewBox="0 0 32 32" width="22" height="22" color="#ffa608" fill="#ffa608" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                                    <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                                    </svg>
                                                                    <svg id="i-star" viewBox="0 0 32 32" width="22" height="22" color="#ffa608" fill="#ffa608" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                                    <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                                    </svg>
                                                                    <svg id="i-star" viewBox="0 0 32 32" width="22" height="22" color="#ffa608" fill="#ffa608" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                                    <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                                    </svg>
                                                                    <svg id="i-star" viewBox="0 0 32 32" width="22" height="22" color="#ffa608" fill="#ffa608" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                                    <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                                    </svg>
                                                                    <svg id="i-star" viewBox="0 0 32 32" width="22" height="22" color="#ffa608" fill="#ffa608" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                                    <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                                    </svg>
                                                                </p>

                                                                @guest
                                                                <p>
                                                                    <button class="btn btn-info" type="button" onclick="obj.registerClient()">
                                                                        Registrate
                                                                    </button>
                                                                </p>

                                                                @else
                                                                <p>

                                                                </p>
                                                                @endguest

                                                                                                                             <!--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
                                                                <a href="/productDetail/{{$value->slug}}" class="btn btn-primary btn-sm" style="
                                                                   display:scroll;
                                                                   position:fixed;
                                                                   bottom:200px;
                                                                   margin-left: 7%;
                                                                   margin-bottom: 1%;
                                                                   border-radius: 10px;
                                                                   background-color: #5baf98;
                                                                   border: 1px solid #5baf98
                                                                   ">
                                                                    <svg id="i-plus" viewBox="0 0 32 32" width="20" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                                    <path d="M16 2 L16 30 M2 16 L30 16" />
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $cont++;
                                                    if ($cont == 4) {
                                                        $cont = 0;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="carousel-item ">
                                                    <div class="row">
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <a class="carousel-control-prev" href="#most_sales" role="button" data-slide="prev" style="left:-15%;">
                                        <span class="carousel-control-prev-icon" aria-hidden="true" style="color:red"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#most_sales" role="button" data-slide="next" style="right: -15%;">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </section>


        <section style="padding-top: 3%;padding-bottom: 2%" >
            <div class="container-fluid">
                <div class="row row-center row-space">
                    <div class="col-lg-8">
                        <img src="images/porque superfuds.png" alt="Sub Image" class="center-block img-responsive" width="100%">
                    </div>
                </div>
                <div class="row row-center">
                    <div class="col-lg-8">
                        <img src="images/como_funciona.png" alt="Sub Image" class="center-block img-responsive" width="100%">
                    </div>
                </div>
                <div class="row row-center">
                    <div class="col-lg-8">
                        <img src="images/nuestra_receta.png" alt="Sub Image" class="center-block img-responsive" width="100%">
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container-fluid">
                <div class="row row-center" >
                    <div class="col-lg-8" style="background-color: #2FC8AE;padding-bottom: .9%"><h2 class="color-font text-center" style="color:#fffbf2">Lo que Aman nuestros <b>Clientes</b> y <b>Proveedores</b></h2></div>
                </div>
                <div class="row row-center">
                    <div class="col-lg-8 " style="padding: 0">

                        <div id="carouselExampleIndicators4" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            </ol>
                            <div class="carousel-inner">

                                <?php
                                $active = "active";
                                foreach ($love_clients as $key => $val) {

                                    if ($key != 0) {
                                        $active = '';
                                    }
                                    ?>
                                    <div class="carousel-item {{$active}}">
                                        <img class="d-block w-100" src="{{$val["url"]}}" alt="{{$val["title"]}}">
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>

                            <a class="carousel-control-prev" href="#carouselExampleIndicators4" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators4" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section style="padding-bottom: 2%;padding-top: 2%" class="pendiente-class">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-10">

                        <div id="carouselExampleIndicators5" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators5" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators5" data-slide-to="1"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row text-center">
                                        <div class="col ">
                                            <img src="logos/olimpica.png" alt="..." class=" center-block img-fluid " width="40%">
                                        </div>
                                        <div class="col">
                                            <img src="logos/la14.png" alt="..." class="center-block img-fluid" width="40%">
                                        </div>
                                        <div class="col">
                                            <img src="logos/farmatodo.png" alt="..." class=" center-block img-fluid" width="40%" >
                                        </div>
                                        <div class="col">
                                            <img src="logos/rappi-3.png" alt="..." class="img-fluid  center-block" width="40%">
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row text-center">
                                        <div class="col">
                                            <img src="logos/click_clack-4.png" alt="..." class="img-fluid center-block" width="40%">
                                        </div>
                                        <div class="col">
                                            <img src="logos/locatel-5.png" alt="..." class="img-fluid center-block" width="40%">
                                        </div>
                                        <div class="col">
                                            <img src="logos/altoque-6.png" alt="..." class="img-fluid center-block" width="40%">
                                        </div>
                                        <div class="col">
                                            <img src="logos/cruz_verde-7.png" alt="..." class="img-fluid center-block" width="40%">
                                        </div>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="row text-center">
                                        <div class="col">
                                            <img src="logos/gastronomy-8.png" alt="..." class="img-responsive center-block" width="40%">
                                        </div>
                                        <div class="col">
                                            <img src="logos/enjoy_fit-11.png" alt="..." class="img-responsive center-block" width="40%">
                                        </div>
                                        <div class="col">
                                            <img src="logos/juliao-10.png" alt="..." class="img-responsive center-block" width="40%">
                                        </div>
                                        <div class="col">
                                            <img src="logos/tiger_market-9.png" alt="..." class="img-responsive center-block" width="40%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators5" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators5" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
    {!!Html::script('js/Page/page.js')!!}

</html>

<?php if ($exibirModal === true) : // Si nuestra variable de control "$exibirModal" es igual a TRUE activa nuestro modal y será visible a nuestro usuario.            ?>
    <script>
        $(function () {
        $("#myModal").modal("show");
        });
    </script>
<?php endif; ?>

<link href="{{ asset('/css/fonts.css') }}" rel="stylesheet" type="text/css">