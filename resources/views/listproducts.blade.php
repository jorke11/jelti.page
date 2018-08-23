  
@extends('layouts.page')

@section('content')
{!!Html::style('/css/page.css')!!}

<style>
    .buttonplus{
        display:scroll;
        position:fixed;
        bottom:170px;
        margin-left: 6%;
        margin-bottom: 1%;
        border-radius: 10px;
        background-color: rgba(255,255,255,0);
        border: 1px solid #5baf98
    }
    .title-products{
        padding: 0;min-height: 60px;      font-size: 16px;
    }
    .star{
        width: 22px;height: 22px
    }

    .buttonplus-svg{
        width: 20px;
        fill:"none"
    }
    .text-supplier{
        font-size: 9px;
    }



    @media (min-width: 1100px){
        .title-new {
            display: none !important;
        }
        .title-products{
            font-size: 16px;
            padding: 0;min-height: 60px;
        }
        .buttonplus{
            display:scroll;
            position:fixed;
            bottom:150px;
            margin-left: 3.5%;
            margin-bottom: 2%;
            border-radius: 10px;
            background-color: rgba(255,255,255,0);
            border: 1px solid #5baf98;

        }

        .buttonplus-svg{
            width: 18px;
            fill:"none"
        }

        .plus-card{
            width: 15px;
            height: 15px
        }

        .star{
            width: 15px;
            height: 15px;
            color:#ffa608;
            fill:#ffa608
        }
        .text-supplier{
            font-size: 9px;
        }
    }

</style>

<section id="content-menu">
    <div  class="container-fluid" style="padding-left: 0; padding-right: 0;position:relative;top: -110px">
        <section id="slider-main" class="main-slider">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">

                        @if(isset($row_category->banner))
                        <img class="d-block w-100" src="{{url($row_category->banner)}}" alt="Second slide" id="main-image-category">
                        @else
                        <img class="d-block w-100" src="{{url("images/banner_sf.png")}}" alt="Second slide" id="main-image-category">
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>

