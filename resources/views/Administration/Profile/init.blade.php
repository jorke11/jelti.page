@extends('layouts.page')
@section('content')

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

    <div class="row">
        <div class="col-6" style="padding-left: 3%">
            <div class="progress" id="progress-info">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="info-complete">
                    0%
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6" id="form-info">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Información personal</h5>
                    <button class="btn btn-info" id="btn-edit">Editar</button>

                    <div class="row" style="padding-top: 20px">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Razon social *</label>
                                <span class="form-control form-label" name="business_name"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tipo de Documento *</label>
                                <span class="form-control form-label" name="type_document"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Documento *</label>
                                <span class="form-control form-label" name="document"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tipo de Persona *</label>
                                <span class="form-control form-label" name="typeperson"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tipo Regimen *</label>
                                <span class="form-control form-label" name="typeregime"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sector *</label>
                                <span class="form-control form-label" name="sector"></span>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Telefono *</label>
                                <span class="form-control form-label" name="phone"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre Contacto</label>
                                <span class="form-control form-label" name="contact"></span>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Telefono contacto</label>
                                <span class="form-control form-label" name="phone_contact"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ciudad de Envio *</label>
                                <span class="form-control form-label" name="city"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Direccion de Envio *</label>
                                <span class="form-control form-label" name="address"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ciudad de Facturacion *</label>
                                <span class="form-control form-label" name="city_invoice"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Direccion de Facturacion *</label>
                                <span class="form-control form-label" name="address_invoice"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 d-none" id="form-input">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['id'=>'frmProfile','url' => 'profile/update','method'=>"PUT"]) !!}
                    <input type="hidden" value="" id="id" name="id" class="form-profile">
                    <h5 class="card-title">Información personal</h5>
                    <button class="card-link btn btn-success">Guardar</button>

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
                                <select name="sector_id" id="type_document_id" name="type_document_id" class="form-control form-profile"></select>
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
                                <select name="sector_id" id="sector_id" name="sector_id" class="form-control form-profile"></select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Telefono *</label>
                                <input type="text" class="form-control form-profile" value="" id="phone" name="phone" required=""/>
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
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-12">
                    <h2>Documentos 
                        <button class="btn btn-info btn-sm" id="btn-show-upload">
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

        </div>
    </div>
</div>
@include("Administration.Profile.modalUpload")
{!!Html::script('js/Ecommerce/Profile.js')!!}
@endsection