@extends('layouts.page')
@section('content')

<section id="slider-main" class="main-slider" style="">
    <div id="carouselExampleIndicators" class="carousel slide">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="images/bannerpromo.png" alt="Second slide">
            </div>
            <div class="carousel-item">
                <a href="/search/all=new"><img class="d-block w-100" src="images/bannernuevoensf.png" alt="First slide"></a>
            </div>
            <div class="carousel-item">
                <a href="/search/all=best&top=10"><img class="d-block w-100" src="images/bannertop10.png" alt="First slide"></a>
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

<section id="divDiets" style="padding-top:2%" class="d-lg-block"></section>

<section id="slider-new-products"></section>
<!--Web-->
<section style="padding-top: 3%;padding-bottom: 2%" >   
    <div class="container-fluid test">
        <div class="row row-center text-center ">
            <div class="col-8">
                <h1 class="text-center">Lo Más Nuevo <br>en SuperFüds</h1>
                <p class="text-center"><a href="/search/all=new" class="link-green">Ver todos</a></p>
            </div>
        </div>

        <div class="row row-center test" >
            <div class="col-lg-11 col-md-12 offset-md-0" style="background-color: #f8f7f5;margin-left: 10px;padding-top: 1%;padding-bottom: 1%">

                <div class="row">
                    <div class="col-10 offset-1 ">
                        <div id="carouselExampleIndicators3" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($newproducts as $i => $val)
                                <div class="carousel-item {{($i==0)?'active':''}}" style="padding: 2%;">
                                    <div class="row text-center">
                                        @foreach($val as $value)
                                        <div class="col-lg-3 col-xs-4 col-md-3 col-6">
                                            <div class="card" id="card_{{$value->id}}">
                                                <img class="card-img-top card-img-product" src="/{{$value->thumbnail}}" alt="Card image cap" onclick="objCounter.redirectProduct('{{$value->slug}}')">
                                                <div class="card-body text-center">
                                                    <p class="text-left text-muted " style="margin:0;" >
                                                        <a href="{{url("search/s=".str_slug(strtolower($value->supplier), '-'))}}" class="text-supplier">{{strtoupper($value->supplier)}}</a>
                                                    </p>
                                                    <h5 class="card-title text-left title-products"  onclick="objCounter.redirectProduct('{{$value->slug}}')">
                                                        {{$value->title_ec}}</h5>
                                                    <p class="text-left">
                                                        <svg id="i-star" viewBox="0 0 32 32"  class="star" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                        <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                        </svg>
                                                        <svg id="i-star" viewBox="0 0 32 32" class="star" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                        <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                        </svg>
                                                        <svg id="i-star" viewBox="0 0 32 32" class="star" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                        <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                        </svg>
                                                        <svg id="i-star" viewBox="0 0 32 32" class="star" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                        <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                        </svg>
                                                        <svg id="i-star" viewBox="0 0 32 32" class="star" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                        <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                        </svg>
                                                    </p>
                                                    @guest
                                                    <p>
                                                    </p>
                                                    @else
                                                    <p class="text-left">
                                                        $ {{number_format($value->price_sf_with_tax,0,",",'.')}}
                                                    </p>
                                                    @endguest

                                                    @if(isset($value->quantity))
                                                    <button class="btn {{(isset($value->quantity)) ? '' : 'd-none'}}" type="button" 
                                                            onmouseover="objCounter.showOption(this,{{$value->id}})" id="buttonShow_{{$value->id}}" style="background-color: #5cb19a;color:white;"
                                                            >{{$value->quantity}} en carrito</button>
                                                    @endif

                                                    <div class="row d-none row-center" id="buttonAdd_{{$value->id}}">
                                                        <div class="col-lg-6">
                                                            <div class="row row-form-add-product">
                                                                <div class="col-lg-4 col-4" style="padding-left: 0;padding-right: 0">
                                                                    <svg id="i-minus" viewBox="0 0 32 32" class="btn-minus-card-product" fill="white"  style="cursor:pointer;"
                                                                         stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                                         onclick="objCounter.deleteUnit({{$value->id}},'{{$value->slug}}','quantity_new_product_{{$value->id}}')">
                                                                    <path d="M2 16 L30 16" />
                                                                    </svg>
                                                                </div>
                                                                <div class="col-lg-4 col-4" style="padding-left: 0;padding-right: 0">
                                                                    <input type="text" id="quantity_new_product_{{$value->id}}" value="{{(isset($value->quantity))?$value->quantity:0}}" class="input-quantity-product input-number"
                                                                           onkeypress="objCounter.addProductEnter(event,'{{$value->short_description}}',
                                                                           '{{$value->slug}}','{{$value->id}}','{{$value->price_sf}}','{{url($value->thumbnail)}}','{{$value->tax}}'
                                                                                       , 'quantity_new_product_{{$value->id}}')">
                                                                </div>
                                                                <div class="col-lg-4 col-4" style="padding-left: 0;padding-right: 0">
                                                                    <svg id="i-plus" viewBox="0 0 35 35" class="btn-minus-card-product" fill="white" stroke="#ffffff" 
                                                                         stroke-linecap="round" stroke-linejoin="round" stroke-width="4" style="cursor:pointer"
                                                                         onclick="objCounter.addProduct('{{$value->short_description}}',
                                                                         '{{$value->slug}}','{{$value->id}}','{{$value->price_sf}}','{{url($value->thumbnail)}}','{{$value->tax}}','quantity_new_product_{{$value->id}}'); return false;">
                                                                    <path d="M16 2 L16 30 M2 16 L30 16" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2" style="margin-left: 3px">
                                                            <div class="row icon-ok">
                                                                <div class="col-lg-6">
                                                                    <svg id="i-checkmark" viewBox="0 0 32 32" class="btn-minus-card-product" fill="none" stroke="currentcolor" stroke-linecap="round" 
                                                                         stroke-linejoin="round" stroke-width="4"
                                                                         style="cursor:pointer"
                                                                         onclick="objCounter.addProduct('{{$value->short_description}}',
                                                                         '{{$value->slug}}','{{$value->id}}','{{$value->price_sf}}','{{url($value->thumbnail)}}','{{$value->tax}}','quantity_new_product_{{$value->id}}', 'check'); return false;"
                                                                         >
                                                                    <path d="M2 20 L12 28 30 4" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button class="btn {{(isset($value->quantity)) ? 'd-none' : '' }}" 
                                                            id="btnOption_{{$value->id}}" onclick="objCounter.showButton('{{$value->short_description}}',
                                                            '{{$value->slug}}','{{$value->id}}','{{$value->price_sf}}','{{url($value->thumbnail)}}','{{$value->tax}}','quantity_new_product_{{$value->id}}')"
                                                            style="background-color: #5cb19a;color:white;">Agregar</button>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
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
        <div class="row row-center text-center" >
            <div class="col-8 ">
                <h1 class="text-center">Los Más <br>Vendidos</h1>
                <p class="text-center"><a href="/search/all=best" class="link-green">Ver todos</a></p>
            </div>
        </div>
        <div class="row row-center test" >
            <div class="col-lg-11 col-md-12 offset-md-0" style="background-color: #f8f7f5;margin-left: 10px;padding-top: 1%;padding-bottom: 1%">

                <div class="row">
                    <div class="col-10 offset-1">
                        <div id="most_sales" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner" id="content-best-seller"></div>

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
            <div class="col-lg-8" id="title-card-client"><h2 class="color-font text-center">Lo que Aman nuestros <b>Clientes</b> y <b>Proveedores</b></h2></div>
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

