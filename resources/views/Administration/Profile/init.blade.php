@extends('layouts.page')
@section('content')

<div class="container-fluid">
    <div class="row row-center">
        <div class="col-6" id="form-info">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Información personal</h5>
                    <button class="btn btn-info" id="btn-edit">Editar</button>
                    
                    <div class="row" style="padding-top: 20px">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Razon social</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tipo de Documento</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Documento</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tipo de Persona</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tipo Regimen</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ciudad</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Telefono</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sector</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pagina Web</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre Contacto</label>
                                <span class="form-control"></span>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Telefono contacto</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ciudad de Envio</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Direccion de Envio</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ciudad de Facturacion</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Direccion de Facturacion</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 d-none" id="form-input">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['id'=>'frmProfile']) !!}
                    <input type="hidden" value="" id="id" name="id">
                    <h5 class="card-title">Información personal</h5>
                    <a href="#" class="card-link btn btn-success">Guardar</a>

                    <div class="row" style="padding-top: 20px">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Razon social</label>
                                <input type="text" class="form-control" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tipo de Documento</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Documento</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tipo de Persona</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tipo Regimen</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ciudad</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Telefono</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sector</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pagina Web</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre Contacto</label>
                                <span class="form-control"></span>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Telefono contacto</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ciudad de Envio</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Direccion de Envio</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ciudad de Facturacion</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Direccion de Facturacion</label>
                                <span class="form-control"></span>
                            </div>
                        </div>
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
{!!Html::script('js/Ecommerce/Profile.js')!!}
@endsection