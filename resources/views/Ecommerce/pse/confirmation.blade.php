@extends('layouts.page')
@section('content')

<style>
    .card{
        -webkit-box-shadow: -9px 8px 12px -2px rgba(0,0,0,0.25);
        -moz-box-shadow: -9px 8px 12px -2px rgba(0,0,0,0.25);
        box-shadow: -9px 8px 12px -2px rgba(0,0,0,0.25);
        border-radius:10px;
        margin-bottom: 3%;
        margin-left: 2%
    }
</style>

{!! Form::open(['id'=>'frmPayment','url'=>'payment/pse']) !!}


@if(Session::has('error'))
<div class="row justify-content-center align-items-center">
    <div class="col-lg-4">
        <div class="alert alert-danger">{{Session::get('error')}}</div>
    </div>
</div>
@endif

<div class="container-fluid" style="padding-top: 40px">
    <div class="row row-center">
            <?php
            $color="";
            if($data["transactionState"]==4){
                $color="success";
            }else if($data["transactionState"]==7){
                    $color="warning";
                }else if($data["transactionState"]==6){
                    $color="danger";
                }
                ?>
        <div class="col-lg-7 justify-content-center align-items-center">
        <div class="alert alert-{{$color}}">{{$data["message"]}}</div>
        </div>
    </div>
    <div class="row row-center">

        <div class="col-lg-7 justify-content-center align-items-center">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row justify-content-center align-items-center" style="padding-bottom: 5%">
                        <div class="col-12">                          
                            <table class="table">
                                        <thead>
                                            <tr ><th colspan="2">Resultados de la operación </th></tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width="50%">Empresa</td>
                                                <td>Superfuds S.A.S</td>
                                            </tr>
                                            <tr>
                                                <td>Nit</td>
                                                <td>900703907-7</td>
                                            </tr>
                                            <tr>
                                                <td>Fecha</td>
                                                <td>{{date("d-m-Y")}}</td>
                                            </tr>
                                            <tr>
                                                <td>Estado</td>
                                                <td>{{$data["state"]}}</td>
                                            </tr>
                                            <tr>
                                                <td>Referencia de pedido</td>
                                                <td>{{$data["referenceCode"]}}</td>
                                            </tr>
                                            <tr>
                                                <td>Referencia de Transacción</td>
                                                <td>{{$data["transactionId"]}}</td>
                                            </tr>
                                            <tr>
                                                <td>Número Transacción / CUS</td>
                                                <td>{{$data["cus"]}}</td>
                                            </tr>
                                            <tr>
                                                <td>Banco</td>
                                                <td>{{$data["pseBank"]}}</td>
                                            </tr>
                                            <tr>
                                                <td>Valor</td>
                                                <td>{{$data["TX_VALUE"]}}</td>
                                            </tr>
                                            <tr>
                                                <td>Moneda</td>
                                                <td>{{$data["currency"]}}</td>
                                            </tr>
                                            <tr>
                                                <td>Descripción</td>
                                                <td>{{$data["description"]}}</td>
                                            </tr>
                                            <tr>
                                                <td>Ip origin</td>
                                                <td>{{$data["pseReference1"]}}</td>
                                            </tr>
                                            <tr>
                                                <?php
                                                    if($data["transactionState"]!=4){
                                                        ?>
                                                        <td><a href="/pse" class="btn btn-info">Reintentar Transacción</a></td>
                                                        <?php
                                                    }
                                                    ?>
                                                <td><a href="/finish-payment?transactionId={{$data["transactionId"]}}" class="btn btn-success">Finalizar Transacción</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                        </div>
                    </div>
                    <div class="row row-center justify-content-center align-items-center" style="padding-bottom: 5%">
                            <div class="col-3">
                                <a 
                                href="/voucher?referenceCode={{$data["referenceCode"]}}&transactionId={{$data["transactionId"]}}&cus={{$data["cus"]}}
                                &pseBank={{$data["pseBank"]}}&TX_VALUE={{$data["TX_VALUE"]}}&currency={{$data["currency"]}}
                                &description={{$data["description"]}}&pseReference1={{$data["pseReference1"]}}&polTransactionState={{$data["polTransactionState"]}}
                                &polResponseCode={{$data["polResponseCode"]}}" 
                                target="_blank" class="btn btn-info">Imprimir comprobante</a>
                            </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>

{!!Form::close()!!}
@endsection