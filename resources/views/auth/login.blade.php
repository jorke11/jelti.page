@extends('layouts.app')

@section('content')
<style>
    .btn-login{
        border-bottom-left-radius: 1em 1em 1em 1em;width: 100% !important;
        border: 0 !important;  
        background: rgba(241,111,92,1) !important;
        background: -moz-linear-gradient(top, rgba(241,111,92,1) 0%, rgba(246,41,12,1) 0%, rgba(231,56,39,1) 0%, rgba(52,205,159,1) 0%, rgba(142,222,174,1) 49%, rgba(142,222,174,1) 100%) !important;
        background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(241,111,92,1)), color-stop(0%, rgba(246,41,12,1)), color-stop(0%, rgba(231,56,39,1)), color-stop(0%, rgba(52,205,159,1)), color-stop(49%, rgba(142,222,174,1)), color-stop(100%, rgba(142,222,174,1))) !important;
        background: -webkit-linear-gradient(top, rgba(241,111,92,1) 0%, rgba(246,41,12,1) 0%, rgba(231,56,39,1) 0%, rgba(52,205,159,1) 0%, rgba(142,222,174,1) 49%, rgba(142,222,174,1) 100%) !important;
        background: -o-linear-gradient(top, rgba(241,111,92,1) 0%, rgba(246,41,12,1) 0%, rgba(231,56,39,1) 0%, rgba(52,205,159,1) 0%, rgba(142,222,174,1) 49%, rgba(142,222,174,1) 100%) !important;
        background: -ms-linear-gradient(top, rgba(241,111,92,1) 0%, rgba(246,41,12,1) 0%, rgba(231,56,39,1) 0%, rgba(52,205,159,1) 0%, rgba(142,222,174,1) 49%, rgba(142,222,174,1) 100%) !important;
        -webkit-transition: all 0.3s ease-in-out !important;
        -moz-transition: all 0.3s ease-in-out !important;
        transition: all 0.3s ease-in-out !important;
    }
    .btn-login:hover{
        background-color: #ffffff !important;
        background: #ffffff !important;
        color: #00c98a! important;
        border: 1px solid #00c98a !important;
    }

</style>
<div class="container" >
    <div class="row" style="padding-top: 10% ;">
        <div class="col-10 col-md-offset-1">
            <div class="panel panel-default" style="background-image: url({{ asset('assets/images/curva.png') }});background-repeat:  no-repeat;border-radius:20px;background-size: auto 100%">
                <div class="panel-body" >
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <div class="row" style="padding-left: 70px;padding-top: 80px;padding-bottom: 30px;">
                            <div class="col-4 col-md-4">
                                <div class="row row-center">
                                    <div class="col-12 col-sm-12 ">
                                        <a href="/" >
                                            <img  src="{{ url('images/page/logosuperf.svg') }}" style="width: 50%" class="center-block">
                                        </a>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <p class="text-center" style="color:white ">ó conectate con nososotros</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4">
                                        <a href="https://www.facebook.com/superfuds/">
                                            <img  src="/images/page/facebook.svg" class="center-block">
                                        </a>
                                    </div>
                                    <div class="col-4 col-md-4">
                                        <a href="https://co.pinterest.com/superfuds/">
                                            <img  src="/images/page/pinterest.svg" class="center-block">
                                        </a>
                                    </div>
                                    <div class="col-4 col-md-4">
                                        <a href="https://www.instagram.com/superfuds/?hl=es-la">
                                            <img  src="/images/page/instagram.png" class="center-block">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-md-offset-2 col-lg-offset-2">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class=" control-label" style='color:rgba(0,0,0,0.8);font-family:"helvetica";font-weight: 600;font-size: 18px'>Correo</label>

                                    <!--<div class="col-md-7">-->
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus 
                                           style="border: 1px solid #ccc">

                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                    <!--</div>-->
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="control-label" style='color:rgba(0,0,0,0.8);font-family:"helvetica";font-weight: 600;font-size: 18px'>Clave</label>

                                    <!--<div class="col-md-7">-->
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                    <!--</div>-->
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6" style="padding-left: 0">
                                        <button type="submit" class="btn btn-success btn-login">
                                            Iniciar Sesion
                                        </button>
                                    </div>
                                    <div class="col-md-6" style="padding-right: 0">
                                        <button type="submit" class="btn" 
                                                style="background-color: transparent; border: 1px solid #5cb19a;color:rgba(0,0,0,0.8);width: 100%;">
                                            Registrarse
                                        </button>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12" style="padding-left: 0">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" style="opacity: 0.5;filter:  alpha(opacity=20);border:1px solid #59D3AD" name="remember" {{ old('remember') ? 'checked' : ''}}> <span style="color:#59D3AD;">Recordarme</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12" style="padding-left: 0">
                                        <a class="btn btn-link" href="{{ url('/password/reset') }}" style="padding-left: 0;color:#59D3AD">
                                            Olvidaste tu Clave?
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
