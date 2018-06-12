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

            .card{
                -webkit-box-shadow: -9px 8px 12px -2px rgba(0,0,0,0.25);
                -moz-box-shadow: -9px 8px 12px -2px rgba(0,0,0,0.25);
                box-shadow: -9px 8px 12px -2px rgba(0,0,0,0.25);
                border-radius:10px;
                margin-bottom: 3%;
                margin-left: 4%
            }
        </style>
        <section id="content-menu">
            @include("header")
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
                                                        {{$val->description}}
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
                                                   onclick="obj.addProduct('{{$value->short_description}}',
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
