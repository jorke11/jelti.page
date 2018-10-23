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

        {!!Html::style('/css/page.css?1')!!}
        <script src="/vendor/plugins.js" async></script>

        {!!Html::style('/vendor/select2/css/select2.min.css')!!}
        {!!Html::script('/vendor/select2/js/select2.js')!!}
        {!!Html::style('/css/edited.css')!!}
        {!!Html::style('/css/card.css?1')!!}

    </head>
    <body >
        <div id="page-content">
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
        </div>
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

<link href="{{ asset('/css/fonts.css') }}" rel="stylesheet" type="text/css">
<!--<script src="{{asset("js/app.js")}}"></script>-->