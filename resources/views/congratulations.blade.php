@extends('layouts.page')
@section('content')
<div class="container-fluid">
    <div class="row center-block justify-content-center" style="margin-top: 5%">
        <div class="col-6">
            <h2 class="text-center" style="font-weight: bold;color:#756d6d">TU COMPRA HA SIDO PROCESADA CORRECTAMENTE.</h2>
            <h3 class="text-center" style="font-weight: bold;color:#756d6d">GRACIAS POR TU COMPRA.</h3>
        </div>
    </div>

    @if(Session::has('success'))
    <div class="row center-block justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-success"><strong> Compra Realizada! Orden #123343</strong></div>
                    <p>Recibiras un mensaje con el detalle de tu Pedido</p>
                    <p>Cuando se despache tu pedido recibiras un Email</p>
                    <p>Recuerda revisar tambien tu bandeja de "spam" o correo no deseado</p>
                </div>
            </div>
        </div>
    </div>
    @else
    <?php
    header('Location: https://superfuds.com/');
    exit;
    ?>
    @endif

    <div class="row center-block justify-content-center" style="margin-top: 1%;margin-bottom: 5%">
        <div class="col-3">
            <a href="{{url("/")}}" class="btn btn-success text-center form-control">Seguir Comprando</a>
        </div>
    </div>
</div>


@endsection