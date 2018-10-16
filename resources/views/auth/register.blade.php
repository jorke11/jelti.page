@extends('layouts.page')

@section('content')
<div class="container" style="padding-top: 20px">
    <div class="row row-center">
        @if (Session::has('error_email'))
        <div class="alert alert-danger">{{Session::get("error_email")}}, <a href="/password/reset">¿Recordar Clave?</a></div>
        @endif
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Registrate como Cliente</h3>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="row row-space">
                            <div class="col-lg-12 ">
                                <label for="business" class="control-label">Compañia</label>
                                <input class="form-control in-page" placeholder="Compañia" type="text" id="business_name" name="business_name" value="{{ old('business_name') }}">
                                @if ($errors->has('business'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('business') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-lg-6">
                                <label for="business" class="control-label">Nombre</label>
                                <input class="form-control in-page" placeholder="Nombre" type="text" name="name" id="name" required value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-lg-6">
                                <label for="business" class="control-label">Apellido</label>
                                <input class="form-control in-page" placeholder="Apellido" type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required> 
                                @if ($errors->has('last_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="row row-space">
                            <div class="col-lg-8">
                                <label for="business" class="control-label">Nit</label>
                                <input class="form-control in-page input-number" placeholder="Nit" type="text" name="document_client" id="document_client" value="{{ old('document_client') }}" required> 
                                <span class="help-block has-error">
                                    @if ($errors->has('document'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('document') }}</strong>
                                    </span>
                                    @endif
                                </span>
                            </div>

                            <div class="col-lg-4">
                                <label for="business" class="control-label">Verifcación</label>
                                <input class="form-control in-page input-number" placeholder="Vericación" type="text" name="verification" id="verification" value="{{ old('verification') }}" required maxlength="1"> 
                                <span class="help-block has-error">
                                    @if ($errors->has('verification'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('verification') }}</strong>
                                    </span>
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-lg-12">
                                <label for="business" class="control-label">Email</label>
                                <input class="form-control in-page" placeholder="Email" type="email" name="email" id="email" required value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-lg-12">
                                <label for="business" class="control-label">Celular de contacto</label>
                                <input class="form-control in-page input-number" placeholder="Celular" type="text" name="phone" id="phone" required value="{{ old('phone') }}">
                                @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrase
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
