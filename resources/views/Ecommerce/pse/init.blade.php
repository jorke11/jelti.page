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

<p style="background:url(https://maf.pagosonline.net/ws/fp?id={{$deviceSessionId_concat}})"></p>

<!--<img src="https://maf.pagosonline.net/ws/fp/clear.png?id={{$deviceSessionId_concat}}">-->
<script src="https://maf.pagosonline.net/ws/fp/check.js?id={{$deviceSessionId_concat}}"></script>
<object type="application/x-shockwave-flash" data="https://maf.pagosonline.net/ws/fp/fp.swf?id={{$deviceSessionId_concat}}" width="1" height="1" id="thm_fp">
    <param name="movie" value="https://maf.pagosonline.net/ws/fp/fp.swf?id={{$deviceSessionId_concat}}" />
</object>


@if(Session::has('error'))
<div class="row justify-content-center align-items-center">
    <div class="col-lg-4">
        <div class="alert alert-danger">{{Session::get('error')}}</div>
    </div>
</div>
@endif
<input type="hidden" value="{{$deviceSessionId}}" name="devicesessionid">

<div class="container-fluid" style="padding-top: 40px">
    <div class="row d-none" id="message-mount" >
        <div class=" col-lg-offset-2 col-lg-10">
            <div class="alert alert-danger">El monto total debe ser Mayor a $10.000 Pesos</div>
        </div>
    </div>
   
    <div class="row pt-3">

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row justify-content-center align-items-center" style="padding-bottom: 5%">
                        <div class="col-11">
                            <div class="panel panel-default">
                                <div class="panel-body">

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
                                                <input type="text" class="form-control form-control-sm input input-payment input-number" id="document_view" value="{{$client->document}}" readonly="">
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
                                                <label for="tgarjeta">Banco *</label>
                                                <select id="bank" name="bank" class="form-control form-control-sm" required="">
                                                    @foreach($banks as $val)
                                                    <option value="{{$val["pseCode"]}}">{{$val["description"]}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="tgarjeta">Nombre del títular *</label>
                                                <input type="text" class="form-control form-control-sm input input-payment input-alpha" id="name_headline" name="name_headline" placeholder="Nombre del títular" required autocomplete="off" maxlength="150"
                                                       value="{{Session::get('name_headline')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="tgarjeta">Tipo de Cliente *</label>
                                                <select class="form-control form-control-sm" id="type_client" name="type_client">
                                                    <option value="0">Seleccione</option>
                                                    @foreach($type_client as $val)
                                                    <option value="{{$val["id"]}}">{{$val["description"]}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="form-group">
                                                        <label for="tgarjeta">Tipo Documento</label>
                                                        <select class="form-control form-control-sm" id="type_document" name="type_document">
                                                            <option value="0">Seleccione</option>
                                                            @foreach($type_document as $val)
                                                            <option value="{{$val["id"]}}">{{$val["description"]}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <div class="form-group">
                                                        <label for="tgarjeta">Documento de Identificación</label>
                                                        <input type="text" class="form-control input input-payment input-number form-control-sm" id="document" name="document" placeholder="Documento de Identificación"
                                                               value="{{Session::get('document')}}">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row row-space">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="tgarjeta">Telefono</label>
                                                <input type="text" class="form-control input input-payment input-number form-control-sm" id="phone_headline" name="phone_headline" data="numbet" placeholder="Telefono" maxlength="10">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-footer">
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="submit" id="btnPayU" class="btn btn-success form-control btn-sm">Pagar</button>
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

        </div>
    </div>
    
     <div class="row row-space">
        <div class="col-1 justify-content-center center-image">
            <img src="/images/logo-pse.png" class="img-responsive" >
        </div>
    </div>

</div>
{!!Form::close()!!}

{!!Html::script('js/Ecommerce/Pse.js')!!}
@endsection