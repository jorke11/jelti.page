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
</style>

<input id="slug_product" value="{{$product->slug}}" type="hidden">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-lg-offset-1">
            <hr style="border-top: 1px solid #8c8c8c;">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active text-center">
                                <div class="col">
                                    <div class="row row-center">
                                        <!--<div class="col-lg-12">-->
                                        @if($product->characteristic!=null)
                                        @foreach($product->characteristic as $val)
                                        <div class="col">
                                            <div class="row">
                                                <div class="row hover01">
                                                    <div class="col-3">
                                                        <img id="sub_{{$val->id}}" src="/{{$val->img}}" alt="" title="{{$val->description}}" class="img-fluid center-block" style="cursor:pointer">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                                @if($product->image!=null)
                                <img src="{{url($product->image)}}" alt="" width="40%">
                                @else
                                <img src="" alt="No disponible" width="80%" style="padding-left: 20%">
                                @endif
                                <div class="carousel-caption">
                                </div>
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
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row" style="padding-bottom: 5%">
                                <div class="col-lg-12" style="color:#979797;font-size: 20px;font-weight: 600">
                                    {{ucwords($supplier["business"])}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" style="font-size: 18px;font-weight: 600">
                                    {{ucwords($product->title)}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="text-muted">Unidades {{$product->units_sf}} &nbsp;
                                        <span class="glyphicon glyphicon-star" style="color:#f0e012"></span>
                                        <span class="glyphicon glyphicon-star" style="color:#f0e012"></span>
                                        <span class="glyphicon glyphicon-star" style="color:#f0e012"></span>
                                        <span class="glyphicon glyphicon-star" style="color:#f0e012"></span>
                                        <span class="glyphicon glyphicon-star-empty"></span>
                                    </h4>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">

                            <h4>Description</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="hidden" id="product_id" name="product_id" value="{{$product->id}}">
                            {{$product->short_description}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <h4 style="color:#434141">Precio $ {{number_format($product->price_sf,0,",",".")}}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="text-muted">Codigo: {{$product->reference}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>Cantidad X{{$product->packaging}} (<b>Disponible</b>): <span class="badge badge-pill badge-success">{{$available}}</span></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" 
                                          onclick="obj.addProduct('{{$product->short_description}}',
                                           '{{$product->slug}}','{{$product->id}}','{{$product->price_sf}}','{{url($product->thumbnail)}}','{{$product->tax}}')"
                                          style="background-color: #30c594;color:white;cursor: pointer">+</span>
                                </div>
                                <input type="text" class="form-control" id="quantity" name="quantity" value="0" type="number">
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="obj.delete('{{$product->short_description}}',
                                           '{{$product->slug}}','{{$product->id}}','{{$product->price_sf}}','{{url($product->thumbnail)}}','{{$product->tax}}')" style="background-color: #30c594;color:white;cursor: pointer">-</span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <br>
                </div>        
            </div>

            <section style="background-color: rgba(255,252,245,.7);width: 100%">
                <div class="row justify-content-center">
                    <div class="col-10">
                        <div class="row">
                            <div class="col">
                                <h2 class="text-muted">Productos Relacionados</h2>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-12">
                                <div class="carousel slide media-carousel" id="newproducts">
                                    <div class="carousel-inner">
                                        <div class="item  active">
                                            <div class="row justify-content-center" style="padding-top: 2%;padding-bottom: 2%">
                                                <?php
                                                $cont = 0;
                                                foreach ($relations as $i => $value) {
                                                    ?>
                                                    <div class="col-3">
                                                        <div class="card" onclick="obj.redirectProduct('{{$value->slug}}')">
                                                            <img class="card-img-top" src="/{{$value->thumbnail}}" alt="Card image cap" >
                                                            <div class="card-body text-center">
                                                                <h5 class="card-title" style="min-height:65px"><?php echo $value->short_description; ?></h5>
                                                                <!--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
                                                                <a href="/productDetail/{{$value->slug}}" class="btn btn-primary">Comprar</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $cont++;
                                                    if ($cont == 5) {
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

                                    <a class="left carousel-control" href="#newproducts" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#newproducts" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </section>
            <div class="row row-center justify-content-center">
                <div class="col-6">
                    <section class="timeline">
                        <ul>
                            <li>
                                <div>
                                    <time>Acerca del producto</time>
                                    <p class="text-justify">{{$product->about}}</p>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <time>Por qué te encantara</time>
                                    <p class="text-justify">{{$product->why}}</p>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <time>Ingredientes</time>
                                    <p class="text-justify">
                                        {{$product->ingredients}}
                                    </p>
                                </div>
                            </li>

                        </ul>
                    </section>

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
        <div class="col-lg-6" id="contentComment">
        </div>
        <div class="col-lg-6">
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
                <button type="button" class="btn btn-primary">Enviar</button>
            </div>
        </div>
    </div>
</div>

{!!Html::script('js/Ecommerce/detailProduct.js')!!}
@endsection
