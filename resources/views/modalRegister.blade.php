@if($errors->any() && Session::has("type_stakeholder")==1)
<script>
    $(function () {
        $("#myModal").modal("show")
    })
</script>
@endif

<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" style="background-color: rgba(255,255,255,.8) !important;padding-top: 7%;">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: rgba(249,247,246,.9) !important;border: 3px solid #ffffff;border-radius: 20px;">

            <div class="modal-body">
                <div class="container-fluid">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}" id='frmLandingPage'>
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-12">
                                <div class="row row-space">
                                    <div class="col-12">
                                        <p style="color:#5c5c5b;font-size:25px;font-weight: 100" class="text-center">Registrate como</p>
                                    </div>
                                </div>
                                <div class="row row-space justify-content-center">
                                    <div class="col-12">
                                        <div class="row text-center">
                                            <div class="col-6 title-green" onclick="objCounter.stakeholder(1, this)" id="title-business" style="cursor:pointer">Comprador</div>
                                            <div class="col-6" onclick="objCounter.stakeholder(2, this)" id="title-supplier" style="cursor:pointer">Proveedor</div>
                                            <input type="hidden" id="type_stakeholder" name="type_stakeholder" class="in-page">
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-space">
                                    <div class="col-lg-12 ">
                                        <label for="business" class="control-label">Compañia</label>
                                        <input class="form-control in-page" placeholder="Compañia" type="text" id="business" name="business" value="{{ old('business') }}">
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
                                        @if ($errors->has('phone_contact'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone_contact') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row row-space d-none" id="field_make">
                                    <div class="col-lg-12">
                                        <textarea class="form-control in-page" placeholder="Cuentanos que a que te dedicas?" name="what_make" id="what_make"></textarea>
                                    </div>
                                </div>
                                <div class="row row-space">
                                    <div class="col-lg-12">
                                        <input type="checkbox" name="agree" id="agree" class="in-page" required checked="{{ old('agree') }}"><span style="color:#5c5c5b"> Acepto términos de servicio | Leer mas</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-outline-success my-2 my-sm-0 btn-sm" id="register" type="button">Registrate</button>
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
