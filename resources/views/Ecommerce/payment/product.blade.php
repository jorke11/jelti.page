@extends('layouts.page')
@section('content')
<br>
<style>
    .timeline ul li {
        list-style-type: none;
        position: relative;
        width: 2px;
        /*margin: 0 auto;*/
        padding-top: 50px;
        background: #30c594;
    }

    /**circulo**/

    .timeline ul li::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: 30%;
        transform: translateX(-50%);
        width: 25px;
        height: 25px;
        border-radius: 50%;
        background: inherit;
    }
    /**container**/
    .timeline ul li div {
        position: relative;
        bottom: 0;
        width: 700px;
        padding: 15px;
        background: #fff;
        color:black;
        font-weight: bold;
        /*border: 1px solid #30c594;*/
        border-radius: 10px;
    }

    /*    .timeline ul li div::before {
            content: '';
            position: absolute;
            bottom: 7px;
            width: 0;
            height: 0;
            border-style: solid;
        }*/
    /*.timeline ul li:nth-child(odd) div {*/
    .timeline ul li> div {
        left: 45px;
    }


    /*.timeline ul li:nth-child(odd) div::before {*/
    /*    .timeline ul li >div::before {
            left: 100%;
            border-color: transparent transparent transparent #30c594;
    
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-top: 20px solid #30c594;
    
        }*/

    .timeline ul li div time {
        width: 100%;
        display: block;

    }
    .timeline ul li div  p {
        font-weight: 100


    }

    .buttonplus{
        display:scroll;
        position:fixed;
        bottom:170px;
        margin-left: 7%;
        margin-bottom: 1%;
        border-radius: 10px;
        background-color: rgba(255,255,255,0);
        border: 1px solid #5baf98
    }
    .title-products{
        padding: 0;min-height: 60px;
    }
    .star{
        width: 22px;
        height: 22px;
        color:#ffa608;
        fill:#ffa608
    }

    .buttonplus-svg{
        width: 20px;
        fill:"none"
    }

    .text-supplier{
        font-size: 12px;
    }

    .btn-plus{
        width: 22px;
        height: 22px;
        color:#ffffff;
        fill:#ffffff;
    }
    .btn-minus{
        width: 24px;
        height: 24px;
        color:#ffffff;
        fill:#ffffff;
    }

    @media (max-width: 1400px){
        .title-new {
            display: none !important;
        }
        .title-products{
            font-size: 12px;
            padding: 0;min-height: 60px;
        }

        .text-supplier{
            font-size: 12px;
        }

        .buttonplus{
            display:scroll;
            position:fixed;
            bottom:140px;
            margin-left: 4%;
            margin-bottom: 2%;
            border-radius: 10px;
            background-color: rgba(255,255,255,0);
            border: 1px solid #5baf98;

        }

        .buttonplus-svg{
            width: 14px;
            fill:"none"
        }


        .star{
            width: 14px;
            height: 14px;
            color:#ffa608;
            fill:#ffa608
        }

        .btn-plus{
            width: 22px;
            height: 22px;
            color:#ffffff;
            fill:#ffffff;
        }
        .btn-minus{
            width: 22px;
            height: 24px;
            color:#ffffff;
            fill:#ffffff;
        }
    }

    @media (max-width: 1100px){
        .title-new {
            display: none !important;
        }
        .title-products{
            font-size: 12px;
            padding: 0;min-height: 60px;
        }

        .text-supplier{
            font-size: 12px;
        }

        .buttonplus{
            display:scroll;
            position:fixed;
            bottom:140px;
            margin-left: 4%;
            margin-bottom: 2%;
            border-radius: 10px;
            background-color: rgba(255,255,255,0);
            border: 1px solid #5baf98;

        }

        .buttonplus-svg{
            width: 14px;
            fill:"none"
        }


        .star{
            width: 14px;
            height: 14px;
            color:#ffa608;
            fill:#ffa608
        }

        .btn-plus{
            width: 22px;
            height: 22px;
            color:#ffffff;
            fill:#ffffff;
        }
        .btn-minus{
            width: 22px;
            height: 24px;
            color:#ffffff;
            fill:#ffffff;
        }
    }



    @media (max-width: 1200px){
        .title-new {
            display: none !important;
        }
        .title-products{
            font-size: 12px;
            padding: 0;min-height: 60px;
        }

        .text-supplier{
            font-size: 12px;
        }

        .buttonplus{
            display:scroll;
            position:fixed;
            bottom:140px;
            margin-left: 4%;
            margin-bottom: 2%;
            border-radius: 10px;
            background-color: rgba(255,255,255,0);
            border: 1px solid #5baf98;

        }

        .buttonplus-svg{
            width: 14px;
            fill:"none"
        }


        .star{
            width: 14px;
            height: 14px;
            color:#ffa608;
            fill:#ffa608
        }
    }




