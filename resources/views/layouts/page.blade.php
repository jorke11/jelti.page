<?php
# Iniciando la variable de control que permitirá mostrar o no el modal
$exibirModal = false;
//unset($_COOKIE["mostrarModal"]);
# Verificando si existe o no la cookie
if (!isset($_COOKIE["mostrarModal"])) {

    # Caso no exista la cookie entra aquí
    # Creamos la cookie con la duración que queramos
    //$expirar = 3600; // muestra cada 1 hora
    //$expirar = 10800; // muestra cada 3 horas
    //$expirar = 21600; //muestra cada 6 horas
    $expirar = 43200; //muestra cada 12 horas
    //$expirar = 86400;  // muestra cada 24 horas
    setcookie('mostrarModal', 'SI', (time() + $expirar));
    # Ahora nuestra variable de control pasará a tener el valor TRUE (Verdadero)
    $exibirModal = true;
}
clearstatcache();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Pragma" content="no-cache">
        <title>SuperFüds</title>
        <script>var PATH = '{{url("/")}}'</script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('assets/images/icon.png') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

        <!-- Fonts -->

        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <meta name="keywords" content="organico,saludable,distribuidor,distribución,mayorista,al por mayor,colombia,bogotá,medellín,cartagena,sin gluten,libre de">
        <meta name="description" content="Superfuds. Hemos creado una forma mas eficiente para que los proveedores y los compradores de productos saludables y ecológicos se conecten! Unete a esta revolución de vida saludable">
        <!-- Styles -->

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        {!!Html::script('/vendor/toastr/toastr.min.js')!!}
        {!!Html::style('/vendor/toastr/toastr.min.css')!!}
        {!!Html::script('/vendor/bootstrap-typeahead.js')!!}

        {!!Html::style('/css/page.css')!!}
        <script src="/vendor/plugins.js" async></script>

        {!!Html::style('/vendor/select2/css/select2.min.css')!!}
        {!!Html::script('/vendor/select2/js/select2.js')!!}
        {!!Html::style('/css/edited.css')!!}
        {!!Html::style('/css/card.css')!!}

    </head>

    <style>
        .carousel-control-prev-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000000' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E") !important;
        }

        .carousel-control-next-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000000' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E") !important;
        }

        .go-top {
            position: fixed;
            bottom: 4em;
            right: 2em;
            text-decoration: none;
            color: #fff;
            background-color: rgb(90,176,153,0.8);
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

        .slider-main{
            position:fixed;
        }

        .link-green{
            color:rgba(91,175,152,1);
            font-weight: 600
        }

        .card{
            -webkit-box-shadow: -9px 8px 12px -2px rgba(0,0,0,0.15);
            -moz-box-shadow: -9px 8px 12px -2px rgba(0,0,0,0.15);
            box-shadow: -9px 8px 12px -2px rgba(0,0,0,0.15);

            border: 1px solid rgba(0,0,0,.07);
            border-radius:10px;
            margin-bottom: 3%;
            margin-left: 4%;
            /*border:none;*/
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

        #loading-super{
            display: scroll;
            position: fixed;
            z-index: 10000;
            left: 50%;
            top: 40%
        }
        #popover-customer{
            position: absolute;
            top: 12%;
            right: 50px;
            text-decoration: none;
            width: 25%;
            padding-top: 0.1em;
            z-index: 2000;
        }

        #content-cart{
            padding: 20px;
            overflow-y: scroll;
            max-height: 500px;
        }

    </style>

    <body>
        @include("modalRegister")
        @include("modalOptions")

        <div id="popover-customer" class="d-none">
            <div class="card">
                <div class="card-header card-customer">Resumen de venta</div>
                <div class="card-body card-customer" id="content-cart"></div>
            </div>
        </div>

        <div class="container-fluid" style="padding-left: 0; padding-right: 0">
            <div id="loading-super" class="d-none" >
                <img src="{!!asset('images/Gif_final.gif')!!}" width='60%' alt="git loading">
            </div>
            @include("header")

            @yield('content')
        </div>
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


</html>
<?php
if (Auth::user() != null) {
    $exibirModal = false;
}

if ($exibirModal === true) : // Si nuestra variable de control "$exibirModal" es igual a TRUE activa nuestro modal y será visible a nuestro usuario.            
    ?>
    <script>
        $(function () {
            $("#myModal").modal("show");
        });
    </script>
<?php endif; ?>

{!!Html::script('js/Page/counter.js')!!}

<link href="{{ asset('/css/fonts.css') }}" rel="stylesheet" type="text/css">
<script src="{{asset("js/app.js")}}"></script>