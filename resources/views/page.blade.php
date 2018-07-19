@extends('layouts.page')
@section('content')

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
                                                        <p class="text-left text-muted" style="margin:0;">{{$value->supplier}}</p>
                                                        <h5 class="card-title text-left" style="padding: 0;min-height: 60px" onclick="obj.redirectProduct('{{$value->slug}}')">
                                                            <?php echo substr($value->short_description, 0, 30); ?>
                                                        </h5>
                                                        <p class="text-left">
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
                                                           bottom:170px;
                                                           margin-left: 6%;
                                                           margin-bottom: 1%;
                                                           border-radius: 10px;
                                                           background-color: rgba(255,255,255,0);
                                                           border: 1px solid #5baf98
                                                           ">
                                                            <svg id="i-plus" viewBox="0 0 32 32" width="20" height="20" fill="none" stroke="#5baf98" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
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



<section style="padding-top: 3%;padding-bottom: 2%" >   
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
                                                        <p class="text-left text-muted" style="margin:0">{{$value->supplier}}</p>
                                                        <h5 class="card-title text-left" style="margin:0;min-height: 60px" onclick="obj.redirectProduct('{{$value->slug}}')">
                                                            <?php echo substr($value->short_description, 0, 25); ?>
                                                        </h5>
                                                        <p class="text-left">
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
                                                            
                                                        </p>
                                                        @else
                                                        <p>

                                                        </p>
                                                        @endguest

                                                                                                                                             <!--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
                                                        <a href="/productDetail/{{$value->slug}}" class="btn btn-primary btn-sm" style="
                                                           display:scroll;
                                                           position:fixed;
                                                           bottom:150px;
                                                           margin-left: 6%;
                                                           margin-bottom: 1%;
                                                           border-radius: 10px;
                                                           background-color: rgba(255,255,255,0);
                                                           border: 1px solid #5baf98
                                                           ">
                                                            <svg id="i-plus" viewBox="0 0 32 32" width="20" height="20" fill="none" stroke="#5baf98" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
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
{!!Html::script('js/Page/page.js')!!}
@endsection