</style>
@include("modalRegister")

<input id="slug_product" value="{{$product->slug}}" type="hidden">
<div class="container-fluid">

    <div class="row">
        <div class="col-8 offset-1">
            <?php echo $breadcrumbs; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active text-center">
                        @if($product->images[0]->path!=null)
                        <img src="{{url($product->images[0]->path)}}" alt="" class="img-fluid" width="30%">
                        @else
                        <img src="" alt="No disponible" width="80%" style="padding-left: 20%">
                        @endif
                    </div>

                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <input type="hidden" id="slug" value="{{$product->slug}}">
        <div class="col-3">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12" style="color:#979797;font-size: 20px;font-weight: 600">
                            {{ucwords($supplier["business"])}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" style="font-size: 33px;">
                            {{ucwords($product->title)}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" style="color:#979797">
                            {{ucwords($product->description)}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" style="color:#979797">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            ${{number_format($product->price_sf,0,",",".")}}
                        </div>
                        <div class="col-lg-5 text-right">
                            Gramos pendiente
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-5 col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" onclick="obj.delete('{{$product->short_description}}',
                                  '{{$product->slug}}','{{$product->id}}','{{$product->price_sf}}','{{url($product->images[0]->path)}}','{{$product->tax}}')" 
                                  style="background-color: rgba(91,175,152,1);color:white;cursor: pointer">-</span>

                        </div>
                        <input type="text" class="form-control" id="quantity" name="quantity" value="0" type="number">
                        <div class="input-group-append">
                            <span class="input-group-text" 
                                  onclick="objCounter.addProduct('{{$product->short_description}}',
                                  '{{$product->slug}}','{{$product->id}}','{{$product->price_sf}}','{{url($product->images[0]->path)}}','{{$product->tax}}')"
                                  style="background-color: rgba(91,175,152,1);color:white;cursor: pointer">+</span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row justify-content-center">
                <div class="col-7 col-md-10">
                    <button class="btn form-control" 
                            style="background-color: rgba(91,175,152,1);color:white;padding-left: 30%;padding-right: 30%;
                            padding-top:0;padding-bottom: 0;border-radius: 10px" 

                            onclick="obj.addCard('{{$product->short_description}}',
                            '{{$product->slug}}','{{$product->id}}','{{$product->price_sf}}','{{url($product->images[0]->path)}}','{{$product->tax}}')"
                            id="btnAddCart"
                            disabled>Agregar al carrito</button>
                </div>
            </div>
            <div class="row justify-content-center" style="margin-top: 3%">
                <div class="col-7 col-md-10">
                    <button class="btn form-control" style="background-color: white;border-color: #ccc;
                            padding-top:0;padding-bottom: 0;border-radius: 10px" id="btnFavourite">
                        <span>{{$text}}</span>
                        <svg id="i-heart" viewBox="0 0 32 32"  width="15" height="15" fill="{{$like}}" stroke="{{$line}}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M4 16 C1 12 2 6 7 4 12 2 15 6 16 8 17 6 21 2 26 4 31 6 31 12 28 16 25 20 16 28 16 28 16 28 7 20 4 16 Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>        
    </div>
    <div class="row" style="padding-bottom: 5%;padding-top: 4%">
        <div class="col-4 offset-2 col-md-5" style="background-color: #f8f7f5;border-radius: 10px;padding-top: 1%">
            <div class="row">
                <div class="col-12 col-md-12">
                    <h4>PORQUE LO AMARAS?</h4>
                </div>
            </div>
            <div class="row" style="padding-bottom: 4%">
                <div class="col-12 col-md-12">
                    <p  class="text-justify" style="padding-right: 9%">{{$product->why}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h4>INGREDIENTES</h4>
                </div>
            </div>
            <div class="row" style="padding-bottom: 4%">
                <div class="col-12">
                    <p  class="text-justify" style="padding-right: 9%">{{$product->ingredients}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h4>DEL PRODUCTO</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p  class="text-justify" style="padding-right: 9%">{{$product->about}}</p>
                </div>
            </div>

        </div>
        <div class="col-2 col-md-3" style="background-color: rgba(91,175,152,1);border-radius: 10px;color:white;left: -40px;margin-top: 3%;margin-bottom: 3%">
            <div class="row">
                <div class="col-12" style="padding-top: 10px;">
                    <h2 class="text-center">INFORMACIÓN NUTRICIONAL</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <span>Tamaño de la porcion</span>
                </div>
                <div class="col-2">
                    20g
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <span>Porciones por empaque</span>
                </div>
                <div class="col-2">
                    10
                </div>
            </div>
            <div class="row" style="padding-bottom: 0;padding-top: 0">
                <div class="col-12">
                    <hr style="background-color: white;height: 10px;margin: 0">
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <span style="font-weight: 600">Cantidad por porción</span>
                </div>
                <div class="col-2">
                    20g
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <span style="font-weight: 600">Calorias</span>
                </div>
                <div class="col-2">
                    20g
                </div>
            </div>
            <div class="row" style="padding-bottom: 0;padding-top: 0">
                <div class="col-12">
                    <hr style="background-color: white;height: 5px;margin: 0">
                </div>
            </div>
            <div class="row">
                <div class="col-5 right">
                    <span style="font-weight: 600">% valor Diario*</span>
                </div>
            </div>
            <div class="row" style="padding-bottom: 0;padding-top: 0">
                <div class="col-12">
                    <hr style="background-color: white;height: 1px;margin: 0">
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <span style="font-weight: 600">Grasa Total</span>
                </div>
                <div class="col-2">
                    20%
                </div>
            </div>
            <div class="row" style="padding-bottom: 0;padding-top: 0">
                <div class="col-12">
                    <hr style="background-color: white;height: 1px;margin: 0">
                </div>
            </div>
            <div class="row">
                <div class="col-8 offset-1">
                    <span>Grasa Saturada</span>
                </div>
                <div class="col-2">
                    10%
                </div>
            </div>
            <div class="row" style="padding-bottom: 0;padding-top: 0">
                <div class="col-12">
                    <hr style="background-color: white;height: 1px;margin: 0">
                </div>
            </div>
            <div class="row">
                <div class="col-8 offset-1">
                    <span>Grasas Trans</span>
                </div>
                <div class="col-2">
                    10%
                </div>
            </div>
            <div class="row" style="padding-bottom: 0;padding-top: 0">
                <div class="col-12">
                    <hr style="background-color: white;height: 1px;margin: 0">
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <span style="font-weight: 600">Colesterol</span>
                </div>
                <div class="col-2">
                    20%
                </div>
            </div>
            <div class="row" style="padding-bottom: 0;padding-top: 0">
                <div class="col-12">
                    <hr style="background-color: white;height: 1px;margin: 0">
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <span style="font-weight: 600">Sodio</span>
                </div>
                <div class="col-2">
                    20%
                </div>
            </div>
            <div class="row" style="padding-bottom: 0;padding-top: 0">
                <div class="col-12">
                    <hr style="background-color: white;height: 1px;margin: 0">
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <span style="font-weight: 600">Carbohidratos Totales</span>
                </div>
                <div class="col-2">
                    20%
                </div>
            </div>
            <div class="row" style="padding-bottom: 0;padding-top: 0">
                <div class="col-12">
                    <hr style="background-color: white;height: 1px;margin: 0">
                </div>
            </div>

            <div class="row">
                <div class="col-8 offset-1">
                    <span>Fibra dietetica</span>
                </div>
                <div class="col-2">
                    10%
                </div>
            </div>
            <div class="row" style="padding-bottom: 0;padding-top: 0">
                <div class="col-12">
                    <hr style="background-color: white;height: 1px;margin: 0">
                </div>
            </div>
            <div class="row">
                <div class="col-8 offset-1">
                    <span>Azucares</span>
                </div>
                <div class="col-2">
                    10%
                </div>
            </div>
            <div class="row" style="padding-bottom: 0;padding-top: 0">
                <div class="col-12">
                    <hr style="background-color: white;height: 1px;margin: 0">
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <span style="font-weight: 600">Proteina</span>
                </div>
                <div class="col-2">
                    20%
                </div>
            </div>
            <div class="row" style="padding-bottom: 0;padding-top: 0">
                <div class="col-12">
                    <hr style="background-color: white;height: 5px;margin: 0">
                </div>
            </div>

            <div class="row">
                <div class="col-10">
                    <span>Vitamina A</span>
                </div>
                <div class="col-2">
                    10%
                </div>
            </div>
            <div class="row" style="padding-bottom: 0;padding-top: 0">
                <div class="col-12">
                    <hr style="background-color: white;height: 1px;margin: 0">
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <span>Vitamina C</span>
                </div>
                <div class="col-2">
                    10%
                </div>
            </div>
            <div class="row" style="padding-bottom: 0;padding-top: 0">
                <div class="col-12">
                    <hr style="background-color: white;height: 1px;margin: 0">
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <span>Calcio</span>
                </div>
                <div class="col-2">
                    10%
                </div>
            </div>
            <div class="row" style="padding-bottom: 0;padding-top: 0">
                <div class="col-12">
                    <hr style="background-color: white;height: 1px;margin: 0">
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <span>Hierro</span>
                </div>
                <div class="col-2">
                    10%
                </div>
            </div>
            <div class="row" style="padding-bottom: 0;padding-top: 0">
                <div class="col-12">
                    <hr style="background-color: white;height: 1px;margin: 0">
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-justify" style="line-height:1;padding-bottom: 3%">
                    *Los porcentajes de valores diarios estan basados en una dieta de 2000 calorias (8500KJ).
                    Sus valores diarios pueden ser mayores o menores dependiendo de sus necesidades caloricas.
                </div>
            </div>


        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="row" style="padding-bottom: 1%">
                <div class="col-12">
                    <h2 class="text-center">Nuestros Valores</h2>
                </div>
            </div>
            <div class="row " style="padding-bottom: 3%">
                <div class="col-12 text-center">
                    <img src="{{url("images/page/iconos-valores.png")}}">
                </div>
            </div>

            <div class="row" style="padding-bottom: 1%">
                <div class="col-12">
                    <h2 class="text-center">Nuestros Certificados</h2>
                </div>
            </div>
            <div class="row " style="padding-bottom: 5%">
                <div class="col-12 text-center">
                    <img src="{{url("images/page/certificados.png")}}">
                </div>
            </div>

        </div>
    </div>

        <!--<section style="background-color: rgba(255,252,245,.7);width: 100%">-->

    <div class="row justify-content-center" style="background-color: #7bc0ad;">
        <div class="col-9">
            <div class="row">
                <div class="col-10 offset-1" style="padding-top: 1%;padding-bottom: 1%">
                    <h2 style="color:white">Productos que te puedan interesar</h2>
                </div>
            </div>
            <div class="row row-space row-center" style="padding-bottom: 1%">
                <div class="col-lg-10 col-md-12 ">
                    <div id="carouselExampleIndicators3" class="carousel slide" data-ride="carousel">

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row text-center">
                                    <?php
                                    $cont = 0;

                                    foreach ($relations as $i => $value) {
                                        ?>
                                        <div class="col-lg-3 col-md-3 col-sm-7">
                                            <div class="card" >
                                                <img class="card-img-top" src="https://superfuds.com/{{$value->thumbnail}}" alt="Card image cap" onclick="obj.redirectProduct('{{$value->slug}}')" style="cursor: pointer;width:60%;position: relative;margin-left: 20%;padding-top: 15px">
                                                <div class="card-body text-center">
                                                    <p class="text-left text-muted text-supplier" >{{strtoupper($value->supplier)}}</p>
                                                    <h5 class="card-title text-left title-products" style="margin:0;min-height: 60px" onclick="obj.redirectProduct('{{$value->slug}}')">
                                                        <?php echo strtoupper(substr($value->short_description, 0, 25)); ?>
                                                    </h5>
                                                    <p class="text-left">
                                                        <svg id="i-star" viewBox="0 0 32 32" class="star"  stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                        <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                        </svg>
                                                        <svg id="i-star" viewBox="0 0 32 32" class="star" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                        <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                        </svg>
                                                        <svg id="i-star" viewBox="0 0 32 32" class="star" width="22" height="22" color="#ffa608" fill="#ffa608" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                        <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                        </svg>
                                                        <svg id="i-star" viewBox="0 0 32 32" class="star" color="#ffa608" fill="#ffa608" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                        <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                        </svg>
                                                        <svg id="i-star" viewBox="0 0 32 32" class="star" color="#ffa608" fill="#ffa608" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
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

                                                    <div class="row <?php echo (isset($value->quantity_order)) ? '' : 'd-none' ?>" id="buttonAdd_{{$value->id}}" style="background-color: green;padding-bottom: 3%;padding-top: 3%;border-radius: 10px">
                                                        <div class="col">
                                                            <svg id="i-plus" class="btn-plus" viewBox="0 0 35 35"  fill="white" stroke="#ffffff" 
                                                                 stroke-linecap="round" stroke-linejoin="round" stroke-width="2" style="cursor:pointer"
                                                                 onclick="objCounter.addProduct('{{$value->short_description}}',
                                                                 '{{$value->slug}}','{{$value->id}}','{{$value->price_sf}}','{{url($value->thumbnail)}}','{{$value->tax}}'); return false;">
                                                            <path d="M16 2 L16 30 M2 16 L30 16" />
                                                            </svg>
                                                        </div>
                                                        <div class="col">
                                                            <span id="quantity_product_{{$value->id}}" style="color:white">{{(isset($value->quantity_order))?$value->quantity_order:0}}</span>
                                                        </div>
                                                        <div class="col" >
                                                            <svg id="i-minus" class="btn-minus" viewBox="0 0 32 32" fill="white"  style="cursor:pointer"
                                                                 stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                 onclick="objCounter.deleteUnit({{$value->id}},'{{$value->slug}}')">
                                                            <path d="M2 16 L30 16" />
                                                            </svg>
                                                        </div>
                                                    </div>

                                                    <button class="btn btn-success <?php echo (isset($value->quantity_order)) ? 'd-none' : '' ?>" 
                                                            id="btnOption_{{$value->id}}" onclick="objCounter.showButton('{{$value->short_description}}',
                                                            '{{$value->slug}}','{{$value->id}}','{{$value->price_sf}}','{{url($value->thumbnail)}}','{{$value->tax}}')">Agregar</button>
                                                                                                                                                    <!--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->

                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $cont++;
                                        if ($cont == 4 && count($relations) != 4) {
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

    <div class="row" style="padding-top: 2%">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-center">Comentarios</h1>
                </div>
            </div>

        </div>
    </div>
    <div class="row" style="padding-top: 2%">
        <div class="col-lg-12" style="margin: 0 auto;">
            <p class="text-center"><button class="btn btn-success" style="background-color:#30c594" id='btnOpenModal' data-target="#modalComment">Escribe tu comentario</button></p>
        </div>
    </div>
    <div class="row" style="padding-top: 2%">
        <div class="col-lg-6 offset-3" id="contentComment">

        </div>

    </div>
</div>

<div class="modal fade" id="modalComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Comentarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmComment">
                    <input type="hidden" class="input-comment" name="answer_id" id="answer_id">
                    <div class="row row-space">
                        <div class="col-lg-12">
                            <input type="text" class="form-control input-comment" name="title" id="txtTitle" placeholder="Asunto">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <textarea class="form-control input-comment" id="txtComment" placeholder="Escribe aqui tu comentario" rows="5"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnSendComment">Enviar</button>
            </div>
        </div>
    </div>
</div>

{!!Html::script('js/Ecommerce/detailProduct.js')!!}
@endsection
