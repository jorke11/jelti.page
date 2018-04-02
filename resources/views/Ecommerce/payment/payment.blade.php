@extends('layouts.client')
@section('content')

{!! Form::open(['id'=>'frm','url'=>'payment/target']) !!}
<input id="order_id" name="order_id" type="hidden" value='{{$id}}'>
@if(Session::has('error'))
<div class="row row-center">
    <div class="col-lg-4">
        <div class="alert alert-danger">{{Session::get('error')}}</div>
    </div>
</div>
@endif


<p style="background:url(https://maf.pagosonline.net/ws/fp?id={{$deviceSessionId_concat}})"></p>

<img src="https://maf.pagosonline.net/ws/fp/clear.png?id={{$deviceSessionId_concat}}">
<script src="https://maf.pagosonline.net/ws/fp/check.js?id={{$deviceSessionId_concat}}"></script>
<object type="application/x-shockwave-flash" data="https://maf.pagosonline.net/ws/fp/fp.swf?id={{$deviceSessionId_concat}}" width="1" height="1" id="thm_fp">
    <param name="movie" value="https://maf.pagosonline.net/ws/fp/fp.swf?id={{$deviceSessionId_concat}}" />
</object>


<div class="row row-center" style="padding-bottom: 5%">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <input type="hidden" value="{{$deviceSessionId}}" name="devicesessionid">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="tgarjeta">Subtotal</label>
                            <input type="text" class="form-control input input-payment input-number" id="subtotal" value="{{$subtotal}}" readonly="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="tgarjeta">Total a Pagar</label>
                            <input type="text" class="form-control input input-payment input-number" id="total" value="{{$total}}" readonly="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="tgarjeta">Cliente</label>
                            <input type="text" class="form-control input input-payment input-number" id="client" value="{{$client->business}}" readonly="">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="tgarjeta">Documento</label>
                            <input type="text" class="form-control input input-payment input-number" id="document" value="{{$client->document}}" readonly="">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="tgarjeta">Pais</label>
                            <select class="form-control" id="country_id" name="country_id" readonly>
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
                            <input type="text" class="form-control input input-payment input-number" id="address_send" value="{{$client->address_send}}" readonly="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="tgarjeta">Dirección Facturacion</label>
                            <input type="text" class="form-control input input-payment input-number" id="address_invoice" value="{{$client->address_invoice}}" readonly="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="tgarjeta">Tarjeta de Credito</label>
                            <input type="text" class="form-control input input-payment input-number" id="number" name="number" placeholder="Numero de tarjeta" maxlength="16" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="tgarjeta">Nombre como aparece en la tarjeta</label>
                            <input type="text" class="form-control input input-payment input-alpha" id="name" name="name" placeholder="Nombre como aparece en la tarjeta" required autocomplete="off" maxlength="15">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="tgarjeta">Fecha de vencimiento</label>
                            <div class="row">
                                <div class="col-lg-6">
                                    <select class="form-control" id="month" name="month">
                                        @foreach($month as $val)
                                        <option value="{{$val}}">{{$val}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <select class="form-control" id="year" name="year">
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
                            <input type="text" class="form-control input-number" id="crc" name="crc" placeholder="Código de Seguridad" maxlength="3" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="tgarjeta">Coutas</label>
                            <select id="dues" name="dues" class="form-control">
                                <option value="1">1</option>
                                @for($i=2;$i<=36;$i++)
                                <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <img src="{{url("images/visa.png")}}" class="img-responsive hidden-xs" id="imgCard">
                    </div>
                </div>
                <div class="row row-space">
                    <div class="col-lg-6">
                        <input type="checkbox" id="checkbuyer" name="checkbuyer" checked=""> ¿Deseas que la informacion del pagador sea la misma?
                    </div>
                </div>

                <div id="divaddpayer" class="hide">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tgarjeta">Nombre Completo</label>
                                <input type="text" class="form-control input input-payment input-alpha input-extern" id="name_buyer" name="name_buyer" placeholder="Nombre Completo" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tgarjeta">Documento</label>
                                <input type="text" class="form-control input input-payment input-number input-extern" id="document_buyer" name="document_buyer" placeholder="Numeo de Documento" autocomplete="off" maxlength="15">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tgarjeta">Departamento</label>
                                <select class="form-control input-departure input-extern" id="department_buyer_id" name='department_buyer_id' width="100%" data-api="/api/getDepartment">
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Ciudad Origen:</label>
                                <select class="form-control input-departure input-extern" id="city_buyer_id" name='city_buyer_id' width="100%">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tgarjeta">Direccion</label>
                                <input type="text" class="form-control input input-payment input-extern" id="addrees_buyer" name="addrees_buyer" placeholder="Dirección" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tgarjeta">Email</label>
                                <input type="text" class="form-control input input-payment input-extern" id="email_buyer" name="email_buyer" placeholder="Email" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tgarjeta">Telefono de contacto</label>
                                <input type="text" class="form-control input input-payment  input-number input-extern" id="phone_buyer" name="phone_buyer" placeholder="Telefono de contacto" maxlength="16" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <button type="submit" id="btnPayment" class="btn btn-success">Pagar</button>
            </div>
        </div>
    </div>

</div>
{!!Form::close()!!}

{!!Html::script('js/Ecommerce/Methods.js')!!}
@endsection