<section>
    <div class="container-fluid"  id="content-image" style="padding-left: 0; padding-right: 0;padding-bottom: 5%;position:relative;top:-100px;min-height: 100px">
        <div class="row center-block" style="margin-right: 0;padding-top:1%">
            <div class="col-lg-2 offset-1 ">
                <span><?php echo $breadcrumbs ?></span>
            </div>
        </div>
        <div class="row center-block" style="margin-right: 0;padding-top:1%">
            <div class="col-2 offset-1 col-md-3 col-md-offset-0">
                <div class="row center-block" id="categories-filter">
                    <div class="col-12" style="border:8px rgba(0,0,0,.1) solid;border-radius: 10px; margin-bottom: 20px">
                        <ul class="list-group">
                            <li class="list-group-item" style=" border-bottom: 3px solid #ccd07b;margin-bottom: 20px"><b>CATEGORIAS</b></li>
                            <div id="content-categories">
                                <?php
                                $active = "";
                                $check = "";
                                $check = "";

                                foreach ($categories as $val) {
                                    if ($slug_category == $val->slug && $val->slug != '') {
                                        $check = "checked";
                                    } else {
                                        $check = "";
                                    }
                                    ?>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-10">
                                                {{ucwords(strtolower($val->description))}}
                                            </div>
                                            <div class="col-2">
                                                <input type="checkbox" class="form-control list-category" name="categories[]" <?php echo $check ?> value="{{$val->slug}}" onclick="obj.reloadCategories('{{$val->slug}}');">
                                            </div>
                                        </div>

                                    </li>
                                    <?php
                                }
                                ?>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-12" style="border:8px rgba(0,0,0,.1) solid;border-radius: 10px">
                        <ul class="list-group">
                            <li class="list-group-item"  style=" border-bottom: 3px solid #ccd07b;margin-bottom: 20px"><b>SUBCATEGORIAS</b></li>
                            <div id="content-subcategories">
                                <?php
                                $active = "";
                                foreach ($subcategory as $val) {
                                    if ($slug_category == $val->slug) {
                                        $active = "active";
                                    } else {
                                        $active = "";
                                    }
                                    ?>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-10">
                                                {{$val->short_description}}
                                            </div>
                                            <div class="col-2">
                                                <input type="checkbox" name="subcategories[]" class="form-control" value="{{$val->slug}}" onclick=obj.reloadCategories('{{$val->slug}}')>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                                ?>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <section id="divproducts">
                    <div class="row justify-content-center text-center" style="padding-bottom: 1%;" >
                        <?php
                        $cont = 0;
                        if (count($products) > 0) {
                            foreach ($products as $value) {
                                ?>
                                <div class="col-3">
                                    <div class="card text-center">
                                        <img class="card-img-right img-fluid" src="http://www.superfuds.com/{{$value->thumbnail}}" alt="Card image cap" onclick="obj.redirectProduct('{{$value->slug}}')" 
                                             style="cursor: pointer;width:60%;position: relative;margin-left: 20%;padding-top: 15px">
                                        <!--                                        <a href="#" id="btn-plus-product_{{$value->id}}" class="btn btn-primary btn-sm" 
                                                                                   style="
                                                                                   margin-left: 75%;
                                                                                   border-radius: 10px;
                                                                                   background-color: white;
                                                                                   border: 1px solid #ccc;
                                                                                   cursor: pointer;
                                                                                   margin-right: 5%;"
                                                                                   onclick="objCounter.addProduct('{{$value->short_description}}',
                                                                                   '{{$value->slug}}','{{$value->id}}','{{$value->price_sf}}','{{url($value->thumbnail)}}','{{$value->tax}}'); return false;"
                                                                                   >
                                                                                    <svg id="i-plus" viewBox="0 0 32 32" class="plus-card" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                                                    <path d="M16 2 L16 30 M2 16 L30 16" />
                                                                                    </svg>
                                                                                </a>-->
                                        <div class="card-body" style="padding-bottom: 1.25em;padding-top:0">

                                            <p class="text-left text-muted text-supplier" style="margin:0;">{{strtoupper($value->supplier)}}</p>
                                            <h5 class="card-title text-left title-products" style="margin:0;min-height: 60px" onclick="obj.redirectProduct('{{$value->slug}}')">
                                                <?php echo strtoupper(substr($value->short_description, 0, 25)); ?>
                                            </h5>
                                           
                                            <p class="text-left">
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
                                                <svg id="i-star" viewBox="0 0 32 32" class="star" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                </svg>
                                            </p>
                                            @guest
                                            <p></p>
                                            @else
                                            <p>
                                                $ {{number_format($value->price_sf,0,",",'.')}}
                                            </p>
                                            @endguest


                                            <div class="row <?php echo (isset($value->quantity)) ? '' : 'd-none' ?>" id="buttonAdd_{{$value->id}}" style="background-color: green;padding-bottom: 3%;padding-top: 3%;border-radius: 10px">
                                                <div class="col-lg-2">
                                                    <svg id="i-plus" viewBox="0 0 35 35" width="28" height="28" fill="white" stroke="#ffffff" 
                                                         stroke-linecap="round" stroke-linejoin="round" stroke-width="2" style="cursor:pointer"
                                                         onclick="objCounter.addProduct('{{$value->short_description}}',
                                                         '{{$value->slug}}','{{$value->id}}','{{$value->price_sf}}','{{url($value->thumbnail)}}','{{$value->tax}}'); return false;">
                                                    <path d="M16 2 L16 30 M2 16 L30 16" />
                                                    </svg>
                                                </div>
                                                <div class="col-lg-8" >
                                                    <span id="quantity_product_{{$value->id}}" style="color:white">{{$value->quantity}}</span>
                                                </div>
                                                <div class="col-lg-2" >
                                                    <svg id="i-minus" viewBox="0 0 32 32" width="28" height="28" fill="white"  style="cursor:pointer"
                                                         stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                         onclick="objCounter.deleteUnit({{$value->id}},'{{$value->slug}}')">
                                                    <path d="M2 16 L30 16" />
                                                    </svg>
                                                </div>
                                            </div>

                                            <button class="btn btn-success <?php echo (isset($value->quantity)) ? 'd-none' : '' ?>" id="btnOption_{{$value->id}}" onclick="obj.showButton('{{$value->short_description}}',
                                                    '{{$value->slug}}','{{$value->id}}','{{$value->price_sf}}','{{url($value->thumbnail)}}','{{$value->tax}}                                            ')">Agregar</button>

                                        </div>
                                    </div>
                                </div>
                                <?php
                                $cont++;
                                if ($cont == 4) {
                                    $cont = 0;
                                    ?>
                                </div>
                                <div class="row" style="padding-top: 2%;padding-bottom: 2%">
                                    <?php
                                }
                            }
                        } else {
                            ?>
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-warning">
                                        No Hemos encontrado productos relacionados con tu busqueda({{$param}})
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    @if(isset($products->links))
                    <div class="row row-center justify-content-center" style="padding-top: 2%;padding-bottom: 2%">
                        <div class="col text-center justify-content-center">
                            <!--{{ $products->links("pagination::bootstrap-4") }}-->
                        </div>
                    </div>
                    @endif
                </section>
            </div>
        </div>
    </div>
</section>
{!!Html::script('js/Page/listProduct.js')!!}
@endsection


