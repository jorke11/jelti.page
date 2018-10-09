@extends('layouts.page')
@section('content')

<style>
    .wizard {
        margin: 20px auto;
        background: #fff;
    }

    .wizard .nav-tabs {
        position: relative;
        margin: 40px auto;
        margin-bottom: 0;
        border-bottom-color: #e0e0e0;
    }

    .wizard > div.wizard-inner {
        position: relative;
    }

    .connecting-line {
        height: 2px;
        background: #e0e0e0;
        position: absolute;
        width: 80%;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: 50%;
        z-index: 1;
    }

    .wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
        color: #555555;
        cursor: default;
        border: 0;
        border-bottom-color: transparent;
    }

    span.round-tab {
        width: 70px;
        height: 70px;
        line-height: 70px;
        display: inline-block;
        border-radius: 100px;
        background: #fff;
        border: 2px solid #e0e0e0;
        z-index: 2;
        /*position: absolute;*/
        left: 0;
        text-align: center;
        font-size: 25px;
    }
    span.round-tab i{
        color:#555555;
    }
    #menu-list li.active span.round-tab {
        background: #fff;
        border: 3px solid rgba(91,175,152,1);

    }
    .wizard li.active span.round-tab i{
        color: #5bc0de;
    }

    span.round-tab:hover {
        color: #333;
        border: 2px solid #333;
    }

    .wizard .nav-tabs > li {
        width: 25%;
    }

    .wizard li:after {
        content: " ";
        position: absolute;
        left: 46%;
        opacity: 0;
        margin: 0 auto;
        bottom: 0px;
        border: 5px solid transparent;
        border-bottom-color: #5bc0de;
        transition: 0.1s ease-in-out;
    }

    .wizard li.active:after {
        content: " ";
        position: absolute;
        left: 46%;
        opacity: 1;
        margin: 0 auto;
        bottom: 0px;
        border: 10px solid transparent;
        border-bottom-color: #5bc0de;
    }

    .wizard .nav-tabs > li a {
        width: 70px;
        height: 70px;
        margin: 20px auto;
        border-radius: 100%;
        padding: 0;
    }

    .wizard .nav-tabs > li a:hover {
        background: transparent;
    }

    .wizard .tab-pane {
        position: relative;
        padding-top: 50px;
    }

    .wizard h3 {
        margin-top: 0;
    }

    @media( max-width : 585px ) {

        .wizard {
            width: 90%;
            height: auto !important;
        }

        span.round-tab {
            font-size: 16px;
            width: 50px;
            height: 50px;
            line-height: 50px;
        }

        .wizard .nav-tabs > li a {
            width: 50px;
            height: 50px;
            line-height: 50px;
        }

        .wizard li.active:after {
            content: " ";
            position: absolute;
            left: 35%;
        }
    }
</style>


