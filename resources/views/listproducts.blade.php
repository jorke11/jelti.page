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


        </style>


    </style>
</div>
<section>
    @include("header")
    <div class="container-fluid" style="padding-left: 0; padding-right: 0">
        <section id="slider-main" class="main-slider">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{url($row_category->banner)}}" alt="Second slide">
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>

<section style="padding-top: 50px">
    <div class="container-fluid" style="padding-left: 0; padding-right: 0">
        <div class="row">
            <div class="col-2">
                <div class="row row-space" style="border:1px #ccc solid;border-radius: 10px; margin-bottom: 20px" id="categories-filter">
                    <div class="col-12" style="padding-right:0px">
                        <ul class="list-group">
                            <li class="list-group-item"><b>CATEGORIAS</b></li>
                            <div id="content-categories">
                                <?php
                                $active = "";
                                $check = "";
                                $check = "";

                                foreach ($category as $val) {
                                    if ($slug_category == $val->slug) {
                                        $check = "checked";
                                    } else {
                                        $check = "";
                                    }
                                    ?>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-10 ">
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
                <div class="row " style="border:1px #ccc solid;border-radius: 10px">
                    <div class="col-12">
                        <ul class="list-group">
                            <li class="list-group-item"><b>SUBCATEGORIAS</b></li>
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
                                                <input type="checkbox" name="subcategories[]" class="form-control" value="{{$val->slug}}" onclick=obj.reloadCategories('{{$val->asdslug}}')>
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
            <div class="col-10 justify-content-center text-center">
                <section id="divproducts">
                    <div class="row justify-content-center text-center" style="padding-bottom: 2%" >
                        <?php
                        $cont = 0;
                        foreach ($products as $value) {
                            ?>
                            <div class="col text-center">

                                <div class="card">
                                    <img class="card-img-top img-fluid" src="/{{$value->thumbnail}}" alt="Card image cap" onclick="obj.redirectProduct('{{$value->slug}}')">
                                    <div class="card-body">
                                        <h5 class="card-title" style="min-height:60px"><?php echo $value->short_description; ?></h5>
                                        <!--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
                                        <a href="/productDetail/{{$value->slug}}" class="btn btn-primary">Comprar</a>
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
                    <div class="row row-center justify-content-center" style="padding-top: 2%;padding-bottom: 2%">
                        <div class="col text-center justify-content-center">
                            {{ $products->links("pagination::bootstrap-4") }}
                        </div>
                    </div>
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
{!!Html::script('js/Page/page.js')!!}

</html>
