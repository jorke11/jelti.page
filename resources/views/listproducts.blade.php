
@extends('layouts.page')

@section('content')
{!!Html::style('/css/page.css')!!}

<section id="content-menu">
    <div  class="container-fluid" style="padding-left: 0; padding-right: 0;position:relative;top: -120px">
        <section id="slider-main" class="main-slider">
            <div id="carouselExampleIndicators" class="carousel slide">
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
    <div class="container-fluid"  id="content-image" style="padding-left: 0; padding-right: 0;padding-bottom: 5%;position:relative;top:-200px;min-height: 100px">
        <div class="row center-block" style="margin-right: 0;padding-top:4%">
            <div class="col-lg-3 offset-1 ">
                <span><?php echo $breadcrumbs ?></span>
            </div>
<!--            <div class="col-lg-8">
                @if(isset($param) && count($products)>0)
                <div class="alert alert-warning">{{count($products)}} Producto{{(count($products)>1)?'s':''}} relacionado con: ({{isset($param)?$param:''}})</div>
                @endif
            </div>-->
        </div>

        <div class="row center-block" style="margin-right: 0;padding-top:1%">
            <div class="col-2 offset-1 col-md-3 col-md-offset-0">
                <div class="row center-block ml-0 mr-0 pl-0 pr-0" id="categories-filter">
                    <div class="col-12" style="border:8px rgba(0,0,0,.1) solid;border-radius: 10px; margin-bottom: 20px">
                        <ul class="list-group">
                            <li class="list-group-item title-menu-left" data-toggle="collapse" onclick="obj.eventCategory(null, 'content-filter-categories')"><b>CATEGORIAS</b> ({{count($categories)}})
                                <span style="float:right" id="plus-icon" class="d-none">
                                    <svg id="i-minus" viewBox="0 0 32 32" class="img-plus-filter" fill="black"
                                         stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <path d="M2 16 L30 16" />
                                    </svg>
                                </span>
                                <span style="float:right" id="minus-icon">
                                    <svg id="i-plus" viewBox="0 0 35 35" class="img-plus-filter" fill="black" stroke="#000000" 
                                         stroke-linecap="round" stroke-linejoin="round" stroke-width="2" style="cursor:pointer">
                                    <path d="M16 2 L16 30 M2 16 L30 16" />
                                    </svg>

                                </span>
                            </li>
                            <div id="content-filter-categories" class="collapse">

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
                                    <li class="list-group-item pb-0 pt-0">
                                        <div class="row" style="cursor:pointer">
                                            <div class="col-12">
                                                <a href="javascript:;" class="list-group-item list-group-item-action" onclick="obj.reloadCategories('{{$val->slug}}', this);">
                                                    <div class="row">
                                                        <div class="col-lg-10 subtitle-menu-left">
                                                            {{ucwords(strtolower($val->description))}} ({{$val->subcategories}})
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <input type="checkbox" class="form-control list-category" 
                                                                   name="categories[]" <?php echo $check ?> value="{{$val->slug}}" id='checkbox_cat_{{$val->slug}}'
                                                                   >
                                                        </div>
                                                    </div>

                                                </a>
                                            </div>
                                        </div>

                                    </li>
                                    <?php
                                }
                                ?>
                            </div>
                        </ul>
                        <ul class="list-group">
                            <li class="list-group-item title-menu-left"  data-toggle="collapse" onclick="obj.eventCategory('subcat', 'content-subcategories')">SUBCATEGORIAS ({{count($subcategory)}})

                                <span style="float:right" id="plus-icon-subcat" >
                                    <svg id="i-plus" viewBox="0 0 35 35" class="img-plus-filter" fill="black" stroke="#000000" stroke-linecap="round" 
                                         stroke-linejoin="round" stroke-width="2">
                                    <path d="M16 2 L16 30 M2 16 L30 16" />
                                    </svg>
                                </span>
                                <span style="float:right" id="minus-icon-subcat" class="d-none">
                                    <svg id="i-minus" viewBox="0 0 32 32" class="img-plus-filter"  fill="black"  style="cursor:pointer"
                                         stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <path d="M2 16 L30 16" />
                                    </svg>
                                </span>

                            </li>
                            <div id="content-subcategories" class="collapse">
                                <?php
                                $active = "";
                                foreach ($subcategory as $val) {
                                    if ($slug_category == $val->slug) {
                                        $active = "active";
                                    } else {
                                        $active = "";
                                    }
                                    ?>
                                    <li class="list-group-item pb-0 pt-0">
                                        <div class="row" style="cursor:pointer" onclick="obj.reloadCategories('{{$val->slug}}'); return false;">
                                            <div class="col-12">
                                                <a href="#" class="list-group-item list-group-item-action" >
                                                    <div class="row">
                                                        <div class="col-lg-10 subtitle-menu-left">
                                                            {{ucwords(strtolower($val->description))}} ({{$val->products}})
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <input type="checkbox" class="form-control list-category" 
                                                                   name="subcategories[]" <?php echo $check ?> value="{{$val->slug}}" id='checkbox_subcat_{{$val->slug}}'>
                                                        </div>
                                                    </div>

                                                </a>
                                            </div>
                                        </div>

                                    </li>
                                    <?php
                                }
                                ?>
                            </div>
                        </ul>
                        <ul class="list-group">
                            <li class="list-group-item title-menu-left"  style=" border-bottom: 3px solid #ccd07b;margin-bottom: 20px;"
                                data-toggle="collapse" onclick="obj.eventCategory('sup', 'content-supplier')"><b>PROVEEDORES</b> ({{count($supplier)}})
                                <span style="float:right" id="plus-icon-sup">
                                    <svg id="i-plus" viewBox="0 0 35 35" class="img-plus-filter" fill="black" stroke="#000000" 
                                         stroke-linecap="round" stroke-linejoin="round" stroke-width="2" style="cursor:pointer">
                                    <path d="M16 2 L16 30 M2 16 L30 16" />
                                    </svg>
                                </span>
                                <span style="float:right" id="minus-icon-sup" class="d-none">
                                    <svg id="i-minus" viewBox="0 0 32 32" class="img-plus-filter" fill="black"  style="cursor:pointer"
                                         stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <path d="M2 16 L30 16" />
                                    </svg>
                                </span></li>
                            <div id="content-supplier" class="collapse">
                                <?php
                                $active = "";
                                foreach ($supplier as $val) {
//                                    if ($slug_category == $val->slug) {
//                                        $active = "active";
//                                    } else {
//                                        $active = "";
//                                    }
                                    ?>
                                    <li class="list-group-item">
                                        <div class="row" style="cursor:pointer" onclick="obj.reloadCategories('{{$val->id}}'); return false;">
                                            <div class="col-10 subtitle-menu-left">
                                                {{ucwords(strtolower($val->business))}} ({{$val->products}})
                                            </div>
                                            <div class="col-2">
                                                <input type="checkbox" name="supplier[]" class="form-control" value="{{$val->id}}" id='checkbox_sup_{{$val->id}}'>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                                ?>
                            </div>
                        </ul>
                        <ul class="list-group" id="filter-diet">
                            <li class="list-group-item title-menu-left"  style=" border-bottom: 3px solid #ccd07b;margin-bottom: 20px;"
                                data-toggle="collapse" onclick="obj.eventCategory('diet', 'content-dietas')"><b>DIETAS</b> ({{count($dietas)}})
                                <span style="float:right" id="plus-icon-diet">
                                    <svg id="i-plus" viewBox="0 0 35 35" class="img-plus-filter" fill="black" stroke="#000000" 
                                         stroke-linecap="round" stroke-linejoin="round" stroke-width="2" style="cursor:pointer">
                                    <path d="M16 2 L16 30 M2 16 L30 16" />
                                    </svg>
                                </span>
                                <span style="float:right" id="minus-icon-diet" class="d-none">
                                    <svg id="i-minus" viewBox="0 0 32 32" class="img-plus-filter" fill="black"  style="cursor:pointer"
                                         stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <path d="M2 16 L30 16" />
                                    </svg>
                                </span></li>
                            <div id="content-dietas" class="collapse">
                                <?php
                                foreach ($dietas as $val) {
//                                    if ($slug_category == $val->slug) {
//                                        $active = "active";
//                                    } else {
//                                        $active = "";
//                                    }
                                    ?>
                                    <li class="list-group-item">
                                        <div class="row" style="cursor:pointer" onclick="obj.reloadCategories('{{$val->id}}'); return false;">
                                            <div class="col-10 subtitle-menu-left">
                                                {{ucwords(strtolower($val->description))}} ({{$val->description}})
                                            </div>
                                            <div class="col-2">
                                                <input type="checkbox" name="dietas[]" class="form-control" value="{{$val->slug}}" id='checkbox_dieta_{{$val->id}}'>
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
                    <div class="row text-center" style="padding-bottom: 1%;" >
                        <?php
                        $cont = 0;
                        if (count($products) > 0) {
                            foreach ($products as $value) {
                                ?>
                                <div class="col-lg-3 col-6">
                                    <div class="card text-center" id="card_{{$value->id}}">
                                        <img class="card-img-right img-fluid" src="https://superfuds.com/{{$value->thumbnail}}" alt="Card image cap" onclick="objCounter.redirectProduct('{{$value->slug}}')" 
                                             style="cursor: pointer;width:60%;position: relative;margin-left: 20%;padding-top: 15px">
                                        <div class="card-body" style="padding-bottom: 1.25em;padding-top:0;padding-left: 15px;padding-right: 15px">
                                            <p class="text-left text-muted text-supplier" style="margin:0;">
                                                <a style="color:#6c757d" href="{{url("/search/s=".str_slug(strtolower($value->supplier), '-'))}}">{{strtoupper($value->supplier)}}</a></p>
                                            <p class="text-left title-products" onclick="objCounter.redirectProduct('{{$value->slug}}')">
                                                <?php echo strtoupper(substr(trim($value->short_description), 0, 30)); ?>
                                            </p>
                                            @guest
                                            <p></p>
                                            @else
                                            <p class="text-left">
                                                $ {{number_format($value->price_sf_with_tax,0,",",'.')}}
                                            </p>
                                            @endguest

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

                                            @if(isset($value->quantity))
                                            <button class="btn <?php echo (isset($value->quantity)) ? '' : 'd-none' ?>" type="button" 
                                                    onmouseover="objCounter.showOption(this,{{$value->id}})" id="buttonShow_{{$value->id}}" 
                                                    style="background-color: #5cb19a;color:white;margin-bottom: 4%"
                                                    >{{$value->quantity}} en carrito</button>
                                            @endif

                                            <div class="row d-none row-center" id="buttonAdd_{{$value->id}}" onmouseout="objCounter.hideButton(this, {{$value->id}})">
                                                <div class="col-lg-6 col-6">
                                                    <div class="row" style="background-color: #5cb19a;color:white;padding-bottom: 2%;padding-top: 5%;
                                                         padding-left: 0;padding-right: 0;border-radius: 10px;">
                                                        <div class="col-lg-4 col-4" style="padding-left: 0;padding-right: 0" onclick="objCounter.deleteUnit({{$value->id}},'{{$value->slug}}')">
                                                            <svg id="i-minus" viewBox="0 0 32 32" class="btn-minus-card-product" fill="white"  style="cursor:pointer;"
                                                                 stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                                 >
                                                            <path d="M2 16 L30 16" />
                                                            </svg>
                                                        </div>
                                                        <div class="col-lg-4 col-4" style="padding-left: 0;padding-right: 0">
                                                            <input type="text" id="quantity_list_product_{{$value->id}}" class="input-quantity-product" value="{{(isset($value->quantity))?$value->quantity:0}}"
                                                                   onkeypress="objCounter.addProductEnter(event,'{{$value->short_description}}',
                                                                               '{{$value->slug}}','{{$value->id}}','{{$value->price_sf}}','{{url($value->thumbnail)}}','{{$value->tax}}'
                                                                                           , 'quantity_list_product_{{$value->id}}')">
                                                        </div>
                                                        <div class="col-lg-4 col-4" style="padding-left: 0;padding-right: 0" onclick="objCounter.addProduct('{{$value->short_description}}',
                                                             '{{$value->slug}}','{{$value->id}}','{{$value->price_sf}}','{{url($value->thumbnail)}}','{{$value->tax}}','quantity_list_product_{{$value->id}}'); return false;">
                                                            <svg id="i-plus" viewBox="0 0 35 35" class="btn-minus-card-product" fill="white" stroke="#ffffff" 
                                                                 stroke-linecap="round" stroke-linejoin="round" stroke-width="4" style="cursor:pointer"
                                                                 >
                                                            <path d="M16 2 L16 30 M2 16 L30 16" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-2" style="margin-left: 3px;">
                                                    <div class="row icon-ok">
                                                        <div class="col-lg-6 col-6">
                                                            <svg id="i-checkmark" viewBox="0 0 32 32" class="btn-minus-card-product" fill="none" stroke="currentcolor" stroke-linecap="round" 
                                                                 stroke-linejoin="round" stroke-width="4"
                                                                 style="cursor:pointer"
                                                                 onclick="objCounter.addProduct('{{$value->short_description}}',
                                                                 '{{$value->slug}}','{{$value->id}}','{{$value->price_sf}}','{{url($value->thumbnail)}}','{{$value->tax}}','quantity_list_product_{{$value->id}}'); return false;"
                                                                 >
                                                            <path d="M2 20 L12 28 30 4" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn <?php echo (isset($value->quantity)) ? 'd-none' : '' ?>" 
                                                    id="btnOption_{{$value->id}}" onclick="objCounter.showButton('{{$value->short_description}}',
                                                    '{{$value->slug}}','{{$value->id}}','{{$value->price_sf}}','{{url($value->thumbnail)}}','{{$value->tax}}','quantity_list_product_{{$value->id}}')" 
                                                    style="background-color: #5cb19a;color:white">Agregar</button>

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
