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
        <style>
            .modal-content {
                background-color: rgba(255,255,255,.6)
            }
        </style>

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

            .go-top {
                position: fixed;
                bottom: 4em;
                right: 2em;
                text-decoration: none;
                color: #fff;
                background-color: rgba(0, 0, 0, 0.3);
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

        </style>
    </div>
    <section>
        <div class="container-fluid" style="padding-left: 0; padding-right: 0">
            <div class="col-xs-offset-2">
                @include("header")
            </div>


            <a class="go-top" href="#">Subir</a>

            <section id="slider-main" class="main-slider">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{$row_category->banner}}" alt="Second slide">
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <section style="padding-top: 100px">
        <div class="container-fluid" style="padding-left: 0; padding-right: 0">
            <div class="row">
                <div class="col-3">
                    <div class="row">
                        <div class="col-12">
                            <ul class="list-group">
                                <li class="list-group-item">CATEGORIAS</li>
                                <?php
                                $active = "";
                                foreach ($category as $val) {
                                    if ($slug_category == $val->slug) {
                                        $active = "active";
                                    } else {
                                        $active = "";
                                    }
                                    ?>
                                    <li class="list-group-item {{$active}}">
                                        {{$val->description}}
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <section>
                        <div class="row" style="padding-top: 2%;padding-bottom: 2%">
                            <?php
                            $cont = 0;
                            foreach ($products as $value) {
                                ?>
                                <div class="col-lg-3">
                                    <div class="thumbnail" style="padding: 0">
                                        <img src="/{{$value->thumbnail}}" alt="Pending" onclick="obj.redirectProduct('{{$value->slug}}')" style="cursor: pointer">
                                        <div class="caption" style="padding: 0">
                                            <h5 class="text-center" style="min-height: 70px"><a href="/productDetail/{{$value->slug}}" style="color:black;font-weight: 400;letter-spacing:2px"><?php echo $value->short_description; ?></a></h5>
                                            @if(!Auth::guest())
                                            <p>
                                            <h4 class="text-center" style="color:black;font-weight: 400;">$ {{number_format($value->price_sf,0,",",".")}}</h4>
                                            </p>
                                            @endif
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    @if(!Auth::guest())
                                                    <a href="/productDetail/{{$value->slug}}" class="btn btn-success form-control" style="background-color: #30c594;">COMPRAR</a>
                                                    @else
                                                    <a href="/login" class="btn btn-success form-control" style="background-color: #30c594;">COMPRAR</a>
                                                    @endif

                                                </div>
                                            </div>


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
                            ?>
                        </div>
                        <div class="row row-center" style="padding-top: 2%;padding-bottom: 2%">
                            <div class="col-8 text-center offset-1">
                                <nav aria-label="Page navigation example">
                                    {{ $products->links("pagination::bootstrap-4") }}
                                </nav>
                            </div>
                        </div>
                    </section>
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