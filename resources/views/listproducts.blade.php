  
@extends('layouts.page')

@section('content')
{!!Html::style('/css/page.css')!!}
    
<section id="content-menu">
    <div class="container-fluid" style="padding-left: 0; padding-right: 0;position:relative;top: -150px">
        <section id="slider-main" class="main-slider">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        @if(isset($row_category->banner))
                        <img class="d-block w-100" src="{{url("images/banner_sf.jpg")}}" alt="Second slide" id="main-image-category">
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>

<section>
    <div class="container-fluid" style="padding-left: 0; padding-right: 0">
        <div class="row center-block" style="margin-right: 0;padding-top:1%">
            <div class="col-2 offset-1">
                <div class="row center-block" id="categories-filter">
                    <div class="col-12" style="border:1px #ccc solid;border-radius: 10px; margin-bottom: 20px">
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
                                                <input type="checkbox" class="form-control" name="categories[]" <?php echo $check ?> value="{{$val->slug}}" onclick="obj.reloadCategories('{{$val->slug}}')">
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
                    <div class="col-12" style="border:1px #ccc solid;border-radius: 10px">
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
                                        <img class="card-img-right img-fluid" src="/{{$value->thumbnail}}" alt="Card image cap" onclick="obj.redirectProduct('{{$value->slug}}')" 
                                             style="cursor: pointer;width:60%;position: relative;margin-left: 20%;padding-top: 15px">
                                        <a href="#" class="btn btn-primary btn-sm" style="
                                           margin-left: 80%;
                                           border-radius: 10px;
                                           background-color: #5baf98;
                                           border: 1px solid #5baf98;
                                           cursor: pointer;
                                           margin-right: 5%;"
                                           onclick="objCounter.addProduct('{{$value->short_description}}',
                                           '{{$value->slug}}','{{$value->id}}','{{$value->price_sf}}','{{url($value->thumbnail)}}','{{$value->tax}}'); return false;"
                                           >
                                            <svg id="i-plus" viewBox="0 0 32 32" width="20" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                            <path d="M16 2 L16 30 M2 16 L30 16" />
                                            </svg>
                                        </a>
                                        <div class="card-body" style="padding-bottom: 1.25em;padding-top:0">

                                            <p class="card-title" onclick="obj.redirectProduct('{{$value->slug}}')" 
                                               style="cursor: pointer;min-height: 60px;margin-bottom: 0;padding-top: 5%" ><?php echo substr($value->short_description, 0, 40); ?></p>
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

                                                                                                                                                                                                        <!--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
                                            @guest
                                            <button class="btn btn-info" type="button" onclick="obj.registerClient()">
                                                Registrate como cliente
                                            </button>

                                            @else
                                            <p>
                                                $ {{number_format($value->price_sf,0,",",'.')}}
                                            </p>
                                            @endguest
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
{!!Html::script('js/Page/detail.js')!!}
@endsection


