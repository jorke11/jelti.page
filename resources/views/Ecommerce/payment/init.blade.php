@extends('layouts.page')
@section('content')

<!--<div class="row" style="padding-bottom: 2%">
    <div class="col-lg-12" style="padding: 0;">
        <img src="http://via.placeholder.com/2000x100" class="img-responsive">
    </div>
</div>-->

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

{!! Form::open(['id'=>'frmPayment','url'=>'payment/target']) !!}

<p style="background:url(https://maf.pagosonline.net/ws/fp?id={{$deviceSessionId_concat}})"></p>

<!--<img src="https://maf.pagosonline.net/ws/fp/clear.png?id={{$deviceSessionId_concat}}">-->
<script src="https://maf.pagosonline.net/ws/fp/check.js?id={{$deviceSessionId_concat}}"></script>
<object type="application/x-shockwave-flash" data="https://maf.pagosonline.net/ws/fp/fp.swf?id={{$deviceSessionId_concat}}" width="1" height="1" id="thm_fp">
    <param name="movie" value="https://maf.pagosonline.net/ws/fp/fp.swf?id={{$deviceSessionId_concat}}" />
</object>

<input id="order_id" name="order_id" type="hidden" value='{{$id}}'>
@if(Session::has('error'))
<div class="row justify-content-center align-items-center">
    <div class="col-lg-4">
        <div class="alert alert-danger">{{Session::get('error')}}</div>
    </div>
</div>
@endif

<div class="container-fluid">
    <div class="row d-none" id="message-mount" >
        <div class=" col-lg-offset-2 col-lg-10">
            <div class="alert alert-danger">El monto total debe ser Mayor a $10.000 Pesos</div>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row justify-content-center align-items-center" style="padding-bottom: 5%">
                        <div class="col-11">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <input type="hidden" value="{{$deviceSessionId}}" name="devicesessionid">

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="tgarjeta">Subtotal</label>
                                                <input type="text" class="form-control form-control-sm input input-payment input-number" id="subtotal" value="{{$subtotal}}" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="tgarjeta">Total a Pagar</label>
                                                <input type="text" class="form-control form-control-sm input input-payment input-number" id="total" value="{{$total}}" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="tgarjeta">Cliente</label>
                                                <input type="text" class="form-control form-control-sm input input-payment input-number" id="client" value="{{$client->business}}" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="tgarjeta">Documento</label>
                                                <input type="text" class="form-control form-control-sm input input-payment input-number" id="document" value="{{$client->document}}" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="tgarjeta">Pais</label>
                                                <select class="form-control form-control-sm" id="country_id" name="country_id" readonly>
                                                    @foreach($countries as $val)
                                                    <option value="{{$val["code"]}}">{{$val["description"]}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="tgarjeta">Dirección Envio</label>
                                                <input type="text" class="form-control form-control-sm input input-payment input-number" id="address_send" value="{{$client->address_send}}" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="tgarjeta">Dirección Facturacion</label>
                                                <input type="text" class="form-control form-control-sm input input-payment input-number" id="address_invoice" value="{{$client->address_invoice}}" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="tgarjeta">Tarjeta de Credito</label>
                                                <input type="text" class="form-control form-control-sm input input-payment input-number" id="number" name="number" 
                                                       placeholder="Numero de tarjeta" maxlength="16" required autocomplete="off" value="{{Session::get('number')}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="tgarjeta">Nombre como aparece en la tarjeta</label>
                                                <input type="text" class="form-control form-control-sm input input-payment input-alpha" id="name_card" name="name_card" placeholder="Nombre como aparece en la tarjeta" required autocomplete="off" maxlength="150"
                                                       value="{{Session::get('name_card')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="tgarjeta">Fecha de vencimiento</label>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <select class="form-control form-control-sm" id="month" name="month">
                                                            @foreach($month as $val)
                                                            <option value="{{$val}}">{{$val}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <select class="form-control form-control-sm" id="year" name="year">
                                                            @foreach($years as $val)
                                                            <option value="{{$val}}">{{$val}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row-space">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="tgarjeta">Código de Seguridad</label>
                                                <input type="text" class="form-control input-number form-control-sm" id="crc" name="crc" placeholder="Código de Seguridad" maxlength="3" required autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="tgarjeta">Coutas</label>
                                                <select id="dues" name="dues" class="form-control form-control-sm">
                                                    <option value="1">1</option>
                                                    @for($i=2;$i<=36;$i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <img src="{{url("images/visa.png")}}" class="img-fluid d-xs-none" id="imgCard">
                                        </div>
                                    </div>
                                    <div class="row row-space">
                                        <div class="col-lg-6">
                                            <input type="checkbox" id="checkbuyer" name="checkbuyer" checked=""> ¿Deseas que la informacion del pagador sea la misma?
                                        </div>
                                    </div>

                                    <div id="divaddpayer" class="d-none">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="tgarjeta">Nombre Completo</label>
                                                    <input type="text" class="form-control input input-payment input-alpha input-extern form-control-sm" id="name_buyer" name="name_buyer" placeholder="Nombre Completo" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="tgarjeta">Documento</label>
                                                    <input type="text" class="form-control input input-payment input-number input-extern form-control-sm" id="document_buyer" name="document_buyer" placeholder="Numeo de Documento" autocomplete="off" maxlength="15">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="tgarjeta">Departamento</label>
                                                    <select class="form-control input-departure input-extern form-control-sm" id="department_buyer_id" name='department_buyer_id' width="100%" data-api="/api/getDepartment">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="email">Ciudad Origen:</label>
                                                    <select class="form-control input-departure input-extern form-control-sm" id="city_buyer_id" name='city_buyer_id' width="100%">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="tgarjeta">Direccion</label>
                                                    <input type="text" class="form-control input input-payment input-extern form-control-sm" id="addrees_buyer" name="addrees_buyer" placeholder="Dirección" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="tgarjeta">Email</label>
                                                    <input type="text" class="form-control input input-payment input-extern form-control-sm" id="email_buyer" name="email_buyer" placeholder="Email" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="tgarjeta">Telefono de contacto</label>
                                                    <input type="text" class="form-control input input-payment  input-number input-extern form-control-sm" id="phone_buyer" name="phone_buyer" placeholder="Telefono de contacto" maxlength="16" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-footer">
                                    <div class="row">
                                        <div class="col-4">
                                            <button type="submit" id="btnPayU" class="btn btn-success form-control btn-sm">Pagar Con Tarjeta Credito</button>
                                        </div>
                                        <div class="col-4">
                                            @if($term>1)
                                            <button type="button" class="btn btn-info form-control" id="btnPay">
                                                <span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>({{$term}}) días Credito SuperFuds
                                            </button>
                                            @endif
                                        </div>
                                        <div class="col-4">
                                            <button type="button" class="btn btn-info form-control" id="btnPSE">
                                                <span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>PSE
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <div class="col-5" >
            <div class="row row-space">
                <div class="col-12">
                    <div id="content-detail" >
                    </div>
                </div>
            </div>
            <div class="row" style="padding-top: 10px">
                <div class="col-10 offset-1">
                    <button class="btn btn-info d-none" type="button" id="btnShowAll">Ver todo
                        <svg id="i-chevron-bottom" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M30 12 L16 24 2 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <!--            <div class="row" style="padding-top: 10px">
                            <div class="col-1">
                                <p>Total</p>
                            </div>
                        </div>-->

        </div>
    </div>
</div>
{!!Form::close()!!}
{!!Html::script('js/Ecommerce/Payment.js')!!}
@endsection