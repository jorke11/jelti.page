@extends('layouts.page')
@section('content')
<div class="container-fluid">
    <div class="row center-block justify-content-center" style="margin-top: 5%">
        <div class="col-lg-12">
            <section id="divproducts">
                <div class="row text-center" style="padding-bottom: 1%;" >
                    <?php
                    $cont = 0;
                    if (count($products) > 0) {
                        foreach ($products as $value) {
                            ?>
                            <div class="col-3">
                                <div class="card text-center">
                                    <img class="card-img-right img-fluid" src="https://superfuds.com/{{$value->thumbnail}}" alt="Card image cap" onclick="obj.redirectProduct('{{$value->slug}}')" 
                                         style="cursor: pointer;width:60%;position: relative;margin-left: 20%;padding-top: 15px">
                                    <div class="card-body" style="padding-bottom: 1.25em;padding-top:0;padding-left: 15px;padding-right: 15px">
                                        <p class="text-left text-muted text-supplier" style="margin:0;">
                                            <a style="color:#6c757d" href="{{url("/search/s=".str_slug(strtolower($value->supplier), '-'))}}">{{strtoupper($value->supplier)}}</a></p>
                                        <p class="text-left text-products" style="margin:0;min-height: 55px;cursor:pointer" onclick="obj.redirectProduct('{{$value->slug}}')">
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

                                        <div class="row d-none row-center" id="buttonAdd_{{$value->id}}" onmouseout="objCounter.hideButton(this, {{$value->id}})"
                                             style="">
                                            <div class="col-lg-6">
                                                <div class="row" style="background-color: #5cb19a;color:white;padding-bottom: 2%;padding-top: 5%;
                                                     padding-left: 0;padding-right: 0;border-radius: 10px;">
                                                    <div class="col-lg-4">
                                                        <svg id="i-minus" viewBox="0 0 32 32" width="25" height="25" fill="white"  style="cursor:pointer;"
                                                             stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                             onclick="objCounter.deleteUnit({{$value->id}},'{{$value->slug}}')">
                                                        <path d="M2 16 L30 16" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-lg-4" style="padding-left: 0;padding-right: 0">
                                                        <input type="text" id="quantity_product_{{$value->id}}" value="{{(isset($value->quantity))?$value->quantity:0}}" size="5" 
                                                               style="text-align: center;padding: 0;border-radius: 5px;border: 0px;padding-bottom: 2px;padding-top: 2px;">
                                                    </div>
                                                    <div class="col-lg-4" >
                                                        <svg id="i-plus" viewBox="0 0 35 35" width="25" height="25" fill="white" stroke="#ffffff" 
                                                             stroke-linecap="round" stroke-linejoin="round" stroke-width="4" style="cursor:pointer"
                                                             onclick="objCounter.addProduct('{{$value->short_description}}',
                                                             '{{$value->slug}}','{{$value->id}}','{{$value->price_sf}}','{{url($value->thumbnail)}}','{{$value->tax}}'); return false;">
                                                        <path d="M16 2 L16 30 M2 16 L30 16" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2" style="margin-left: 3px">
                                                <div class="row" style="background-color: #5cb19a;color:white;padding-bottom: 15%;padding-top: 40%;
                                                     padding-left: 0;padding-right: 0;border-radius: 10px;">
                                                    <div class="col-lg-6">
                                                        <svg id="i-checkmark" viewBox="0 0 32 32" width="20" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" 
                                                             stroke-linejoin="round" stroke-width="4"
                                                             style="cursor:pointer"
                                                             onclick="objCounter.addProductCheck('{{$value->short_description}}',
                                                             '{{$value->slug}}','{{$value->id}}','{{$value->price_sf}}','{{url($value->thumbnail)}}','{{$value->tax}}'); return false;"
                                                             >
                                                        <path d="M2 20 L12 28 30 4" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn <?php echo (isset($value->quantity)) ? 'd-none' : '' ?>" 
                                                id="btnOption_{{$value->id}}" onclick="objCounter.showButton('{{$value->short_description}}',
                                                '{{$value->slug}}','{{$value->id}}','{{$value->price_sf}}','{{url($value->thumbnail)}}','{{$value->tax}}')" 
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
@endsection

