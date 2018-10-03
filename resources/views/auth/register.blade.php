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

                        <div class="form-group{{ $errors->has('business_name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Compañia</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="business_name" value="{{ old('business_name') }}" required autofocus>

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Apellido</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('document') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nit</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control input-number" name="document" value="{{ old('document') }}" required autofocus>

                                @if ($errors->has('document'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('document') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <!--                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                    <label for="password" class="col-md-4 control-label">Password</label>
                        
                                                    <div class="col-md-6">
                                                        <input id="password" type="password" class="form-control" name="password" required>
                        
                                                        @if ($errors->has('password'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                        
                                                <div class="form-group">
                                                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                                                    <div class="col-md-6">
                                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                                    </div>
                                                </div>-->

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