<div class="container-fluid">
    @if(Session::has("status"))
    <div class="row row-center" >
        <div class="col-5">
            <div class="alert alert-success">{{Session::get("status")}}</div>
        </div>
    </div>
    @endif
    @if(Session::has("error"))
    <div class="row row-center" >
        <div class="col-5">
            <div class="alert alert-warning">{{Session::get("error")}}</div>
        </div>
    </div>
    @endif
    @if(Session::has("error_profile"))
    <div class="row row-center" >
        <div class="col-5">
            <div class="alert alert-warning">{{Session::get("error_profile")}}</div>
        </div>
    </div>
    @endif

    <div class="row row-center">
        <div class="col-6" style="padding-left: 3%">
            <div class="progress" id="progress-info">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="info-complete">
                    0%
                </div>
            </div>
        </div>
    </div>

    <div class="row row-center">
        <div class="col-6" id="form-input">
            <div class="card">
                <div class="card-body">
                    <div class="row row-center" style="padding-bottom: 3%">
                        <div class="col-6">
                            <ul class="nav nav-tabs" role="tablist" id="menu-list">
                                <li role="presentation" class="active" id="circle-user">
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1" id="tab-user">
                                        <span class="round-tab">
                                            <svg id="i-user" viewBox="0 0 32 32" width="32" color="rgba(91,175,152,1);" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                            <path d="M22 11 C22 16 19 20 16 20 13 20 10 16 10 11 10 6 12 3 16 3 20 3 22 6 22 11 Z M4 30 L28 30 C28 21 22 20 16 20 10 20 4 21 4 30 Z" />
                                            </svg>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled" style="padding-left: 60%" id="circle-doc" >
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2" id="tab-doc">
                                        <span class="round-tab">
                                            <svg id="i-file" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                            <path d="M6 2 L6 30 26 30 26 10 18 2 Z M18 2 L18 10 26 10" />
                                            </svg>  
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {!! Form::open(['id'=>'frmProfile','url' => 'profile/update','method'=>"PUT","novalidate"]) !!}
                    <input type="hidden" value="" id="id" name="id" class="form-profile">
                    <input type="hidden" value="{{$redirect}}" name="redirect">
                    <h5 class="card-title text-center">Información personal</h5>

                    <div class="row" id="step1">
                        <div class="col-12">
                            <div class="row" style="padding-top: 20px">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Razon social *</label>
                                        <input type="text" class="form-control form-profile" value="" id="business_name" name="business_name"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tipo de Documento *</label>
                                        <select name="sector_id" id="type_document_id" name="type_document_id" class="form-control form-profile" disabled></select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Documento *</label>
                                        <input type="text" class="form-control form-profile input-number" value="" id="document" name="document" disabled/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tipo de Persona *</label>
                                        <select name="type_person_id" id="type_person_id" class="form-control form-profile" required></select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tipo Regimen *</label>
                                        <select name="type_regime_id" id="type_regime_id" class="form-control form-profile" required></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Sector *</label>
                                        <select name="sector_id" id="sector_id" name="sector_id" class="form-control form-profile" required></select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Telefono *</label>
                                        <input type="tel" class="form-control form-profile input-number" value="" id="phone" name="phone" required=""
                                                pattern="[0-9]"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nombre Contacto</label>
                                        <input type="text" class="form-control form-profile" value="" id="contact" name="contact"/>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Telefono contacto</label>
                                        <input type="text" class="form-control form-profile" value="" id="phone_contact" name="phone_contact"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ciudad de Envio *</label>
                                        <select class="form-control form-profile" id="city_id" name='city_id' width="100%" data-api="/api/getCity" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Direccion de Envio *</label>
                                        <input type="text" class="form-control form-profile" value="" id="address_send" name="address_send" required="" required/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Copiar dirección de envio a facturación</label>
                                        <input type="checkbox" id="copy-info" name="copy-info">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ciudad de Facturacion *</label>
                                        <select class="form-control form-profile" id="invoice_city_id" name='invoice_city_id' width="100%" data-api="/api/getCity" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Direccion de Facturacion *</label>
                                        <input type="text" class="form-control form-profile" value="" id="address_invoice" name="address_invoice" required/>
                                    </div>
                                </div>
                            </div>     
                            <button class="card-link btn btn-info" type="button" style="float:right" id="btn-next">Continuar >></button>
                        </div>
                    </div>

                    <div class="row d-none"id="step2">
                        <div class="col-12">
                            <h2>Documentos 
                                <button class="btn btn-info btn-sm" id="btn-show-upload" type="button">
                                    <svg id="i-upload" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <path d="M9 22 C0 23 1 12 9 13 6 2 23 2 22 10 32 7 32 23 23 22 M11 18 L16 14 21 18 M16 14 L16 29" />
                                    </svg>
                                </button></h2>
                            <table class="table table-condensed table-bordered" id="table-documents">
                                <thead>
                                    <tr>
                                        <th>Documento</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <button class="card-link btn btn-info d-none" style="float:right" id="btn-end" type="submit">Finalizar</button>

                    {!!Form::close()!!}
                </div>
            </div>
        </div>

    </div>
</div>
@include("Administration.Profile.modalUpload")
{!!Html::script('js/Ecommerce/Profile.js')!!}
@endsection